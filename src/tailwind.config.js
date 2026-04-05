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
                mono: ['"JetBrains Mono"', ...defaultTheme.fontFamily.mono],
            },
            colors: {
                border: 'hsl(220 13% 91%)',
                input: 'hsl(220 13% 91%)',
                ring: 'hsl(262 83% 58%)',
                background: 'hsl(0 0% 100%)',
                foreground: 'hsl(224 71% 4%)',
                primary: {
                    DEFAULT: 'hsl(262 83% 58%)',
                    foreground: 'hsl(0 0% 100%)',
                },
                secondary: {
                    DEFAULT: 'hsl(220 14% 96%)',
                    foreground: 'hsl(224 71% 4%)',
                },
                muted: {
                    DEFAULT: 'hsl(220 14% 96%)',
                    foreground: 'hsl(220 9% 46%)',
                },
                accent: {
                    DEFAULT: 'hsl(220 14% 96%)',
                    foreground: 'hsl(224 71% 4%)',
                },
                destructive: {
                    DEFAULT: 'hsl(0 84% 60%)',
                    foreground: 'hsl(0 0% 100%)',
                },
                card: {
                    DEFAULT: 'hsl(0 0% 100%)',
                    foreground: 'hsl(224 71% 4%)',
                },
                popover: {
                    DEFAULT: 'hsl(0 0% 100%)',
                    foreground: 'hsl(224 71% 4%)',
                },
                chart: {
                    1: 'hsl(262 83% 58%)',
                    2: 'hsl(173 58% 39%)',
                    3: 'hsl(197 37% 24%)',
                    4: 'hsl(43 96% 56%)',
                    5: 'hsl(27 87% 67%)',
                },
            },
            borderRadius: {
                xl: '0.75rem',
                lg: '0.5rem',
                md: '0.375rem',
            },
        },
    },

    plugins: [forms],
};
