let mix = require('laravel-mix')
const tailwindcss = require('tailwindcss')

mix
  .setPublicPath('dist')
  .js('resources/js/field.js', 'js')
  .sass('resources/assets/sass/field.scss', 'css')
