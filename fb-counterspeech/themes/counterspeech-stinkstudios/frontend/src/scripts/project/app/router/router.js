'use strict';

var EVENT = require('./../events/events');
var MainView = require('./../views/mainView');

var Router = function() {
  this.routes = {
    ':language/:page/:post(/)?*queryString': 'default',
    ':language/:page/:post/': 'default',
    ':language/:page(/:post)(/)?*queryString': 'default',
    ':language/:page/': 'default',
    ':language(/:page/)(/:post)(/)?*queryString': 'default',
    ':language(/)': 'default',
    '': 'default',
  };

  this.history = [];

  this.mainView = MainView;

  Backbone.Router.call(this);
};

_.extend(Router, Backbone.Router);
_.extend(Router.prototype, Backbone.Router.prototype);

Router.prototype.init = function() {
  this.listenToOnce(this.mainView, EVENT.INIT, _onMainViewInit.bind(this));
  this.mainView.init();
};

var _onMainViewInit = function() {
  Backbone.history.start({
    pushState: true,
  });
};

Router.prototype.default = function(language_, page_, post_) {
  console.log('Router - language,page,post', language_, page_, post_);

  var language = language_ ? language_ : null;
  var page = page_ ? page_ : null;
  var post = post_ ? post_ : null;

  this.mainView.pageManager.navigateTo(language, page, post);

  this.history.push(page);
};

Router.prototype.current_page = function() {
  return _.last(this.history);
};

Router.prototype.back = function() {
  Backbone.history.navigate(this.previous_page(), { trigger: false });
};

Router.prototype.previous_page = function() {
  if (this.history.length <= 1) return null;
  else return this.history[this.history.length - 2];
};

module.exports = new Router();
