import FooterI from '@/types/setting'
import { FaPhoneAlt } from 'react-icons/fa'
import { FaFacebook, FaInstagram, FaLocationDot, FaWhatsapp, FaYoutube } from 'react-icons/fa6'
import { MdCopyright, MdEmail } from 'react-icons/md'
import DarkToggle from './DarkToggle'

const Footer = (props: FooterI) => {
  const icons = {
    phone: <FaPhoneAlt />,
    email: <MdEmail />,
    whatsapp: <FaWhatsapp />,
    youtube: <FaYoutube size={32} />,
    instagram: <FaInstagram size={32} />,
    facebook: <FaFacebook size={32} />
  }

  const marketingOffices = [
    {
      icon: <FaLocationDot />,
      text: props.address,
      url: props.google_maps_url,
    },
    ...props.contacts?.map(c => ({
      icon: icons[c.type as never],
      text: c.label,
      url: c.url
    })) ?? []
  ]

  const socialMediaKeys = Object.keys(props.social_medias ?? {})


  return (
    <footer className='grid grid-cols-1 sm:grid-cols-[max-content,auto] justify-between w-full px-3 py-5 border-t border-base-200'>
      <div id='marketing-offices'>
        <h3 className='text-xl font-black'>Marketing Office</h3>
        <ul>
          {marketingOffices.map((mo, idx) => (
            <li key={idx}>
              <a href={mo.url}
                target="_blank"
                rel="noopener noreferrer"
                className='flex items-center gap-3'
              >
                {mo.icon} {mo.text}
              </a>
            </li>
          ))}
        </ul>
        <div className='flex gap-3'>
          {props.social_medias ? socialMediaKeys.map(smk => (
            <a href={props.social_medias![smk]}
              key={smk}
            >
              {icons[smk as never]}
            </a>
          )) : <></>}
        </div>
      </div>

      <div id='marketing-executives'
        className='flex flex-col'
      >
        <h3 className='text-xl font-black'>Marketing Executives</h3>
        {props.marketing_executives ? props.marketing_executives.map(me => (
          <a href={`https://wa.me/${me.phone?.replace('0', '+62')}`}
            target='_blank'
            key={me.phone}
            className='btn btn-sm btn-ghost justify-start'
            rel="noreferrer"
          >
            <span className='w-14 text-start'>{me.name}</span> <FaWhatsapp /> {me.phone?.replace('0', '+62')}
          </a>
        )) : <></>}
      </div>

      <span className='flex items-center gap-1 col-span-full justify-between'>
        <span>
          <MdCopyright className='inline' /> 2024 <a href="https://hafidzubaidillah.com"
            className='link-hover'
          >
            hafidzubaidillah.com
          </a>
        </span>
        <div className='justify-self-end'>
          <DarkToggle />
        </div>
      </span>
    </footer>
  )
}

export default Footer
