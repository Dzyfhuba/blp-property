import type Product from './product'
import type { Column, SearchValue } from './search-option'

export type Model = {
    id?: string
    batch?: string
    product_id?: string
    criterion?: SearchValue
    total?: number
    pairwise_comparison_normalized?: {
        [key in Column]: SearchValue
    }
    pairwise_comparison_priority?: SearchValue
    pairwise_comparison_line_quality?: SearchValue
    pairwise_comparison_consistency_ratio?: number
    created_at?: string
    updated_at?: string
}

export type Search = {
    total: number
    criterion: SearchValue
}

export type SmarterResponse = {
    models: (Model & { product: Product })[]
    search: Search
    pairwise_comparison: {
        [key in Column]: SearchValue
    }
}
