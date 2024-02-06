/*
 * Home page is still WIP
 *
 * The Map features have not been fully complete.
 *
 */

var PageView = require('app/abstract/pageView');
var CV = require('app/config/currentValues');
var gsap = require('gsap');
var CarouselView = require('./../../components/carouselView');

var HomePageView = function(options, datas) {
  this.map = null;

  // this.minZoom = 0.95;
  this.minZoom = 1;
  this.maxZoom = 8;

  this.$mapSegmentEl = null;
  this.$mastheadImages = [];
  this.$carouselEl = null;
  this.wrapper = null;
  this.mapEl = null;
  this.svg = null;
  this.d3Map = null;
  this.d3Projection = null;
  this.g = null;
  this.defaultCircleScale = 0.5;
  this.circleLinkScale = this.defaultCircleScale;
  this.jsonWorld = null;
  this.mapPointsData = null;
  this.d3Zoom = null;
  // desktop or mobile map. changes on resize depending on breakpoint;
  this.mapState = null;
  this.breakPointTablet = 1024;
  this.mapPointsJSON = window.cpsch.siteUrl + '/wp-json/counterspeech/map';
  // for desktop
  this.mapJSON =
    window.cpsch.sDir + '/frontend/public/assets/json/world-110m.geojson';
    // window.cpsch.sDir + '/frontend/public/assets/json/map-corrected.geojson';
  // for mobile:
  this.mapJSONnoPoles =
    window.cpsch.sDir + '/frontend/public/assets/json/world-map-names.json';
  // disable resize of the map until this.mapSetup is true.
  this.mapIsSetup = false;

  console.log('HomePageView');

  this.events = {
    'click .section-wrapper': 'revealDropdown',
    'click #contact-module': 'contactModuleReveal',
    'click .close-cross': 'contactModuleHide',
    'click .contact-module-overlay': 'contactModuleHide',
    'click .btn-zoom-in': 'zoomBtnClick',
    'click .btn-zoom-out': 'zoomBtnClick',
  };

  PageView.call(this, options, datas);
};

_.extend(HomePageView, PageView);
_.extend(HomePageView.prototype, PageView.prototype);

HomePageView.prototype.initDOM = function() {
  this.$body = document.body;

  this.$mastheadImages = this.$el.find('.masthead-image-container');
  this.$mapSegmentEl = this.$el.find('.map-segment');
  this.$carouselEl = this.$el.find('.carousel-wrapper');
  this.$carouselItems = this.$el.find('.carousel-item');
  this.$contactModule = this.$el.find('.contact-module-container');
  this.$contactModuleOverlay = this.$el.find('.contact-module-overlay');
  this.$dropDownWrapper = this.$el.find('.dropdown-wrapper');
  PageView.prototype.initDOM.call(this);
};

HomePageView.prototype.onDOMInit = function() {
  this.chooseMasthead();
  PageView.prototype.onDOMInit.call(this);
};

// must happen on show when we get the view port size in CV.
HomePageView.prototype.show = function() {
  // always have the carousel active. whether it is at tablet or not,
  // we will disable the timer in desktop state.
  this.$carouselItems.first().addClass('active');
  this.carousel = new CarouselView(
    { el: this.$carouselEl, hasTimer: true, hasIndicators: true },
    null
  );
  this.carousel.init();

  this.setupMap();
  PageView.prototype.show.call(this);
};

HomePageView.prototype.chooseMasthead = function() {
  var shownImage = localStorage.getItem('shownImage') || 0;
  var elCaptions = this.$el.find('.masthead-caption-wrapper');
  var i = 0;
  var a = this.$mastheadImages.length;
  for (i; i < a; i++) {
    this.$mastheadImages[i].setAttribute('data-id', i);
    if (i == shownImage) {
      $(this.$mastheadImages[i]).removeClass('hide').addClass('resize-image');
      $(elCaptions[i]).removeClass('hide');
    } else {
      $(this.$mastheadImages[i]).remove();
      $(elCaptions[i]).remove();
    }
  }
  // Added this because the localStorage was breaking on incognito browsers
  if (localStorage.getItem('shownImage')) {
    if (shownImage >= parseInt(a) - 1 ) {
      localStorage.setItem('shownImage', 0);
    } else {
      localStorage.setItem('shownImage', parseInt(shownImage) + 1);
    }
  }
};

