import { defineConfig } from 'cypress'
import plugin from './tests/cypress/plugins/index'

export default defineConfig({
  chromeWebSecurity: false,
  retries: 2,
  defaultCommandTimeout: 5000,
  watchForFileChanges: false,
  videosFolder: 'tests/cypress/videos',
  screenshotsFolder: 'tests/cypress/screenshots',
  fixturesFolder: 'tests/cypress/fixture',
  e2e: {
    setupNodeEvents(on, config) {
      return plugin(on, config)
    },
    baseUrl: 'http://localhost',
    specPattern: 'tests/cypress/integration/**/*.cy.{js,jsx,ts,tsx}',
    supportFile: 'tests/cypress/support/index.js',
  },
})
