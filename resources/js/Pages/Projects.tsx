import Categories from '@/Components/Dashboard/Categories'
import Layout from '@/Layouts/Layout'
import type { PageProps } from '@/types'
import type Category from '@/types/category'

interface Props extends PageProps {
    data: Category[]
}

const ProjectsPage = (props: Props) => {
  return (
    <Layout {...props}>
      <div className='pt-20'>
        <Categories categories={props.data} />
      </div>
    </Layout>
  )
}

export default ProjectsPage
