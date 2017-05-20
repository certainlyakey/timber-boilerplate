'use strict';

// GULP CONFIG
// .env is located in the root of the repo
require('dotenv').config({ path: './../../../.env' });


//npm install to get all the deps
var gulp              = require('gulp');
var gutil             = require('gulp-util');


// Environment variables
// if defined in a .env file or if defined as a gulp commandline argument (gulp --env=true)
var dev = true;
if (typeof process.env.ENV !== 'undefined') {
  dev = (process.env.ENV === 'dev');
}
if (typeof gutil.env.env !== 'undefined') {
  dev = (gutil.env.env === 'dev');
}


var sass              = require('gulp-sass');
var plumber           = require('gulp-plumber'); //restoring on build error
var cssnano           = require('gulp-cssnano'); //css minification
var concat            = require('gulp-concat'); //joining files
var notify            = require('gulp-notify'); 
var uglify            = require('gulp-uglify'); //uglifying js
var bourbon           = require('node-bourbon');
var svgsprite         = require('gulp-svg-sprite'); //creates svg sprites from source files
var jshint            = require('gulp-jshint'); // jshint-stylish should be installed too
var autoprefixer      = require('gulp-autoprefixer');
var sourcemaps        = require('gulp-sourcemaps');
var browserify        = require('browserify');
var babelify          = require('babelify'); //babel-preset-es2015 should be installed too
var source            = require('vinyl-source-stream');
var buffer            = require('vinyl-buffer');
var modernizr         = require('gulp-modernizr');



// TASKS CONFIG
var svgSymbolsSpriteConfig  = {
  mode           : {
    symbol       : {
      dest       : '.',
      prefix     : '.u-svg-%s',
      dimensions : '-size',
      sprite     : 'img/sprite.svg',
      render     : {
        scss     : {
          dest   : 'scss/generated/_svg-sprite.scss'
        }
      }
    }
  }
};



// TASKS
gulp.task('svg-sprites', function() {
  gulp.src('img/svg-sprite-source/*.svg')
    .pipe(svgsprite(svgSymbolsSpriteConfig)).on('error', function(error){ console.log(error); })
    .pipe(gulp.dest('./'))
    .pipe(dev ? notify('SVG sprite created successfully!') : gutil.noop() );
});


gulp.task('styles', function() {
  gulp.src(['scss/style.scss'])
  .pipe(plumber())
  .pipe( dev ? sourcemaps.init() : gutil.noop() )
  .pipe(sass({ 
    style: 'expanded',
    includePaths: [bourbon.includePaths, 'node_modules/susy/sass']
  }))
  .pipe(autoprefixer({
    browsers: [
      'last 3 versions'
    ]
  }))
  .pipe(cssnano())
  .pipe(concat('style.css'))
  .pipe( dev ? sourcemaps.write() : gutil.noop() )
  .pipe(gulp.dest('./'))
  .pipe(dev ? notify('CSS compiled and concatenated successfully!') : gutil.noop() );
});


gulp.task('jshint', function(){
  var src  = [
    'Gulpfile.js',
    'js/modules/*.js'
  ];

  gulp.src(src)
    .pipe(jshint())
    .pipe(jshint.reporter(require('jshint-stylish')));
});


gulp.task('modernizr', function(){
  var src = [
    './js/scripts.min.js',
    './style.css'
  ];

  gulp.src(src)
    .pipe(modernizr('modernizr.min.js', {
      options: ['setClasses'],
      classPrefix: 'js-supports-'
    }))
    .pipe(uglify())
    .pipe(gulp.dest('js'))
    .on('error', gutil.log);
});


gulp.task('scripts', function(){
  var bundler = browserify('js/main.js');

  bundler.transform(babelify, {
      presets: ['es2015']
    })
    .bundle()
    .on('error', gutil.log)
    .pipe(source('scripts.min.js'))
    .pipe(buffer())
    // don't uglify if we're in local environment, do uglify if it's something other
    .pipe(dev ? gutil.noop() : uglify())
    .pipe(gulp.dest('js'))
    .pipe(dev ? notify('JS compiled and concatenated successfully!') : gutil.noop());
});


var libs_copied_from_modules  = [
  'node_modules/jquery/dist/jquery.min.js'
];
gulp.task('copy_to_libs', () => gulp
  .src(libs_copied_from_modules)
  .pipe(gulp.dest('js/libs'))
);


gulp.task('default', [
  'copy_to_libs',
  'styles',
  'scripts',
  'svg-sprites',
  'modernizr'
]);



// WATCH
gulp.task('watch', ['default'], function(){
  // Gulpfile.js:
  gulp.watch('Gulpfile.js', [
    'jshint'
  ]);

  // Scripts:
  gulp.watch('js/modules/*.js', [
    'jshint',
    'scripts'
  ]);

  // Styles:
  gulp.watch('scss/**/*.scss', [
    'styles'
  ]);

  // SVG:
  gulp.watch('img/svg-sprite-source/*.svg', [
    'svg-sprites'
  ]);  
});