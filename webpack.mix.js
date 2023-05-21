let mix = require('laravel-mix');

mix.js('resource/js/app.js', 'public/js')
.sass('resource/sass/login.scss', 'public/css');