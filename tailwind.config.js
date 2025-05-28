import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';
import typography from '@tailwindcss/typography';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './vendor/laravel/jetstream/**/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
        './resources/js/**/*.vue',
    ],

    darkMode: 'class', // <--- wichtig
    theme: {
        extend: {
            colors: {
                antasus: {
                primary: '#14B8A6', // Teal 500
                dark: '#0F766E',    // Teal 700
                light: '#CCFBF1',   // Teal 100
                neutral: '#F8FAFC', // z. B. Hintergrund
                text: '#1E293B',    // Slate 800 für Lesbarkeit
                },
            },
            fontFamily: {
                sans: ['Figtree', ...defaultTheme.fontFamily.sans],
            },
            animation: {
            'fade-in': 'fadeIn 0.9s ease-out',
            },
            keyframes: {
            fadeIn: {
                '0%': { opacity: 0, transform: 'translateY(10px)' },
                '100%': { opacity: 1, transform: 'translateY(0)' },
            },
            },
            backdropBlur: {
                sm: '4px',
                md: '8px',
            },
        },
    },

    plugins: [forms, typography],
};
