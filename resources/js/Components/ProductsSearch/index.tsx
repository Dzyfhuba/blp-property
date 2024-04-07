import { AllSelectOption, Column, type SearchValue } from '@/types/search-option'
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
import { useStoreActions, useStoreState } from '@/State/hooks'
import { router } from '@inertiajs/react'
import { GrPowerReset } from 'react-icons/gr'

const ProductsSearch = () => {
  const [list, setList] = useState<({ column: Column, text?: string })[]>(data as never)
  const [options, setOptions] = useState<AllSelectOption>()
  const [index, setIndex] = useState(0)
  const { searchValue } = useStoreState(states => states)
  const { resetSearchValue } = useStoreActions(action => action)
  const [errors, setErrors] = useState<string[]>()

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
        text: res.data.message || 'Something went wrong',
      })
      setOptions({})
    }
  }


  useEffect(() => {
    getData()

    // swiperRef?.el.querySelectorAll<HTMLInputElement&HTMLSelectElement>('input,select').forEach(element => {
    //   element.addEventListener('keydown', (e) => {
    //     console.log('keydown')
    //     e.preventDefault()
    //     if (e.key === 'Tab'){
    //       swiperRef?.slideNext()
    //     }
    //   })
    // })

  }, [swiperRef, window])

  const columns: Column[] = [
    'price',
    'bedrooms',
    'bathrooms',
    'land_size',
    'facility',
    'public_facility',
    'design',
    'location',
    'floors',
    'building_size',
  ]

  const handleSubmit = async (e: SyntheticEvent) => {
    e.preventDefault()

    const messages = columns.map((column) => {
      if (!searchValue[column]) return `${column} belum diisi`
    }).filter(e => typeof e === 'string') as string[] || []

    if (messages.length) {
      console.log({ messages })
      setErrors(messages)
      return
    }

    router.get('/products', {
      search: searchValue
    })
    Swal.close()
  }

  const getSummaryCriteriaData = (column: Column) => {
    switch (column) {
    case 'price':
      return (
        <>
          <td>Harga</td>
          <td>:</td>
          <td>{searchValue[column] ? `Rp. ${searchValue[column]} juta` : ''}</td>
        </>
      )
    case 'bedrooms':
      return (
        <>
          <td>Jumlah Kamar</td>
          <td>:</td>
          <td>{searchValue[column] ? searchValue[column] + ' Kamar tidur' : ''}</td>
        </>
      )
    case 'bathrooms':
      return (
        <>
          <td>Jumlah Kamar Mandi</td>
          <td>:</td>
          <td>{searchValue[column] ? searchValue[column] + ' Kamar mandi' : ''}</td>
        </>
      )
    case 'floors':
      return (
        <>
          <td>Jumlah Lantai</td>
          <td>:</td>
          <td>{searchValue[column] ? searchValue[column] + ' Lantai' : ''}</td>
        </>
      )
    case 'facility':
      return (
        <>
          <td>Fasilitas</td>
          <td>:</td>
          <td>{searchValue[column] ? options?.facilityOptions?.filter(e => e.value == searchValue[column])[0].label : ''}</td>
        </>
      )
    case 'public_facility':
      return (
        <>
          <td>Fasilitas Publik</td>
          <td>:</td>
          <td>{searchValue[column] ? searchValue[column] + ' Kamar mandi' : ''}</td>
        </>
      )
    case 'land_size':
      return (
        <>
          <td>Luas Tanah</td>
          <td>:</td>
          <td>{searchValue[column] ? searchValue[column] + ' m2' : ''}</td>
        </>
      )
    case 'building_size':
      return (
        <>
          <td>Luas Bangunan</td>
          <td>:</td>
          <td>{searchValue[column] ? searchValue[column] + ' m2' : ''}</td>
        </>
      )
    case 'location':
      return (
        <>
          <td>Lokasi</td>
          <td>:</td>
          <td>{searchValue[column] ? searchValue[column] + ' Kamar mandi' : ''}</td>
        </>
      )
    case 'design':
      return (
        <>
          <td>Desain</td>
          <td>:</td>
          <td>{searchValue[column] ? searchValue[column] + ' Kamar mandi' : ''}</td>
        </>
      )
    default:
      return (
        <>
          <td>Undefined</td>
          <td>:</td>
          <td>Undefined</td>
        </>
      )
    }
  }

  return (
    <form id="productsSearch"
      ref={formRef}
      onSubmit={handleSubmit}
    >
      {
        errors?.length ? <div className='alert alert-error p-2 grid-flow-row grid-cols-1'>
          {errors?.length ? errors.map((e, idx) => (
            <span key={idx}>{e}</span>
          )) : <></>}
        </div> : <></>
      }
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
            className='h-max flex flex-col grow m-auto'
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
        <SwiperSlide>
          <h1>Summary</h1>
          <table className='w-max mx-auto text-start'>
            <thead>
              <tr>
                <th className='text-center'>Kriteria</th>
                <th></th>
                <th className='text-center'>Jawaban</th>
              </tr>
            </thead>
            <tbody>
              {Object.keys(searchValue).map((key) => (
                <tr key={key}>
                  {getSummaryCriteriaData(key as Column)}
                </tr>
              ))}
            </tbody>
          </table>
        </SwiperSlide>
      </Swiper>
      <div className='join self-end flex justify-end'>
        <button type='reset'
          className='btn btn-error btn-outline mr-auto btn-square'
          onClick={() => {
            window.localStorage.removeItem('searchValue')
            resetSearchValue()
            router.get('/products', undefined, {
              preserveScroll: true
            })
          }}
        >
          <GrPowerReset size={24} />
        </button>
        {index + 1 <= list.length ? (
          <button
            onClick={() => swiperRef?.slidePrev()}
            className='btn btn-square btn-primary join-item !rounded-l-lg'
            disabled={index === 0}
            type='button'
          >
            <FaCaretLeft size={24} />
          </button>
        ) : (
          <>
            <button type='button'
              onClick={() => swiperRef?.slidePrev()}
              className='btn btn-primary btn-outline mr-3'
            >
                            Back
            </button>
            <button type='submit'
              className='btn btn-primary'
            >
                            Search
            </button>
          </>
        )}

        {index + 1 <= list.length ? (
          <div className='btn btn-square btn-primary join-item'>
            {`${index + 1}/${list.length}`}
          </div>
        ) : <></>}
        {index + 1 <= list.length ? (
          <button
            className={'btn btn-primary join-item'}
            type={'button'}
            onClick={() => swiperRef?.slideNext()}
          >
            <FaCaretRight size={24} />
          </button>
        ) : <></>}
      </div>
    </form>
  )
}

export default ProductsSearch
