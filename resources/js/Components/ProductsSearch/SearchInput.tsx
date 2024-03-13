import { AllSelectOption, Column } from '@/types/search-option'
import lodash from 'lodash'
import Input from '../Input'

type Props = {
  column: Column
  options: AllSelectOption
}

const SearchInput = (props: Props) => {


  switch (props.column) {
  case 'price':
    return (
      <div className='flex flex-col'>
        <Input htmlFor='price' label='Kisaran Harga' placeholder='Kisaran Harga' />
      </div>
    )
  case 'bedrooms':
    return (
      <div className='flex flex-col'>
        <select name="bedrooms" key={props.column} id="bedrooms" className='select grow select-bordered' required>
          <option value="">Pilih Jumlah Kamar Tidur...</option>
          {props.options.bedrooms.map(item => (
            <option value={item.value} key={item.value}>{item.label}</option>
          ))}
        </select>
      </div>
    )
  case 'bathrooms':
    return (
      <div className='flex flex-col'>
        <select name="bathrooms" key={props.column} id="bathrooms" className='select grow select-bordered' required>
          <option value="">Pilih Jumlah Kamar Mandi...</option>
          {props.options.bathrooms.map(item => (
            <option value={item.value} key={item.value}>{item.label}</option>
          ))}
        </select>
      </div>
    )
  case 'land_size':
    return (
      <div className='w-full'>
        <Input htmlFor='price' label='Luas tanah' placeholder='Luas tanah' />
      </div>
    )
  case 'facility':
    return (
      <div className='flex flex-col'>
        <select name="facility_id" key={props.column} id="facility_id" className='select grow select-bordered capitalize' required>
          <option value="">Pilih fasilitas...</option>
          {props.options.facilityOptions.map(item => (
            <option value={item.value} key={item.value}>{item.label}</option>
          ))}
        </select>
      </div>
    )
  case 'public_facility':
    return (
      <div className='flex flex-col'>
        <select name="public_facility_id" key={props.column} id="public_facility_id" className='select grow select-bordered capitalize' required>
          <option value="">Pilih fasilitas publik...</option>
          {props.options.publicFacilityOptions.map(item => (
            <option value={item.value} key={item.value}>{item.label}</option>
          ))}
        </select>
      </div>
    )
  case 'design':
    return (
      <div className='flex flex-col'>
        <select name="design_id" key={props.column} id="design_id" className='select grow select-bordered capitalize' required>
          <option value="">Pilih desain...</option>
          {props.options.designOptions.map(item => (
            <option value={item.value} key={item.value}>{item.label}</option>
          ))}
        </select>
      </div>
    )
  case 'location':
    return (
      <div className='flex flex-col'>
        <Input htmlFor='location' label='Jarak dari keramaian umum' placeholder='Jarak dari keramaian umum' />
      </div>
    )
  case 'floors':
    return (
      <div className='flex flex-col'>
        <select name="floors" key={props.column} id="floors" className='select grow select-bordered' required>
          <option value="">Pilih Jumlah lantai...</option>
          {props.options.floors.map(item => (
            <option value={item.value} key={item.value}>{item.label}</option>
          ))}
        </select>
      </div>
    )
  case 'building_size':
    return (
      <div className='w-full'>
        <Input htmlFor='building_size' label='Luas bangunan' placeholder='Luas bangunan' />
      </div>
    )
  }
}

export default SearchInput