'use strict';

var gulp = require('gulp');
var rename = require('gulp-rename');
var uglify = require('gulp-uglify');
var minifyCss = require('gulp-minify-css');

gulp.task('js', function () {
        return gulp.src('templates/js/ShoppingApp.js')
            // This will output the non-minified version
            .pipe(gulp.dest('templates/js/'))
            // This will minify and rename to foo.min.js
            .pipe(uglify())
            .pipe(rename({ extname: '.min.js' }))
            .pipe(gulp.dest('templates/js/'));
});
gulp.task('css', function() {
    return gulp.src('templates/css/main.css')
        .pipe(gulp.dest('templates/css/'))
        .pipe(minifyCss({compatibility: 'ie8'}))
        .pipe(gulp.dest('templates/css/'));
});

gulp.task('default', function () {
    gulp.watch('templates/js/ShoppingApp.js', function () {
        gulp.run('js');
    });
    gulp.watch('templates/css/main.css', function () {
        gulp.run('css');
    });
});
