import { ItemInterface, ReactSortable } from 'react-sortablejs'
import ProductInput from './ProductInput'
import { SyntheticEvent, useState } from 'react'

const SearchProducts = () => {
  const [list, setList] = useState<ItemInterface[]>([
    { id: 'price', },
    { id: 'bedrooms', },
    { id: 'bathrooms', },
    { id: 'land_size', },
    { id: 'facility', },
    { id: 'public_facility', },
    { id: 'design', },
    { id: 'location', },
    { id: 'floors', },
    { id: 'building_size', },
  ])

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
      <div className="flex flex-col gap-3">
        <ReactSortable
          list={list}
          setList={setList}
        >
          {list.map(item => (
            <div key={item.id}>
              <h1>{'asdasd' + item.id}</h1>
            </div>
          ))}
        </ReactSortable>
      </div>
      <button className='btn btn-primary'>
        Search
      </button>
    </form>
  )
}

export default SearchProducts