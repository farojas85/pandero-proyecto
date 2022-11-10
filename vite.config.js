import { defineConfig, loadEnv } from 'vite';
import laravel from 'laravel-vite-plugin';
import vue from '@vitejs/plugin-vue';

export default ({mode}) => {

    // const env = loadEnv(mode, process.cwd(), '')
    // const envo = env.VITE_APP_ENV == 'local' ? false : true

    return defineConfig({
        plugins: [
            laravel({
                input: 'resources/js/app.js',
                refresh: true,
            }),
            vue({
                template: {
                    transformAssetUrls: {
                        base: null,
                        includeAbsolute: false,
                    },
                },
            }),
        ],
        server:{
            //https: envo
        }
    });
}
// export default defineConfig({
//     plugins: [
//         laravel({
//             input: 'resources/js/app.js',
//             refresh: true,
//         }),
//         vue({
//             template: {
//                 transformAssetUrls: {
//                     base: null,
//                     includeAbsolute: false,
//                 },
//             },
//         }),
//     ],
//     server:{
//         //https: env
//     }
// });
