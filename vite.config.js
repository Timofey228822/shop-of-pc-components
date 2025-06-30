import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import tailwindcss from '@tailwindcss/vite';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/css/app.css',
                'resources/css/for_shop/dashboard.css',
                'resources/css/for_shop/shop.css',
                'resources/css/for_shop/product.css',
                'resources/css/for_shop/admin.css',
                'resources/css/auth/login.css',
                'resources/css/auth/register.css',
                'resources/css/auth/welcome.css',
                'resources/js/app.js',
                'resources/js/for_shop/dashboard.js',
                'resources/js/for_shop/admin.js',
                'resources/js/auth/login.js',
                'resources/js/auth/register.js',
            ],
            refresh: true,
        }),
        tailwindcss(),
    ],
});
