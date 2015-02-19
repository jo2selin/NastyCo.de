'use-strict';

/*
 * Folder path
 */

var appSrc = './app';
var appBuild = './dist';
var appTemp = './.tmp';

/*
 * Add Gulp and tools
 */
var gulp = require('gulp');
var $ = require('gulp-load-plugins')();
var del = require('del');
var runSequence = require('run-sequence');
var browserSync = require('browser-sync');
var pagespeed = require('psi');
var reload = browserSync.reload;
var cmq = require('gulp-combine-media-queries');

/*
 * Scripts
 */
gulp.task('script', function() {
    return gulp.src( appSrc + '/js/**/*.js' )
        .pipe(reload({
            stream: true,
            once: true
        }))
        .pipe(gulp.dest( appBuild + '/js/' ))
        .pipe($.concat('script.js'))
        .pipe(gulp.dest( appTemp + '/js/' ))
        .pipe(gulp.dest( appBuild + '/js/' ))
        .pipe($.uglify())
        .pipe($.rename('script.min.js'))
        .pipe(gulp.dest( appTemp + '/js/' ))
        .pipe(gulp.dest( appBuild + '/js/' ))
        .pipe(gulp.dest( appSrc + '/js/' ))
        .pipe($.size({
            title: 'scripts'
        }))
        .pipe($.if(!browserSync.active, $.jshint.reporter('fail')));
});

/*
 * Images
 */
gulp.task('images', function() {
    return gulp.src( appSrc + '/img/**/*.{jpg,jpeg,png,gif,svg}' )
        .pipe($.cache($.imagemin({
            progressive: true,
            interlaced: true
        })))
        .pipe(gulp.dest( appBuild + '/img/' ))
        .pipe($.size({
            title: 'images'
        }));
});

/*
 * Copy All Files At The Root Level (app)
 */
gulp.task('copy', function() {
    return gulp.src([
            appSrc + '/.htaccess',
            appSrc + '/robots.txt',
            appSrc + '/humans.txt',
            // appSrc + '/**/*.wav',
            // appSrc + '/**/*.php',
            appSrc + '/**/*.{appcache,tmp,css,js,wav,php,xml,json,ico}',
            // appSrc + '/**/*.css',
            appSrc + '/**/**/*.{jpg,jpeg,png,gif,svg}'
        ], {
            dot: true
        }).pipe(gulp.dest( appBuild ))
        .pipe($.size({
            title: 'copy'
        }));
});

/*
 * Fonts
 */
gulp.task('fonts', function() {
    return gulp.src( appSrc + '/fonts/**' )
        .pipe(gulp.dest( appBuild + '/fonts' ))
        .pipe($.size({
            title: 'fonts'
        }));
});

/*
 * Styles
 */
gulp.task('styles', function() {
    return gulp.src( appSrc + '/scss/**/*.scss' )
        .pipe($.changed('styles', {
            extension: '.scss'
        }))
        .pipe($.sass({
                includePaths: require('node-bourbon').includePaths
            })
            .on('error', console.error.bind(console))
        )
        .pipe(gulp.dest( appTemp + '/css/' ))
        .pipe(gulp.dest( appSrc + '/css/' ))
        .pipe(gulp.dest( appBuild + '/css/' ))
        .pipe(cmq({log: true }))
        .pipe($.autoprefixer({
            browsers: ['last 2 versions'],
            cascade: false
        }))
        // .pipe($.uncss({
        //     html: [
        //         './app/index.html',
        //         './app/styleguide.html'
        //     ],
        //     ignore: [
        //         /.js-/,
        //         /.is-/
        //     ]
        // }))
        .pipe($.if( '*.css', $.csso() ))
        .pipe($.rename('style.min.css'))
        .pipe(gulp.dest( appTemp + '/css/' ))
        .pipe(gulp.dest( appSrc + '/css/' ))
        .pipe(gulp.dest( appBuild + '/css/' ))
        .pipe($.size({
            title: 'styles'
        }));
});

/*
 * Clean
 */
gulp.task('clean', del.bind(null, [
    appTemp,
    appBuild
]));

/*
 * Watch and reload
 */
gulp.task('serve', ['styles', 'script'], function() {
    browserSync({
        notify: false,
        // Run as an https by uncommenting 'https: true'
        // Note: this uses an unsigned certificate which on first access
        //       will present a certificate warning in the browser.
        // https: true,
        proxy: "http://ShegueyLand/"
        //server: [ appTemp, appSrc]
    });
    gulp.watch( appSrc + '/**/*.php', reload);
    gulp.watch( appSrc + '/scss/**/*.scss', ['styles', reload]);
    gulp.watch( appSrc + '/js/**/*.js', ['script', reload]);
    gulp.watch( appSrc + '/img/**/*', reload);
});

/*
 * Build and serve the output from the dist build
 */
gulp.task('serve:dist', ['default'], function() {
    browserSync({
        notify: false,
        server: 'dist'
    });
});

/*
 * Build Production Files, the Default Task
 */
gulp.task('default', ['clean'], function(cb) {
    runSequence('styles', ['script', 'images', 'fonts', 'copy'], cb);
});

// Run PageSpeed Insights
// Update `url` below to the public URL for your site
gulp.task('pagespeed', pagespeed.bind(null, {
    // By default, we use the PageSpeed Insights
    // free (no API key) tier. You can use a Google
    // Developer API key if you have one. See
    // http://goo.gl/RkN0vE for info key: 'YOUR_API_KEY'
    url: 'https://www.sheguey.land',
    strategy: 'mobile'
}));