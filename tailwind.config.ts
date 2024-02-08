import defaultTheme from 'tailwindcss/defaultTheme'
import forms from '@tailwindcss/forms'
import { Config } from 'tailwindcss'
import theme from 'daisyui/src/theming/themes'
import { Config as DaisyUIConfig } from 'daisyui'

/** @type {import('tailwindcss').Config} */

const config: Config & {
    daisyui: DaisyUIConfig
} = {
  content: [
    './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
    './storage/framework/views/*.php',
    './resources/views/**/*.blade.php',
    './resources/js/**/*.tsx',
  ],
  // daisyui: {
  //   themes: [
  //     {
  //       light: {
  //         ...theme['light'],
  //         primary: '#F2B84D',
  //         secondary: '#DAF24D',
  //         accent: '#EA4208',
  //         'base-content': '#000',
  //       },
  //     },
  //     // {
  //     //   dark: {
  //     //     ...theme['dark'],
  //     //     primary: '#EAB308',
  //     //     secondary: '#B0EA08',
  //     //     accent: '#EA4208',
  //     //     'base-content': '#fff',
  //     //   },
  //     // },
  //   ],
  // },
  daisyui: {},
  theme: {
    extend: {
      fontFamily: {
        sans: ['Figtree', ...defaultTheme.fontFamily.sans],
      },
      backgroundColor: {
        'dark': '#1d232a',
        'light': '#ffffff',
      },
      textColor: {
        'dark': '#ffffff',
        'light': '#000000',
      },
      boxShadow: {
        normal: '4.0px 8.0px 8.0px rgba(0,0,0,0.38)'
      },
      colors: {
        primary: '#F2B84D',
        secondary: '#DAF24D',
        accent: '#EA4208',
      },
    },
  },
  plugins: [
    forms,
    require('daisyui')
  ],
}


export default config