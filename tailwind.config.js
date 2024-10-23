const plugin = require('tailwindcss/plugin')

module.exports = {
  purge: {
    content: [
      './resources/js/**/*.vue',
      './resources/js/*.vue',
      './resources/js/cms/*.vue',
      './resources/js/cms/**/*.vue',
      './resources/js/views/**/*.vue',
      './resources/js/views/*.vue',

      './resources/views/*.blade.php',
      './resources/views/**/*.blade.php',
    ],
    /*
    * Preserve vue transitions: https://forum.vuejs.org/t/some-transitions-not-working-in-production-anymore/86587/3 
    */
    whitelistPatterns: [/enter$/, /enter-to$/, /leave$/, /leave-to$/, /leave-active$/, /enter-active$/, /move$/],
    defaultExtractor: content => content.match(/[A-Za-z0-9-_:/]+/g) || []
  },
  prefix: 'tw-',
  important: true,
  theme: {
    extend: {
      colors: {
        'steilgut-gold': '#ebcb9a',
        'steilgut-beige': '#c4bbaa',
        'steilgut-gray': '#c2b9a8',
        'steilgut-red': '#af7977',
        'steilgut-blue': '#00B5F5',
        'steilgut-dark-blue': '#002A8F',

        'masthead-header-gold': '#ebcb9a',
        'masthead-video-input-beige': '#c4bbaa',
        'lang-beige': '#c4bbaa',
        'light-gray': '#b6afaf',
        'wine-gray': '#c2b9a8',
        'wine-yellow': '#dccb79',
        'wine-icon-blue': '#00B5F5',
        'wine-dark-blue': '#002A8F',
        'wine-gray': '#a6a6a6',
        'mt-bg-brown': '#343434',
        'news-bg-brown': '#343434',
        'news-text-gold': '#b09a79',
        'steilgut-history-text-gold': '#ebcb9a',
        'steilgut-text-gold': '#ebcb9a',
        'steilgut-text-gray': '#c4bbaa',
        'steilgut-text-brown': '#343434',

        // dynamic drop down list 
        'dyn-drop-down-item-bg-beige': '#cbcdc4',
        'dyn-drop-down-item-text-pink': '#af7977',
        'dyn-drop-down-bg-loading-gray': '#c4bbaa',
        'dyn-drop-down-border-loading-gold': '#b09a79',
      },
      textColor: {
        'wines-text-brown': '#343434',
      },
      spacing: {
        '1/2': '50%',
        '030': '30%',
        '1/3': '33.333333%',
        '2/3': '66.666667%',
        '1/5': '20%',
        '1/4': '25%',
        '028': '28%',
        '027': '27%',
        '026': '26%',
        '2/4': '50%',
        '7/10': '70%',
        '3/4': '75%',
        '1/5': '20%',
        '2/5': '40%',
        '042': '42%',
        '045': '45%',
        '3/5': '60%',
        '4/5': '80%',
        '1/6': '16.666667%',
        '2/6': '33.333333%',
        '3/6': '50%',
        '4/6': '66.666667%',
        '5/6': '83.333333%',
        '085': '85%',
        '1/12': '8.333333%',
        '1/10': '10%',
        '2/12': '16.666667%',
        '3/12': '25%',
        '4/12': '33.333333%',
        '03277': '32.77777%',
        '5/12': '41.666667%',
        '6/12': '50%',
        '058': '58%',
        '7/12': '58.333333%',
        '8/12': '66.666667%',
        '065': '65%',
        '9/12': '75%',
        '10/12': '83.333333%',
        '9/10': '90%',
        '11/12': '91.666667%',
        '03665': '36.65%',
        '9/12vh': '75vh',
        '105_75vh': '105.75vh',
        '10vh': '10vh',
        '11vh': '11vh',
        '12vh': '12vh',
        '13vh': '13vh',
        '14vh': '14vh',
        '15vh': '15vh',
        '16vh': '16vh',
        '17vh': '17vh',
        '18vh': '18vh',
        '19vh': '19vh',
        '20vh': '20vh',
      },

      zIndex: {
        'n-3': '-3',
        'n-2': '-2',
        'n-1': '-1',
        '1': '1',
        '2': '2',
        '3': '3',
        '4': '4',
        '5': '5',
        '6': '6',
        '7': '7',
        '8': '8',
        '9': '9',
        '10': '10',
        '11': '11',
        '12': '12',
        '13': '13',
        '14': '14',
        '15': '15',
        '16': '16',
        '17': '17',
        '18': '18',
        '19': '19',
        '20': '20',
        '21': '21',
        '22': '22',
        '23': '23',
      },
      screens: {
        /*
         * @link: https://websiteedu.com/media-queries-for-mobile-and-tablets/?__cf_chl_jschl_tk__=f4b85448ac9131968259f036667ebbe13f3aee4e-1620873849-0-AfVyBOo3EXzkNnPk3o7Y2fBiOHMOfi9Ez_ELD5YtZPhiuNEWff8cy4MUte33zch82L-l8ED6GNcOpaSmkrLTf-MBeOtEwaD0lOUn3JpenolXersHBNrzqH1P2EriQDQ0T3zRwahK5L0Dv1HaV6FtQjSWLbpUA3dzW6f9QfGllFDKoFKyFoeR7ma8DzneAa8_lg_P4uZKkDeDNYNeu4N5ZPGU8bYgv7OSYrlY17sKUZYScM5cG5IWZdKKED70KvynQtzyL22ETSPnUUSdew9gTFo3xTQhiOjCO-h79BHYAl9u9yUtrVPzZ1vXPuL3d8DXGM_Dw7rSMbTARgqzMPirmWcZZnYgYI_Ad_puGDQEky3Mg4ma4ltgGVG__BKE_JGL1Th8dKZhG3-48KTSJNAwh_vX0x3SCvVckdjUkcc4yQ0fkkTUeEy55KZ76yiqO35_PVGoQGj4yBIYAe84TKs8hdVDH7LqZuz_8MfLbzsyRExG0ri6AZhSfs999AwnI72B0g
         *
         * Samsung 
         * Samsung S8,8+,9,9+,10: W360px - H740px 4x
         *
         * Iphone
         * iPhone 5, 5C, 5S, SE: W320px - H568px 2x
         * iPhone 6 Plus, 6S Plus, 7 Plus, 8 Plus: W414px - H736px 3x
         * iPhone 6, 6S, 7, 8: W375px - H667px 2x
         * iPhone XR, 11: W414px - H896px 2x
         * iPhone XS Max, 11 Pro Max: 414px - 896px 3x
         * iPhone X, XS, 11 Pro: 375px -  812px 3x
        */
        'landscape-xs': { 'raw': 'only screen and (min-width: 320px) and (max-width: 640px) and (orientation: landscape)' },

        'landscape-sm': { 'raw': 'only screen and (min-width: 340px) and (max-width: 740px) and (orientation: landscape)' },

        'landscape': { 'raw': 'only screen and (min-width: 320px) and (max-width: 1024px) and (orientation: landscape)' },

        'lg-table-portrait': { 'raw': 'only screen and (min-width: 1025px) and (orientation: portrait)' },

        'sm': '640px',
        // => @media (min-width: 640px) { ... }

        'md': { 'raw': 'only screen and (min-width: 1025px) and (orientation: landscape)' },
        // => @media (min-width: 1025px) { ... }

        'lg': '1280px',
        // => @media (min-width: 1280px) { ... }

        'xl': '1536px',
        // => @media (min-width: 1536px) { ... }
      },

      width: {
        'fit-content': 'fit-content',
      },

      height: {
        'fit-content': 'fit-content',
      },
      outline: {
        steilgutGold: '2px solid #ebcb9a',
        steilgutGray: '2px solid #c4bbaa',
        blue: '2px solid #0000ff',
      },
    },

    minWidth: {
      '0': '0',
      '1/5': '20%',
      '1/4': '25%',
      '026': '26%',
      '027': '27%',
      '028': '28%',
      '1/3': '30%',
      '03277': '32.77777%',
      '033': '33%',
      '040': '40%',
      '042': '42%',
      '045': '45%',
      '1/2': '50%',
      '054': '54%',
      '058': '58%',
      '060': '60%',
      '065': '65%',
      '070': '70%',
      '3/4': '75%',
      '080': '80%',
      '090': '90%',
      'full': '100%',
      'fit-content': 'fit-content',
    },

    minHeight: {
      '0': '0',
      '010': '10%',
      '1/5': '20%',
      '1/4': '25%',
      '026': '26%',
      '027': '27%',
      '028': '28%',
      '1/3': '30%',
      '03277': '32.77777%',
      '033': '33%',
      '04': '40%',
      '1/2': '50%',
      '060': '60%',
      '065': '65%',
      '070': '70%',
      '3/4': '75%',
      '080': '80%',
      '090': '90%',
      'full': '100%',
      'fit-content': 'fit-content',
      '9/12vh': '75vh',
      '077vh': '77vh',
      '4/5vh': '80vh',
      '105_75vh': '105.75vh',
    },

    maxWidth: {
      '0': '0',
      '1/5': '20%',
      '026': '26%',
      '027': '27%',
      '028': '28%',
      '1/4': '25%',
      '1/3': '30%',
      '03277': '32.77777%',
      '033': '33%',
      '040': '40%',
      '042': '42%',
      '045': '45%',
      '1/2': '50%',
      '054': '54%',
      '058': '58%',
      '060': '60%',
      '065': '65%',
      '070': '70%',
      '3/4': '75%',
      '080': '80%',
      '085': '85%',
      '090': '90%',
      '095': '95%',
      'full': '100%',
      'fit-content': 'fit-content',
      'min-content': 'min-content',
      'max-content': 'max-content'
    },

    maxHeight: {
      '0': '0',
      '010': '10%',
      '1/5': '20%',
      '026': '26%',
      '027': '27%',
      '028': '28%',
      '1/4': '25%',
      '1/3': '30%',
      '033': '33%',
      '04': '40%',
      '1/2': '50%',
      '060': '60%',
      '065': '65%',
      '070': '70%',
      '3/4': '75%',
      '080': '80%',
      '090': '90%',
      'full': '100%',
      'fit-content': 'fit-content',
      'min-content': 'min-content',
      'max-content': 'max-content',
      '9/12vh': '75vh',
      '077vh': '77vh',
      '079vh': '79vh',
      '4/5vh': '80vh',
    },

    fontSize: {
      'md-steilgut-inspiration-time-font-size': 'min(calc(0.5rem + var(--100nvh,1vh) * 0.85), 1.125rem)',
    }
  },
  variants: {
  },
  plugins: [
    plugin(function ({ addBase, addUtilities, config }) {
      addBase({
        'blockquote': {
          'display': 'block',
          'marginTop': '1em',
          'margin-bottom': '1em',
          'margin-left': '40px',
          'margin-right': '40px',
        },

        'figure': {
          'margin': '2em 0 2em 0',
          'max-width': 'fit-content',
          'text-align': 'end',
          'color': '#ebcb9a',
        },
      })

      // Add some custome classes
      const newUtilities = {
        '.filter-none': {
          filter: 'none',
        },
        '.filter-grayscale-070': {
          filter: 'grayscale(70%)',
          opacity: '1',
        },
        '.filter-grayscale': {
          filter: 'grayscale(100%)',
          opacity: '1',
        },
      }

      addUtilities(newUtilities, ['responsive', 'hover'])
    })
  ],
}
