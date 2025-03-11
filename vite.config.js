import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import react from '@vitejs/plugin-react-swc'
import tailwindcss from '@tailwindcss/vite'

export default defineConfig({
    resolve: {
        alias: {
            ziggy: path.resolve('vendor/tightenco/ziggy/src/js/route.js'),
        },
    },
    plugins: [
        react(),
        tailwindcss(),
        laravel({
            input: ['resources/css/app.css', 'resources/js/app.jsx'],
            refresh: true,
        }),
    ],
});
