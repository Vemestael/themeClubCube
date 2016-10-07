'use strict';

var gulp = require('gulp');
var sass = require('gulp-sass');
var debug = require('gulp-debug');
var sourcemaps = require('gulp-sourcemaps');
var autoprefixer = require('gulp-autoprefixer');
var plumber = require('gulp-plumber');


gulp.task('sass', function (callback) {
  return gulp.src('css/sass/*.sass')
    .pipe(sourcemaps.init())
    .pipe(sass().on('error', sass.logError))
    .pipe(debug({title: 'sass:'}))
    .pipe(autoprefixer({
      browsers: [
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

gulp.task('watch', function () {
  gulp.watch('css/sass/**/*.*', ['sass']);
});

gulp.task('default', ['sass', 'watch']);