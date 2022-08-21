module.exports = {
  mode: 'jit',
  purge: [
    './public/**/*.php',
    './view/**/*.php',
  ],
  darkMode: false,
  content: [
    './public/**/*.php',
    './view/**/*.php'
  ],
  theme: {
    extend: {
      colors: {
        primary: '#FFA500',
      }
    },
  },
  plugins: [
    require('@tailwindcss/forms'),
  ],
}