HomePageView.prototype.bindEvents = function() {
	PageView.prototype.bindEvents.call(this);
	// setup tracking for mobile/tablet accordion components
  this.$el.find('.list-link.map-copy').on('click', function(e) {
		// e.preventDefault();
    if(window.ga && window.gdprSafeTrack) {
      window.gdprSafeTrack(function () {
        window.ga('send', 'event', 'HomePageAccordion', 'click', e.currentTarget.innerText );
      });
    }
  });
}

HomePageView.prototype.setupMap = function() {
  this.wrapper = document.querySelector('.map-wrapper');
  this.mapEl = document.getElementById('global-map');

  // pass reference to view in D3 actions:
  var that = this;
  var width = this.mapEl.offsetWidth,
    height = this.mapEl.offsetHeight,
    center = [width / 2, height / 2];

  this.d3Map = d3
    .select(this.mapEl)
    .append('svg')
    .attr('width', width)
    .attr('height', height)
    .append('g');

  this.svg = this.mapEl.querySelector('svg');

  if (CV.viewport.width <= this.breakPointTablet) {
    this.setupMapMobile();
  } else {
    this.setupMapDesktop();
  }
  this.mapIsSetup = true;
};

// clean map on switching from mobile to desktop states
HomePageView.prototype.cleanUpState = function() {
  console.log(' clean up map changing type.');
  if (this.d3Zoom) {
    this.d3Zoom.on('zoom', null);
    this.d3Zoom = null;
  }

  if (this.g) {
    // that.g.selectAll('.country-link').remove();
    this.g.remove();
    this.g = null;
    // d3.selectAll('g').remove();
  }
  //d3.selectAll('.button.zoom').on('click', null);
};

HomePageView.prototype.toggleMapUI = function() {
  if (this.mapState === 'mobile') {
    this.$el.find('.btn-zoom-in').addClass('hidden');
    this.$el.find('.btn-zoom-out').addClass('hidden');
  } else {
    this.$el.find('.btn-zoom-in').removeClass('hidden');
    this.$el.find('.btn-zoom-out').removeClass('hidden');
  }
};

HomePageView.prototype.setupMapDesktop = function() {
  console.log(' setupMapDesktop ', this.d3Map);
  this.mapState = 'desktop';
  this.cleanUpState();
  this.toggleMapUI();

  this.g = this.d3Map.append('g').attr('class', 'grp-desktop');

  var that = this;
  this.d3Zoom = d3.behavior
    .zoom()
    .scaleExtent([this.minZoom, this.maxZoom])
    .on('zoom', this.zoomD3Behavior.bind(this));

  this.d3Map
    .call(this.d3Zoom)
    // disable wheel zoom:
    // https://github.com/d3/d3-zoom/issues/80
    .on('mousewheel.zoom', null)
    .on('wheel.zoom', null);

  this.drawMap();
  this.$carouselEl.removeClass('active');
  this.$dropDownWrapper.removeClass('active');
  this.carousel.stopTimer();
  this.mapState = 'desktop';
  this.$mapSegmentEl.removeClass('tab-mble');
};

