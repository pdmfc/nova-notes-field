let mix = require('laravel-mix');

mix
    // .setPublicPath('dist')
    .js('resources/js/field.js', 'dist/js').vue({ version: 2 })
    .sass('resources/sass/field.scss', 'resources/sass')


    .webpackConfig(webpack => {
        return {
            // Fixes Moment's missing locale on moment-with-locales
            plugins: [
                new webpack.ContextReplacementPlugin(
                    /^\.\/locale$/,
                    context => {
                        if (!/\/moment\//.test(context.context)) return;

                        Object.assign(context, {
                            regExp: /^\.\/\w+/,
                            request: '../locale',
                        });
                    }
                ),
            ],
        };
    });
