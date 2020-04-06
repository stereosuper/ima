"use strict";function _slicedToArray(o,t){return _arrayWithHoles(o)||_iterableToArrayLimit(o,t)||_nonIterableRest()}function _arrayWithHoles(o){if(Array.isArray(o))return o}function _iterableToArrayLimit(o,t){if(Symbol.iterator in Object(o)||"[object Arguments]"===Object.prototype.toString.call(o)){var e=[],l=!0,r=!1,i=void 0;try{for(var n=o[Symbol.iterator](),s;!(l=(s=n.next()).done)&&(e.push(s.value),!t||e.length!==t);l=!0);}catch(o){r=!0,i=o}finally{try{l||null==n.return||n.return()}finally{if(r)throw i}}return e}}function _nonIterableRest(){throw new TypeError("Invalid attempt to destructure non-iterable instance")}function createCommonjsModule(o,t){return o(t={exports:{}},t.exports),t.exports}var smoothscroll=createCommonjsModule((function(o,t){!function(){function t(){function o(o){var t;return new RegExp(["MSIE ","Trident/","Edge/"].join("|")).test(o)}function t(o,t){this.scrollLeft=o,this.scrollTop=t}function e(o){return.5*(1-Math.cos(Math.PI*o))}function l(o){if(null===o||"object"!=typeof o||void 0===o.behavior||"auto"===o.behavior||"instant"===o.behavior)return!0;if("object"==typeof o&&"smooth"===o.behavior)return!1;throw new TypeError("behavior member of ScrollOptions "+o.behavior+" is not a valid value for enumeration ScrollBehavior.")}function r(o,t){return"Y"===t?o.clientHeight+y<o.scrollHeight:"X"===t?o.clientWidth+y<o.scrollWidth:void 0}function i(o,t){var e=a.getComputedStyle(o,null)["overflow"+t];return"auto"===e||"scroll"===e}function n(o){var t=r(o,"Y")&&i(o,"Y"),e=r(o,"X")&&i(o,"X");return t||e}function s(o){for(;o!==p.body&&!1===n(o);)o=o.parentNode||o.host;return o}function c(o){var t,l,r,i,n=(v()-o.startTime)/h;l=e(n=n>1?1:n),r=o.startX+(o.x-o.startX)*l,i=o.startY+(o.y-o.startY)*l,o.method.call(o.scrollable,r,i),r===o.x&&i===o.y||a.requestAnimationFrame(c.bind(a,o))}function f(o,e,l){var r,i,n,s,f=v();o===p.body?(r=a,i=a.scrollX||a.pageXOffset,n=a.scrollY||a.pageYOffset,s=d.scroll):(r=o,i=o.scrollLeft,n=o.scrollTop,s=t),c({scrollable:r,method:s,startTime:f,startX:i,startY:n,x:e,y:l})}var a=window,p=document;if(!("scrollBehavior"in p.documentElement.style&&!0!==a.__forceSmoothScrollPolyfill__)){var u=a.HTMLElement||a.Element,h=468,d={scroll:a.scroll||a.scrollTo,scrollBy:a.scrollBy,elementScroll:u.prototype.scroll||t,scrollIntoView:u.prototype.scrollIntoView},v=a.performance&&a.performance.now?a.performance.now.bind(a.performance):Date.now,y=o(a.navigator.userAgent)?1:0;a.scroll=a.scrollTo=function(o,t){void 0!==o&&(!0!==l(o)?f.call(a,p.body,void 0!==o.left?~~o.left:a.scrollX||a.pageXOffset,void 0!==o.top?~~o.top:a.scrollY||a.pageYOffset):d.scroll.call(a,void 0!==o.left?o.left:"object"!=typeof o?o:a.scrollX||a.pageXOffset,void 0!==o.top?o.top:void 0!==t?t:a.scrollY||a.pageYOffset))},a.scrollBy=function(o,t){void 0!==o&&(l(o)?d.scrollBy.call(a,void 0!==o.left?o.left:"object"!=typeof o?o:0,void 0!==o.top?o.top:void 0!==t?t:0):f.call(a,p.body,~~o.left+(a.scrollX||a.pageXOffset),~~o.top+(a.scrollY||a.pageYOffset)))},u.prototype.scroll=u.prototype.scrollTo=function(o,t){if(void 0!==o)if(!0!==l(o)){var e=o.left,r=o.top;f.call(this,this,void 0===e?this.scrollLeft:~~e,void 0===r?this.scrollTop:~~r)}else{if("number"==typeof o&&void 0===t)throw new SyntaxError("Value could not be converted");d.elementScroll.call(this,void 0!==o.left?~~o.left:"object"!=typeof o?~~o:this.scrollLeft,void 0!==o.top?~~o.top:void 0!==t?~~t:this.scrollTop)}},u.prototype.scrollBy=function(o,t){void 0!==o&&(!0!==l(o)?this.scroll({left:~~o.left+this.scrollLeft,top:~~o.top+this.scrollTop,behavior:o.behavior}):d.elementScroll.call(this,void 0!==o.left?~~o.left+this.scrollLeft:~~o+this.scrollLeft,void 0!==o.top?~~o.top+this.scrollTop:~~t+this.scrollTop))},u.prototype.scrollIntoView=function(o){if(!0!==l(o)){var t=s(this),e=t.getBoundingClientRect(),r=this.getBoundingClientRect();t!==p.body?(f.call(this,t,t.scrollLeft+r.left-e.left,t.scrollTop+r.top-e.top),"fixed"!==a.getComputedStyle(t).position&&a.scrollBy({left:e.left,top:e.top,behavior:"smooth"})):a.scrollBy({left:r.left,top:r.top,behavior:"smooth"})}else d.scrollIntoView.call(this,void 0===o||o)}}}o.exports={polyfill:t}}()})),smoothscroll_1=smoothscroll.polyfill;!function(){var o=document.getElementsByClassName("js-thumbnail");if(o.length){smoothscroll.polyfill();var t=function o(t,e){for(var l=0,r=t.length;l<r;)e(t[l],l),l+=1},e=function o(t,e){var l=e.href.indexOf("#"),r;if(l>=0){t.preventDefault();var i=e.href.slice(l+1),n,s,c=_slicedToArray(document.getElementsByClassName(i),1)[0];if(c){var f,a=c.getBoundingClientRect().top,p=(window.scrollY||window.pageYOffset)+a;window.scroll({top:p,left:0,behavior:"smooth"})}}},l;(function l(){t(o,(function(o){o.addEventListener("click",(function(){e(event,o)}),!1)}))})()}}();
//# sourceMappingURL=secteurs-min.js.map