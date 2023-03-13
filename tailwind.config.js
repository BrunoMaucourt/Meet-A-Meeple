/** @type {import('tailwindcss').Config} */
module.exports = {
  content: [
    './assets/**/*.js',
    './templates/**/*.html.twig'
  ],
  theme: {
    colors: {
      'main-orange': {
        DEFAULT: '#FFB300',
      },
      'main-green': {
        DEFAULT: '#00E3A0',
      },
      'main-grey': {
        DEFAULT: '#B6A999',
      },
      'main-brown': {
        DEFAULT: '#504538',
      },
      'main-emerald': {
        DEFAULT: '#00A96C',
      },
      'white': {
        DEFAULT: '#ffffff',
      },
      'black': {
        DEFAULT: '#000000',
      },
      'red': {
        DEFAULT: '#ff0000',
      },
    },
    extend: {},
  },
  plugins: [],
}
