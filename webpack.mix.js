let mix = require('laravel-mix');

mix.sass('resources/sass/login.scss', 'public/css');
mix.browserSync('127.0.0.1:8000');