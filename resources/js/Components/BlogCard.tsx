import BlogI from '@/types/blog'
import { Link } from '@inertiajs/react'
import Image from './Image'

const BlogCard = (props: BlogI & {className?: string}) => {
  const hover = `group-hover:scale-x-90 group-hover:-translate-x-[5%] transition-transform
  group-focus:scale-x-90 group-focus:-translate-x-[5%] transition-transform`
  return (
    <Link
      className={'card hover focus group' + (props.className ? ` ${props.className}` : '')}
      href={`/blogs/${props.slug}`}
    >
      <Image
        src={`/storage/${props.thumbnail}`}
        alt={props.title}
        className='h-40 object-cover group-hover:brightness-50'
      />
      <h1 className={'text-xl font-bold ' + hover}>{props.title}</h1>
      <p className={'line-clamp-2 text-xs opacity-75 ' + hover}>{props.description}</p>
    </Link>
  )
}

export default BlogCard