HomePageView.prototype.animateCircle = function(circle) {
  var countryPoint = circle;
  var backgroundPoint = $(circle).prev();
  var linkBounce = 1.15;
  var linkFade = 1.55;

  if (this.circleLinkScale !== 1) {
    // calculate the zooms of the circle if it is not the default 1.0
    if (1 - this.d3Zoom.scale() * 0.25 > 0.2) {
      linkBounce = (1 - this.d3Zoom.scale() * 0.25) * linkBounce;
      linkFade = (1 - this.d3Zoom.scale() * 0.25) * linkFade;
    } else {
      linkBounce = 0.2 * linkBounce;
      linkFade = 0.2 * linkFade;
    }
  }

  var tl = new TimelineLite();
  // we animate starting at the current scale.
  tl.from(countryPoint, 0, {
    scale: this.circleLinkScale,
    transformOrigin: 'center center',
  });
  // we animate to the bounce
  tl.from(countryPoint, 0.33, {
    ease: Power2.easeInOut,
    scale: linkBounce,
    transformOrigin: 'center center',
  });
  // and return to the scale
  tl.to(countryPoint, 0.33, {
    ease: Power2.easeInOut,
    scale: this.circleLinkScale,
    transformOrigin: 'center center',
  });
  tl.play();

  TweenMax.fromTo(
    backgroundPoint,
    0.65,
    {
      scale: this.circleLinkScale,
      opacity: 1,
      transformOrigin: 'center center',
    },
    {
      scale: linkFade,
      opacity: 0,
      transformOrigin: 'center center',
    }
  );
};

HomePageView.prototype.zoomBtnClick = function(e) {
  console.log(' -- zoomBtnClick -- ');
  var that = this,
    scale = this.d3Zoom.scale(),
    extent = this.d3Zoom.scaleExtent(),
    translate = this.d3Zoom.translate(),
    x = translate[0],
    y = translate[1],
    factor = e.currentTarget.dataset.id === 'zoom_in' ? 2 : 1 / 2,
    target_scale = scale * factor,
    width = this.mapEl.offsetWidth,
    height = this.mapEl.offsetHeight,
    center = [width / 2, height / 2];

  // If we're already beyond an or equal to an extent:
  if (target_scale === extent[0] || target_scale === extent[1]) {
    console.log(' out of bounds', extent, target_scale);
    // return false;
  }

  // If the factor is too much, scale it down to reach the extent exactly
  var clamped_target_scale = Math.max(
    extent[0],
    Math.min(extent[1], target_scale)
  );
  if (clamped_target_scale != target_scale) {
    target_scale = clamped_target_scale;
    factor = target_scale / scale;
  }

  if (target_scale === scale) {
    console.log(' already at this scale level', scale);
    return;
  }

  // Center each vector, stretch, then put back
  x = (x - center[0]) * factor + center[0];
  y = (y - center[1]) * factor + center[1];

  // Transition to the new view over 350ms
  d3.transition().duration(350).tween('zoom', function() {
    var interpolate_scale = d3.interpolate(scale, target_scale),
      interpolate_trans = d3.interpolate(translate, [x, y]);

    return function(t) {
      that.d3Zoom.scale(interpolate_scale(t)).translate(interpolate_trans(t));
      that.executeZoom();
    };
  });
};

// D3 zoom behavior, catches zoom and drag events on the map.
HomePageView.prototype.zoomD3Behavior = function() {
  console.log('--- zoom d3 ', d3.event);
  if (
    d3.event &&
    d3.event.sourceEvent &&
    d3.event.sourceEvent.type === 'mousewheel'
  ) {
    // that sneaky IE gets here.
    return;
  }

  // console.log(this.d3Zoom.translate(), this.d3Zoom.scale());

  var t = d3.event.translate || this.d3Zoom.translate(),
    s = d3.event.scale || this.d3Zoom.scale(),
    height = this.mapEl.offsetHeight,
    width = this.mapEl.offsetWidth,
    h = height / 3;

  console.log(t, s);
  // limit the bounds of the drag area:
  t[0] = Math.min(width * (s - 1), Math.max(width * (1 - s), t[0]));
  t[1] = Math.min(
    height / 2 * (s - 1) + h * s,
    Math.max(height / 2 * (1 - s) - h * s, t[1])
  );
  this.d3Zoom.translate(t);
  this.executeZoom();
};

