(()=>{"use strict";var n={n:e=>{var t=e&&e.__esModule?()=>e.default:()=>e;return n.d(t,{a:t}),t},d:(e,t)=>{for(var o in t)n.o(t,o)&&!n.o(e,o)&&Object.defineProperty(e,o,{enumerable:!0,get:t[o]})},o:(n,e)=>Object.prototype.hasOwnProperty.call(n,e),r:n=>{"undefined"!=typeof Symbol&&Symbol.toStringTag&&Object.defineProperty(n,Symbol.toStringTag,{value:"Module"}),Object.defineProperty(n,"__esModule",{value:!0})}},e={};function t(n,e,t,o,r,i,u){try{var c=n[i](u),a=c.value}catch(n){return void t(n)}c.done?e(a):Promise.resolve(a).then(o,r)}n.r(e);const o=window.regeneratorRuntime;var r=n.n(o);const i=window.jQuery;var u=n.n(i);const c=window.wcPPCP.utils;var a;u()(document).on("wfocuBucketCreated",function(){var n,e=(n=r().mark((function n(e,t){var o,i;return r().wrap((function(n){for(;;)switch(n.prev=n.next){case 0:a=t,null!==(o=window)&&void 0!==o&&null!==(i=o.wfocu_vars)&&void 0!==i&&i.wcPPCPSettings&&(window.wcPPCPSettings=window.wfocu_vars.wcPPCPSettings);case 2:case"end":return n.stop()}}),n)})),function(){var e=this,o=arguments;return new Promise((function(r,i){var u=n.apply(e,o);function c(n){t(u,r,i,c,a,"next",n)}function a(n){t(u,r,i,c,a,"throw",n)}c(void 0)}))});return function(n,t){return e.apply(this,arguments)}}()),u()(document).on("wfocu_external",(function(n,e){(a=e).inOfferTransaction=!0,s().then((function(n){var e=n.redirect;window.location=e})).catch((function(n){var e,t;a.swal.show({text:null===(e=wfocu_vars)||void 0===e||null===(t=e.messages)||void 0===t?void 0:t.offer_msg_pop_failure,type:"warning"}),window.location=wfocu_vars.order_received_url}))}));var s=function(){return new Promise((function(n,e){u().ajax({method:"post",url:(0,c.getRestRoute)("funnelkit/upsell/order"),data:a.getBucketSendData()}).done((function(e){n(e)})).fail((function(n){e(n)}))}))};(this.wcPPCP=this.wcPPCP||{})["wc-ppcp-woofunnels-upsell"]=e})();
//# sourceMappingURL=wc-ppcp-woofunnels-upsell.js.map