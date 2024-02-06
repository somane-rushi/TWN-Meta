var PageView = require('app/abstract/pageView');
var CV = require('app/config/currentValues');

var AboutPageView = function(options, datas) {
  console.log('AboutPageView');

  this.events = {
    'click #contact-module': 'contactModuleReveal',
    'click .close-cross': 'contactModuleHide',
    'click .contact-module-overlay': 'contactModuleHide',
  };

  PageView.call(this, options, datas);
};

_.extend(AboutPageView, PageView);
_.extend(AboutPageView.prototype, PageView.prototype);

AboutPageView.prototype.initDOM = function() {
  this.$body = document.body;

  this.$contactModule = this.$el.find('.contact-module-container');
  this.$contactModuleOverlay = this.$el.find('.contact-module-overlay');

  PageView.prototype.initDOM.call(this);
};

AboutPageView.prototype.onDOMInit = function() {
  PageView.prototype.onDOMInit.call(this);
};

AboutPageView.prototype.onShown = function() {
  PageView.prototype.onShown.call(this);
};

AboutPageView.prototype.onResize = function() {
  PageView.prototype.onResize.call(this);
};

AboutPageView.prototype.dispose = function() {
  PageView.prototype.dispose.call(this);
};

AboutPageView.prototype.contactModuleReveal = function(e) {
  console.log(CV.viewport.width);

  if (CV.viewport.width > 768) {
    e.preventDefault();
    $(this.$body).addClass('noscroll');
    this.$contactModule.addClass('active');
  }
};

AboutPageView.prototype.contactModuleHide = function(e) {
  this.$contactModule.removeClass('active');
  $(this.$body).removeClass('noscroll');
};

module.exports = AboutPageView;
