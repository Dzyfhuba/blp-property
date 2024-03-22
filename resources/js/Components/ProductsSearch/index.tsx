import { AllSelectOption, Column } from '@/types/search-option'
import { SyntheticEvent, createRef, useEffect, useState } from 'react'
import 'swiper/css'
import 'swiper/css/virtual'
import data from './data.json'
import { Swiper, SwiperClass, SwiperRef, SwiperSlide, useSwiper } from 'swiper/react'
import SearchInput from './SearchInput'
import { FaCaretLeft, FaCaretRight } from 'react-icons/fa6'
import { Virtual } from 'swiper/modules'
import axios, { AxiosError } from 'axios'
import Swal from 'sweetalert2'
import { useStoreState } from '@/State/hooks'

const ProductsSearch = () => {
  const [list, setList] = useState<({ column: Column, text?: string })[]>(data as never)
  const [options, setOptions] = useState<AllSelectOption>()
  const [index, setIndex] = useState(0)
  const { searchValue } = useStoreState(states => states)
  const [error, setError] = useState<string>()

  const [swiperRef, setSwiperRef] = useState<SwiperClass>()
  const formRef = createRef<HTMLFormElement>()

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

  const filled = Object.keys(searchValue).filter((key) => !!searchValue[key as Column]).length
  const allowedToSubmit = filled===list.length && index === list.length - 1
  console.log(filled)

  useEffect(() => {
    getData()
  }, [])

  const handleSubmit = async (e: SyntheticEvent) => {
    e.preventDefault()
    console.log('send')

    const data = await axios.post<{
        error?: object
        data?: unknown[]
        item?: object
    }>('/api/smarter', searchValue)
      .then(res => res.data)
      .catch((error) => {
        const keys = Object.keys(error.response?.data.error)
        setError(keys.map(key => error.response?.data.error[key]).join('<br/>'))
        if (error.response?.status === 400 && error.response?.data) {
          console.log(error.response?.data)
          console.log(list.filter(e => Object.keys(error.response?.data['error'] as object).includes(e.column))[0])
          const errorIndex = list.indexOf(list.filter(e => Object.keys(error.response?.data['error'] as object).includes(e.column))[0])
          console.log('indexOf', errorIndex)
          swiperRef?.slideTo(errorIndex)
        }
      })

    console.log(data)
  }

  return (
    <form id="productsSearch"
      ref={formRef}
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
        <SwiperSlide></SwiperSlide>
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
          //   disabled={filled < index + 1}
          type={allowedToSubmit || index === list.length ? 'submit' : 'button'}
          onClick={list.length === index ? undefined : () => {swiperRef?.slideNext()}}
        >
          {allowedToSubmit || index+1 === list.length  ? 'Search' : <FaCaretRight size={24} />}
        </button>
      </div>
      {error ? (
        <span>{error}</span>
      ) : <></>}
    </form>
  )
}

export default ProductsSearch
