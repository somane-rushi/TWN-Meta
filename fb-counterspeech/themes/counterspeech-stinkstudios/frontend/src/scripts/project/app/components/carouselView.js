var BaseView = require('./../abstract/baseView');
var CV = require('./../config/currentValues');
var EVENT = require('./../events/events');
var CarouselIndicatorView = require('./carouselIndicatorView');

var CarouselView = function(options, datas) {
  this.$carouselItemsContainer = null;
  this.$carouselItems = null;
  this.$itemsEl = null;

  this.$indicatorEl = null;
  this.aCarouselIndicators = [];

  this.currentIndex = 0;

  this.isDestroy = null;
  this.timer = null;

  this.lastDeltaX = 0;
  this.TRESHOLD = 100;
  this.ALLOWEDTIME = 300;

  BaseView.call(this, options, datas);
};
_.extend(CarouselView, BaseView);
_.extend(CarouselView.prototype, BaseView.prototype);

CarouselView.prototype.initDOM = function() {
  this.$carouselItemsContainer = this.$el.find('.carousel');
  this.$carouselItems = this.$el.find('.carousel-item');
  this.$indicatorEl = this.$el.find('.indicator');

  this.isDestroy = false;

  BaseView.prototype.initDOM.call(this);
};

CarouselView.prototype.onDOMInit = function() {
  for (var i = 0; i < this.$indicatorEl.length; i++) {
    this.$indicatorEl[i];
    this.createCarouselIndicators({ el: this.$indicatorEl[i] });
  }

  // Always set first indicator on init
  if (this.aCarouselIndicators[0]) this.aCarouselIndicators[0].toggleActive();

  this.startTimer();

  BaseView.prototype.onDOMInit.call(this);
};

CarouselView.prototype.createCarouselIndicators = function(_obj) {
  var indicator = new CarouselIndicatorView(_obj, null);
  indicator.init();

  this.aCarouselIndicators.push(indicator);
};

CarouselView.prototype.bindEvents = function() {
  this.handlers.indicator = this.indicatorClicked.bind(this);

  for (var i = 0; i < this.aCarouselIndicators.length; i++) {
    this.listenTo(
      this.aCarouselIndicators[i],
      EVENT.CAROUSEL_INDICATOR_CLICKED,
      this.handlers.indicator
    );
  }

  BaseView.prototype.bindEvents.call(this);
};

CarouselView.prototype.indicatorClicked = function(e) {
  this.goToItem(e.indicator.index);

  this.startTimer();
};

CarouselView.prototype.onResize = function() {
  this.recenterCurrent();
  BaseView.prototype.onResize.call(this);
};

CarouselView.prototype.startTimer = function() {
  this.timer = window.setTimeout(this.itemManager.bind(this), 6000);
};

CarouselView.prototype.stopTimer = function() {
  window.clearTimeout(this.timer);
  this.timer = null;
};

CarouselView.prototype.itemManager = function(e) {
  if (this.isDestroy) return;
  if (this.timer) this.stopTimer();

  // var i = e != void 0 ? this.currentIndex + parseInt($(e.currentTarget).attr("index")) : this.currentIndex + 1;
  var i = e != void 0
    ? this.currentIndex + parseInt($(e.indicator.index).attr('index'))
    : this.currentIndex + 1;
  this.direction = e != void 0 ? parseInt($(e.currentTarget).attr('index')) : 1;

  this.goToItem(i);
};

CarouselView.prototype.recenterCurrent = function() {
  var w = this.$carouselItems[this.currentIndex].offsetWidth;
  var margin = 19.5; // half of page margin + half of carousel item margin
  var x = this.currentIndex * -w - margin;

  if (this.currentIndex === 0) {
    this.$carouselItemsContainer.css('transform', 'translate3d(0, 0, 0)');
  } else {
    this.$carouselItemsContainer.css(
      'transform',
      'translate3d(' + x + 'px, 0, 0)'
    );
  }
};

CarouselView.prototype.goToItem = function(index) {
  for (var i = 0; i < this.$carouselItems.length; i++) {
    if (i === index) {
      $(this.$carouselItems[index]).addClass('active');
    } else {
      $(this.$carouselItems[i]).removeClass('active');
    }
  }

  if (this.currentIndex === index) return;

  if (index > this.$carouselItems.length - 1) {
    index = 0;
  } else if (index < 0) {
    index = this.$carouselItems.length - 1;
  }

  // Disable old indicator
  this.aCarouselIndicators[this.currentIndex].toggleActive();
  this.aCarouselIndicators[index].toggleActive();

  this.currentIndex = index;

  var w = this.$carouselItems[index].offsetWidth;
  var margin = 19.5; // half of page margin + half of carousel item margin
  var x = this.currentIndex * -w - margin;

  if (this.currentIndex === 0) {
    this.$carouselItemsContainer.css('transform', 'translate3d(0, 0, 0)');
  } else {
    this.$carouselItemsContainer.css(
      'transform',
      'translate3d(' + x + 'px, 0, 0)'
    );
  }

  if (this.timer) {
    this.stopTimer();
  } else {
    this.startTimer();
  }
};

CarouselView.prototype.onTouchStart = function(e) {
		this.startTime = new Date().getTime();
    this.startDeltaX = parseInt(CV.touch.x);
    //this.stopTimer();
}

CarouselView.prototype.onTouchEnd = function(e) {
		this.elapsedTime = new Date().getTime() - this.startTime;
    this.lastDeltaX = parseInt(CV.touch.x);
    this.onUp();
}

CarouselView.prototype.onUp = function() {

		this.elapsedTime = new Date().getTime() - this.startTime;

		this.distanceX = this.lastDeltaX - this.startDeltaX;

	if (this.elapsedTime <= this.ALLOWEDTIME && Math.abs(this.distanceX) >= this.TRESHOLD){
      if (this.distanceX > 0) {
        this.goToItem(this.currentIndex - 1);
      } else {
        this.goToItem(this.currentIndex + 1);
      }
	}

}

//CarouselView.prototype.onUpdate = function() {
  // if (this.lastDeltaX != CV.touch.deltaX) {
	// 		this.lastDeltaX = CV.touch.deltaX;
  //
  //     if (Math.abs(this.lastDeltaX) < this.TRESHOLD || this.elapsedTime <= this.ALLOWEDTIME) return;
  //
  //     if (this.lastDeltaX > 0) {
  //       this.goToItem(this.currentIndex - 1);
  //       console.log('prev');
  //     } else {
  //       this.goToItem(this.currentIndex + 1);
  //       console.log('next');
  //     }
  // }
//};

CarouselView.prototype.destroy = function() {
  $(this.$carouselItems).removeAttr('style');
  $(this.$el).removeAttr('style');
  this.stopTimer();
  this.currentIndex = null;
  this.isDestroy = true;
};

module.exports = CarouselView;
