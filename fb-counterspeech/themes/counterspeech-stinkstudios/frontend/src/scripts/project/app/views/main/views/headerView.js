var CV = require('app/config/currentValues');
var Config = require('app/config/config');
var EVENT = require('app/events/events');
var Tools = require('app/tools/tools');
var BaseView = require('app/abstract/baseView');

var HeaderView = function(options, datas) {
  this.events = {
    'click .burger': 'onBurgerClick',
    'click .dropdown-button': 'onDropdownClick',
    // 'click .close-overlay': 'hideHeader',
  };

  BaseView.call(this, options, datas);
};

_.extend(HeaderView, BaseView);
_.extend(HeaderView.prototype, BaseView.prototype);

HeaderView.prototype.initDOM = function() {
  this.$header = this.$el;
  this.$menu = this.$el.find('.header-right');
  this.$burger = this.$el.find('.burger');
  this.$dropdownBtn = this.$el.find('.dropdown-button');
  this.$dropdownWrapper = this.$el.find('.dropdown-wrapper');
  this.$dropdownLocations = this.$el.find('.locations.dropdown-wrapper');
  this.$dropdownInitiatives = this.$el.find('.initiatives.dropdown-wrapper');
  this.$dropdownLanguages = this.$el.find('.language-dropdown');
  this.$countryOptions = this.$el.find('.country-options');
  this.$initiativeOptions = this.$el.find('.initiative-options');
  this.$closeOverlay = $(document).find('.header-close-overlay');
  this.$headerLinks = this.$el.find('.header-link');
  this.$resourcesBtn = this.$el.find('.header-link .resources-btn');
  this.$aboutBtn = this.$el.find('.header-link .about-btn');
  BaseView.prototype.initDOM.call(this);
};

HeaderView.prototype.onDOMInit = function() {
  if (CV.currentPage === 'country-page') {
    var pathName = window.location.href.slice(-10, -1);
    if (this.$countryOptions) {
      for (var i = 0; i < this.$countryOptions.length; i++) {
        if (this.$countryOptions[i].classList.contains(pathName)) {
          $(this.$countryOptions[i]).addClass('active');
        }
      }
    }
  } else if (CV.currentPage === 'initiative-page') {
    var pathName = window.location.href.slice(-10, -1);
    if (this.$initiativeOptions) {
      for (var i = 0; i < this.$initiativeOptions.length; i++) {
        if (this.$initiativeOptions[i].classList.contains(pathName)) {
          $(this.$initiativeOptions[i]).addClass('active');
        }
      }
    }
  }

  _.each(
    this.$headerLinks,
    function(el) {
      if (CV.currentPage === this.$(el).attr('data-id')) {
        this.$(el).addClass('active-page');
      }
    }.bind(this)
  );

	BaseView.prototype.onDOMInit.call(this);
};

HeaderView.prototype.bindEvents = function() {
	// outside of this.$el
	this.$closeOverlay.bind('click', this.hideHeader.bind(this));
	console.log(' --- bind events header ---');

	this.$el.find('a.header-copy.country-options').bind('click', function(e){
		// e.preventDefault();
		if (window.ga && window.gdprSafeTrack) {
      window.gdprSafeTrack(function () {
        window.ga('send', 'event', 'HeaderCountryLink', 'click', e.currentTarget.innerText );
      });
    }
	});

	BaseView.prototype.bindEvents.call(this);
};

HeaderView.prototype.onResize = function() {
  if (CV.viewport.width < 768) {
    if (this.$dropdownWrapper.hasClass('active')) {
      this.$dropdownWrapper.removeClass('active');
      this.$dropdownBtn.removeClass('active');
    }
  }
};

HeaderView.prototype.onBurgerClick = function(e) {
  if (this.$dropdownWrapper.hasClass('active')) {
    this.$dropdownWrapper.removeClass('active');
    this.$dropdownBtn.removeClass('active');
  }
  $(e.target).toggleClass('active');
  this.$menu.toggleClass('active');
  this.$closeOverlay.toggleClass('active');
};

HeaderView.prototype.onDropdownClick = function(e) {
	// manage children that have an <a> tag, as well as if it is just the &:after pseudo class
	e.preventDefault();
	// tagName in DOM is uppercase, but just in case let's force uppercase:
	var target = (e.target.tagName.toUpperCase() == 'A') ? e.target.parentNode : e.target;
	if ($(target).hasClass('active')) {
    this.$dropdownBtn.removeClass('active');
    this.$dropdownWrapper.removeClass('active');
    this.$dropdownLanguages.removeClass('active');
    if (CV.viewport.width > 768) {
      this.$closeOverlay.removeClass('active');
    }
  } else {
    this.$dropdownBtn.removeClass('active');
    this.$dropdownWrapper.removeClass('active');
    if (CV.viewport.width > 768) {
      this.$closeOverlay.removeClass('active');
    }
    $(target).toggleClass('active');

    if ($(target).hasClass('locations')) {
      this.$dropdownLocations.toggleClass('active');
      if (CV.viewport.width > 768) {
        this.$closeOverlay.toggleClass('active');
      }
    } else if ($(target).hasClass('initiatives')) {
      this.$dropdownInitiatives.toggleClass('active');
      if (CV.viewport.width > 768) {
        this.$closeOverlay.toggleClass('active');
      }
    } else if ($(target).hasClass('language')) {

      this.$dropdownLanguages.toggleClass('active');
      if (CV.viewport.width > 768) {
        this.$closeOverlay.toggleClass('active');
      }
    }
  }
};

HeaderView.prototype.mouseLeaveHeader = function(e) {
	console.log(' mouse leave ------ ');
}

HeaderView.prototype.hideHeader = function(e) {
	console.log(' hide header...');
  if (CV.viewport.width > 768) {
    this.$dropdownBtn.removeClass('active');
    this.$dropdownWrapper.removeClass('active');
    this.$closeOverlay.removeClass('active');
  } else {
    if (this.$dropdownWrapper.hasClass('active')) {
      this.$dropdownWrapper.removeClass('active');
      this.$dropdownBtn.removeClass('active');
    }
    this.$burger.toggleClass('active');
    this.$menu.toggleClass('active');
    this.$closeOverlay.removeClass('active');
  }
};

module.exports = HeaderView;
