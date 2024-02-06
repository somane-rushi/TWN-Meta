var path          = require('path');
var webpack       = require('webpack');
var ManifestPlugin = require('webpack-manifest-plugin');
var baseDir				= path.join( __dirname, '../');
var appEntryPoint = path.join( baseDir, 'src/scripts/project/main.js');
var includePath   = path.join(baseDir, 'src/scripts');
var PROD          = JSON.parse(process.env.ENV_PROD || 0);
var env           = { prod: PROD };
var plugins       = [ new webpack.NoEmitOnErrorsPlugin() ];

if (PROD) {
  plugins.push(
    new webpack.optimize.UglifyJsPlugin({
      sourceMap: false,
      mangle: true,
      compress: {
        drop_console: true
      },
      output: {
        comments: false
      }
    })
  );

	plugins.push(
		new ManifestPlugin({
			fileName: 'asset-manifest.json',
		})
	);

  var filename = 'bundle.min.[hash:8].js';
  var pathname = 'dist/js/';
} else {

  var filename = 'bundle.js';
  var pathname = 'public/js/';
}

// function generatedVersion() {
//
// 	var splittime = (+ new Date()).toString().match(/.{1,5}/g);
// 	var v = '';
// 	for ( var s = 0; s < splittime.length; s++) {
// 		v += splittime[s] + '.';
// 	}
//
// 	return v.substring(0, v.length - 1)
// };

plugins.push(new webpack.DefinePlugin({
  ENV: JSON.stringify(env)
}));

plugins.push(new webpack.ProvidePlugin({
  $: 'jquery',
  _: 'underscore',
  Backbone: 'backbone',
  d3: 'd3',
  jQuery: 'jquery',
}));

// console.log('appEntryPoint: ', appEntryPoint);
// console.log('baseDir + pathname', baseDir + pathname);

module.exports = {

  node: {fs: 'empty'},

  entry: appEntryPoint,

  output: {
    path: baseDir + pathname,
    filename: filename,
    publicPath: baseDir + pathname
  },
  plugins: plugins,
  resolve: {
    alias: {
      'app': baseDir + '/src/scripts/project/app',
      'd3': includePath + '/vendors/d3.min',
      'Detectizr': includePath + '/vendors/detectizr',
      'jquery': includePath + '/vendors/zepto',
      'zepto': 'jquery'
    }
  },

  module: {
    loaders: [
      {test: /zepto\.js$/, loader: 'exports-loader?Zepto; delete window.$; delete window.Zepto;'},
      {test: /detectizr\.js$/, loader: 'imports-loader?this=>window!exports-loader?window.Detectizr;'},
      {test: /d3\.js$/, loader: 'imports-loader?this=>window!exports-loader?window.d3;'},
    ]
  },

  stats: {colors: true},
  devtool: 'source-map'
};
