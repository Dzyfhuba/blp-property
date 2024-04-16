import Footer from '@/Components/Footer'
import Image from '@/Components/Image'
import Layout from '@/Layouts/Layout'
import type { PageProps } from '@/types'
import type Category from '@/types/category'
import { Parser } from 'html-to-react'

interface Props extends PageProps {
  item: Category
  // aside: {
  //   title?: string
  //   contacts?: {
  //     url?: string
  //     label?: string
  //     type?: string
  //   }[]
  //   marketing_executives?: {
  //     name?: string
  //     phone?: string
  //   }[]
  //   social_medias?: {
  //     [key: string]: string
  //   }
  //   address?: string
  //   google_maps_url?: string
  // }
}

const CategoriesShow = (props: Props) => {
  return (
    <Layout className='flex'
      {...props}
    >
      <article>
        <section id="header"
          className='mt-20 relative'
        >
          <Image
            src={props.item.images_top?.length ? `/storage/${props.item.images_top[0]}` : ''}
            alt={props.item.name}
            className='brightness-50'
          />
          <h1
            className={`absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2
          bg-primary text-white font-black text-2xl sm:text-4xl text-center rounded-md uppercase font-montserrat
          p-3 md:w-full max-w-screen-sm`}
          >
            {props.item.name}
          </h1>
        </section>

        <section id="description"
          className='prose p-3 mx-auto'
        >
          {Parser().parse(props.item.description || '')}
        </section>

        <section id="detail"
          className='prose prose-h2:m-0 mx-auto p-3'
        >
          {props.item.details?.map((detail, idx) => (
            <div key={idx}>
              <div
                className="divider divider-primary h-24 sm:h-auto wf"
              >
                <h2>{detail.title || 'title'}</h2>
              </div>
              <div>
                {Parser().parse(detail.description)}
              </div>
              <div>
                {detail.images?.map(image => (
                  <Image key={image}
                    src={`/storage/${image}`}
                    alt={props.item.name}
                    className='w-full h-auto object-contain'
                    zoomable
                  />
                ))}
              </div>
            </div>
          ))}
        </section>
      </article>
    </Layout>
  )
}

export default CategoriesShow
