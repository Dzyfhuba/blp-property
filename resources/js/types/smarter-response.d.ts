import type Product from './product'
import type { Column, SearchValue } from './search-option'

export type Model = {
    id: string
    batch: string
    product_id: string
    criterion: SearchValue
    total: string
    pairwise_comparison_normalized: string
    pairwise_comparison_priority: string
    pairwise_comparison_line_quality: string
    pairwise_comparison_consistency_ratio: string
    created_at: string
    updated_at: string
}

export type Search = {
    total: number
    criterion: SearchValue
}

export type SmarterResponse = {
    model: Model & { product: Product }
    search: Search
    pairwise_comparison: {
        [key in Column]: SearchValue
    }
}
