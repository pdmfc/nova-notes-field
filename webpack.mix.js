let mix = require('laravel-mix')

mix
  .setPublicPath('dist')
  .js('resources/js/field.js', 'js')
  .sass('resources/sass/field.scss', 'css')

mix.webpackConfig(webpack => {
    return {
        plugins: [
            new webpack.ContextReplacementPlugin(/^\.\/locale$/, context => {
                   if (!/\/moment\//.test(context.context)) return

                   Object.assign(context, {
                     regExp: /^\.\/\w+/,
                     request: '../locale', // resolved relatively
                   })
            })
        ]
    }
})
