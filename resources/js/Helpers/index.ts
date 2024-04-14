import type { Column } from '@/types/search-option'

export function formatNumber(number:number) {
  const formattedNumber = number.toString()

  // Check if there are decimal places
  if (formattedNumber.includes('.')) {
    const decimalPlaces = formattedNumber.split('.')[1].length

    // Remove trailing zeros and the decimal point if all decimal places are zero
    const roundedNumber = parseFloat(number.toFixed(decimalPlaces))
    return roundedNumber.toString().replace(/(\.0+|0+)$/, '')
  }

  return parseFloat(formattedNumber)
}

export const minMax: {
    [key in Column]: {min: number, max: number}
} = {
  price: { min: 1, max: 3 },
  bedrooms: { min: 1, max: 3 },
  bathrooms: { min: 1, max: 2 },
  floors: { min: 1, max: 2 },
  facility: { min: 1, max: 3 },
  public_facility: { min: 1, max: 3 },
  land_size: { min: 1, max: 3 },
  building_size: { min: 1, max: 3 },
  location: { min: 1, max: 3 },
  design: { min: 1, max: 3 },
}

export type SMARTER = {
    weight: number
    value: number
    column: Column
}

export const smarter = (input: SMARTER) =>
  input.weight * 100 * ((input.value - minMax[input.column].min) / (minMax[input.column].max - minMax[input.column].min))
