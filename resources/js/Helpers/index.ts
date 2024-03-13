export function formatNumber(number:number) {
  const formattedNumber = number.toString()

  // Check if there are decimal places
  if (formattedNumber.includes('.')) {
    const decimalPlaces = formattedNumber.split('.')[1].length
    
    // Remove trailing zeros and the decimal point if all decimal places are zero
    const roundedNumber = parseFloat(number.toFixed(decimalPlaces))
    return roundedNumber.toString().replace(/(\.0+|0+)$/, '')
  }

  return formattedNumber
}

