import { AllSelectOption, Column } from '@/types/search-option'
import axios from 'axios'
import { SyntheticEvent, useEffect, useState } from 'react'
import { GoGrabber } from 'react-icons/go'
import { MdClose } from 'react-icons/md'
import { ItemInterface, ReactSortable } from 'react-sortablejs'
import Swal from 'sweetalert2'
import SearchInput from './SearchInput'
import data from './data.json'

const SearchProducts = () => {
  const [unlist, setUnlist] = useState<(ItemInterface & { column: Column, text?: string })[]>(data as never)

  const [list, setList] = useState<(ItemInterface & { column: Column, text?: string })[]>([])

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

  const handleFilterChange = (value: string, action: 'add' | 'delete') => {
    console.log(value)
    if (action === 'add') {
      setList([...list, unlist.filter(l => l.id === value)[0]])
      setUnlist(unlist.filter(u => u.id !== value))
    } else if (action === 'delete') {
      setUnlist([...unlist, list.filter(l => l.id === value)[0]])
      setList(list.filter(u => u.id !== value))
    }
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
                <div key={item.id}
                  className='gap-1 grid grid-cols-[auto,minmax(0,1fr)] grid-flow-col auto-rows-auto justify-start'
                >
                  <div className='btn px-0 btn-ghost handle-sort !h-full w-max'>
                    <GoGrabber size={24} />
                  </div>
                  <div className='flex-1 justify-self-stretch'
                    draggable={false}
                  >
                    <SearchInput column={item.column}
                      options={options}
                    />
                  </div>
                  <button type='button'
                    className='btn btn-ghost text-red-500 px-0'
                    onClick={() => handleFilterChange(item.column, 'delete')}
                  >
                    <MdClose size={24} />
                  </button>
                </div>
              ))}
            </ReactSortable>
          </div>
          {list.length >= 10 ? <></> : (
            <select className='btn btn-sm text-start block mx-auto'
              onChange={(e) => handleFilterChange(e.target.value, 'add')}
            >
              <option value="">Tambah Filter {`${list.length}/10`}</option>
              {unlist.filter(u => !list.includes(u)).map(item => (
                <option value={item.id}
                  key={item.id}
                >{item.text}</option>
              ))}
            </select>
          )}
          {list.length ? (
            <button className='btn btn-primary'
              disabled={list.length < 10}
            >
              Search
            </button>
          ) : <></>}
        </>
      ) : (
        <></>
      )}
    </form>
  )
}

export default SearchProducts
