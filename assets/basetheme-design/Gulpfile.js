'use strict';

var gulp = require('gulp');
var sass = require('gulp-sass');
var debug = require('gulp-debug');
var sourcemaps = require('gulp-sourcemaps');
var autoprefixer = require('gulp-autoprefixer');
var jade = require('gulp-jade');
var plumber = require('gulp-plumber');
var notify = require('gulp-notify');
var bs = require('browser-sync').create();
var imagemin = require('gulp-imagemin');

gulp.task('serve', function () {

  bs.init({
    proxy: "http://localhost:63342/assets/basetheme-design/",
    port: 63342,
    ui: {
      port: 63342
    }
  });

  gulp.watch("css/*.css").on('change', bs.reload);
  gulp.watch("*.html").on('change', bs.reload);
});

gulp.task('sass', function (callback) {
  return gulp.src(['css/sass/*.sass'])
      .pipe(plumber(
          {
            errorHandler: notify.onError(function (err) {
                  return {
                    title: 'sass',
                    message: err.message
                  };
                }
            )
          }))
      .pipe(sourcemaps.init())
      .pipe(sass())
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

gulp.task('templates', function (callback) {
  gulp.src('jade/*.jade')
      .pipe(plumber())
      .pipe(jade({
        pretty: true,
      }))
      .on('error', notify.onError(function (err) {
        return {
          title: 'jade',
          message: err.message
        }
      }))
      .pipe(gulp.dest('.'))
      .pipe(debug({title: 'jade:'}));
  callback();
});

gulp.task('minImg', function () {
  return gulp.src('../uploads/gallery/*.jpg')
      .pipe(imagemin({
        progressive: true,
      }))
      .pipe(gulp.dest('../uploads/gallery/images'));
});

gulp.task('watch', function () {
  gulp.watch('css/sass/**/*.*', ['sass']);
  gulp.watch('jade/**/*.*', ['templates']);
});

//gulp.task('default', ['serve', 'templates', 'sass', 'watch']);
gulp.task('default', ['templates', 'sass', 'watch']);

/**
 * var notify = require ('gulp-notify');
 *
 * .on('error', notify.onError(function(err) {
 * return: {
 *  title: 'sass';
 *  message: err.message
 * };
 * }))  можно проверить установив после одного потока сасс - но он будет работать только на один поток
 * чтобы работал на все потоки и ловил ошибки используем так пламбер и ставим его в
 *
 *самом начале
 *
 * второй вариант отлова ошибок
 * .pipe(plumber(
 *  errorHandler: notify.onError(function(err) {
 *  return: {
 *  title: 'sass';
 *  message: err.message
 * };
 *  }
 * ))
 *
 *
 *
 *  .on('error', notify.onError(function (err) {
            return {
                title: 'sass',
                message: err.message,
            };
        }))
 */
