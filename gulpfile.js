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
const sassSrc  = './src/scss/main.scss';
const distCSS  = path.resolve(__dirname, 'dist/css/');

const webpack = require('webpack');
const webpackConfig = require("./webpack.dev.js");
const webpackProdConfig = require("./webpack.prod.js");


gulp.task("webpack:build", function(callback) {
	var Config = Object.create(webpackProdConfig);
	webpack(Config, function(err, stats) {
		if(err) throw new gutil.PluginError("webpack:build", err);
		gutil.log("[webpack:build]", stats.toString({
			colors: true
		}));
		callback();
	});
});


var DevConfig = Object.create(webpackConfig);
DevConfig.devtool = "sourcemap";
var devCompiler = webpack(DevConfig);

gulp.task("webpack:dev", function(callback) {
	devCompiler.run(function(err, stats) {
		if(err) throw new gutil.PluginError("webpack:dev", err);
		gutil.log("[webpack:dev]", stats.toString({
			colors: true
		}));
		callback();
	});
});

gulp.task('sass:dev', function(callback) {
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


gulp.task( 'sass:build', ['sass:dev'], function() {
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


gulp.task( 'watch:sass', function() {
    gulp.watch( path.resolve(__dirname, './src/scss/*.scss'), ['sass:dev'] );
		gulp.watch( path.resolve(__dirname, './src/scss/**/*.scss'), ['sass:dev'] );
});
gulp.task( 'watch:webpack', function() {
    gulp.watch( path.resolve(__dirname, 'src/**/*.js'), ["webpack:dev"] );
});
gulp.task( 'watch', ['watch:webpack', 'watch:sass'] );

gulp.task("build:sass", ["sass:build"]);
gulp.task("build:webpack", ["webpack:build"]);
gulp.task("build", [ "build:sass", "build:webpack" ]);

gulp.task( 'default', ['watch'] );
