/** @type {import('tailwindcss').Config} */
export default {
    content: [
        "./resources/**/*.blade.php",
        "./resources/**/*.js",
        "./resources/**/*.vue",
        "./node_modules/tw-elements/js/**/*.js",
    ],
    theme: {
        extend: {},
    },
    plugins: [[require("tw-elements/plugin.cjs")]],
};

