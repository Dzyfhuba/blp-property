import Advantages from '@/Components/Dashboard/Advantages'
import Categories from '@/Components/Dashboard/Categories'
import Heros from '@/Components/Dashboard/Heros'
import ProductsDisplay from '@/Components/Dashboard/ProductsDisplay'
import Layout from '@/Layouts/Layout'
import { PageProps } from '@/types'
import Category from '@/types/category'
import Setting from '@/types/setting'

interface Props extends PageProps {
  categories: Category[]
  setting: Setting
}

export default function Dashboard(props: Props) {
  return (
    <Layout
      {...props}
    >
      <Heros />
      <div className='container mx-auto'>
        <ProductsDisplay />
        <Advantages />
        <Categories categories={props.categories} />
      </div>
    </Layout>
  )
}
