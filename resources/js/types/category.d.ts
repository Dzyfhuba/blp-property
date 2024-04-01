export default interface Category {
  id?: number
  name?: string
  description?: string
  images_top?: string[]
  images_bottom?: string[]
  details?: string
  status?: 'complete' | 'progress'
  created_at?: string
  updated_at?: string
}