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
                sans: ['Figtree', ...defaultTheme.fontFamily.sans],
            },
            colors: {
                'brown': {
                    100: '#f5f5f5',
                    200: '#dcdcdc',
                    300: '#b0a08f',
                    400: '#8e735b',
                    500: '#6f4f28',
                    600: '#5e3a1f',
                    700: '#4c2c14',
                    800: '#3b1e0a',
                    900: '#2c1507',
                },
                // Agrega más colores según sea necesario
            },
        },
    },

    plugins: [
        forms,
        // Agrega otros plugins si es necesario
    ],
};
