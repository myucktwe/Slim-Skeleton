// Modules & Plugins
var gulp        = require('gulp');
var browserSync = require('browser-sync').create();

// Static server
gulp.task('browser-sync', function () {
    browserSync.init({
        proxy: 'develop:8082',
        port: '8082',
        // online: true,
        // browser: ['chrome', 'firefox'],
        // browser: ['chrome'],
        browser: ['firefox'],
    });
    // browserSync.init({
    //     server: './public/',
    //     directory: true,
    //     browser: ['firefox'],
    // });
    gulp.watch('./**/*.php').on('change', browserSync.reload);
    gulp.watch('./**/*.twig').on('change', browserSync.reload);
    gulp.watch('./**/*.scss').on('change', browserSync.reload);
    gulp.watch('./**/*.js').on('change', browserSync.reload);
});

// Default & Custom Task
gulp.task('default', gulp.parallel('browser-sync'));
gulp.task('sync', gulp.series('browser-sync'));
