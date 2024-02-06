var EVENT = require('./../../../events/events');
var CV = require('./../../../config/currentValues');
var Config = require('./../../../config/config');
var BaseView = require('./../../../abstract/baseView');

var FooterView = function(options, datas) {
  this.events = {
    'click .dropdown-button': 'onDropdownClick',
    'click #contact-module': 'contactModuleReveal',
    'click .close-cross': 'contactModuleHide',
    'click .contact-module-overlay': 'contactModuleHide',
  };

  BaseView.call(this, options, datas);
};

_.extend(FooterView, BaseView);
_.extend(FooterView.prototype, BaseView.prototype);

FooterView.prototype.initDOM = function() {
  this.$body = document.body;

  this.$dropdownBtn = this.$el.find('.dropdown-button');
  this.$dropdownWrapper = this.$el.find('.dropdown-wrapper');

  this.$dropdownLocations = this.$el.find('.locations.dropdown-wrapper');
  this.$dropdownInitiatives = this.$el.find('.initiatives.dropdown-wrapper');

  this.$contactModule = this.$el.find('.contact-module-container');
  this.$contactModuleOverlay = this.$el.find('.contact-module-overlay');

  this.$languageContainer = this.$el.find('.language-container');

  this.onResize();

  BaseView.prototype.initDOM.call(this);
};

FooterView.prototype.onDOMInit = function() {
  if (
    window.location.href.indexOf('#contact-form') > -1 &&
    window.location.href.indexOf('en/contact') === -1
  ) {
    this.refreshModule();
  }

  BaseView.prototype.onDOMInit.call(this);
};

FooterView.prototype.bindEvents = function() {
  BaseView.prototype.bindEvents.call(this);

	// tracking events:
	this.$el.find('.country-list li a').on('click', function(e) {
		// e.preventDefault();
		if (window.ga && window.gdprSafeTrack) {
      window.gdprSafeTrack(function() {
        window.ga('send', 'event', 'FooterCountryLink', 'click', e.currentTarget.innerText);
      });
    }
	});

	this.$el.find('a.footer-copy.country-link').on('click', function(e) {
		// e.preventDefault();
    if (window.ga && window.gdprSafeTrack) {
      window.gdprSafeTrack(function () {
        window.ga('send', 'event', 'FooterCountryLink', 'click', e.currentTarget.innerText );
      });
    }
	});
};

FooterView.prototype.onResize = function() {};

FooterView.prototype.onDropdownClick = function(e) {
  $(e.target).toggleClass('active');

  if ($(e.target).hasClass('locations')) {
    $(this.$dropdownLocations).toggleClass('active');
    $(this.$dropdownInitiatives).removeClass('active');
  } else if ($(e.target).hasClass('initiatives')) {
    $(this.$dropdownInitiatives).toggleClass('active');
    $(this.$dropdownLocations).removeClass('active');
  }
};

FooterView.prototype.contactModuleReveal = function(e) {
  console.log(CV.viewport.width);

  if (CV.viewport.width > 1024) {
    e.preventDefault();
    $(this.$body).addClass('noscroll');
    this.$contactModule.addClass('active');
  }
};

FooterView.prototype.refreshModule = function() {
  if (CV.viewport.width > 1024) {
    window.scrollTo(0, document.body.scrollHeight);
    $(this.$body).addClass('noscroll');
    this.$contactModule.addClass('active');
  }
};

FooterView.prototype.contactModuleHide = function(e) {
  this.$contactModule.removeClass('active');
  $(this.$body).removeClass('noscroll');
};

module.exports = FooterView;
