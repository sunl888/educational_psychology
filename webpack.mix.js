let mix = require('laravel-mix');

function resolve (dir) {
    return path.join(__dirname, dir);
}
mix.webpackConfig({
    module: {
        rules: [
            {
                test: /\.(js|vue)$/,
                enforce: 'pre',
                include: resolve('resources/assets'),
                use: [{
                    loader: 'eslint-loader',
                    options: {
                        formatter: require('eslint-friendly-formatter')
                    }
                }]
            }
        ]
    }
});
mix.js('resources/assets/admin/app.js', 'public/js/admin')
    .version();
