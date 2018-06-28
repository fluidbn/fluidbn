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

mix.autoload({
    'jquery': ['$', 'window.jQuery', "jQuery", "window.$", "jquery", "window.jquery"],
    'popper.js/dist/umd/popper.js': ['Popper', 'window.Popper']
})

    .js('resources/assets/js/app.js', 'public/js')
   .js('resources/assets/js/functions.js', 'public/js/functions.js')
   .sass('resources/assets/sass/app.scss', 'public/css').version()

   .sass('resources/assets/sass/custom.scss', 'public/css/custom.css').version()
   .sass('resources/assets/sass/carousel.scss', 'public/css/carousel.css').version()
   .sass('resources/assets/sass/welcome.scss', 'public/css/welcome.css').version();