// triggered on each step/increment of the animation cycle.
// Runs the zoom action to zoom on the map, and also scale the circles as needed.
HomePageView.prototype.executeZoom = function(circleDuration) {
  if (this.d3Zoom === null) {
    return;
  }
  console.log(' -- executeZoom -- ');
  var currentScale = this.d3Zoom.scale();

  this.g.attr(
    'transform',
    'translate(' + this.d3Zoom.translate() + ')scale(' + currentScale + ')'
  );

  // console.log(' --- currentScale unrounded()', currentScale);
  // we round the current scale value to get the end destination basically.
  currentScale = Math.round(currentScale);

  // the scale levels and circle size need to be perfect per feedback,
  // to get the exact results requested we manually set the circle
  // scale and animate.
  if (currentScale < 1.5) {
    this.circleLinkScale = this.defaultCircleScale;
  } else if (currentScale > 1.5 && currentScale < 3.5) {
    this.circleLinkScale = 0.35;
  } else if (currentScale >= 3.5 && currentScale < 6) {
    this.circleLinkScale = 0.26;
  } else {
    this.circleLinkScale = 0.17;
  }

  // console.log('\n\n----');
  // console.log(' currentScale ', currentScale);
  // console.log(' circleLinkScale ', this.circleLinkScale);

  // we want a 0.0 time if on resize, we want 0.13 on zoom, and user interaction.
  circleDuration = (typeof circleDuration === 'undefined')? 0.13 : circleDuration;

  TweenMax.to(this.g.selectAll('circle'), circleDuration, {
    scale: this.circleLinkScale,
    transformOrigin: 'center center',
    delay: 0,
    ease: 'Power4.easeOut',
  });
};

HomePageView.prototype.drawMap = function() {
  console.log(' ---- draw Map ---');

  var that = this,
    width = this.mapEl.offsetWidth,
    height = this.mapEl.offsetHeight,
    center = [width / 2, height / 2];

  this.d3Projection = d3.geo
    .mercator()
    .translate([width / 2, height / 1.5])
    // .rotate([-12, 0, 0]) // to uncrop russia, warning you will get a line.
    .rotate([0, 0, 0])
    .scale((width - 1) / 2 / Math.PI * this.minZoom);

  var path = d3.geo.path().projection(this.d3Projection);

  this.resizeMapWrappers(width, height);

  d3.json(that.mapJSON, function(error, world) {
    d3.json(that.mapPointsJSON, function(error, data) {
      if (that.mapState === 'mobile') {
        console.log(' ---- edge case where the state has changed since loading the json.');
        return;
      }
      // sanitize the coordinates so they are all numbers.
      // this protects against user input error on the cms side.
      for (var p = 0; p < data.length; p++) {
        data[p].lon = that.sanitizeCoord(data[p].lon);
        data[p].lat = that.sanitizeCoord(data[p].lat);
      }
      that.mapPointsData = data;
      that.redrawCircles();
      // everything is loaded and init-ed
      that.$mapSegmentEl.addClass('loaded');
    });

    that.g
      .append('path')
      .datum({ type: 'Sphere' })
      .attr('class', 'world-wrapper')
      .attr('d', path);

    for ( var w = 0; w < world.features.length; w++) {
      if(  world.features[w].id === 'PAK' ){
          // world.features[w].id === 'KPA' ||
          // world.features[w].id === 'KIA' ) {
        // console.log(' null the modified pakistan border and use that which matches 110m.');
        world.features[w].geometry = null;
      }
    }

    that.jsonWorld = world;

    // that.g
    //   .append('path')
    //   .datum(world)
    //   .attr('class', 'boundaries')
    //   .attr('d', path);

    that.redrawCountries(path);
  });
};

