import Advantages from '@/Components/Dashboard/Advantages'
import Categories from '@/Components/Dashboard/Categories'
import Heroes from '@/Components/Dashboard/Heroes'
import ProductsDisplay from '@/Components/Dashboard/ProductsDisplay'
import Layout from '@/Layouts/Layout'
import { PageProps } from '@/types'
import Category from '@/types/category'
import type Hero from '@/types/hero'
import Setting from '@/types/setting'

interface Props extends PageProps {
  categories: Category[]
  setting: Setting
  heroes: Hero[]
}

export default function Dashboard(props: Props) {
  return (
    <Layout
      {...props}
    >
      <Heroes heroes={props.heroes} />
      <div className='container mx-auto'>
        <ProductsDisplay />
        <Advantages />
        <Categories categories={props.categories} />
      </div>
    </Layout>
  )
}
