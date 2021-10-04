module.exports = {
    purge: [
        './resources/**/*.blade.php',
        './resources/**/*.js',
        './resources/**/*.vue',
      ],
  darkMode: false, // or 'media' or 'class'
  theme: {
    extend: {},
    screens: {
        'sm': {'min': '320px', 'max': '769px'},

        // => @media (min-width: 576px) { ... }

        'md': '768px',
        // => @media (min-width: 768px) { ... }

        'lg': '1024px',
        // => @media (min-width: 1024px) { ... }

        'xl': '1280px',
        // => @media (min-width: 1280px) { ... }

        '2xl': '1536px',
        // => @media (min-width: 1536px) { ... }


      }
  },
  variants: {
    extend: {},
  },
  plugins: [],
}
