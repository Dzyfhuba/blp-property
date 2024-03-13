import { getImageUrl } from '@/Helpers/url'
import Layout from '@/Layouts/Layout'
import { PageProps } from '@/types'
import Brand from '../Images/brand.png'
import Heros from '@/Components/Heros'

export default function Dashboard(props: PageProps) {
  console.log(props.widgets.filter(a => a.layout?.includes('header')))
  return (
    <Layout widgets={props.widgets}>
      <Heros />
    </Layout>
  )
}
