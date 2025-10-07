/** @type {import('tailwindcss').Config} */
module.exports = {
  content: ["./**/*.php"],
  theme: {
    extend: {
      fontFamily: {
        poppins: ["Poppins", "ui-sans-serif", "system-ui"],
      },
      colors: {
        egg: {
          light: "#f7f4f1",
          DEFAULT: "#ede9e5",
          dark: "#e0dad5",
        },
        ink: "#111111",
      },
    },
  },
  plugins: [],
};
