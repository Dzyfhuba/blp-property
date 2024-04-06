import ImageNotFound from '@/Images/image-not-found.png'
import Image from '@/Components/Image'
import Layout from '@/Layouts/Layout'
import type { PageProps } from '@/types'
import type Product from '@/types/product'
import lorem from '@/Variables/lorem'
import { Link } from '@inertiajs/react'
import withReactContent from 'sweetalert2-react-content'
import Swal from 'sweetalert2'
import 'sweetalert2/dist/sweetalert2.min.css'
import Client from '@/Components/Client'
import SearchProducts from '@/Components/ProductsSearch'

interface Props extends PageProps {
    data: Product[]
}

const Products = (props: Props) => {
  const ReactSwal = withReactContent(Swal)

  const handleSearchModal = () => {
    ReactSwal.fire({
      html: (
        <Client>
          <SearchProducts />
        </Client>
      ),
      showConfirmButton: false,
      showCloseButton: true,
      title: 'Cari Hunian Terbaik Anda',
    })
  }

  return (
    <Layout>
      <section id="products"
        className='pt-20 max-w-screen-sm mx-auto'
      >
        {/* filter */}
        <div>
          <button className='btn btn-primary'
            onClick={() => handleSearchModal()}
          >
                        Cari Rumah Terbaik Untuk Anda
          </button>
        </div>

        {/* products list */}
        <div className="grid p-3 justify-center gap-3 sm:grid-cols-2">
          {props.data.map((item) => (
            <article key={item.id}
              className='card overflow-hidden shadow-md bg-base-200 hover:cursor-pointer group'
            >
              <Link href={`/categories/${item.category?.name}`}>
                <Image src={item.images ? item.images[0] : ImageNotFound}
                  zoomable={false}
                  alt={`${item.name} ${import.meta.env.VITE_APP_NAME}`}
                  className='h-40 w-full object-cover'
                />
                <div className='p-3'>
                  <h1 className='font-black text-lg group-hover:underline'>{item.name}</h1>
                  <h2 className='text-sm'>{item.category?.name}</h2>
                  <p className='line-clamp-2 text-xs'>{item.description || lorem}</p>
                </div>
              </Link>
            </article>
          ))}
        </div>
      </section>
    </Layout>
  )
}

export default Products