import type { User } from '.'

export default interface Blog {
    id?: string
    title?: string
    slug?: string
    description?: string
    content?: string
    tags?: string
    thumbnail?: string
    user_id?: string
    user?: User
    public?: string
    created_at?: string
    updated_at?: string
}
