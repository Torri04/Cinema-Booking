import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: ['resources/scss/booking.scss', 'resources/scss/member.scss', 'resources/scss/film.scss', 'resources/scss/info.scss', 'resources/scss/home.scss', 'resources/scss/index.scss', 'resources/scss/signin.scss', 'resources/scss/signup.scss', 'resources/scss/navbar.scss'],
            refresh: true,
        }),
    ],
});
