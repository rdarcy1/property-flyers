const elixir = require('laravel-elixir');

require('laravel-elixir-vue-2');

/*
 |--------------------------------------------------------------------------
 | Elixir Asset Management
 |--------------------------------------------------------------------------
 |
 | Elixir provides a clean, fluent API for defining some basic Gulp tasks
 | for your Laravel application. By default, we are compiling the Sass
 | file for our application, as well as publishing vendor resources.
 |
 */

elixir(mix => {
    mix.sass('app.scss')
    .scripts([
        'libs/sweetalert-dev.js',
        'libs/lity.js',
        'libs/bootstrap.min.js'
    ], './public/js/libs.js')
    .scripts([
        'ui.js'
    ], './public/js/scripts.js')
    .styles([
        'libs/sweetalert.css',
        'libs/lity.css'
    ], './public/css/libs.css');
});
