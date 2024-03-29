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

// mix.js('resources/js/app.js', 'public/js/app.js')
//     .vue()
//     .sass('resources/sass/app.scss', 'public/css');


mix.setPublicPath('public_html/');
// mix.js('resources/js/app.js', 'js')
// mix.sass('resources/sass/app.scss', 'css');

mix.js(['resources/js/app.js'], 'public_html/js/app.js').vue();
