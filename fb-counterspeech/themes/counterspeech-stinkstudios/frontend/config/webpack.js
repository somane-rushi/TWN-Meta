//
// This script will manage all webpack configurations.
// based off of NODE variables sent it will determine how to build and what to build:
//

var chalk = require('chalk');
var webpack = require('webpack');
var config = require('./webpack.config');
var configInline = require('./webpack.inline.config');
var del = require('delete');
var path = require('path');

var INLINE = JSON.parse(process.env.INLINE || false);
var PROD = JSON.parse(process.env.ENV_PROD || false);
var handleCompile;
var compiler;
var wTYPE = '';

if (INLINE) {
	// render inline config.
	compiler = webpack(configInline);
	wTYPE = 'Inline JS';
} else {
	// render src js file.
	compiler = webpack(config);
	wTYPE = 'App JS';
}

if (PROD) {
	// remove any existing files in the dist folder.
	if (!INLINE) {
		var jsFiles = path.join(config.output.path, '*.js');
		// delete hashed previous file.
		del.sync( jsFiles );
	}
	// no watch, just the run command above.
	compiler.run(webpackResponse);
	console.log(chalk.bgCyan(' Webpack Running '+ wTYPE +' in Production.'));


} else {
	console.log(chalk.bgCyan(' Webpack Running '+ wTYPE + ' in Development.'));
	compiler.watch({ // watch options:
	    aggregateTimeout: 300, // wait so long for more changes
	    poll: true // use polling instead of native watchers
	    // pass a number to set the polling interval
	}, webpackResponse);
}

function webpackResponse(err, stats) {
	// console.log(stats);
	if (err) {
		printErrors(chalk.bgRed('Failed to compile.'), [err]);
		process.exit(1);
	}
	if (stats.compilation.errors.length) {
		printErrors('Failed to compile.', stats.compilation.errors);
		process.exit(1);
	}
	console.log(chalk.bgGreen('Compiled successfully: '+ wTYPE + ' ' + new Date()));
};

// Print out errors
function printErrors(summary, errors) {
  console.log(chalk.bgRed(summary));
  console.log();
  errors.forEach(err => {
    console.log(err.message || err);
    console.log();
  });
}
