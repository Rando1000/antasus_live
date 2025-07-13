import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';
import typography from '@tailwindcss/typography';

/** @type {import('tailwindcss').Config} */
export default {
  darkMode: 'class',
  content: [
    './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
    './vendor/laravel/jetstream/**/*.blade.php',
    './storage/framework/views/*.php',
    './resources/views/**/*.blade.php',
    './resources/js/**/*.vue',
  ],
  theme: {
    extend: {
      colors: {
        'antasus-primary': '#00fdcf', // Haupt-CI
        'antasus-second': '#099c8f', // Neben-CI
        'antasus-black': '#000000',
        'antasus-indigo': '#4851F4',
        'antasus-neutral': '#F8FAFC',
        'antasus-bg': '#ffffff',
        // DARK-VARIANTEN
        'antasus-dark': '#091015',           // z.B. für BG dark
        'antasus-dark-neutral': '#1E293B',   // für bessere Lesbarkeit
        'antasus-dark-card': '#131B22',      // für Karten, Panels etc.
        'antasus-dark-border': '#223040',    // Border dark
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
}
