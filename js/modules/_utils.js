'use strict';

/**
 * Common utility functions
 */
function init() {


  // adds classes to IE and Edge
  if (this.isIE()) {
    document.documentElement.classList.add('js-browser-ie');
  }
  if (this.isEdge()) {
    document.documentElement.classList.add('js-browser-edge');
  }



  // adds class to Chrome
  if (this.isChrome()) {
    document.documentElement.classList.add('js-browser-chrome');
  }



  // adds class to Safari
  if (this.isSafari()) {
    document.documentElement.classList.add('js-browser-safari');
  }



  // adds class to iOS Safari
  if (this.isiOSSafari()) {
    document.documentElement.classList.add('js-browser-ios-safari');
  }


}



function isIE() {
  var isIE = /*@cc_on!@*/false || !!document.documentMode;
  return isIE;
}



function isEdge() {
  // Pre-webkit Edge 20+
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
  isIE: isIE,
  isEdge: isEdge,
  isChrome: isChrome,
  isSafari: isSafari,
  isiOSSafari: isiOSSafari
};
