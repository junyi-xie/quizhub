module.exports = {
  mode: 'jit',
  purge: ['./public/**/*.php'],
  darkMode: false,
  content: [
    './public/**/*.php'
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