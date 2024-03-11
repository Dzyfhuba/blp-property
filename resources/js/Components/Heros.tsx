import { Swiper, SwiperSlide } from 'swiper/react'
import 'swiper/css'
import 'swiper/css/pagination'
import { Pagination } from 'swiper/modules'
import Slider1 from '@/Images/Slider-BLP-Property-1.jpg'
import Slider2 from '@/Images/Slider-BLP-Property-2.jpg'
import Slider3 from '@/Images/Slider-BLP-Property-3.jpg'
import styles from './Heros.module.css'

const Heros = () => {
  return (
    <Swiper
      pagination={{
        clickable: true
      }}
      loop={true}
      modules={[Pagination]}
      className='bg-base-200'
    >
      <SwiperSlide>
        <div className={styles.mainContainer}>
          <button className='btn btn-primary'>
            Search
          </button>
        </div>
      </SwiperSlide>
      {[Slider1,Slider2,Slider3].map((slide, idx) => (
        <SwiperSlide key={idx}>
          <img
            src={slide}
            alt={`${import.meta.env.VITE_APP_NAME} ${idx}`}
            className='w-full h-screen object-contain'
          />
        </SwiperSlide>
      ))}
    </Swiper>
  )
}

export default Heros