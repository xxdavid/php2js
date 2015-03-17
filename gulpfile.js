var gulp = require('gulp');
var shell = require('gulp-shell');

gulp.task('runTests', shell.task([
    'php tests/tester.php'
]));


gulp.task('watch', function () {
    gulp.watch(['src/**', 'tests/**'], ['runTests'])
});