const gulp = require('gulp');
const concat = require('gulp-concat');
const minify = require('gulp-minify');
const exec = require('child_process').exec;

gulp.task('minifyJs', function () {    
  return gulp.src(['src/**/*.js'])
    .pipe(concat('bundle.js'))
    // .pipe(minify())
    .pipe(minify({
      ext:{
          min:'.min.js'
      },
      // exclude: ['tasks'],
    }))
    .pipe(gulp.dest('assets/js'));
});

gulp.task('styles', function () {
  return gulp.src(['src/**/*.css'])
    .pipe(concat('styles.css'))
    .pipe(gulp.dest('assets/css'));
});

gulp.task('tailwind', function (cb) {
  exec('npx tailwindcss -i ./assets/css/styles.css -o ./assets/css/styles.min.css --minify', function (err, stdout, stderr) {
    console.log(stdout);
    console.log(stderr);
    cb(err);
  });
});

gulp.task('watch', function () {
  gulp.watch('src/**/*.js', gulp.series('minifyJs'));
  gulp.watch(['src/**/*.css', '**/*.php', 'tailwind.config.js'], gulp.series('styles', 'tailwind'));
});

gulp.task('prod', gulp.series('minifyJs', 'styles', 'tailwind'));
