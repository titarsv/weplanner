'use strict';

var gulp = require("gulp");
var bower = require("gulp-bower");
var elixir = require("laravel-elixir");
var bourbon = require('bourbon');
var fileinclude    = require('gulp-file-include');
var gulpRemoveHtml = require('gulp-remove-html');
var browserSync    = require('browser-sync');
var rename         = require('gulp-rename');
var autoprefixer   = require('gulp-autoprefixer');
var del = require('del');

gulp.task('bower', function() {
    return bower();
});

var res = 'resources/assets/';

gulp.task('browser-sync', function() {
    browserSync({
        server: {
            baseDir: res
        },
        notify: false
    });
});

// включаем генерацию sourcemaps
elixir.config.sourcemaps = false;

elixir.extend("fileinclude", function(source, destination, prefix) {
    del(gulp.dest(destination));
    return gulp.src(source)
        .pipe(fileinclude({
            prefix: prefix
        }))
        .pipe(gulpRemoveHtml())
        .pipe(gulp.dest(destination));
});

elixir(function (mix) {

    // запускаем bower и подтягиваем все необходимые зависимости
    //mix.task('bower');

    // копируем все изображения в public
    mix.copy([
        res+'img/**/*.png',
        res+'img/**/*.jpg',
        res+'img/**/*.jpeg',
        res+'img/**/*.ico',
        res+'img/**/*.svg',
        res+'admin/img/**/*.png',
        res+'libs/chosen/*.png'
    ], 'public/img');

    // копируем все шрифты в public
    mix.copy([
        res+'fonts/**/*.ttf',
        res+'fonts/**/*.woff',
        res+'fonts/**/*.woff2',
        res+'fonts/**/*.eot',
        res+'fonts/**/*.otf',
        res+'fonts/**/*.svg'
    ], 'public/fonts');

    // Компилируем sass файлы и сохраняем результат в директорию resources/css
    mix.sass('custom.scss', res+'css/custom.css', {
        includePaths: [
            res
        ]
    });

    // mix.sass('fonts.sass', 'public/css/fonts.min.css', {
    //     includePaths: [
    //         bourbon.includePaths,
    //         res
    //     ]
    // });

    // mix.sass(['header.sass'], res+'header.min.css', {
    //     includePaths: [
    //         bourbon.includePaths
    //     ]
    // });

    mix.styles([
        res+'css/bootstrap.min.css',
        res+'css/font-awesome.min.css',
        res+'css/jquery.bootgrid.min.css',
        res+'css/jquery-ui.min.css',
        res+'css/style.css',
        res+'css/custom.css'
    ], 'public/css/main.min.css', res);

    // elixir.config.assetsPath = "resources/assets/admin";
    //
    // mix.sass(['admin.scss'], res+'admin/css/admin.min.css');
    //
    // mix.styles([
    //     res+'css/bootstrap.min.css',
    //     res+'css/font-awesome.min.css',
    //     res+'css/jquery.bootgrid.min.css',
    //     res+'css/jquery-ui.min.css',
    //     res+'css/style.css'
    // ], 'public/css/main.min.css', res);
    //
    // elixir.config.assetsPath = "resources/assets";

    // Объединяем скрипты
    mix.scripts([
        'js/jquery-2.2.4.min.js',
        'js/bootstrap.min.js',
        'js/jquery.bootgrid.fa.min.js',
        'js/jquery.bootgrid.min.js',
        'js/jquery.gridrotator.js',
        'js/jquery-ui.min.js',
        'js/modernizr.custom.26633.js',
        'js/main.js',
        'js/custom.js'
    ], 'public/js/main.min.js', res);

    // mix.scripts([
    //     'libs/jquery/jquery.min.js',
    //     'libs/chart.js/dist/Chart.min.js',
    //     'libs/bootstrap-sass/assets/javascripts/bootstrap.min.js',
    //     'libs/jquery.nicescroll/jquery.nicescroll.min.js',
    //     'libs/maskedinput/maskedinput.min.js',
    //     'libs/chosen/chosen.jquery.js',
    //     'js/jquery.maphilight.resize.min.js',
    //     'js/jquery.rwdImageMaps.min.js',
    //     'admin/js/admin.js',
    //     'admin/js/transliterate.js',
    //     'admin/js/imagesloader.js',
    //     'admin/js/imagesloader.admin.js'
    // ], 'public/js/admin.min.js', res);

    // генерируем файлы с уникальным именем, чтобы исключить кеширование на клиенте
    mix.version([
        'public/css/main.min.css',
        //'public/css/admin.min.css',
        'public/js/main.min.js'//,
        //'public/js/admin.min.js'
    ]);

    //del('resources/views/public/layouts/header.blade.php');

    // копируем стили в шаблоны
    //mix.fileinclude(res+'views/**/*.blade.php', 'resources/views', '@@');

    mix.browserSync({
        proxy: 'laravel.lh'
    });
});