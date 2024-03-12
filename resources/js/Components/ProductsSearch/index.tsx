import { ItemInterface, ReactSortable } from 'react-sortablejs'
import SearchInput from './SearchInput'
import { SyntheticEvent, useEffect, useState } from 'react'
import axios from 'axios'
import { AllSelectOption, Column } from '@/types/search-option'
import Swal from 'sweetalert2'
import { GoGrabber } from 'react-icons/go'

const SearchProducts = () => {
  const [list, setList] = useState<(ItemInterface & { column: Column })[]>([
    { id: 'price', column: 'price' },
    { id: 'bedrooms', column: 'bedrooms' },
    { id: 'bathrooms', column: 'bathrooms' },
    { id: 'land_size', column: 'land_size' },
    { id: 'facility', column: 'facility' },
    { id: 'public_facility', column: 'public_facility' },
    { id: 'design', column: 'design' },
    { id: 'location', column: 'location' },
    { id: 'floors', column: 'floors' },
    { id: 'building_size', column: 'building_size' },
  ])

  const [options, setOptions] = useState<AllSelectOption>()

  const getSelectOptions = async () => {
    Swal.showLoading()
    const res = await axios.get('/api/search')

    if (res.status !== 200) {
      console.error()
      return
    }

    console.log(res.data)

    setOptions(res.data)
    Swal.hideLoading()
  }

  useEffect(() => {
    getSelectOptions()
  }, [])

  const handleSubmit = (e: SyntheticEvent) => {
    e.preventDefault()
    console.log(list)
  }

  return (
    <form
      onSubmit={handleSubmit}
    >
      <h1 className="text-xl font-black">
        Cari Rumah
      </h1>
      {options ? (
        <>
          <div className="flex flex-col gap-3">
            <ReactSortable
              list={list}
              setList={setList}
              handle='.handle-sort'
              className='flex flex-col gap-3'
            >
              {list.map(item => (
                <div key={item.id} className='gap-1 grid grid-cols-[auto,minmax(0,1fr)] grid-flow-col auto-rows-auto justify-start'>
                  <div className='btn px-0 btn-ghost handle-sort !h-full w-max'>
                    <GoGrabber size={24} />
                  </div>
                  <div className='flex-1 justify-self-stretch' draggable={false}>
                    <SearchInput column={item.column} options={options} />
                  </div>
                </div>
              ))}
            </ReactSortable>
          </div>
          <button className='btn btn-primary'>
            Search
          </button>
        </>
      ) : (
        <></>
      )}
    </form>
  )
}

export default SearchProducts