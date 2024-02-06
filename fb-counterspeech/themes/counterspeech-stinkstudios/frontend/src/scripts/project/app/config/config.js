'use strict';

var Config = function() {
  /**
   * name of the app
   * @type {String}
   */
  this.appName = 'Counterspeech';

  /**
   * Does the browser is an IE browser ?
   * @type {boolean}
   */
  this.isIE = false;

  /**
   * Google Analytic ID
   * @type {String}
   * The id is tied to http://www.stinkstudios.com
   */
  // this.gaID = '';

  /**
   * Base URL of the website
   * @type {string}
   */
  this.baseUrl = window.location.origin || 'http://' + window.location.host;

  /**
   * Root used by Backbone.history
   * @type {string}
   */
  this.root = '';

  /**
   * Is an High resolution screen ?
   * @type {boolean}
   */
  this.isRetina = false;

  /**
   * Object containing device informations (based on Detectizr)
   * @type {Object}
   */
  this.device = null;

  /**
   * Does the browser has webgl ?
   * @type {boolean}
   */
  this.hasWEBGL = true;

  /**
   * Breakpoint mobile resolution
   * @type {float}
   */
  this.breakPointMobile = 768;

  /**
   * Get current mode
   * @type {boolean}
   */
  this.isDevMode = window.location.origin == 'http://counterspeech.dev'
    ? false
    : true;

  /**
   * current folder App path
   */
  // TODO: define production URL
  this.folderPath = window.location.origin == 'https://www.counterspeech.com'
    ? null
    : window.location.origin + '/wp-content/themes/counterspeech-stinkstudios/';
};

Config.prototype.init = function() {
  Detectizr.detect();
};

// IE 11 detection
var _isIE = function() {
  return (
    navigator.appName == 'Microsoft Internet Explorer' ||
    (navigator.appName == 'Netscape' &&
      new RegExp('Trident/.*rv:([0-9]{1,}[.0-9]{0,})').exec(
        navigator.userAgent
      ) != null)
  );
};

var _isHighRes = function() {
  var dpr =
    window.devicePixelRatio ||
    // fallback for IE
    window.screen.deviceXDPI / window.screen.logicalXDPI ||
    // default value
    1;

  return !!(dpr > 1);
};

module.exports = new Config();
