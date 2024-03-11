import { FaCopyright } from 'react-icons/fa'
import DarkToggle from './DarkToggle'
import { MdCopyright } from 'react-icons/md'

const Footer = () => {
  return (
    <footer className='grid grid-cols-1 sm:grid-cols-2 justify-between w-full px-3 py-5 border-t border-base-200'>
      <span className='flex items-center gap-1'>
        <MdCopyright /> 2024 <a href="https://hafidzubaidillah.com" className='link-hover'>
          hafidzubaidillah.com
        </a>
      </span>
      <div className='justify-self-end'>
        <DarkToggle />
      </div>
    </footer>
  )
}

export default Footer