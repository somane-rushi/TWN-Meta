const path = require('path');
// Require the Node.js path module
const webpack = require('webpack');
// Require webpack for the modules

const PROD = JSON.parse(process.env.ENV_PROD || false);
// Produciton flag is passed in the npm script.

let plugins = [];
let filename = "bundle.js";
let outputPath = path.join(__dirname, '../../script-templates/');
let devtool = "eval-source-map";
let cache = true;
let watch = true;
// Define the plugins, filename, outputPath, devtool, cache and watch for when the env is not PROD
//
if( PROD ) {
  // Override devtool, plugins, filename and outputPath when the PROD flag is enabled
  plugins.push(
    new webpack.optimize.UglifyJsPlugin({
      minimize: true,
      drop_console: true,
      compress: {
          warnings: false,
          pure_funcs: [ 'console.log' ]
      },
      output: {
        comments: false,
      }
    })
  );
  // Add UglifyJsPlugin if the env is PROD

  filename = 'bundle.min.js';
  // Update the filename

  devtool = false;
  // remove the source mapping on prod

  cache = false;
  // setting cache to false in production

  watch = false;
  // setting watch to false in production

  // console.log('\n ---- WEBPACK ----\n running in production');

}else {
  // console.log('\n ---- WEBPACK ----\n running in development');
}

module.exports = {

  entry: "./src/scripts-inline/inline.js",
  // Here the application starts executing
  // and webpack starts bundling

  output: {
   // options related to how webpack emits results
   path: outputPath,
   // output path for the bundle, set on top depending on the environment
   filename: filename,
    // the filename template for entry chunks, set on top depending on the environment
  },

  devtool: devtool,
  // devtool is defined on top and switched depending on the environment
  // enhance debugging by adding meta info for the browser devtools
  // source-map most detailed at the expense of build speed.

  target: "web",
  // the environment in which the bundle should run
  // changes chunk loading behavior and available modules

  resolve: {

    modules: [
      "node_modules",
    ],
    // options for resolving module requests
    // (does not apply to resolving to loaders)
  },

  stats: {
    colors: true,
    errors: true,
    errorDetails: true
  },
  // lets you precisely control what bundle information gets displayed

  plugins: plugins,
  // list of additional plugins

  // Advanced options
  bail: true,
  // fail out on the first error instead of tolerating it.

  cache: cache,
  // disable/enable caching

  watch: watch,
  // enables watching
};
