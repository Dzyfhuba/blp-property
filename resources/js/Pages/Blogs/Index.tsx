import BlogCard from '@/Components/BlogCard'
import Image from '@/Components/Image'
import Layout from '@/Layouts/Layout'
import type { PageProps } from '@/types'
import type Blog from '@/types/blog'

interface Props extends PageProps {
  data: Blog[]
}

const Index = (props: Props) => {
  return (
    <Layout {...props}>
      <section id="blog"
        className='mt-20 grid max-w-screen-sm mx-auto p-3 sm:grid-cols-2 gap-3'
      >
        {props.data.map(item => (
          <BlogCard key={item.id}
            {...item}
          />
        ))}
      </section>
    </Layout>
  )
}

export default Index
