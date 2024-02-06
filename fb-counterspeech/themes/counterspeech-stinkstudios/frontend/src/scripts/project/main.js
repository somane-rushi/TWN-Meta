'use strict';

var App = require('./app/app');

/**
 * Main module - App entry point
 * @module Main
 */

var Main = function() {};

/**
 * Callback fired once the document is ready
 * @public
 */

Main.prototype.onReady = function() {
  var app = new App();
  app.init();

  // make sure this is executed at the end of the callstack not immediately.
  setTimeout(function() {
    var body = document.querySelector('body') || document.body;
    // body.classList.remove('loading');
    // console.log('\n CURRENT BUILD - ' + VERSION + '\n\n');
  }, 0);
};

// DOM Ready for Internet Explorer 9 and Above
var ready = function(callback) {
  document.readyState === 'interactive' || document.readyState === 'complete'
    ? callback()
    : document.addEventListener('DOMContentLoaded', callback);
};

// Call the onReady function to start the app
ready(function() {
  var main = new Main();
  main.onReady();
});
