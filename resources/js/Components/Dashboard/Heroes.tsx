import Slider1 from '@/Images/Slider-BLP-Property-1.jpg'
import Slider2 from '@/Images/Slider-BLP-Property-2.jpg'
import Slider3 from '@/Images/Slider-BLP-Property-3.jpg'
import NotFoundImage from '@/Images/image-not-found.png'
import Swal from 'sweetalert2'
import withReactContent from 'sweetalert2-react-content'
import 'sweetalert2/dist/sweetalert2.min.css'
import 'swiper/css'
import 'swiper/css/pagination'
import { Pagination } from 'swiper/modules'
import { Swiper, SwiperSlide } from 'swiper/react'
import Client from '../Client'
import SearchProducts from '../ProductsSearch'
import styles from './Heroes.module.css'
import type Hero from '@/types/hero'
import Image from '../Image'

const Heroes = (props: {heroes: Hero[]}) => {
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
      allowOutsideClick: false,
    })
  }

  return (
    <>
      <Swiper
        pagination={{
          clickable: true
        }}
        loop={true}
        modules={[Pagination]}
        className='bg-base-200'
      >
        <SwiperSlide>
          <div className={styles.mainContainer + ' relative'}>
            <Image
              src={props.heroes ? props.heroes[0].image : NotFoundImage}
              alt='main hero'
              className='h-screen w-full object-cover absolute'
            />
            <button className='btn btn-primary z-10'
              onClick={() => handleSearchModal()}
            >
              Cari Rumah Terbaik Untuk Anda
            </button>
          </div>
        </SwiperSlide>
        {/* {[Slider1, Slider2, Slider3].map((item, idx) => ( */}
        {props.heroes.slice(1).map((item, idx) => (
          <SwiperSlide key={idx}>
            <Image
              src={`/storage/${item.image}`}
              alt={`${import.meta.env.VITE_APP_NAME} ${item.title}`}
              className='w-full h-screen object-cover'
            />
          </SwiperSlide>
        ))}
      </Swiper>
    </>
  )
}

export default Heroes
