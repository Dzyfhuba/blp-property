import { AllSelectOption, Column } from '@/types/search-option'
import Input from '../Input'
import { useStoreActions, useStoreState } from '@/State/hooks'

type Props = {
  column: Column
  options: AllSelectOption
}

const SearchInput = (props: Props) => {
  const { setSearchValue } = useStoreActions(actions => actions)
  const { searchValue } = useStoreState(state => state)

  switch (props.column) {
  case 'price':
    return (
      <div className='flex flex-col py-6'>
        <Input
          currency
          htmlFor='price'
          label='Rp. 100.000.000 - 500.000.000'
          placeholder='Kisaran Harga'
          defaultValue={searchValue[props.column]}
          onChange={(e) => setSearchValue({
            column: props.column,
            value: e.target.value
          })} 
        />
      </div>
    )
  case 'bedrooms':
    return (
      <div className='flex flex-col py-6'>
        <select
          name="bedrooms"
          key={props.column}
          id="bedrooms"
          className='select grow select-bordered'
          required
          defaultValue={searchValue[props.column]}
          onChange={(e) => setSearchValue({
            column: props.column,
            value: e.target.value
          })}
        >
          <option value="">Pilih Jumlah Kamar Tidur...</option>
          {props.options.bedrooms?.map(item => (
            <option
              value={item.value}
              key={item.value}
            >{item.label}</option>
          ))}
        </select>
      </div>
    )
  case 'bathrooms':
    return (
      <div className='flex flex-col py-6'>
        <select name="bathrooms"
          key={props.column}
          id="bathrooms"
          className='select grow select-bordered'
          required
          defaultValue={searchValue[props.column]}
          onChange={(e) => setSearchValue({
            column: props.column,
            value: e.target.value
          })} 
        >
          <option value="">Pilih Jumlah Kamar Mandi...</option>
          {props.options.bathrooms?.map(item => (
            <option
              value={item.value}
              key={item.value}
            >{item.label}</option>
          ))}
        </select>
      </div>
    )
  case 'land_size':
    return (
      <div className='w-full py-6'>
        <Input
          htmlFor='price'
          label='Luas tanah'
          placeholder='Luas tanah' 
          defaultValue={searchValue[props.column]}
          required
          onChange={(e) => setSearchValue({
            column: props.column,
            value: e.target.value
          })} 
        />
      </div>
    )
  case 'facility':
    return (
      <div className='flex flex-col py-6'>
        <select
          name="facility_id"
          key={props.column}
          id="facility_id"
          className='select grow select-bordered capitalize'
          required
          defaultValue={searchValue[props.column]}
          onChange={(e) => setSearchValue({
            column: props.column,
            value: e.target.value
          })} 
        >
          <option value="">Pilih fasilitas...</option>
          {props.options.facilityOptions?.map(item => (
            <option
              value={item.value}
              key={item.value}
            >{item.label}</option>
          ))}
        </select>
      </div>
    )
  case 'public_facility':
    return (
      <div className='flex flex-col py-6'>
        <select
          name="public_facility_id"
          key={props.column}
          id="public_facility_id"
          className='select grow select-bordered capitalize'
          required
          defaultValue={searchValue[props.column]}
          onChange={(e) => setSearchValue({
            column: props.column,
            value: e.target.value
          })} 
        >
          <option value="">Pilih fasilitas publik...</option>
          {props.options.publicFacilityOptions?.map(item => (
            <option
              value={item.value}
              key={item.value}
            >{item.label}</option>
          ))}
        </select>
      </div>
    )
  case 'design':
    return (
      <div className='flex flex-col py-6'>
        <select
          name="design_id"
          key={props.column}
          id="design_id"
          className='select grow select-bordered capitalize'
          required
          defaultValue={searchValue[props.column]}
          onChange={(e) => setSearchValue({
            column: props.column,
            value: e.target.value
          })} 
        >
          <option value="">Pilih desain...</option>
          {props.options.designOptions?.map(item => (
            <option
              value={item.value}
              key={item.value}
            >{item.label}</option>
          ))}
        </select>
      </div>
    )
  case 'location':
    return (
      <div className='flex flex-col py-6'>
        <Input
          htmlFor='location'
          label='Jarak dari keramaian umum'
          placeholder='Jarak dari keramaian umum' 
          required
          defaultValue={searchValue[props.column]}
          onChange={(e) => setSearchValue({
            column: props.column,
            value: e.target.value
          })} 
        />
      </div>
    )
  case 'floors':
    return (
      <div className='flex flex-col py-6'>
        <select
          name="floors"
          key={props.column}
          id="floors"
          className='select grow select-bordered'
          required
          defaultValue={searchValue[props.column]}
          onChange={(e) => setSearchValue({
            column: props.column,
            value: e.target.value
          })} 
        >
          <option value="">Pilih Jumlah lantai...</option>
          {props.options.floors?.map(item => (
            <option
              value={item.value}
              key={item.value}
            >{item.label}</option>
          ))}
        </select>
      </div>
    )
  case 'building_size':
    return (
      <div className='w-full py-6'>
        <Input
          htmlFor='building_size'
          label='Luas bangunan'
          placeholder='Luas bangunan'
          required
          defaultValue={searchValue[props.column]}
          onChange={(e) => setSearchValue({
            column: props.column,
            value: e.target.value
          })}  
        />
      </div>
    )
  }
}

export default SearchInput