HomePageView.prototype.redrawCountries = function(path) {
  if (this.jsonWorld === null) {
    console.log(' --- redrawCountries json world null.');
    return;
  }
  this.g.selectAll('.country').remove();

  this.g
    .attr('class', 'boundaries')
    .selectAll('boundaries')
    .data(this.jsonWorld.features)
    .enter()
    .append('path')
    .attr('class', function(d) {
      var code = d.id;
      // var code = d.properties.iso_a3;
      return 'country ' + code;
    })
    .attr('d', path);
}

// used on init and resize.
// this is not ideal, but makes the points always in line with the map on resize.
// on resize we remove all the points and redraw them. Just trying to reassign the point cx,cy
// values was not working correctly.
HomePageView.prototype.redrawCircles = function() {
  var that = this;
  console.log('---- kill all tweens before we remove all the circles.');
  TweenMax.killAll();

  if (!that.g) {
    console.log(' circles not found, that.g is null', that.g);
    return;
  }

  that.g.selectAll('.country-link').remove();

  if(this.mapPointsData === null) {
    console.log(' no map point data...');
    return;
  }

  that.g
    .selectAll('circle')
    .data(this.mapPointsData)
    .enter()
    .append('a')
    .attr('xlink:href', function(d) {
      if (d.permalink) {
        return d.permalink;
      } else {
        return false;
      }
    })
    .attr('class', 'country-link')
    .attr('data-point', function(d) {
      return d.country;
    })
    .attr('data-icon', function(d) {
      return d.icon;
    })
    .attr('data-mustache', function(d) {
      return d.mustache;
    })
    .attr('data-metric', function(d) {
      return d.data_point;
    })
    .append('circle')
    .attr('cx', function(d) {
      var cx = that.d3Projection([d.lon, d.lat])[0];
      d.x = cx;
      return cx;
    })
    .attr('cy', function(d) {
      var cy = that.d3Projection([d.lon, d.lat])[1];
      d.y = cy;
      return cy;
    })
    .attr('class', 'background-circle')
    .attr('r', 7);


  that.g
    .selectAll('.country-link')
    .append('circle')
    .attr('cx', function(d) {
      var cx = that.d3Projection([d.lon, d.lat])[0];
      return cx;
    })
    .attr('cy', function(d) {
      var cy = that.d3Projection([d.lon, d.lat])[1];
      return cy;
    })
    .attr('class', 'foreground-circle')
    .attr('transform-origin', 'center center')
    .attr('r', 7)
    .on('mouseover', function() {
      console.log(' mouse over..');
      that.animateCircle(this);
      that.revealDataPoint(this);
    });

  that.$el.find('.country-link').on('click', function(e) {
		// e.preventDefault();
    if (window.ga && window.gdprSafeTrack) {
      window.gdprSafeTrack(function() {
        window.ga('send', 'event', 'MapPin', 'click', e.currentTarget.getAttribute('data-point') );
      });
    }
  })

  // resize circles with no animation.
  that.executeZoom(0.0);
};

HomePageView.prototype.sanitizeCoord = function(coord) {
  if (isNaN(coord)) {
    var gpsDepth = 6;
    console.log(' GPS point ----- is NAN!');
    // try to parse a GPS value out of the string: if a user incorrectly put in:
    // 90.3563° E 23.6850° N as coordinates.
    if (coord.length > gpsDepth) {
      coord = coord.substring(gpsDepth, 0);
      if (!isNaN(coord)) {
        return coord;
      }
    }
    // if we get here. fail.
    return -180;
  } else {
    // it is a number nothing needed.
    // convert string to number:
    return parseFloat(coord);
  }
};

