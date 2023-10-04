import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import path from 'path'

export default defineConfig({
    plugins: [
        laravel({
            input: ['resources/css/login.css', 'resources/css/app.css', 'resources/css/colors.css', 'resources/css/AdminKit.css', 'resources/js/AdminKit.js', 'resources/js/AdminKit2.js','resources/js/app.js'],
            refresh: true,
        }),
    ],
    resolve: {
        alias: {
            '~bootstrap': path.resolve(__dirname, 'node_modules/bootstrap'),
        }
    }
});
