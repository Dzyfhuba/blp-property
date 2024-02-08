import { getImageUrl } from '@/Helpers/url'
import { User } from '@/types'
import { Widget } from '@/types/widget'
import { PropsWithChildren } from 'react'
import Brand from '../Images/brand.png'

export default function Layout({ user, children, ...props }: PropsWithChildren<{ user?: User, widgets?: Widget[] }>) {
  return (
    <>
      <nav className='shadow-normal'>
        <div className='flex justify-between flex-col sm:flex-row p-3 items-center max-w-screen-md mx-auto'>
          <img src={Brand} alt={import.meta.env.VITE_APP_NAME} className='h-11 object-contain' />
          <div className='flex flex-col items-center w-full sm:items-end'>
            {props.widgets?.filter(a => a.layout?.includes('header')).map(w => (
              <div key={w.id} className='grid auto-cols-max grid-flow-col-dense items-baseline gap-1'>
                <img src={getImageUrl(w.image)} alt={w.title} className='h-4 row-span-2 sm:order-2' />
                <h2 className='hidden'>{w.title}</h2>
                <a href={w.link} rel='noreferrer'>
                  <div dangerouslySetInnerHTML={{ __html: w.content || '' }}></div>
                </a>
              </div>
            ))}
          </div>
        </div>
      </nav>
      <main className='p-3 min-h-[150vh]'>
        {children}
      </main>
    </>
  )
}
