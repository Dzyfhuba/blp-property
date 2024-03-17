import Heros from '@/Components/Heros'
import ProductsDisplay from '@/Components/ProductsDisplay'
import Layout from '@/Layouts/Layout'
import { PageProps } from '@/types'

export default function Dashboard(props: PageProps) {
  console.log(props.widgets.filter(a => a.layout?.includes('header')))
  return (
    <Layout widgets={props.widgets}>
      <Heros />
      <ProductsDisplay />
    </Layout>
  )
}
