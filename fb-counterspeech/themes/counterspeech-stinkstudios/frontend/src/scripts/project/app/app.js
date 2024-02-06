'use strict';

require('Detectizr');
require('d3');
require('underscore');

var Router = require('./router/router');
var Config = require('./config/config');

/**
 * app: Init the app
 * @constructor
 */
var App = function() {
  _.extend(this, Backbone.Events);
};

/**
 * Handles the init
 */
App.prototype.init = function() {
  Config.init();
  Router.init();
};

module.exports = App;
