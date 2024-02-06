/* enhance.js, based on the progressive enhancement boilerplate by @scottjehl - Filament group.
Copyright 2014 @scottjehl, Filament Group, Inc. Licensed MIT */
// (function( window ) {
'use strict';
var setTimeout = window.setTimeout;
var enhance = {};
// Define some variables to be used throughout this file
var doc = window.document;
var docElem = doc.documentElement;
var head = doc.head || doc.getElementsByTagName('head')[0];
// this references a meta tag's name whose content attribute should define the path to the full CSS file for the enhanced site
var fullCSSKey = 'fullcss';
// this references a meta tag's name whose content attribute should define the path to the enhanced JS file for the site (delivered to qualified browsers)
var fullJSKey = 'fulljs';
// classes to be added to the HTML element in qualified browsers
var htmlClasses = ['enhanced'];
// specify the filepath for the js file we want to use for the test
var pathInTheme = '/frontend/dist/js/vendors/detector-custom.min.js';
var pathTheme = window.cpsch.sDir;
var detectorURI = pathTheme + pathInTheme;
// specify the exact file size
var downloadSize = 4074;

// loadJS: load a JS file asynchronously. Included from https://github.com/filamentgroup/loadJS/
function loadJS(src) {
  var ref = window.document.getElementsByTagName('script')[0];
  var script = window.document.createElement('script');
  script.src = src;
  script.async = true;
  ref.parentNode.insertBefore(script, ref);
  return script;
}
// expose it
enhance.loadJS = loadJS;

// loadCSS: load a CSS file asynchronously. Included from https://github.com/filamentgroup/loadCSS/
function loadCSS(href, before, media) {
  var ss = window.document.createElement('link');
  var ref = before || window.document.getElementsByTagName('script')[0];
  var sheets = window.document.styleSheets;
  ss.rel = 'stylesheet';
  ss.href = href;
  // temporarily, set media to something non-matching to ensure it'll fetch without blocking render
  ss.media = 'only x';
  // inject link
  ref.parentNode.insertBefore(ss, ref);
  // This function sets the link's media back to `all` so that the stylesheet applies once it loads
  // It is designed to poll until document.styleSheets includes the new sheet.
  function toggleMedia() {
    var defined;
    for (var i = 0; i < sheets.length; i++) {
      if (sheets[i].href && sheets[i].href.indexOf(href) > -1) {
        defined = true;
      }
    }
    if (defined) {
      ss.media = media || 'all';
    } else {
      setTimeout(toggleMedia);
    }
  }

  toggleMedia();
  return ss;
}
// expose it
enhance.loadCSS = loadCSS;

// getMeta function: get a meta tag by name
// NOTE: meta tag must be in the HTML source before this script is included in order to guarantee it'll be found
function getMeta(metaname) {
  var metas = window.document.getElementsByTagName('meta');
  var meta;
  for (var i = 0; i < metas.length; i++) {
    if (metas[i].name && metas[i].name === metaname) {
      meta = metas[i];
      break;
    }
  }
  return meta;
}
// expose it
enhance.getMeta = getMeta;

/* Enhancements for all browsers - qualified or not */

// NOTE we can do a check here for any obvious features like querySelector (IE8+) and return if it's not supported
// if( !( 'querySelector' in doc ) ){
//   // basic browsers: last stop here!
//   return;
// }

// Add classes to HTML element
function addEnhanceClass() {
  docElem.className += '' + htmlClasses.join(' ');
}

// Remove classes to HTML element
function removeEnhanceClass() {
  docElem.className = docElem.className.replace(htmlClasses.join(' '), ' ');
}

function makeEnhancements() {
  /* Enhancements for qualified browsers - 'Cutting the Mustard'
      Add your qualifications for major browser experience divisions here.
      For example, you might choose to only enhance browsers that support document.querySelector (IE8+, etc).
      Use case will vary.
    */

    addEnhanceClass();
    
    /* Load JavaScript enhancements in one request.
          Your DOM framework and dependent component scripts should be concatenated and minified into one file that we'll load dynamically (keep that file as small as possible!)
          A meta tag with a name matching the fullJSKey should have a content attribute referencing the path to this JavaScript file.
          */
    var fullJS = getMeta(fullJSKey);
    if (fullJS) {
      loadJS(fullJS.content);
    }
}

makeEnhancements();

// expose the 'enhance' object globally. Use it to expose anything in here that's useful to other parts of your application.
window.enhance = enhance;
// }(this));
