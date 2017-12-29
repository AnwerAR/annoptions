const gulp          = require( 'gulp' );
const sass          = require( 'gulp-sass' );
const cleanCSS      = require('gulp-clean-css');
const rename        = require('gulp-rename');
const autoPrefixer  = require( 'gulp-autoPrefixer' );
const sourcemaps    = require('gulp-sourcemaps');
const plumber       = require( 'gulp-plumber' );
const notifier      = require( 'gulp-plumber-notifier' );
const path          = require('path');

const gutil    = require("gulp-util");
const sassSrc  = './scss/main.scss';
const distCSS  = path.resolve(__dirname, 'dist/css/');

const webpack = require('webpack');
const webpackConfig = require("./webpack.config.js");
//import {webpackConfig} from './webpack.config';

gulp.task("webpack:build", function(callback) {
	// modify some webpack config options
	var myConfig = Object.create(webpackConfig);
	myConfig.plugins = myConfig.plugins.concat(
		new webpack.DefinePlugin({
			"process.env": {
				// This has effect on the react lib size
				"NODE_ENV": JSON.stringify("production")
			}
		}),
		new webpack.optimize.DedupePlugin(),
		new webpack.optimize.UglifyJsPlugin()
	);

	// run webpack
	webpack(myConfig, function(err, stats) {
		if(err) throw new gutil.PluginError("webpack:build", err);
		gutil.log("[webpack:build]", stats.toString({
			colors: true
		}));
		callback();
	});
});


// modify some webpack config options
var myDevConfig = Object.create(webpackConfig);
myDevConfig.devtool = "sourcemap";
//myDevConfig.debug = true;

// create a single instance of the compiler to allow caching
var devCompiler = webpack(myDevConfig);

gulp.task("webpack:build-dev", function(callback) {
	// run webpack
	devCompiler.run(function(err, stats) {
		if(err) throw new gutil.PluginError("webpack:build-dev", err);
		gutil.log("[webpack:build-dev]", stats.toString({
			colors: true
		}));
		callback();
	});
});

gulp.task('style-expanded', function(callback) {
  gulp.src( sassSrc )
    .pipe(sourcemaps.init())
    .pipe( sass( { outputStyle: 'expanded' } ) )
    .pipe( plumber() )
    .pipe( notifier() )
    .pipe( cleanCSS ( { format: 'beautify' } ) )

    //.pipe( autoPrefixer( 'last 4 versions', 'safari 5', 'ie 8', 'ie 9', 'ie 10', 'opera 12.1', 'ios 6', 'android 4' ) )
    .pipe( autoPrefixer( {browsers: 'last 4 versions', flexbox: 'no-2009' } ) )

    .pipe(rename({extname: '.css' /*suffix:*/ }))
    .pipe(sourcemaps.write( distCSS + 'maps'))
    .pipe(gulp.dest( distCSS ))
    .on('end', callback);
});


gulp.task( 'style-min', ['style-expanded'], function() {
    gulp.src( sassSrc )
    .pipe( sass({outputStyle: 'expanded'}) )
    .pipe( plumber() )
    .pipe( notifier() )

    .pipe(cleanCSS({
        level: { 2: { restructureRules: true, mergeSemantically: true } },
    }))
    .pipe(rename({suffix: '.min' }))
    .pipe( gulp.dest( distCSS ) );
});


gulp.task( 'watch', function() {
    gulp.watch( './scss/*.scss', ['style-min'] );
		gulp.watch( './scss/**/*.scss', ['style-min'] );
    //gulp.watch( path.resolve(__dirname, 'src/js/*.js'), ['webpack'] );
    gulp.watch( path.resolve(__dirname, 'src/**/*.js'), ["webpack:build-dev"] );
});

gulp.task("webpack-build", ["webpack:build"]);
gulp.task("webpack-dev", ["webpack:build-dev"]);
gulp.task( 'default', ['watch'] );
gulp.task( 'build', ['style-min', 'webpack-build'] );
