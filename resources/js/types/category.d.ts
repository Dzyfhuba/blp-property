export default interface Category {
  id?: number
  name?: string
  description?: string
  images_top?: string[]
  images_bottom?: string[]
  details?: {
    title?: string
    description?: string
    images?: string[]
  }[]
  slug?: string
  status?: 'complete' | 'progress'
  created_at?: string
  updated_at?: string
}
