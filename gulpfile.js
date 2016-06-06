var gulp = require('gulp');
var sass = require('gulp-sass');
var browserSync = require('browser-sync').create();

gulp.task('styles', function() {
    gulp.src('./app/scss/main.scss')
        .pipe(sass({
            outputStyle: 'compressed'
        }).on('error', sass.logError))
        .pipe(gulp.dest('./app/css'))
        .pipe(browserSync.reload({
            stream: true
        }));
    gulp.src('./app/scss/materialize.scss')
        .pipe(sass({
            outputStyle: 'compressed'
        }))
        .pipe(sass().on('error', sass.logError))
        .pipe(gulp.dest('./app/css'))
        .pipe(browserSync.reload({
            stream: true
        }));
});

gulp.task('serve', function() {

    browserSync.init({
        server: {
            baseDir: './app/'
        }
    })
    gulp.watch('./app/**/*.scss', ['styles']);
    gulp.watch('./app/**/*.html').on('change', browserSync.reload);
});

gulp.task('default', ['styles', 'serve']);