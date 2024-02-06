'use strict';

var CurrentValues = function() {
  /**
   * Viewport object
   * @type {Object}
   */
  this.viewport = { width: 0, height: 0, wrapperWidth: 0 };

  /**
   * Mouse object
   * @type {Object}
   */
  this.mouse = { x: 0, y: 0 };

  /**
   * Touch object
   * @type {Object}
   */
  this.touch = { x: 0, y: 0, startX: 0, startY: 0, deltaX: 0, deltaY: 0 };

  /**
   * Is mouse out of window?
   * @type {boolean}
   */
  this.outWindow = false;

  /**
   * scroll Y value
   * @type {number}
   */
  this.scrollY = 0;

  /**
   * scroll Y direction
   * @type {number}
   */
  this.scrollYDirection = 'down';

  /**
   * current page
   * @type {string}
   */
  this.currentPage = null;

  /**
   * delta Y value
   * @type {number}
   */
  this.scrollDeltaY = 0;

  /**
   * Block mouse wheel?
   * @type {boolean}
   */
  this.mouseWheelBlock = false;

  /**
   * is it the first time you browse the website?
   * @type {boolean}
   */
  this.firstTime = true;

  /**
   * Is mobile size?
   * @type {Boolean}
   */
  this.isMobileSize = false;

  /**
   * Is mobile?
   * @type {Boolean}
   */
  this.isMobile = Detectizr.device.type == 'mobile';

  /**
   * Is tablet?
   * @type {Boolean}
   */
  this.isTablet = Detectizr.device.type == 'tablet';

  /**
   * Breakpoint
   * @type {Boolean}
   */
  this.breakpoint = null;

  /**
   * main datas
   * @type {Object}
   */
  this.mainDatas = null;

  /**
   * main assets
   * @type {Object}
   */
  this.isAnimating = false;

  /**
   * Check if any of the blocks are currently animating
   * @type {Object}
   */
  this.blockIsAnimating = false;

  /**
   * delta Y value
   * @type {number}
   */
  this.scrollDeltaY = 0;

  /**
   * Is scroll/touch ?
   * @type {boolean}
   */
  this.isTouch = 0;

  /**
   * MainView reference
   * @type {Object}
   */
  this.mainView = null;

  /**
   * Is scrolling
   * @type {Object}
   */
  this.isScrolling = false;

  this.overlayActive = false;
};

CurrentValues.prototype.init = function() {};

CurrentValues.prototype.navigate = function(href) {
  var root = location.protocol + '//' + location.host;

  // Ensure the root is part of the anchor href, meaning it's relative.
  if (href && href.slice(0, root.length) === root) {
    href = href.replace(root, '');

    if (this.isAnimating === false) Backbone.history.navigate(href, true);
  }
};

module.exports = new CurrentValues();
