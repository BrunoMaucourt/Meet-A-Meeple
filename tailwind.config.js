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
    extend: {
      fontFamily:{
        'pacifico': ['Pacifico', 'cursive'],
        'montserrat' : ['Montserrat', 'sans-serif'],
      }  
    },
    keyframes:{
      'open-menu':{
        '0%': { transform :'translateX(-18rem)' },
        '100%': { transform :'translateX(0px)' },
      },
    },
    animation: {
      'open-menu' : 'open-menu 0.5s ease-in-out forwards',
    },
  },
  plugins: [],
}
