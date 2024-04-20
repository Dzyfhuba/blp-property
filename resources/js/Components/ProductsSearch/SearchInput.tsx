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
        {/* <Input
          tabIndex={-1}
          type='text'
          currency
          id='price'
          name='price'
          htmlFor='price'
          label='Rp. 300 juta - 1000 juta'
          placeholder='Kisaran Harga'
          defaultValue={searchValue[props.column]}
          onChange={(e) => setSearchValue({
            column: props.column,
            value: e.target.value
          })}
        /> */}
        <select
          tabIndex={-1}
          name="price"
          key={props.column}
          id="price"
          className='select grow select-bordered'
          defaultValue={searchValue[props.column]}
          onChange={(e) => setSearchValue({
            column: props.column,
            value: e.target.value
          })}
        >
          <option value="">Pilih Jumlah Kamar Tidur...</option>
          {props.options.price?.map(item => (
            <option
              value={item.value}
              key={item.value}
            >{item.label}</option>
          ))}
        </select>
      </div>
    )
  case 'bedrooms':
    return (
      <div className='flex flex-col py-6'>
        <select
          tabIndex={-1}
          name="bedrooms"
          key={props.column}
          id="bedrooms"
          className='select grow select-bordered'
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
          tabIndex={-1}
          key={props.column}
          id="bathrooms"
          className='select grow select-bordered'
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
      <div className='flex py-6'>
        <select name="land_size"
          tabIndex={-1}
          key={props.column}
          id="land_size"
          className='select grow select-bordered'
          defaultValue={searchValue[props.column]}
          onChange={(e) => setSearchValue({
            column: props.column,
            value: e.target.value
          })}
        >
          <option value="">Pilih Jumlah Kamar Mandi...</option>
          {props.options.land_size?.map(item => (
            <option
              value={item.value}
              key={item.value}
            >{item.label}</option>
          ))}
        </select>
      </div>
    )
  case 'facility':
    return (
      <div className='flex flex-col py-6'>
        <select
          tabIndex={-1}
          name="facility"
          key={props.column}
          id="facility"
          className='select grow select-bordered capitalize'
          defaultValue={searchValue[props.column]}
          onChange={(e) => setSearchValue({
            column: props.column,
            value: e.target.value
          })}
        >
          <option value="">Pilih fasilitas...</option>
          {props.options.facility?.map(item => (
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
          tabIndex={-1}
          name="public_facility"
          key={props.column}
          id="public_facility"
          className='select grow select-bordered capitalize'
          defaultValue={searchValue[props.column]}
          onChange={(e) => setSearchValue({
            column: props.column,
            value: e.target.value
          })}
        >
          <option value="">Pilih fasilitas publik...</option>
          {props.options.public_facility?.map(item => (
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
          tabIndex={-1}
          name="design"
          key={props.column}
          id="design"
          className='select grow select-bordered capitalize'
          defaultValue={searchValue[props.column]}
          onChange={(e) => setSearchValue({
            column: props.column,
            value: e.target.value
          })}
        >
          <option value="">Pilih desain...</option>
          {props.options.design?.map(item => (
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
        <select
          tabIndex={-1}
          name="location"
          key={props.column}
          id="location"
          className='select grow select-bordered capitalize'
          defaultValue={searchValue[props.column]}
          onChange={(e) => setSearchValue({
            column: props.column,
            value: e.target.value
          })}
        >
          <option value="">Lokasi Strategis</option>
          {props.options.location?.map(item => (
            <option
              value={item.value}
              key={item.value}
            >{item.label}</option>
          ))}
        </select>
      </div>
    )
  case 'floors':
    return (
      <div className='flex flex-col py-6'>
        <select
          tabIndex={-1}
          name="floors"
          key={props.column}
          id="floors"
          className='select grow select-bordered'
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
      <div className='flex py-6'>
        <select
          tabIndex={-1}
          name="building_size"
          key={props.column}
          id="building_size"
          className='select grow select-bordered'
          defaultValue={searchValue[props.column]}
          onChange={(e) => setSearchValue({
            column: props.column,
            value: e.target.value
          })}
        >
          <option value="">Pilih Jumlah lantai...</option>
          {props.options.building_size?.map(item => (
            <option
              value={item.value}
              key={item.value}
            >{item.label}</option>
          ))}
        </select>
      </div>
    )
  }
}

export default SearchInput
