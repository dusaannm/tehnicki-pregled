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
                sans: ['Inter', 'Figtree', ...defaultTheme.fontFamily.sans],
            },
            colors: {
                primary: {
                    DEFAULT: '#14a800',
                    50: '#f2fcf0',
                    100: '#e1f8de',
                    200: '#c5f2be',
                    300: '#9ae890',
                    400: '#67d65b',
                    500: '#3eb832',
                    600: '#14a800', // Our main brand color
                    700: '#1d8208',
                    800: '#1c660d',
                    900: '#185410',
                },
                surface: '#ffffff',
                background: '#f9fafb', // Very light gray for page background
            },
            boxShadow: {
                'sharp': '0 1px 3px 0 rgba(0, 0, 0, 0.1), 0 1px 2px 0 rgba(0, 0, 0, 0.06)',
                'sharp-md': '0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06)',
            }
        },
    },

    plugins: [forms],
};
