import { IoIosHome } from 'react-icons/io'
import style from './ProductsDisplay.module.css'

const ProductsDisplay = () => {
  const products = [
    {
      title: 'GKB',
      subtitle: 'Gresik Kota Baru'
    },
    {
      title: 'PPS',
      subtitle: 'Pondok Permata Suci'
    },
    {
      title: 'GKR',
      subtitle: 'Gresik Kota Raya'
    },
    {
      title: 'PSR',
      subtitle: 'Permata Sidayu Residence'
    },
  ]

  return (
    <section id="products-display" className={style.section}>
      <div className="divider divider-primary h-24 sm:h-auto">
        <h2 className={style.title}>Properti-properti kami</h2>
      </div>

      <div className={style.gridContainer}>
        {products.map((product, idx) => (
          <div key={idx}>
            <div className='mask mask-circle text-base-content bg-base-200 p-5'>
              <IoIosHome size={52} className='mx-auto' />
            </div>
            <h3>{product.title}</h3>
            <span>{product.subtitle}</span>
          </div>
        ))}
      </div>
    </section>
  )
}

export default ProductsDisplay