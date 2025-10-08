/** @type {import('tailwindcss').Config} */
module.exports = {
  content: ["./**/*.php", "./src/**/*.{js,ts,jsx,tsx}"],
  safelist: ["arrow-btn", "close-btn"],
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
        blueLink: {
          light: "#93C5FD",
          DEFAULT: "#3B82F6",
          dark: "#2563EB",
        },
        ink: "#111111",
      },
      typography: ({ theme }) => ({
        DEFAULT: {
          css: {
            color: theme("colors.ink"),
            a: {
              color: theme("colors.blueLink.DEFAULT"),
              textDecoration: "none !important",
              "&:hover": {
                color: theme("colors.blueLink.dark"),
                textDecoration: "underline !important",
              },
            },
            strong: { color: theme("colors.ink") },
            h1: { color: theme("colors.ink") },
            h2: { color: theme("colors.ink") },
            h3: { color: theme("colors.ink") },
            h4: { color: theme("colors.ink") },
            blockquote: { color: theme("colors.ink") },
            figcaption: { color: theme("colors.ink") },
          },
        },
      }),
    },
  },
  plugins: [require("@tailwindcss/typography")],
};
