const mix = require("laravel-mix");

import Chart from 'chart.js/auto';

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

mix.js("resources/js/app.js", "public/js")
    .js("resources/js/front-office.js", "public/js")
    .js("resources/js/checkbox-validation.js", "public/js")
    .js("resources/js/useful-functions.js", "public/js")
    .js("resources/js/chart.js", "public/js")
    .sass("resources/sass/app.scss", "public/css")
    .options({
        processCssUrls: false,
    });

    