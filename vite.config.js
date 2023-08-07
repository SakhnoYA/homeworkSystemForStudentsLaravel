import { defineConfig } from 'vite'
import laravel from 'laravel-vite-plugin'

    export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/css/app.css',
                'resources/js/app.js',
                'resources/js/checklist.js',
            ],
            refresh: true,
        }),
    ],
    build: {
        rollupOptions: {
            output: {

                chunkFileNames: 'assets/js/[name]-[hash].js',
                entryFileNames: 'assets/js/[name]-[hash].js',

                assetFileNames: ({ name }) => {
                    if (/\.(gif|jpe?g|png|svg|ico|json)$/.test(name ?? '')) {
                        return 'assets/img/[name]-[hash][extname]'
                    }

                    if (/\.css$/.test(name ?? '')) {
                        return 'assets/css/[name]-[hash][extname]'
                    }

                    if (/\.(ttf|woff2?|eot)$/.test(name ?? '')) {
                        return 'assets/fonts/[name]-[hash][extname]'
                    }

                    return 'assets/[name]-[hash][extname]'
                },
            },
        },
    },
})