HomePageView.prototype.redrawMap = function() {
  if (!this.g) {
    console.log(' no map yet!');
    return;
  }

  var that = this;

  var width = this.wrapper.offsetWidth,
    height = this.wrapper.offsetHeight,
    center = [width / 2, height / 2],
    newScale = (width - 1) / 2 / Math.PI;

  this.resizeMapWrappers(width, height);

  // this.d3Zoom.scale(1);

  this.d3Projection.translate([width / 2, height / 1.5]).scale(newScale);

  var path = d3.geo.path().projection(this.d3Projection);

  // this.d3Map.select('.countries').attr('d', path);
  this.d3Map.selectAll('.world-wrapper').attr('d', path);
  // this.d3Map.selectAll('.boundaries').attr('d', path);

  this.redrawCountries(path);
  this.redrawCircles();

  this.d3Map.selectAll('.button').attr('cx', function(d) {
    return width - 42;
  });

  this.d3Map.selectAll('.line').attr('x', function(d) {
    return width - 53;
  });
};

HomePageView.prototype.setupMapMobile = function() {
  this.mapState = 'mobile';
  this.cleanUpState();
  this.toggleMapUI();

  var that = this;
  console.log(' --- setup map mobile. ---');
  this.$mapSegmentEl.addClass('tab-mble');
  setTimeout(function() {
    var width = this.mapEl.offsetWidth,
      height = this.mapEl.offsetHeight,
      center = [width / 2, height / 2];

    this.resizeMapWrappers(width, height);

    this.g = this.d3Map.append('g');

    this.d3Projection = d3.geo
      .mercator()
      .translate([width / 2, height / 1.5])
      .scale(width * 1.6 / Math.PI);

    var path = d3.geo.path().projection(this.d3Projection);

    d3.json(this.mapJSON, function(error, world) {
      that.g
        .append('path')
        .datum({ type: 'Sphere' })
        .attr('class', 'world-wrapper')
        .attr('d', path);

      that.g
        .append('path')
        .datum(world)
        .attr('class', 'boundaries')
        .attr('d', path);

      // everything is loaded and init-ed
      that.$mapSegmentEl.addClass('loaded');
    });

    this.$carouselEl.addClass('active');
    this.$dropDownWrapper.addClass('active');
    this.carousel.startTimer();
  }.bind(this), 10 );
};

// for both mobile and desktop we need to resize the map space to avail space.
HomePageView.prototype.resizeMapWrappers = function(width, height) {
  $(this.mapEl).css({
    width: width,
    height: height,
  });

  $(this.svg).css({
    width: width,
    height: height,
  });
}

HomePageView.prototype.redrawMobile = function() {
  if (!this.g) {
    console.log(' no map yet mobile!');
    return;
  }

  var that = this;
  var width = this.wrapper.offsetWidth,
    height = this.wrapper.offsetHeight,
    center = [width / 2, height / 2];

  this.resizeMapWrappers(width, height);

  this.d3Projection
    .translate([width / 2, height / 1.5])
    .scale(width * 1.6 / 2 / Math.PI);

  var path = d3.geo.path().projection(this.d3Projection);

  that.d3Map.selectAll('.button').attr('cx', function(d) {
    return width - 42;
  });

  that.d3Map.selectAll('.line').attr('x', function(d) {
    return width - 53;
  });
};

HomePageView.prototype.revealDataPoint = function(e) {
  console.log('\n*** revealDataPoint ***');

  var defaultSidebar = this.$el.find('.map-intro-copy.default');
  var dataSidebar = this.$el.find('.map-intro-copy.data-points');

  // first, hide the default
  $(defaultSidebar).css('display', 'none');

  // second, display the datapoint
  $(dataSidebar).css('display', 'block');

  var point = e.target ? e.target.parentNode : e.parentNode,
    country = point.getAttribute('data-point'),
    mustache = point.getAttribute('data-mustache'),
    metric = point.getAttribute('data-metric');

  // console.log('point: ', point);
  // console.log('country: ', country);
  // console.log('metric: ', metric);

  var dataHeader = document.getElementById('data-country'),
    dataBody = document.getElementById('data-body'),
    dataMustacheWrapper = document.getElementById('data-mustache'),
    dataIcon = document.getElementById('data-icon');

  dataHeader.innerHTML = country;
  dataBody.innerHTML = metric;

  if (mustache) {
    dataMustacheWrapper.innerHTML =
      '<span class="mustache">' + mustache + '</span>';
    dataMustacheWrapper.style.display = 'flex';
    dataMustacheWrapper.style.alignItems = 'center';
    dataMustacheWrapper.style.marginTop = '0';
  } else {
    dataMustacheWrapper.innerHTML = '';
  }
};

