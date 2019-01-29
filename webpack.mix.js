// noinspection JSAnnotator
let mix = require('laravel-mix');

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

mix.copy('resources/assets/web/css/*.css', 'public/web/css')
    .copy('resources/assets/web/js/*.js', 'public/web/js')
    .copy('resources/assets/admin/css/*.css', 'public/admin/css')
    .copy('resources/assets/admin/js/*.js', 'public/admin/js')
    .copy('resources/assets/admin/js/utilities/*.js', 'public/admin/js/utilities')
    .copy('resources/assets/admin/js/pages/*.js', 'public/admin/js/pages');

if (mix.inProduction()) {
    mix.version();
}