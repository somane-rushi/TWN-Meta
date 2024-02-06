var EVENT = require('./../events/events');
var CV = require('./../config/currentValues');
var BaseView = require('./baseView');

var PageView = function(options, data) {
  /**
   * Model
   * @type {Backbone Model}
   */
  this.model = this.model != undefined
    ? this.model
    : new Backbone.Model({ asynchronous: false });

  // this.elMastHead = null;
  this.videoViews = [];
  BaseView.call(this, options, data);
};

_.extend(PageView, BaseView);
_.extend(PageView.prototype, BaseView.prototype);

PageView.prototype.initialize = function(options, data) {
  //Checking if data passed as attributes and merging them with model attributes
  var data = data != undefined ? data : null; //put in a page property to match the templating data style
  if (data != null) this.model.set(data);

  BaseView.prototype.initialize.call(this, options, data);
};

PageView.prototype.initializeRender = function() {
  //Asyncronous rendering checking
  //We check if we are on the server ( and data are here ) or if we need to fecth model before render
  if (this.model.get('asyncronous') === true) {
    this.model.fetch({
      success: this.render.bind(this),
    });
  } else {
    this.render();
  }
};

/**
 * @override
 * Handles the rendering.
 * If this.id is provided, it tries to get the element from the DOM
 * If not, it generates the element based on the tempalte provided, and append it to the container
 */

PageView.prototype.renderTemplate = function() {
  var html = this.template(this.model.attributes);
  this.setElement(html);
};

/**
 * Add a view based on a model
 * No need to store or anything because it's part of a collection
 */
PageView.prototype.addOne = function(model, el, view, className) {
  if (el != null) el = el[0];
  var subView = new view({ model: model, el: el, className: className });
  subView.init();
  return subView;
};

/**
 * Handles the initialization of DOM element
 * Here we should create reference of DOM elements we want to manipulate
 */

PageView.prototype.initDOM = function() {
  this.$fbVideoElements = document.querySelectorAll('.fb-video');

  if (this.$fbVideoElements && this.$fbVideoElements.length >= 0) {
    this.initVideoSDK(document, 'script', 'facebook-jssdk');
  }

  BaseView.prototype.initDOM.call(this);
};

PageView.prototype.onDOMInit = function() {
  this.onResize();

  // scrolltop
  // this gets init'ed way too late to be useful.
  // window.scrollTo(0, 0);

  BaseView.prototype.onDOMInit.call(this);
};

PageView.prototype.setupDOM = function() {
  var imgs = document.querySelectorAll('img');
  for (var i = 0; i < imgs.length; i++) {
    var img = imgs[i];
    if (img.complete) {
      this.imgLoaded({
        target: img,
      });
    } else {
      imgs[i].addEventListener('load', this.imgLoaded.bind(this));
    }
  }
};

/**
 * Bind events
 */
PageView.prototype.bindEvents = function() {
  BaseView.prototype.bindEvents.call(this);
};

PageView.prototype.initVideoSDK = function(d, s, id) {
  var js,
    fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s);
  js.id = id;
  js.src = '//connect.facebook.net/en_US/sdk.js#xfbml=1&version=v2.6';
  fjs.parentNode.insertBefore(js, fjs);
};

PageView.prototype.imgLoaded = function(e) {
  if (e.target.parentNode.classList.contains('resize-image')) {
    // console.log(' found loaded image with resize-image');
    this.resizeAnyResizeImages();
  }
};

PageView.prototype.onShown = function() {
  BaseView.prototype.onShown.call(this);
};

PageView.prototype.onHidden = function() {
  BaseView.prototype.onHidden.call(this);
};

PageView.prototype.hide = function(direct) {
  // No need to replay the timeline, just trigger the hidden event
  // if (!this.isShown){
  // 	this.trigger(EVENT.HIDDEN);
  // 	return;
  // }
  this.TL.hide.play(0);
};

PageView.prototype.onResize = function() {
  this.resizeAnyResizeImages();
};

// search for any images that have the resize-image class.
PageView.prototype.resizeAnyResizeImages = function() {
  var resizeImages = document.querySelectorAll('.resize-image');
  if (resizeImages.length === 0) return;

  for (var i = 0; i < resizeImages.length; i++) {
    this.scaleToFit(resizeImages[i]);
  }
};

PageView.prototype.scaleToFit = function(container) {
  var img = container.querySelector('img'),
    imgw = img.naturalWidth,
    imgh = img.naturalHeight,
    imgRatio = imgw / imgh;

  var containerW = $(container).width(),
    containerH = $(container).height(),
    containerRatio = containerW / containerH;

  // console.log(containerRatio +'>'+ imgRatio);

  if (isNaN(imgRatio)) {
    // if there was no image, liklely going to pull a NAN.
    nw = containerW;
    nh = containerW;
  } else if (containerRatio > imgRatio) {
    nw = containerW;
    nh = containerW * 1 / imgRatio;
  } else {
    nw = containerH * imgRatio;
    nh = containerH;
  }
	// avoid blue bars on sides by adding 2 pixels to both w and height.
  $(img).css({
    width: Math.ceil(nw) + 2,
    height: Math.ceil(nh) + 2,
  });

  $(img).addClass('show');
};

PageView.prototype.onKeyDown = function(e) {};

PageView.prototype.dispose = function() {
  if (this.model != null) this.model.stopListening();

  this.model = null;
  this.handlers = null;

  BaseView.prototype.dispose.call(this);
};

module.exports = PageView;
