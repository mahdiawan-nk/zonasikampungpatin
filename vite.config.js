import {
    defineConfig
} from 'vite';
import laravel from 'laravel-vite-plugin';
import tailwindcss from "@tailwindcss/vite";

export default defineConfig({
    plugins: [
        laravel({
            input: ['resources/css/app.css', 'resources/js/app.js','resources/js/landing.js'],
            refresh: ['resources/views/**/*.blade.php', 'app/Livewire/**/*.php'],
        }),
        tailwindcss(),
    ],
    server: {
        host: true,        // penting, agar bisa diakses dari luar container node
        port: 5173,
        strictPort: true,
        cors: true,
        hmr: {
            host: "localhost", // jika akses via localhost
            port: 5173,
        },
        watch: {
            usePolling: true,
            interval: 300,
        },
    },
});