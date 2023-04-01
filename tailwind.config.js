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
      'glass-animation':{
        '0%': { transform : 'scale(1.6)' },
        '10%': { transform : 'rotateZ(0deg) scale(1.3)' },
        '100%': { transform : 'rotateZ(0deg) scale(1.3)' },
        //'70%': { transform : 'rotateZ(90deg) translateX(30px) translateY(-50px)' },
        //'100%': { transform : 'rotateZ(90deg) translateX(30px) translateY(-50px)' },
      },
      'meeple-zoom':{
        '0%' : { transform : 'scale(1)' },
        '6%' : { transform : 'scale(1)' },
        '11%' : { transform : 'scale(2)' },
        '100%' : { transform : 'scale(2)' },
        //'66%' : { transform : 'scale(1)' },
        //'100%' : { transform : 'scale(1)' },
      },
      'pop-meeple-map':{
        '0%' : { transform : 'scaleY(0) scaleX(0)' },
        '4%' : { transform : 'scaleY(1.3) scaleX(0.7)' },
        '6%' : { transform : 'scaleY(0.8) scaleX(1.2)' },
        '8%' : { transform : 'scaleY(1.1) scaleX(0.9)' },
        '10%' : { transform : 'scaleY(0.9) scaleX(1.1)' },
        '12%' : { transform : 'scaleY(1) scaleX(1)' },
        
        '20%' : {transform : 'scaleY(1) scaleX(1) ' },
        '100%' : { transform : 'scaleY(1)' },
      },
      'chat1':{
        '0%' : { transform : 'scale(1)', bottom : '2.5rem', left : '6rem'  },
        '4%' : { transform : 'scale(1)', bottom : '2.5rem', left : '6rem'  },
        '10%' : { transform : 'scale(1)', bottom : '2.5rem', left : '6rem'  },
        '15%' : { transform : 'scale(1)', bottom : '3rem', left : '3rem' },
        '21%' : { transform : 'scale(1)', bottom : '3rem', left : '3rem' },
        '26%' : { transform : 'scale(1)', bottom : '6rem', left : '3rem' },
        '100%' : { transform : 'scale(1)', bottom : '6rem', left : '3rem' },
      },
      'chat2':{
        '0%' : { transform : 'scale(0)', bottom : '0', right : '3rem'  },
        '5%' : { transform : 'scale(0)', bottom : '0', right : '3rem'  },
        '11%' : { transform : 'scale(0)', bottom : '0', right : '3rem'  },
        '15%' : { transform : 'scale(1)', bottom : '0', right : '3rem'  },
        '21%' : { transform : 'scale(1)', bottom : '0', right : '3rem'  },
        '26%' : { transform : 'scale(1)', bottom : '3rem', right : '3rem'  },
        '100%' : { transform : 'scale(1)', bottom : '3rem', right : '3rem' },
      },
      'chat3':{
        '0%' : { transform : 'scale(0)', bottom : '0', left : '3rem'  },
        '22%' : { transform : 'scale(0)', bottom : '0', left : '3rem'  },
        '26%' : { transform : 'scale(1)', bottom : '0', left : '3rem'  },
        '100%' : { transform : 'scale(1)', bottom : '0rem', left : '3rem'  },
      },
    },
    animation: {
      'open-menu' : 'open-menu 0.5s ease-in-out forwards',
      'glass-animation' : 'glass-animation 10s ease-in 1.5s forwards',
      'meeple-zoom' : 'meeple-zoom 10s ease-in 1.5s forwards',
      'pop-meeple-map' : 'pop-meeple-map 10s linear 4s forwards',
      'chat1' : 'chat1 10s linear 5.5s forwards',
      'chat2' : 'chat2 10s linear 5.5s forwards',
      'chat3' : 'chat3 10s linear 5.5s forwards',
    },
  },
  plugins: [],
}
