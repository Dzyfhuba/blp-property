import Footer from '@/Components/Footer'
import Navbar from '@/Components/Navbar'
import type { PageProps } from '@/types'
import Setting from '@/types/setting'
import { type HTMLAttributes } from 'react'

export default function Layout({ children, className, ...props }: HTMLAttributes<HTMLElement> & PageProps & {
//   widgets?: Widget[]
  setting?: Setting
}) {
  return (
    <>
      <Navbar />
      <main className={'min-h-[150vh]' + (className ? ` ${className}` : '')}>
        {children}
      </main>

      <Footer {...props.setting} />
    </>
  )
}
