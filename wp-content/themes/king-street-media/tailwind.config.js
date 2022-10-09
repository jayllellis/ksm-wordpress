// const defaultTheme = require("tailwindcss/defaultTheme");

module.exports = {
  content: ["./**/*.{html,js,php}", "./components/**/*.{html,js,php}"],
  theme: {
    colors: {
      'white': '#ffffff',
      'black': '#000000',
      'red': '#ff0000',
      'lightpink': 'lightpink',
      'lightgrey': '#c5c5c5',
    },
    extend: {
      fontFamily: {
        // sans: ['Gothic A1', ...defaultTheme.fontFamily.sans],
        sans: ['Gothic A1', 'sans-serif'],
      },
      spacing: {
        '7.5': '1.875rem',
        '10.5': '2.625rem',
        '11.5': '2.875rem',
        '12.5': '3.125rem',
        '13.5': '3.375rem',
        '15': '3.75rem',
        '15.5': '3.875rem',
        '17.5': '4.375rem',
        '20.5': '5.125rem',
        '22.5': '5.625rem',
        '26': '6.5rem',
        '29': '7.25rem',
        '31': '7.75rem',
        '35': '8.75rem',
        '37.5': '9.375rem',
        '45': '11.25rem',
        '49': '12.25rem',
        '54': '13.5rem',
        '87.5': '21.875rem',
        '100': '25rem',
      },
      fontSize: {
        '1.5xl': '1.375rem',
        '2.5xl': '2.125rem',
        '4.5xl': '2.625rem',
        // '53px': '3.3125rem',
        '5.5xl': '3.25rem',
        '6.5xl': '4rem',
      },
      lineHeight: {
        'supertight': '1.2',
        'supersnug': '1.45',
        'superrelaxed': '1.91',
      },
      maxWidth: {
        'screen': '100vw',
        'wrapper': '82.375rem',
      },
      zIndex: {
        '2': '2',
      },
      borderRadius: {
        '2.5xl': '1.25rem'
      },
      gap: {
        '87.5': '21.875rem',
      },
      gridTemplateColumns: {
        'collage': '1fr 0.9fr 1.38fr 1.04fr',
        'project1': '0.41fr 0.55fr',
        'template2': '0.45fr 0.28fr',
        'template2-2': '0.35fr 0.36fr',
        'template4': '0.35fr 0.49fr',
        // 'projects': '0.56fr 0.44fr',
        // 'projects-2': '0.72fr',
        // 'projects-3': '0.44fr 0.56fr',
      },
  },
  },
  plugins: [],
}
