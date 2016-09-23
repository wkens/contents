const elixir = require('laravel-elixir');

require('laravel-elixir-vue');

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
    var bpath = 'node_modules/bootstrap-sass/assets';
    mix.sass('app.scss')
       .webpack('app.js');
        .copy(bpath + '/fonts', 'public/fonts')
        .copy(bpath + '/javascripts/bootstrap.min.js', 'public/js');
    mix.sass('layout.scss');
});
