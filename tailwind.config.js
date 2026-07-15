import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ['Geist', ...defaultTheme.fontFamily.sans],
                heading: ['Feature', 'serif', ...defaultTheme.fontFamily.serif],
            },
            colors: {
                brand: {
                    primary: '#1786F8',
                    secondary: '#ADDEFA',
                    accent: '#FF9F1C',
                },
            },
        },
    },

    plugins: [forms],
};
