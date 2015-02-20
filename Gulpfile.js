var gulp = require('gulp'),
    gulpLoadPlugins = require('gulp-load-plugins'),
    plugins = gulpLoadPlugins(),
    autoprefixer = require('gulp-autoprefixer'),
    cmq = require('gulp-combine-media-queries');

var app = 'app/Resources',
    src = 'src/Nastycode/Bundle/FrontBundle/Resources/public',
    web = 'web/bundles/nastycodefront';

var onError = function(err) {
    console.log(err);
};

gulp.task('Sass', function() {

    gulp.src(app + '/scss/**/*.scss')
        .pipe(plugins.plumber({
            errorHandler: onError
        }))
        .pipe(plugins.rubySass({
            compass: true,
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
        .pipe(plugins.minifyCss({keepSpecialComments:0}))
        .pipe(plugins.rename({suffix: '.min'}))
        .pipe(gulp.dest(src + '/css/'))
        .pipe(gulp.dest(web + '/css/'));
});

gulp.task('default', function () {
    return gulp.src('src/app.css')
        
        .pipe(gulp.dest('dist'));
});





gulp.task('watch', function() {
    gulp.watch(app + '/scss/**/*.scss', ['Sass']);
});


gulp.task('build', [


'Sass,'
]);

gulp.task('default', [
'Sass,'
]);
