export type Option = {
  id: number
  label: string
  value: number
}

export type AllSelectOption = {
  designOptions: Option[]
  facilityOptions: Option[]
  locationOptions: Option[]
  publicFacilityOptions: Option[]
  bedrooms: Option[]
  bathrooms: Option[]
  floors: Option[]
}

export type Column = 'price' | 'bedrooms' | 'bathrooms'
| 'land_size' | 'facility' | 'public_facility' | 'design'
| 'location' | 'floors' | 'building_size'