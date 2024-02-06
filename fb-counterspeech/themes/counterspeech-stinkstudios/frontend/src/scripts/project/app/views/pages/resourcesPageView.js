var PageView = require('app/abstract/pageView');
var CV = require('app/config/currentValues');

var ResourcesPageView = function(options, datas) {
  console.log('ResourcesPageView');

  // this.canvasMask = null;

  this.events = {
    'click #contact-module': 'contactModuleReveal',
    'click .close-cross': 'contactModuleHide',
    'click .contact-module-overlay': 'contactModuleHide',
  };

  PageView.call(this, options, datas);
};

_.extend(ResourcesPageView, PageView);
_.extend(ResourcesPageView.prototype, PageView.prototype);

ResourcesPageView.prototype.initDOM = function() {
  this.$body = document.body;

  this.$contactModule = this.$el.find('.contact-module-container');
  this.$contactModuleOverlay = this.$el.find('.contact-module-overlay');

  PageView.prototype.initDOM.call(this);
};

ResourcesPageView.prototype.onDOMInit = function() {
  PageView.prototype.onDOMInit.call(this);
};

ResourcesPageView.prototype.onShown = function() {
  PageView.prototype.onShown.call(this);
};

ResourcesPageView.prototype.onResize = function() {
  PageView.prototype.onResize.call(this);
};

ResourcesPageView.prototype.dispose = function() {
  PageView.prototype.dispose.call(this);
};

ResourcesPageView.prototype.contactModuleReveal = function(e) {
  console.log(CV.viewport.width);

  if (CV.viewport.width > 768) {
    e.preventDefault();
    $(this.$body).addClass('noscroll');
    this.$contactModule.addClass('active');
  }
};

ResourcesPageView.prototype.contactModuleHide = function(e) {
  $(this.$body).removeClass('noscroll');
  this.$contactModule.removeClass('active');
};

module.exports = ResourcesPageView;
