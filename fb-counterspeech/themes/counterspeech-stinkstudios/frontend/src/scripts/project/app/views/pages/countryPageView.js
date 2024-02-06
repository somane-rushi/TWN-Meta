/*
 * Country page is still WIP
 *
 * The Map features have not been fully complete.
 *
 *
 * references:
 * http://bl.ocks.org/d3noob/5189284
 * http://bl.ocks.org/patricksurry/6621971
 */

var PageView = require('app/abstract/pageView');
var CV = require('app/config/currentValues');

var CountryPageView = function(options, datas) {
  // D3 variables.
  this.mapEl = null;
  this.d3path = null;
  this.d3World = null;
  this.d3Projection = null;
  this.tlast = [0, 0];
  this.slast = null;
  this.scale = 1;
  this.rotate = 0;
  this.countryCode = '';
  this.countryLat = 0;
  this.countryLng = 0;
  this.startingScale = 230;
  this.minMapScale = 1000;
  this.maxMapScale = 3500;
  this.mapJSON =
    window.cpsch.sDir + '/frontend/public/assets/json/world-110m.geojson';
    // window.cpsch.sDir + '/frontend/public/assets/json/map-corrected.geojson';
  // animate only on start. on resize it looks really bad.
  this.animateOnStartOnly = true;
  this.breakpoint = {
    mobile: 768,
  };
  this.isMobile = false;

  this.events = {
    'click #contact-module': 'contactModuleReveal',
    'click .close-cross': 'contactModuleHide',
    'click .contact-module-overlay': 'contactModuleHide',
  };
  PageView.call(this, options, datas);
};
_.extend(CountryPageView, PageView);
_.extend(CountryPageView.prototype, PageView.prototype);

CountryPageView.prototype.initDOM = function() {
  this.$body = document.body;
  this.$contactModule = this.$el.find('.contact-module-container');
  this.$contactModuleOverlay = this.$el.find('.contact-module-overlay');
  PageView.prototype.initDOM.call(this);
};

CountryPageView.prototype.onDOMInit = function() {
  this.mapEl = document.getElementById('country-map');
  this.setupMap();
  PageView.prototype.onDOMInit.call(this);
};

CountryPageView.prototype.setupMap = function() {
  var that = this;

  this.wrapper = document.querySelector('.map-wrapper');
  this.svg = document.querySelector('#country-map svg');
  this.countryCode = this.mapEl.getAttribute('data-code');
  this.countryLat = this.mapEl.getAttribute('data-lat');
  this.countryLng = this.mapEl.getAttribute('data-lng');

  var width = this.mapEl.offsetWidth,
    height = this.mapEl.offsetHeight,
    center = [width / 2, height / 2];

  this.d3Projection = d3.geo.mercator();
  this.d3path = d3.geo.path().projection(this.d3Projection);

  var map = d3
    .select(this.mapEl)
    .append('svg')
    .attr('width', '100%')
    .attr('height', '100%')
    .append('g');

  this.g = map;

  d3.json(this.mapJSON, function(error, _world) {
    if (error) return console.log(error);
    // console.log(_world);
    that.d3World = _world;
    that.redraw();
  });
};

CountryPageView.prototype.redraw = function() {
  // console.log(' - redraw -');

  var width = this.wrapper.offsetWidth,
    height = this.wrapper.offsetHeight,
    countryCode = this.mapEl.getAttribute('data-code'),
    center = [width / 2, height / 2];

  // reset projection before zoomin
  this.d3Projection
    .rotate([this.rotate, 0])
    .scale(this.startingScale)
    .translate(center);

  $(this.mapEl).css('width', width);
  $(this.mapEl).css('height', height);

  var that = this,
    zoomed = false;

  that.g.selectAll('path').remove();

  that.g
    .attr('class', 'countries')
    .selectAll('countries')
    .data(that.d3World.features)
    .enter()
    .append('path')
    .attr('class', function(d) {
      var code = d.id;
      // var code = d.properties.iso_a3;
      return 'country ' + code;
    })
    .attr('name', function(d) {
      return d.properties.name;
    })
    .attr('d', that.d3path)
    .attr('id', function(d) {
      // console.log(d.properties.iso_a3 === countryCode);
      // if ( d.properties.iso_a3 === countryCode ) {
      if (d.id === countryCode) {
        d.id = countryCode;
        that.zoomToLatLng(d);
        zoomed = true;
      }
      return countryCode;
    });

  if (!zoomed) {
    // if region failed, zoom in regardless.
    that.zoomToLatLng({ id: null });
  }
};

