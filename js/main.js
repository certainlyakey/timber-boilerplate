'use strict';
import { addBrowserClasses } from './modules/_utils';
import { example_module } from './modules/example-module';

document.addEventListener('DOMContentLoaded', function() {

  document.getElementsByClassName('is-page-loading')[0].classList.remove('is-page-loading');
  document.getElementsByClassName('no-js')[0].classList.remove('no-js');

  // Common functions
  addBrowserClasses();

  // Import Javascript modules here:
  example_module();

});
