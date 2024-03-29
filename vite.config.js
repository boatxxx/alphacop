import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/sass/app.scss',
                'resources/js/chart.js',
                'resources/js/Leaflet.js',
                'resources/js/Quagga.js',
            ],
            refresh: true,
        }),
    ],
});
