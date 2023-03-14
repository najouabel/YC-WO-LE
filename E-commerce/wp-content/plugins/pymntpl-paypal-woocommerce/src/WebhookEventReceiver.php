<?php

namespace PaymentPlugins\WooCommerce\PPCP;

use PaymentPlugins\WooCommerce\PPCP\Utilities\OrderLock;
use PaymentPlugins\WooCommerce\PPCP\Utilities\PayPalFee;
use PaymentPlugins\WooCommerce\PPCP\Utilities\QueryUtil;


class WebhookEventReceiver {

	private $client;

	private $payment_handler;

	private $logger;

	public function __construct( WPPayPalClient $client, PaymentHandler $payment_handler, Logger $logger ) {
		$this->client          = $client;
		$this->payment_handler = $payment_handler;
		$this->logger          = $logger;
		$this->initialize();
	}

	private function initialize() {
		add_action( 'wc_ppcp_webhook_event_payment.capture.completed', [ $this, 'do_capture_completed' ], 10, 2 );
		add_action( 'wc_ppcp_webhook_event_payment.capture.refunded', [ $this, 'do_refund_processed' ], 10, 2 );
		add_action( 'wc_ppcp_webhook_event_customer.dispute.created', [ $this, 'do_dispute_created' ], 10, 2 );
		add_action( 'wc_ppcp_webhook_event_customer.dispute.resolved', [ $this, 'do_dispute_resolved' ], 10, 2 );
	}

	/**
	 * @param \PaymentPlugins\PayPalSDK\Capture      $capture
	 * @param \PaymentPlugins\PayPalSDK\WebhookEvent $event
	 */
	public function do_capture_completed( $capture, $event ) {
		//only process if the order doesn't have a lock
		$order = wc_get_order( $capture->custom_id );
		if ( $order && ! OrderLock::has_order_lock( $order ) ) {
			$transaction_id = $order->get_transaction_id();
			if ( ! $transaction_id ) {
				$paypal_order_id = $order->get_meta( Constants::ORDER_ID );
				if ( $paypal_order_id ) {
					$paypal_order = $this->client->orderMode( $order )->orders->retrieve( $paypal_order_id );
					if ( ! is_wp_error( $paypal_order ) ) {
						$order->payment_complete( $capture->id );
						$this->payment_handler->save_order_meta_data( $order, $paypal_order );
					} else {
						throw new \Exception( $paypal_order->get_error_message(), 400 );
					}
				}
			}
		}
	}

	/**
	 * @param \PaymentPlugins\PayPalSDK\Refund       $refund
	 * @param \PaymentPlugins\PayPalSDK\WebhookEvent $event
	 *
	 * @throws \Exception
	 */
	public function do_refund_processed( $refund, $event ) {
		if ( isset( $refund->custom_id ) ) {
			$order = wc_get_order( $refund->custom_id );
			if ( $order && ! OrderLock::has_order_lock( $order ) ) {
				$refund_id = QueryUtil::get_wc_refund_from_paypal_refund( $refund );
				// refund doesn't exist so create it
				if ( ! $refund_id ) {
					$wc_refund = wc_create_refund( [
						'amount'   => $refund->amount->value,
						'reason'   => isset( $refund->note_to_payer ) ? $refund->note_to_payer : __( 'Refund created within PayPal.', 'pymntpl-paypal-woocommerce' ),
						'order_id' => $order->get_id()
					] );
					if ( $wc_refund ) {
						// update the net amount since the refund affects that
						PayPalFee::update_net_from_refund( $refund, $order );
						$wc_refund->update_meta_data( Constants::PAYPAL_REFUND, $refund->id );
						$wc_refund->save();
						$order->add_order_note( sprintf( __( 'Order refunded in PayPal. Amount: %1$s. Refund ID: %2$s', 'pymntpl-paypal-woocommerce' ),
							wc_price( $refund->amount->value, [ 'currency' => $refund->amount->currency ] ), $refund->id ) );
					}
				}
			}
		}
	}

	public function do_dispute_created( $dispute, $event ) {
		foreach ( $dispute->disputed_transactions as $txn ) {
			$txn_id = $txn->seller_transaction_id;
			$order  = QueryUtil::get_wc_order_from_paypal_txn( $txn_id );
			if ( $order ) {
				$order->update_meta_data( Constants::DISPUTE_STATUS, $order->get_status() );
				$order->update_status( 'on-hold', sprintf( __( 'Dispute %1$s created. Dispute reason: %2$s.', 'pymntpl-paypal-woocommerce' ), $dispute->dispute_id, $dispute->reason ) );
			}
		}
	}

	public function do_dispute_resolved( $dispute, $event ) {
		foreach ( $dispute->disputed_transactions as $txn ) {
			$txn_id = $txn->seller_transaction_id;
			$order  = QueryUtil::get_wc_order_from_paypal_txn( $txn_id );
			if ( $order ) {
				$status = $order->get_meta( Constants::DISPUTE_STATUS );
				$order->delete_meta_data( Constants::DISPUTE_STATUS );
				$order->update_status( $status, sprintf( __( 'Dispute %1$s resolved.', 'pymntpl-paypal-woocommerce' ), $dispute->dispute_id ) );
			}
		}
	}

}