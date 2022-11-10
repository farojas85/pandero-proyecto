import { defineConfig, loadEnv } from 'vite';
import laravel from 'laravel-vite-plugin';
import vue from '@vitejs/plugin-vue';

// console.log(import.meta.env.VITE_APP_ENV)


export default ({mode}) => {

    process.env = Object.assign(process.env, loadEnv(mode, process.cwd(), ''));

    const envo = process.env.APP_ENV =='local' ? false : true

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
            https: envo
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
