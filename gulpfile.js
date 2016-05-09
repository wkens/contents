var elixir = require('laravel-elixir');

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

elixir(function(mix) {
    var bpath = 'node_modules/bootstrap-sass/assets';
    mix.sass('app.scss')
        .copy(bpath + '/fonts', 'public/fonts')
        .copy(bpath + '/javascripts/bootstrap.min.js', 'public/js');
    mix.sass('layout.scss');
});
