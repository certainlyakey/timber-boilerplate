'use strict';

jQuery(window).on('load', function() {
  jQuery('html').removeClass('is-page-loading');
});



jQuery(function($){

  // Common functions
  var common = require('./modules/_common');

  // Import Javascript modules here:
  var example_module = require('./modules/example-module');

  // common.init();
  example_module.init();
});
