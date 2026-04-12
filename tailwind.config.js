import defaultTheme from "tailwindcss/defaultTheme";
import forms from "@tailwindcss/forms";

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        "./vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php",
        "./storage/framework/views/*.php",
        "./resources/views/**/*.blade.php",
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ["Figtree", ...defaultTheme.fontFamily.sans],
            },
            colors: {
                warkop: {
                    red: "#9B1B30",
                    "red-dark": "#7A1526",
                    cream: "#F5E6D3",
                    "cream-light": "#FEFBF6",
                },
            },
        },
    },

    plugins: [forms],
};
