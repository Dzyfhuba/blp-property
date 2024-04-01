import { getImageUrl } from '@/Helpers/url'
import { User } from '@/types'
import { Widget } from '@/types/widget'
import { PropsWithChildren } from 'react'
import Brand from '../Images/brand.png'
import Navbar from '@/Components/Navbar'
import Footer from '@/Components/Footer'
import FooterI from '@/types/setting'

export default function Layout({ user, children, ...props }: PropsWithChildren<{
  user?: User
  widgets?: Widget[]
  footer?: FooterI
}>) {
  return (
    <>
      <Navbar />
      <main className='min-h-[150vh]'>
        {children}
      </main>

      <Footer {...props.footer} />
    </>
  )
}
