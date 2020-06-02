'use strict';

/**
 * Common utility functions
 */
export const isIE = () => {
  var isIE = /*@cc_on!@*/false || !!document.documentMode;
  return isIE;
};


export const isEdge = () => {
  // Edge 20+
  var isEdge = !isIE() && !!window.StyleMedia;
  return isEdge;
};


export const isChrome = () => {
  var isChrome = !!window.chrome;
  return isChrome;
};


export const isSafari = () => {
  var isSafari = !!navigator.userAgent.match(/Version\/[\d\.]+.*Safari/);
  return isSafari;
};


export const isiOSSafari = () => {
  var isiOS = !!navigator.userAgent.match(/iPad/i) || !!navigator.userAgent.match(/iPhone/i);
  var isWebkit = !!navigator.userAgent.match(/WebKit/i);
  return isiOS && isWebkit;
};


export const addBrowserClasses = () => {

  // adds classes to IE and Edge
  if (isIE()) {
    document.documentElement.classList.add('js-browser-ie');
  }
  if (isEdge()) {
    document.documentElement.classList.add('js-browser-edge');
  }



  // adds class to Chrome
  if (isChrome()) {
    document.documentElement.classList.add('js-browser-chrome');
  }



  // adds class to Safari
  if (isSafari()) {
    document.documentElement.classList.add('js-browser-safari');
  }



  // adds class to iOS Safari
  if (isiOSSafari()) {
    document.documentElement.classList.add('js-browser-ios-safari');
  }

};


export const debounce = (func, ms) => {
  let timeout;
  return () => {
    clearTimeout(timeout);
    timeout = setTimeout(() => {
      timeout = null;
      func();
    }, ms);
  };
};
