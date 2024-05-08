describe('template spec', () => {
  it('passes', () => {
    cy.visit(process.env.APP_URL || 'http://localhost')
  })
})
