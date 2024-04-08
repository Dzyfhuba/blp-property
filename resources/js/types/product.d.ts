import type Category from './category'

export default interface Product {
    id?: number
    name?: string
    description?: string
    category_id?: string
    category?: Category
    price?: string
    bedrooms?: string
    bathrooms?: string
    land_size?: string
    facility_option_id?: string
    public_facility_option_id?: string
    design_option_id?: string
    location_option_id?: string
    floors?: string
    building_size?: string
    capacity?: string
    occupied?: string
    images?: string[]
    created_at?: string
    updated_at?: string
}
