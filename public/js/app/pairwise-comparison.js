const criterion = [
  'price',
  'bedrooms',
  'bathrooms',
  'floors',
  'facility',
  'public_facility',
  'land_size',
  'building_size',
  'location',
  'design',
]

const pairwiseComparison = document.querySelectorAll('#pairwise-comparison [criteria1], #pairwise-comparison [criteria2]')

// console.log(pairwiseComparison)

pairwiseComparison.forEach((element) => {
  const criteria = {
    row: element.getAttribute('criteria1'),
    column: element.getAttribute('criteria2')
  }

  element.addEventListener('keyup', (event) => {
    const target = document.querySelector(`#pairwise-comparison [criteria2="${criteria.row}"][criteria1="${criteria.column}"]`)

    if (target && element.value) {
      target.value = 1 / element.value
    }

    if (!element.value) target.value = null
  })
})
