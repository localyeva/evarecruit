var gulp = require('gulp');

// Include Our Plugins
var less = require('gulp-less');
var minifyCSS = require('gulp-minify-css');
var uglify = require('gulp-uglify');
var concat = require('gulp-concat');
var addsrc = require('gulp-add-src');
var sourcemaps = require('gulp-sourcemaps');
var templateCache = require('gulp-angular-templatecache');

// CSS & Less
/*
gulp.task('css', function(){
    gulp.src('less/all.less')
	.pipe(sourcemaps.init())
	.pipe(less())
	.pipe(minifyCSS())
	.pipe(sourcemaps.write('source-maps'))
	.pipe(gulp.dest('public/css'));
});
*/

// CSS
gulp.task('css', function() {
    gulp.src('css/bootstrap.min.css')
    .pipe(addsrc.append('css/font-awesome.css'))
    .pipe(addsrc.append('css/jquery.sidr.dark.css'))
    .pipe(addsrc.append('css/jquery.fancybox.css'))
    .pipe(addsrc.append('css/nanoscroller.css'))
    .pipe(sourcemaps.init())
    .pipe(concat('app.css'))
    .pipe(minifyCSS())
    .pipe(sourcemaps.write('source-maps'))
    .pipe(gulp.dest('public/css'));
});


// CSS extra
gulp.task('css-extra', function() {
    gulp.src('css/jquery.sidr.dark.css')
    .pipe(addsrc.append('css/jquery.fancybox.css'))
    .pipe(addsrc.append('css/nanoscroller.css'))
    .pipe(sourcemaps.init())
    .pipe(concat('extra.css'))
    .pipe(minifyCSS())
    .pipe(sourcemaps.write('source-maps'))
    .pipe(gulp.dest('public/css'));
});

// JS
gulp.task('js', function() {
    gulp.src('js/bootstrap.min.js')
    .pipe(addsrc.append('js/jquery.sidr.min.js'))
    .pipe(addsrc.append('js/jquery.nanoscroller.min.js'))
    .pipe(addsrc.append('js/jquery.fancybox.min.js'))
    .pipe(sourcemaps.init())
    .pipe(concat('app.js'))
    .pipe(uglify())
    .pipe(sourcemaps.write('source-maps'))
    .pipe(gulp.dest('public/js'));
});

// Plugin - JS
gulp.task('plugin-js', function() {
    gulp.src('plugin-js/jquery.validate.min.js')
    .pipe(addsrc.append('plugin-js/jquery.validate.bootstrap.popover.min.js'))
    .pipe(addsrc.append('plugin-js/additional-methods.min.js'))
    .pipe(sourcemaps.init())
    .pipe(concat('plugin.js'))
    .pipe(uglify())
    .pipe(sourcemaps.write('source-maps'))
    .pipe(gulp.dest('public/js'));
});


// Compile JS
gulp.task('compile', function () {
  gulp.src('js/*.js')
  .pipe(concat('main.js'))
  // gulp.dest('dist/'); // has no method 'dest'
});


// Default Task
gulp.task('default', ['js', 'css', 'css-extra', 'plugin-js']);
