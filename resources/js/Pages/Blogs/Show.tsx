import BlogCard from '@/Components/BlogCard'
import Layout from '@/Layouts/Layout'
import type { PageProps } from '@/types'
import type Blog from '@/types/blog'
import { Parser } from 'html-to-react'

interface Props extends PageProps {
    item: Blog
    other_blogs: Blog[]
}

export default function Show(props: Props) {
  return (
    <Layout {...props}>
      <article id="blog-show"
        className='mt-20 p-3 prose mx-auto'
      >
        {Parser().parse(props.item.content)}
      </article>

      <section
        className='grid auto-cols-[100%] sm:auto-cols-[300px] grid-flow-col gap-3 p-3 overflow-x-auto snap-x snap-mandatory scrollbar-hide'
      >
        {props.other_blogs.map(blog => (
          <BlogCard key={blog.id}
            className='snap-center sm:snap-center'
            {...blog}
          />
        ))}
      </section>
    </Layout>
  )
}
