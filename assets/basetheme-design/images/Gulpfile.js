'use strict';

var gulp = require('gulp');
var sass = require('gulp-ruby-sass');
var debug = require('gulp-debug');
var sourcemaps = require('gulp-sourcemaps');
var livereload = require('gulp-livereload');
var autoprefixer = require('gulp-autoprefixer');
var jade = require('gulp-jade');
var plumber = require('gulp-plumber');


gulp.task('sass', function (callback) {
    return sass('css/sass/main.sass',
        { sourcemap: true,
          style: 'expanded'})
        .on('error', sass.logError)
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
        .pipe(debug({title: 'sass:'}))
        .pipe(sourcemaps.write('.', {
            includeContent: false,
            sourceRoot: 'source'
        }))
        .pipe(debug({title: 'maps:'}))
        .pipe(gulp.dest('css'))
        .pipe(livereload());
    callback()
});

gulp.task('templates', function() {
    gulp.src('jade/**/*.jade')
        .pipe(plumber())
        .pipe(jade({
            pretty: true,
        }))
        .pipe(livereload())
        .pipe(gulp.dest('.'))
});

gulp.task('watch', function () {
    livereload.listen();
    gulp.watch('css/sass/**/*.sass', ['sass']);
    livereload.listen();
    gulp.watch('jade/**/*.jade', ['templates']);
});

gulp.task('default', ['sass', 'templates', 'watch']);

//gulp.watch('css/sass/**/*.*', gulp.series('sass'));
//gulp.task('watch', function(){
//    gulp.watch('css/sass/**/*.*', ['sass'])
//});

gulp.task('exmpl', function (callback) {
    console.log(12);
    callback();
});

//gulp.task('all:ex', gulp.series('exmpl'));