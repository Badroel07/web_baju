/** @type {import('tailwindcss').Config} */
export default {

  content: [
    "./resources/**/*.blade.php",
    "./resources/**/*.js",
    "./resources/**/*.vue",
  ],
  darkMode: 'class',
  theme: {
    extend: {
      colors: {
        primary: "#000000",
        "background-light": "#F3F4F6",
        "background-dark": "#121212",
        "surface-light": "#FFFFFF",
        "surface-dark": "#1E1E1E",
        "accent-dark": "#2D2D2D",
        "text-light": "#1f1f1f",
        "text-dark": "#f5f5f5",
        "gray-light": "#757575",
        "gray-dark": "#a3a3a3",
      },
      fontFamily: {
        sans: ["Inter", "sans-serif"],
        display: ["Oswald", "sans-serif"],
      },
      borderRadius: {
        DEFAULT: "0px", // Sharp edges style
      },
    },
  },
  plugins: [
    require('@tailwindcss/typography'),
    require('@tailwindcss/forms'),
  ],
}
