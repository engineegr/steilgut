const mix = require('laravel-mix');
let webpack = require('webpack');
const path = require('path');
// const miniCssExtractPlugin = require("mini-css-extract-plugin");
const cssMinimizerPlugin = require("css-minimizer-webpack-plugin");

require('laravel-vue-lang/mix');
require('laravel-mix-tailwind');

mix.webpackConfig({
    devtool: 'source-map',
    resolve: {
        alias: {
            jquery: path.resolve(__dirname, 'node_modules/jquery/dist/jquery.js'),
            '@': path.resolve('resources')
        },
    },

    optimization: {
        minimizer: [
            // For webpack@5 you can use the `...` syntax to extend existing minimizers (i.e. `terser-webpack-plugin`), uncomment the next line
            `...`,
            new cssMinimizerPlugin(),
        ],
        // minimize: true,
    },

    externals: {
        jquery: 'jQuery',
    },

    plugins: [
        // ProvidePlugin helps to recognize $ and jQuery words in code
        // And replace it with require('jquery')
        new webpack.ProvidePlugin({
            $: 'jquery',
            jQuery: 'jquery',
        }),
    ],

    module: {
        rules: [
            // {
            //     test: /.s?css$/,
            //     use: [miniCssExtractPlugin.loader, "css-loader", "sass-loader"],
            // },
        ],
    },

    watchOptions: {
        poll: 1000,
        followSymlinks: false,
        ignored: ['/\.git/', '/node_modules/', '/storage/', '/vendor/'],
    },
});

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

mix.js(['resources/js/app.js'], 'public/js').vue()
    .js('resources/js/cms/cms.js', 'public/js').vue()
    .js('resources/js/demo/demo.js', 'public/js').vue()
    .js('resources/js/events.js', 'public/js').sourceMaps()
    .tailwind('./tailwind.config.js')
    .copy(['resources/sass/fonts/'], 'public/fonts/')
    .sass('resources/sass/app.scss', 'public/css')
    .sass('resources/sass/cms.scss', 'public/css')
    .sass('resources/sass/demo.scss', 'public/css')
    .css('resources/css/fa-5.15.4.min.css', 'public/css')
    .lang();

if (mix.inProduction()) {
    mix.version();
}
