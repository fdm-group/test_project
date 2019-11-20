var gulp = require('gulp');
var sass = require('gulp-sass');
var cleanCSS = require('gulp-clean-css');
var browserSync = require('browser-sync').create();
var reload = browserSync.reload;
var slick = 'node_modules/slick-carousel/slick/';
var jssrc = 'fdm/src/js/';
var urlAdjuster = require('gulp-css-url-adjuster');
// start browserSync
gulp.task('browser-sync', function(){
	browserSync.init({
		proxy: 'http://fresh.local/'
	});
});

gulp.task('sass', function(){
		return gulp.src(['node_modules/bootstrap/scss/bootstrap.scss','node_modules/@fortawesome/fontawesome-free/scss/*.*', slick + 'slick.css', 'fdm/src/scss/style.scss'])
		.pipe(sass().on('error', sass.logError))
		.pipe(urlAdjuster({prepend: '/wp-content/themes/fdm/images/'}))
		.pipe(cleanCSS({compatibility: 'ie8'}))
		.pipe(gulp.dest('fdm/css'))
		.pipe(browserSync.stream());

});

gulp.task('js', function() {
    return gulp.src(['node_modules/bootstrap/dist/js/bootstrap.min.js', 'node_modules/@fortawesome/fontawesome-free/js/all.js', slick + 'slick.min.js', jssrc + '*.js', 'node_modules/jquery/dist/jquery.min.js', 'node_modules/popper.js/dist/umd/popper.min.js'])
        .pipe(gulp.dest("fdm/js"))
        .pipe(browserSync.stream());
});

gulp.task('watch',['browser-sync', 'sass','js'], function(){
gulp.watch(['node_modules/bootstrap/scss/bootstrap.scss','fdm/src/scss/**/*.scss','fdm/src/js/*.js'], ['sass','js']);

});

gulp.task('default', ['browser-sync', 'sass', 'watch', 'js']);
