'use strict';

var gulp = require('gulp');
var sass = require('gulp-sass');
var debug = require('gulp-debug');
var sourcemaps = require('gulp-sourcemaps');
var autoprefixer = require('gulp-autoprefixer');
var jade = require('gulp-jade');
var plumber = require('gulp-plumber');
var uglify = require('gulp-uglify');
var notify = require('gulp-notify');
var bs = require('browser-sync').create();
var imagemin = require('gulp-imagemin');
const rename = require("gulp-rename");
const del = require('del');
const clean_css = require('gulp-clean-css');
const { src } = require('gulp');

gulp.task('serve', function () {

  bs.init({
    proxy: "http://localhost:63342/assets/basetheme-design/",
    port: 63342,
    ui: {
      port: 63342
    }
  });

  gulp.watch("src/css/*.css").on('change', bs.reload);
  gulp.watch("dist/*.html").on('change', bs.reload);
});

gulp.task('sass', function (callback) {
  return gulp.src(['src/css/sass/*.sass'])
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
        overrideBrowserslist: ['last 5 versions'],
        cascade: true
      }))
      .pipe(debug({title: 'prefx:'}))
      .pipe(debug({title: 'maps:'}))
      .pipe(clean_css())
      .pipe(gulp.dest('dist/css'));
  callback();
});


gulp.task('skins', function (callback) {
  return gulp.src(['src/css/sass/skins/*.sass'])
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
      .pipe(sass())
      .pipe(debug({title: 'sass:'}))
      .pipe(autoprefixer({
        overrideBrowserslist: ['last 5 versions'],
        cascade: true
      }))
      .pipe(debug({title: 'prefx:'}))
      .pipe(gulp.dest('dist/css/skins'));
  callback();
});

gulp.task('templates', function (callback) {
  gulp.src('src/jade/*.jade')
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
      .pipe(gulp.dest('dist/'))
      .pipe(debug({title: 'jade:'}));
  callback();
});

gulp.task('scripts', function (callback) {
  return gulp.src(
    'src/js/**/*.js' 
  )
  .pipe(uglify()) 
  .pipe(gulp.dest('dist/js/'))
  callback();
});

gulp.task('fonts', function (callback) {
  return gulp.src(
    'src/fonts/**/*.*' 
  ) 
  .pipe(gulp.dest('dist/fonts/'))
  callback();
});

gulp.task('images', function (callback) {
  return gulp.src(
    'src/images/**/*.*' 
  )
  .pipe(imagemin({
    progressive: true,
    svgoPlugins: [{removeViewBox: false}],
    interlaced: true,
    optimizationLevel: 3
  }))
  .pipe(gulp.dest('dist/images/'))
  callback();
});

gulp.task('clean', function (callback) {
  return del('dist/');
  callback();
});

gulp.task('minImg', function () {
  return gulp.src('../src_uploads/**/*.*'
  )
      .pipe(imagemin({
        progressive: true,
        svgoPlugins: [{removeViewBox: false}],
        interlaced: true,
        optimizationLevel: 1
      }))
      .pipe(gulp.dest('../uploads/'));
});



gulp.task('watch', function () {
  gulp.watch('src/css/sass/**/*.*', gulp.parallel('sass'));
  gulp.watch('src/css/sass/skins/*.*', gulp.parallel('skins'));
  gulp.watch('src/jade/**/*.*', gulp.parallel('templates'));
  gulp.watch('src/js/**/*.*', gulp.parallel('scripts'));
  gulp.watch('src/fonts/**/*.*', gulp.parallel('fonts'));
  gulp.watch('src/images/**/*.*', gulp.parallel('images'));
});


gulp.task('default', gulp.series('clean', gulp.parallel('templates', 'sass', 'scripts', 'fonts', 'images', 'skins', 'minImg', 'watch')));

