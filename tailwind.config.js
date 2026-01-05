/** @type {import('tailwindcss').Config} */
export default {

  content: [
    "./resources/**/*.blade.php",
    "./resources/**/*.js",
    "./resources/**/*.vue",
  ],
  theme: {
    extend: {
      colors: {
        primary: "#ED1D24",
        "background-light": "#F5F5F5",
        "background-dark": "#0f0f0f",
        "surface-light": "#FFFFFF",
        "surface-dark": "#1a1a1a",
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
