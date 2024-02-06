var PageView = require('app/abstract/pageView');
var CV = require('app/config/currentValues');

var InitiativePageView = function(options, datas) {
  console.log('InitiativePageView');

  // this.canvasMask = null;

  this.events = {
    'click #contact-module': 'contactModuleReveal',
    'click .close-cross': 'contactModuleHide',
    'click .contact-module-overlay': 'contactModuleHide',
  };

  PageView.call(this, options, datas);
};

_.extend(InitiativePageView, PageView);
_.extend(InitiativePageView.prototype, PageView.prototype);

InitiativePageView.prototype.initDOM = function() {
  this.$body = document.body;

  this.$contactModule = this.$el.find('.contact-module-container');
  this.$contactModuleOverlay = this.$el.find('.contact-module-overlay');

  PageView.prototype.initDOM.call(this);
};

InitiativePageView.prototype.onDOMInit = function() {
  PageView.prototype.onDOMInit.call(this);
};

InitiativePageView.prototype.onShown = function() {
  PageView.prototype.onShown.call(this);
};

InitiativePageView.prototype.onResize = function() {
  PageView.prototype.onResize.call(this);
};

InitiativePageView.prototype.dispose = function() {
  PageView.prototype.dispose.call(this);
};

InitiativePageView.prototype.contactModuleReveal = function(e) {
  console.log(CV.viewport.width);

  if (CV.viewport.width > 768) {
    e.preventDefault();
    $(this.$body).addClass('noscroll');
    this.$contactModule.addClass('active');
  }
};

InitiativePageView.prototype.contactModuleHide = function(e) {
  this.$contactModule.removeClass('active');
  $(this.$body).removeClass('noscroll');
};

module.exports = InitiativePageView;
