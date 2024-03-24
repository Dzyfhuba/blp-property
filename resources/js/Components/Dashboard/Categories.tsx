import ImageNotFound from '@/Images/image-not-found.png'
import Image from '@/Components/Image'
import styles from './Categories.module.css'
import Category from '@/types/category'
import { Link } from '@inertiajs/react'

type Props = {
  categories: Category[]
}

const Categories = (props: Props) => {
  return (
    <section id="categories">
      <div id='progress'
        className={styles.container}
      >
        <h2>Project Berjalan</h2>
        <div className={styles.gridList}>
          {props.categories.filter(c => c.status === 'progress').map(c => (
            <Link key={c.id}
              className={styles.gridItem}
              href={`/categories/${c.id}`}
              target='_blank'
            >
              <Image
                src={c.images_top ? `/storage/${c.images_top![0]}` : ImageNotFound}
                className='h-56 object-cover'
                zoomable={false}
              />
              <h3>
                {c.name}
              </h3>
            </Link>
          ))}
        </div>
      </div>

      <div id='compelete'
        className={styles.container}
      >
        <h2>Project Selesai</h2>
        <div className={styles.gridList}>
          {props.categories.filter(c => c.status === 'complete').map(c => (
            <Link key={c.id}
              className={styles.gridItem}
              href={`/categories/${c.id}`}
              target='_blank'
            >
              <Image
                src={c.images_top ? `/storage/${c.images_top![0]}` : ImageNotFound}
                className='h-56 object-cover'
                zoomable={false}
              />
              <h3>
                {c.name}
              </h3>
            </Link>
          ))}
        </div>
      </div>
    </section>
  )
}

export default Categories
