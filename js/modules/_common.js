'use strict';

/**
 * Common functions
 */
function init() {

  // jQuery.extend(...);



  // adds classes to IE and Edge
  
  if (this.isIE()) {
    $('html').addClass('js-browser-ie');
  }
  if (this.isEdge()) {
    $('html').addClass('js-browser-edge');
  }



  // adds class to Chrome
  if (this.isChrome()) {
    $('html').addClass('js-browser-chrome');
  }



  // adds class to Safari
  if (this.isSafari()) {
    $('html').addClass('js-browser-safari');
  }



  // adds class to iOS Safari
  if (this.isiOSSafari()) {
    $('html').addClass('js-browser-ios-safari');
  }


}



function isIE() {
  var isIE = /*@cc_on!@*/false || !!document.documentMode;
  return isIE;
}



function isEdge() {
  // Edge 20+
  var isEdge = !this.isIE() && !!window.StyleMedia;
  return isEdge;
}



function isChrome() {
  var isChrome = !!window.chrome;
  return isChrome;
}



function isSafari() {
  var isSafari = !!navigator.userAgent.match(/Version\/[\d\.]+.*Safari/);
  return isSafari;
}



function isiOSSafari() {
  var isiOS = !!navigator.userAgent.match(/iPad/i) || !!navigator.userAgent.match(/iPhone/i);
  var isWebkit = !!navigator.userAgent.match(/WebKit/i);
  return isiOS && isWebkit;
}


module.exports = {
  init: init,
  isiOSSafari: isiOSSafari,
  isSafari: isSafari,
  isEdge: isEdge,
  isIE: isIE,
  isChrome: isChrome
};