CountryPageView.prototype.zoomToLatLng = function(object) {
  // console.log(' zooming to lat long: ', this.countryLat, this.countryLng);
  var that = this,
    lat = this.countryLat,
    lng = this.countryLng,
    projection = this.d3Projection,
    pt = projection([lat, lng]),
    width = this.wrapper.offsetWidth,
    height = this.wrapper.offsetHeight,
    currentScale = projection.scale(),
    // skip amount of progression from the base map during animation:
    skipAmount = {
      r: 0.98,
      s: 0.17,
    };

  // console.log(d3.select('.' + object.id));
  d3.select('.' + object.id).attr('class', 'highlight');
	if (object.id == 'IND' ) {
		// also select KPA / KIA countries as India
		// Kashmir, Pakistani administered. hmmm?
		d3.select('.KPA').attr('class', 'highlight');
		// Kashmir, India administered.
		d3.select('.KIA').attr('class', 'highlight');
	}
	
  if (isNaN(pt[0]) || isNaN(pt[1])) {
    var fail = true;
    var gpsDepth = 6;
    console.log(' GPS points ----- are NAN!');
    // try to parse a GPS value out of the string: if a user incorrectly put in:
    // 90.3563° E 23.6850° N as coordinates.
    if (lat.length > gpsDepth && lng.length > gpsDepth) {
      lat = lat.substring(gpsDepth, 0);
      lng = lng.substring(gpsDepth, 0);
      if (!isNaN(lat) && !isNaN(lng)) {
        pt = projection([lat, lng]);
        if (!isNaN(pt[0]) && !isNaN(pt[1])) {
          fail = false;
        }
      }
    }
    if (fail) {
      return;
    }
  }

  var duration = 750;
  var debug = this.animateOnStartOnly ? 1 : 0;
  var b = this.d3path.bounds(object),
    scale = 0.93 / ((b[1][1] - b[0][1]) / height) * this.startingScale;

  // animate only the first time.
  this.animateOnStartOnly = false;

  if (object.id == 'USA') {
    skipAmount.s = 0.45;
    scale = 900;
  } else if (object.id == 'CAN') {
    skipAmount.s = 0.45;
    scale = 900;
  } else if (object.id == 'FRA') {
    skipAmount.s = 0.45;
    scale = 1500;
  } else if (object.id == 'PHL') {
    scale = 1700;
  } else if (object.id == 'MAR') {
    scale = 1000;
	} else if (object.id == 'BHR') {
		scale = 38000;
	} else if (object.id == 'BRA') {
		scale = 600;
	} else if (object.id == 'IND') {
		scale = 800;
  } else if (scale < this.minMapScale) {
    console.log(' min map....');
    scale = this.minMapScale;
  } else if (scale > this.maxMapScale) {
    scale = this.maxMapScale;
  }

  if (this.isMobile) {
    scale = 0.5 * scale;
  }

  var projectionInverted = projection.invert([width - pt[0], height - pt[1]]);
  var destination = {
    s: scale,
    x: projectionInverted[0],
    y: projectionInverted[1],
  };

  // console.log('pts', pt);
  // console.log('projectionInverted', projectionInverted);
  // console.log('destination', destination);

  // set the globe closer in on start of animation.
  var s = d3.interpolate(projection.scale(), destination.s);
  var r = d3.interpolate(projection.rotate(), [
    destination.x,
    destination.y,
    0,
  ]);
  projection.rotate(r(skipAmount.r)).scale(s(skipAmount.s));
  that.g.selectAll('path').attr('d', that.d3path);

  d3.transition().duration(duration * debug).tween('rst', function() {
    var s = d3.interpolate(projection.scale(), destination.s);
    var r = d3.interpolate(projection.rotate(), [
      destination.x,
      destination.y,
      0,
    ]);

    return function(t) {
      projection.rotate(r(t)).scale(s(t));
      // re-project path data
      that.g.selectAll('path').attr('d', that.d3path);
    };
  });
};

CountryPageView.prototype.onShown = function() {
  PageView.prototype.onShown.call(this);
};

CountryPageView.prototype.onResize = function() {
  if (CV.viewport.width > this.breakpoint.mobile) {
    this.isMobile = false;
  } else {
    this.isMobile = true;
  }

  if (this.g && this.d3World) {
    this.redraw();
  }

  PageView.prototype.onResize.call(this);
};

CountryPageView.prototype.dispose = function() {
  PageView.prototype.dispose.call(this);
};

CountryPageView.prototype.contactModuleReveal = function(e) {
  // console.log(CV.viewport.width);

  if (CV.viewport.width > this.breakpoint.mobile) {
    e.preventDefault();
    this.$contactModule.addClass('active');
    $(this.$body).addClass('noscroll');
  }
};

CountryPageView.prototype.contactModuleHide = function(e) {
  this.$contactModule.removeClass('active');
  $(this.$body).removeClass('noscroll');
};

module.exports = CountryPageView;