//
// this could be converted to media queries.
//
HomePageView.prototype.resizeMapCopySidePanel = function() {
  var dataHeader = document.getElementById('data-country'),
    dataBody = document.getElementById('data-body');

  var dataBodyFontSize = '8.0rem';

  if (CV.viewport.width < 1440 && CV.viewport.width > 1270) {
    dataBodyFontSize = '6.6rem';
  } else if (CV.viewport.width < 1270 && CV.viewport.width > 1100) {
    dataBodyFontSize = '5.8rem';
  } else if (CV.viewport.width < 1100 && CV.viewport.width > 900) {
    dataBodyFontSize = '5.0rem';
  } else if (CV.viewport.width < 900) {
    dataBodyFontSize = '4.6rem';
  }

  dataHeader.style.fontSize = '4.0rem';
  dataHeader.style.fontWeight = '100';
  dataHeader.style.lineHeight = '5.5rem';
  dataHeader.style.paddingBottom = '7.0rem';

  dataBody.style.fontSize = dataBodyFontSize;
  dataBody.style.fontWeight = '100';
  dataBody.style.lineHeight = '9.3rem';
  dataBody.style.letterSpacing = '-2px';
  dataBody.style.paddingTop = '4.0rem';
};

HomePageView.prototype.defaultData = function(e) {};

HomePageView.prototype.revealDropdown = function(e) {
  console.log('**** revealDropdown');
  $(e.target).toggleClass('active');
};

HomePageView.prototype.onResize = function() {
  if (!this.mapIsSetup) {
    return;
  }
  console.log('\n\n ----- resize ----');

  if (this.mapState == 'desktop' && CV.viewport.width > this.breakPointTablet) {
    // desktop state is already init, and viewport is large enough
    console.log('   desktop redraw');
    this.redrawMap();
  } else if (
    this.mapState == 'mobile' &&
    CV.viewport.width <= this.breakPointTablet
  ) {
    console.log('   mobile redraw');
    this.redrawMobile();
  } else if (
    this.mapState == 'desktop' &&
    CV.viewport.width <= this.breakPointTablet
  ) {
    console.log(' setup mobile');
    // desktop state is init, but desktop is too small.
    this.setupMapMobile();
  } else if (
    (this.mapState = 'mobile' && CV.viewport.width > this.breakPointTablet)
  ) {
    console.log(' setup desktop');
    // is mobile state but larger than breakpoint
    this.setupMapDesktop();
  }
  this.carousel.onResize();
  // this.resizeMapCopySidePanel();
  PageView.prototype.onResize.call(this);
};

HomePageView.prototype.contactModuleReveal = function(e) {
  if (CV.viewport.width > 768) {
    e.preventDefault();
    this.$contactModule.addClass('active');
    $(this.$body).addClass('noscroll');
  }
};

HomePageView.prototype.onTouchStart = function() {
  if (this.carousel) {
    this.carousel.onTouchStart();
  }
}

HomePageView.prototype.onTouchEnd = function() {
  if (this.carousel) {
    this.carousel.onTouchEnd();
  }
}

HomePageView.prototype.contactModuleHide = function(e) {
  this.$contactModule.removeClass('active');
  $(this.$body).removeClass('noscroll');
};

HomePageView.prototype.dispose = function() {
  this.carousel.dispose();
  this.carousel = null;
  this.$carouselEl = null;
  PageView.prototype.dispose.call(this);
};

module.exports = HomePageView;
