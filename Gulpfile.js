var gulp = require('gulp'),
    $ = require('gulp-load-plugins')(),
    autoprefixer = require('gulp-autoprefixer'),
    cmq = require('gulp-combine-media-queries');

var app = 'app/Resources',
    src = 'src/Nastycode/Bundle/FrontBundle/Resources/public',
    web = 'web/bundles/nastycodefront';

var onError = function(err) {
    console.log(err);
};


/*
 * Sass
 */
gulp.task('Sass', function() {

    gulp.src(app + '/scss/**/*.scss')
        .pipe($.plumber({
            errorHandler: onError
        }))
        .pipe($.rubySass({
            compass: false,
            style: 'nested',
            check: true
        }))
        .pipe(cmq({ //combine media query
            log: true
        }))
        .pipe(autoprefixer({
            browsers: ['last 2 versions'],
            cascade: false
        }))
        .pipe($.minifyCss({keepSpecialComments:0}))
        .pipe($.rename({suffix: '.min'}))
        .pipe(gulp.dest(src + '/css/'))
        .pipe(gulp.dest(web + '/css/'));
});


/*
 * Script
 */
gulp.task('script', function() {
    return gulp.src([
        app + '/js/vendor/!(modernizr)*.js',
        // app + '/js/foundation.min.js',
        app + '/js/foundation/foundation.js',
        app + '/js/foundation/foundation.dropdown.js',
        app + '/js/foundation/foundation.tab.js',
        app + '/js/foundation/foundation.reveal.js',
        app + '/js/app.js',
        ])

        .pipe($.concat('script.js'))
            .pipe(gulp.dest(src + '/js/' ))   
            .pipe(gulp.dest(web + '/js/' ))

        .pipe($.uglify())
        .pipe($.rename('script.min.js'))
            .pipe(gulp.dest(src + '/js/' ))   
            .pipe(gulp.dest(web + '/js/' ));    
});


/*
 * Images
 */
gulp.task('images', function() {
    return gulp.src( app + '/img/*.{jpg,jpeg,png,gif,svg}' )
        .pipe($.imagemin({
            progressive: true,
            interlaced: true
        }))
        .pipe(gulp.dest(src + '/img/' ))   
        .pipe(gulp.dest(web + '/img/' ));
});

/*
 * Font
 */
gulp.task('font', function() {
    return gulp.src( app + '/font/*' )
        .pipe(gulp.dest(src + '/font/' ))   
        .pipe(gulp.dest(web + '/font/' ));
});


// gulp.task('default', function () {
//     return gulp.src('src/app.css')
        
//         .pipe(gulp.dest('dist'));
// });


/*
 * watch
 */
gulp.task('watch', function() {
    gulp.watch(app + '/scss/**/*.scss', ['Sass']);
    gulp.watch(app + '/img/**/*.{jpg,jpeg,png,gif,svg}', ['images']);
});


/*
 * build
 */
gulp.task('build', ['script','images','font','Sass']);


gulp.task('default', [
'Sass,'
]);
