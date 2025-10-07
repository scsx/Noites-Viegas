/** @type {import('tailwindcss').Config} */
module.exports = {
  content: ["./**/*.php", "./src/**/*.{js,ts,jsx,tsx}"],
  theme: {
    container: {
      center: true,
      screens: {
        sm: "640px",
        md: "720px",
        lg: "900px",
        xl: "1200px",
        "2xl": "1200px",
      },
    },
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
