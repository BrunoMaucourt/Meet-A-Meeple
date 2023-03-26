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
        dark: '#DC9A00',
      },
      'main-green': {
        DEFAULT: '#00E3A0',
      },
      'main-grey': {
        DEFAULT: '#B6A999',
        light: '#dbdbdb',
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
        dark: '#D70000',
      },
    },
    extend: {
      fontFamily:{
        'pacifico': ['Pacifico', 'cursive'],
        'montserrat' : ['Montserrat', 'sans-serif'],
      },
      boxShadow: {
        'around': '0 -1px 4px 0 rgba(26, 26, 26, 0.3),0 4px 8px 0 rgba(26, 26, 26, 0.3)',
        'inset-xl': 'inset 0px 0px 10px rgba(0,0,0,0.1)'
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
