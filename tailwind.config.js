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
                sans: ['Inter', ...defaultTheme.fontFamily.sans],
                heading: ['Rajdhani', ...defaultTheme.fontFamily.sans],
            },
            colors: {
                tactical: {
                    bg: '#0b0f14',
                    panel: '#111a23',
                    muted: '#1b2a39',
                    line: '#2f455a',
                    accent: '#e6b800',
                    warfare: '#22c55e',
                    operations: '#f97316',
                },
            },
            keyframes: {
                'slide-in': {
                    '0%': { opacity: '0', transform: 'translateY(10px)' },
                    '100%': { opacity: '1', transform: 'translateY(0)' },
                },
                'pulse-glow': {
                    '0%, 100%': { boxShadow: '0 0 0 rgba(230, 184, 0, 0)' },
                    '50%': { boxShadow: '0 0 18px rgba(230, 184, 0, 0.3)' },
                },
                'toast-in': {
                    '0%': { opacity: '0', transform: 'translateY(12px) scale(0.95)' },
                    '100%': { opacity: '1', transform: 'translateY(0) scale(1)' },
                },
                'toast-out': {
                    '0%': { opacity: '1', transform: 'translateY(0) scale(1)' },
                    '100%': { opacity: '0', transform: 'translateY(12px) scale(0.95)' },
                },
                'stat-fill': {
                    '0%': { width: '0%' },
                    '100%': { width: 'var(--stat-value)' },
                },
            },
            animation: {
                'slide-in': 'slide-in 0.3s ease-out',
                'pulse-glow': 'pulse-glow 1.8s ease-in-out infinite',
                'toast-in': 'toast-in 0.3s ease-out',
                'toast-out': 'toast-out 0.25s ease-in forwards',
                'stat-fill': 'stat-fill 0.8s ease-out forwards',
            },
        },
    },

    plugins: [forms],
};
