'use strict';

var gulp = require('gulp');
var sass = require('gulp-ruby-sass');
var debug = require('gulp-debug');
var sourcemaps = require('gulp-sourcemaps');
var autoprefixer = require('gulp-autoprefixer');
var jade = require('gulp-jade');
var plumber = require('gulp-plumber');
var bs = require('browser-sync').create();

gulp.task('serve', function() {

    bs.init({
        proxy: "http://localhost:63342/themeClubCube/assets/basetheme-design/"
    });

    gulp.watch("css/*.css").on('change', bs.reload);
    gulp.watch("*.html").on('change', bs.reload);
});

gulp.task('sass', function (callback) {
    return sass(['css/sass/critical.sass', 'css/sass/main-style.sass'],
        { sourcemap: true,
          style: 'expanded'})
        .on('error', sass.logError)
        .pipe(debug({title: 'sass:'}))
        .pipe(autoprefixer({
            browsers:  [
                'Chrome >= 35',
                'Firefox >= 31',
                'Edge >= 12',
                'Explorer >= 9',
                'iOS >= 8',
                'Safari >= 8',
                'Android 2.3',
                'Android >= 4',
                'Opera >= 12'
            ],
            cascade: true
        }))
        .pipe(debug({title: 'prefx:'}))
        .pipe(sourcemaps.write('.', {
            includeContent: false,
            sourceRoot: 'source'
        }))
        .pipe(debug({title: 'maps:'}))
        .pipe(gulp.dest('css'));
    callback();
});

gulp.task('templates', function(callback) {
    gulp.src('jade/*.jade')
        .pipe(plumber())
        .pipe(jade({
            pretty: true,
        }))
        .pipe(gulp.dest('.'))
        .pipe(debug({title: 'jade:'}));
    callback();
});

gulp.task('watch', function () {
    gulp.watch('css/sass/**/*.*', ['sass']);
    gulp.watch('jade/**/*.*', ['templates']);
});

gulp.task('default', ['serve','templates','sass', 'watch']);