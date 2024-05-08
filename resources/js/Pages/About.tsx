import Layout from '@/Layouts/Layout'
import { PageProps } from '@/types'

interface Props extends PageProps {
//   about: {
//     content?: string
//     images?: string[]
//   }
}

const About = (props: Props) => {
  return (
    <Layout {...props}>
      {/* kerjakan di sini */}
      <div className='pt-20'>about</div>
    </Layout>
  )
}

export default About
