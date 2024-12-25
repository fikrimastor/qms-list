import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import { svelte } from "@sveltejs/vite-plugin-svelte";
import { resolve } from 'path';
import laravelTranslator from "laravel-translator/vite";

export default defineConfig({
    plugins: [
        laravel({
            input: ['resources/css/app.css', 'resources/js/app.js'],
            ssr: 'resources/js/ssr.js',
            refresh: true,
        }),
        svelte({}),
        laravelTranslator()
    ],
    resolve: {
    alias: {
        '@': resolve(__dirname, 'resources/js'),
        '~': resolve(__dirname, 'resources'),
    },
    extensions: ['.js', '.svelte', '.json'],
}
});
