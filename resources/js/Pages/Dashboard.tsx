import Advantages from '@/Components/Dashboard/Advantages'
import Categories from '@/Components/Dashboard/Categories'
import Heros from '@/Components/Dashboard/Heros'
import ProductsDisplay from '@/Components/Dashboard/ProductsDisplay'
import Layout from '@/Layouts/Layout'
import { PageProps } from '@/types'
import Category from '@/types/categories'
import Footer from '@/types/setting'

interface Props extends PageProps {
  categories: Category[]
  setting: Footer
}

export default function Dashboard(props: Props) {
  console.log(props)
  return (
    <Layout widgets={props.widgets} footer={props.setting}>
      <Heros />
      <div className='container mx-auto'>
        <ProductsDisplay />
        <Advantages />
        <Categories categories={props.categories} />
      </div>
    </Layout>
  )
}
