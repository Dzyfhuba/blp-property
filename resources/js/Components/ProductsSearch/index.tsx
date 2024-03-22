import { AllSelectOption, Column } from '@/types/search-option'
import { SyntheticEvent, createRef, useEffect, useState } from 'react'
import 'swiper/css'
import 'swiper/css/virtual'
import data from './data.json'
import { Swiper, SwiperClass, SwiperRef, SwiperSlide, useSwiper } from 'swiper/react'
import SearchInput from './SearchInput'
import { FaCaretLeft, FaCaretRight } from 'react-icons/fa6'
import { Virtual } from 'swiper/modules'
import axios from 'axios'
import Swal from 'sweetalert2'
import { useStoreState } from '@/State/hooks'

const ProductsSearch = () => {
  const [list, setList] = useState<({ column: Column, text?: string })[]>(data as never)
  const [options, setOptions] = useState<AllSelectOption>()
  const [index, setIndex] = useState(0)
  const { searchValue } = useStoreState(states => states)

  const [swiperRef, setSwiperRef] = useState<SwiperClass>()

  const getData = async () => {
    const res = await axios.get('/api/search')

    if (res.status === 200) {
      setOptions(res.data)
    } else {
      Swal.fire({
        title: `Error ${res.status} ${res.statusText}`,
        icon: 'error',
        text: res.data.message || 'Something went wrong'
      })
      setOptions({})
    }
  }

  const filled = Object.keys(searchValue).filter((key) => searchValue[key as Column]).length
  const allowedToSubmit = filled===list.length && index === list.length - 1
  console.log(filled)

  useEffect(() => {
    getData()
  }, [])

  const handleSubmit = (e: SyntheticEvent) => {
    e.preventDefault()
  }

  return (
    <form id="productsSearch"
      onSubmit={handleSubmit}
    >
      <Swiper
        allowTouchMove={false}
        modules={[Virtual]}
        onSwiper={(swiper) => setSwiperRef(swiper)}
        onSlideChange={(swiper) => {
          console.log(swiper.realIndex)
          setIndex(swiper.realIndex)
        }}
      >
        {list.map((item, idx) => (
          <SwiperSlide key={item.column}
            className='h-full flex flex-col grow'
            virtualIndex={idx}
          >
            <label>
              {item.text}
              {options ? <SearchInput column={item.column}
                options={options} 
              /> : <></>}
            </label>
          </SwiperSlide>
        ))}
      </Swiper>
      <div className='join self-end flex justify-end'>
        <button
          onClick={() => swiperRef?.slidePrev()}
          className='btn btn-square btn-primary join-item'
          disabled={index === 0}
          type='button'
        >
          <FaCaretLeft size={24} />
        </button>
        <div className='btn btn-square btn-primary join-item'>
          {`${index+1}/${list.length}`}
        </div>
        <button
          className={`btn ${allowedToSubmit || index+1 === list.length ? '' : 'btn-square'} btn-primary join-item`}
          disabled={filled < index + 1}
          type={filled === index + 1 ? 'submit' : 'button'}
          onClick={allowedToSubmit ? undefined : () => {swiperRef?.slideNext()}}
        >
          {allowedToSubmit || index+1 === list.length  ? 'Search' : <FaCaretRight size={24} />}
        </button>
      </div>
    </form>
  )
}

// const Controller = () => {
//   const swiper = useSwiper()
//   useEffect(() => {
//     console.log(swiper.activeIndex)
//   }, [swiper.activeIndex])
//   return (
//     <div className='join'>
//       <button
//         onClick={() => swiper.slidePrev()}
//         className='btn btn-square btn-primary join-item'
//       >
//         <FaCaretLeft size={24} />
//       </button>
//       <button
//         onClick={() => swiper.slideNext()}
//         className='btn btn-square btn-primary join-item'
//       >
//         <FaCaretRight size={24} />
//       </button>
//     </div>
//   )
// }

export default ProductsSearch