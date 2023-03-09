<?php
/**
 * The base configuration for WordPress
 *
 * The wp-config.php creation script uses this file during the installation.
 * You don't have to use the web site, you can copy this file to "wp-config.php"
 * and fill in the values.
 *
 * This file contains the following configurations:
 *
 * * Database settings
 * * Secret keys
 * * Database table prefix
 * * ABSPATH
 *
 * @link https://wordpress.org/support/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'E-commerce' );

/** Database username */
define( 'DB_USER', 'root' );

/** Database password */
define( 'DB_PASSWORD', '' );

/** Database hostname */
define( 'DB_HOST', 'localhost' );

/** Database charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8mb4' );

/** The database collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', '' );

/**#@+
 * Authentication unique keys and salts.
 *
 * Change these to different unique phrases! You can generate these using
 * the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}.
 *
 * You can change these at any point in time to invalidate all existing cookies.
 * This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY',         ';!r =)x(6?0OqwmMBd/EYl]=ffO(>(bNEsM9_neenhSbFXrqe7%O3U*t1{J}6S,c' );
define( 'SECURE_AUTH_KEY',  'G:pgc,RGOv){WF.[n}EzY]>:Q;KpE7Xi1dHa*n)qY|(Di-y@&5><Ma}nSJ3JqS{Z' );
define( 'LOGGED_IN_KEY',    'u?g/3-l@ON f7?,`C.-ocyz/#fVw`h4PY#x%?-D:R3)Z6B._6]FbLJJYo$eyto8?' );
define( 'NONCE_KEY',        '*rNzP^D{ZSISUEj/rqn@rH?^-t$}]hZ!L,Zx}I >LC=D]97j0Uy0~{L3dE(a[/{P' );
define( 'AUTH_SALT',        '$Da;pP=[>h@+XC$^g.tS/0/-|[+ChP?JzeR,/Xp~ b:|WkfmyHa8v3dRMKg@mbxv' );
define( 'SECURE_AUTH_SALT', 'Oq}#lB>G7&xxTtJ>jd:%UQcPR#TReI*J#H3;VB@gYdkXf>E4{`5KBCA`:}]k9>c5' );
define( 'LOGGED_IN_SALT',   'jZ%/6.gN7U_QV2%=c^Tra9h^qrX1tHVx&=t|kwHipnlfLr<r6Voi?IDAJS/XEFzu' );
define( 'NONCE_SALT',       'rN=32tMZoi(E,UX:LAK,t`e:KT8m;18dkC}60.a3go1Vb8can0w3DxRBW?*D%nlW' );

/**#@-*/

/**
 * WordPress database table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'wp_';

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 *
 * For information on other constants that can be used for debugging,
 * visit the documentation.
 *
 * @link https://wordpress.org/support/article/debugging-in-wordpress/
 */
define( 'WP_DEBUG', false );

/* Add any custom values between this line and the "stop editing" line. */



/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
