const mix = require('laravel-mix');

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel application. By default, we are compiling the Sass
 | file for the application as well as bundling up all the JS files.
 |
 */

mix
    .scripts([
        'resources/js/jquery-3.6.0.min.js',
        'resources/js/jquery.dataTables.min.js',
        'resources/js/bootstrap.bundle.min.js',
        'resources/js/popper.min.js',
        'resources/js/jquery.toast.js',
        'resources/js/pdfmake.min.js',
        'resources/js/vfs_fonts.js',
        'resources/js/jConfirm.min.js',
        'resources/js/bootstrap-multiselect.min.js',
        'resources/js/summernote.min.js',
        'resources/js/siwei.js',
        'resources/js/siwei-functions.js',
    ], 'public/js/all.js')
    .styles([
        'resources/css/bootstrap.min.css',
        'resources/css/jquery.toast.css',
        'resources/css/icofont.min.css',
        'resources/css/jquery.dataTables.min.css',
        'resources/css/jConfirm.min.css',
        'resources/css/bootstrap-multiselect.min.css',
        'resources/css/summernote.min.css',
        'resources/css/siwei.css',
    ], 'public/css/all.css')
    .version();

mix
    .scripts([
        'resources/js/jquery-3.6.0.min.js',
        'resources/js/bootstrap.bundle.min.js',
        'resources/js/jquery.toast.js',
        'resources/js/siwei.js',
        'resources/js/siwei-functions.js',
    ], 'public/js/all-logout.js')
    .styles([
        'resources/css/bootstrap.min.css',
        'resources/css/jquery.toast.css',
        'resources/css/icofont.min.css',
        'resources/css/siwei-logout.css',
    ], 'public/css/all-logout.css')
    .version();
