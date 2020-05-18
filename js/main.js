'use strict';

document.addEventListener('DOMContentLoaded', function() {

  document.getElementsByClassName('is-page-loading')[0].classList.remove('is-page-loading');
  document.getElementsByClassName('no-js')[0].classList.remove('no-js');

  // Common functions
  const utils = require('./modules/_utils').init();

  // Import Javascript modules here:
  const example_module = require('./modules/example-module').init();

});
