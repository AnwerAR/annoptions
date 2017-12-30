var webpack = require('webpack');
var path = require('path');
var CompressionPlugin = require('compression-webpack-plugin');
var BUILD_DIR = path.resolve(__dirname, 'dist');
var APP_DIR = path.resolve(__dirname, 'src/js');

let webpackProdConfig = {
	entry: APP_DIR + '/index.js',
	output: {
		path: BUILD_DIR + '/js',
		filename: 'ann-options.min.js'
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
	},
	plugins: [
		new webpack.optimize.UglifyJsPlugin({
			mangle: false,
			sourcemap: false
		}),
		new webpack.optimize.AggressiveMergingPlugin(),
		new CompressionPlugin({
			asset: "[path].gz[query]",
			algorithm: "gzip",
			test: /\.js$/,
			threshold: 10240,
			minRatio: 0.8
		})
	],
};

module.exports = webpackProdConfig;
