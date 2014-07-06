var gulp = require('gulp'),
	sass = require('gulp-ruby-sass'),
	uglify = require('gulp-uglify'),
	concat = require('gulp-concat'),
	minifycss = require('gulp-minify-css'),
	notify = require('gulp-notify'),
	rename = require('gulp-rename'),
	paths = { 
		sass : 'sass/*.scss'
	};

gulp.task('styles', function() {
	return gulp.src(['sass/*.scss'])
		.pipe(sass({ style: 'expanded' }))
		.pipe(gulp.dest(''))
		.pipe(rename({ suffix: '.min' }))
		.pipe(minifycss())
		.pipe(gulp.dest(''))
		.pipe(notify({ message : 'Styles complete.' }));
});

gulp.task('watch', function() {
  gulp.watch(paths.sass, ['styles']);
});