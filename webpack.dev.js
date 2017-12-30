var webpack = require('webpack');
var path = require('path');

var BUILD_DIR = path.resolve(__dirname, 'dist');
var APP_DIR = path.resolve(__dirname, 'src/js');

let webpackDevConfig = {
	entry: APP_DIR + '/index.js',
	output: {
		path: BUILD_DIR + '/js',
		filename: 'ann-options.js'
	},
	externals: {
		jquery: 'jQuery'
	},
	module: {
		loaders: [{
			test: /\.js?/,
			include: APP_DIR,
			exclude: /node_modules/,
			loader: 'babel-loader'
		}]
	}
};

module.exports = webpackDevConfig;
