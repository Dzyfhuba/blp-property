export type Option = {
  id?: number
  label?: string
  value?: number
}

export type AllSelectOption = {
  [key in Column]?: Option[]
}

export type Column =
  'price' |
  'bedrooms' |
  'bathrooms' |
  'land_size' |
  'facility' |
  'public_facility' |
  'design' |
  'location' |
  'floors' |
  'building_size'

export type SearchValue = {
  [key in Column]?: string | number
}
