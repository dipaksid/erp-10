import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/sass/app.scss',
                'resources/js/app.js',
            ],
            refresh: true,
        }),
    ],
    resolve: {
        alias: {
            "$": 'jQuery',
            "jQuery": "jquery",
            "window.jQuery": "jquery",
            //'~bootstrap': path.resolve(__dirname, 'node_modules/bootstrap')
        },
    },
});
