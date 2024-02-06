var PageView = require('app/abstract/pageView');
var CV = require('app/config/currentValues');

var ContactPageView = function(options, datas) {
  console.log('ContactPageView');

  // this.canvasMask = null;

  this.events = {};

  PageView.call(this, options, datas);
};

_.extend(ContactPageView, PageView);
_.extend(ContactPageView.prototype, PageView.prototype);

ContactPageView.prototype.initDOM = function() {
  PageView.prototype.initDOM.call(this);
};

ContactPageView.prototype.onDOMInit = function() {
  PageView.prototype.onDOMInit.call(this);
};

ContactPageView.prototype.onShown = function() {
  PageView.prototype.onShown.call(this);
};

ContactPageView.prototype.onResize = function() {
  PageView.prototype.onResize.call(this);
};

ContactPageView.prototype.dispose = function() {
  PageView.prototype.dispose.call(this);
};

module.exports = ContactPageView;
