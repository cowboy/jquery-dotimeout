/*
 * jQuery doTimeout: Like setTimeout, but better! - v0.4 - 7/15/2009
 * http://benalman.com/projects/jquery-dotimeout-plugin/
 * 
 * Copyright (c) 2009 "Cowboy" Ben Alman
 * Dual licensed under the MIT and GPL licenses.
 * http://benalman.com/about/license/
 */
(function($){var a={},c="doTimeout",d=Array.prototype.slice;$[c]=function(){return b.apply(window,[0].concat(d.call(arguments)))};$.fn[c]=function(){var f=d.call(arguments),e=b.apply(this,[c+f[0]].concat(f));return typeof f[0]==="number"||typeof f[1]==="number"?this:e};function b(k){var l=this,g,i={},m=arguments,h=4,f=m[1],j=m[2],o=m[3];if(typeof f!=="string"){h--;f=k=0;j=m[1];o=m[2]}if(k){g=l.eq(0);g.data(k,i=g.data(k)||{})}else{if(f){i=a[f]||(a[f]={})}}i.id&&clearTimeout(i.id);delete i.id;function e(){if(k){g.removeData(k)}else{if(f){delete a[f]}}}function n(){i.id=setTimeout(function(){i.fn()},j)}if(o){i.fn=function(p){o.apply(l,d.call(m,h))&&!p?n():e()};n()}else{if(i.fn){j===undefined?e():i.fn(j===false);return true}else{e()}}}})(jQuery);