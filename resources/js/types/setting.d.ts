export default interface Footer {
  weight_product_criterion?: {
    weight?: number
    criteria?: string
  }[]
  contacts?: {
    url?: string
    label?: string
    type?: string
  }[]
  marketing_executives?: {
    name?: string
    phone?: string
  }[]
  social_medias?: {
    [key: string]: string
  }
  address?: string
  google_maps_url?: string
}