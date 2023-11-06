const defaultTheme = require('tailwindcss/defaultTheme');

// tailswindアイコン追加
const {
    iconsPlugin,
    getIconCollections,
} = require("@egoist/tailwindcss-icons");
// tailswindアイコン追加

/** @type {import('tailwindcss').Config} */
module.exports = {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ['Nunito', ...defaultTheme.fontFamily.sans],
            },
        },
    },

    plugins: [
        require('@tailwindcss/forms'),

        iconsPlugin({
            // 利用したい icon collection を利用する
            // https://icones.js.org/
            collections: getIconCollections(["fa6-regular", "fa6-solid"]),
        }),
    ],

    //ここから追加
    purge: [
        './resources/**/*.blade.php',
        './resources/**/*.js',
        './resources/**/*.vue',
    ],
    //ここまで追加
};
