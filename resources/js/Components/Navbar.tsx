import ImageBrand2 from '@/Images/brand2.png'
import { User } from '@/types'
import { Link, router } from '@inertiajs/react'
import { useEffect, useState } from 'react'
import { FaPhoneAlt } from 'react-icons/fa'
import { MdAccountCircle, MdClose, MdMenu } from 'react-icons/md'
import styles from './Navbar.module.css'

type Props = {
    user?: User
}

const Navbar = (props: Props) => {

  const handleLogout = () => {
    try {
      router.post(route('logout')) // Make sure to use the correct route name
    } catch (error) {
      console.error('Logout failed:', error)
    }

  }

  const [isScrolled, setIsScrolled] = useState(false)
  const [prevScrollPos, setPrevScrollPos] = useState(0)

  const handleScroll = () => {
    const currentScrollPos = window.scrollY

    if (currentScrollPos > prevScrollPos) {
      // Scrolling down
      setIsScrolled(true)
    } else {
      // Scrolling up
      setIsScrolled(false)
    }

    setPrevScrollPos(currentScrollPos)
  }

  useEffect(() => {
    window.addEventListener('scroll', handleScroll)
    return () => {
      window.removeEventListener('scroll', handleScroll)
    }
  }, [prevScrollPos])

  return (
    <nav
      className={`${styles.container} ${isScrolled ? '-translate-y-full' : 'translate-y-0'}`}
    >
      <div className={styles.topContact}>
        <FaPhoneAlt /> <a href={'tel:031-3930777'}
          target="_blank"
          rel="noopener noreferrer"
        >{'031-3930777'}</a>
      </div>
      <div className={styles.topBar}>
        <label htmlFor="my-drawer"
          className="btn btn-ghost btn-sm btn-square p-0 drawer-button sm:hidden"
        >
          <MdMenu size={24} />
        </label>
        <Link href='/'
          className="uppercase font-black h-full"
        >
          {/* <h1>{import.meta.env.VITE_APP_NAME}</h1> */}
          <img src={ImageBrand2}
            alt={import.meta.env.VITE_APP_NAME}
            className="h-full"
          />
        </Link>

        <div className='hidden sm:block'>
          <Link href='/'
            className={styles.navItem}
          >
                        Home
          </Link>
          <Link href='/products'
            className={styles.navItem}
          >
                        Produk Kami
          </Link>
          <Link href='/projects'
            className={styles.navItem}
          >
                        Project Kami
          </Link>
          <Link href='/blogs'
            className={styles.navItem}
          >
                        Blog
          </Link>
          <Link href='/about'
            className={styles.navItem}
          >
                        Tentang Kami
          </Link>
        </div>

        {/* <details className="dropdown hidden sm:block dropdown-end">
          <summary className="btn btn-sm btn-ghost">
            {props.user?.name || 'Account'} <MdAccountCircle size={24} />
          </summary>
          <ul className="p-2 shadow menu dropdown-content z-[1] bg-base-100 rounded-box w-52">
            <li>
              <DarkToggle />
            </li>
            {props.user ? (
              <>
                <li>
                  <a href="/admin">Admin Page</a>
                </li>
                <li>
                  <button onClick={handleLogout}>Logout</button>
                </li>
              </>
            ) : (
              <>
                <li>
                  <a href={route('login')}>Login</a>
                </li>
                <li>
                  <a href={route('register')}>Register</a>
                </li>
              </>
            )}
          </ul>
        </details> */}
      </div>
      <div className="drawer sm:hidden">
        <input id="my-drawer"
          type="checkbox"
          className="drawer-toggle"
        />
        <div className="drawer-side">
          <label htmlFor="my-drawer"
            aria-label="close sidebar"
            className="drawer-overlay"
          ></label>
          <ul className="menu p-4 w-full max-w-xs min-h-full bg-base-200 text-base-content">
            {/* Sidebar content here */}
            <li>
              <label htmlFor="my-drawer"
                className="ml-auto btn btn-ghost btn-sm btn-square drawer-button"
              >
                <MdClose size={24} />
              </label>
            </li>
            <li>
              <Link href='/'>
                                Home
              </Link>
            </li>
            <li>
              <Link href='/products'>
                                Produk Kami
              </Link>
            </li>
            <li>
              <Link href='/projects'>
                                Project Kami
              </Link>
            </li>
            <li>
              <Link href='/blogs'>
                                Blog
              </Link>
            </li>
            <li>
              <Link href='/about'>
                                Tentang Kami
              </Link>
            </li>
            <li>
              <details className="">
                <summary className="">
                  {props.user?.name || 'Account'} <MdAccountCircle size={24} />
                </summary>
                <ul className="">
                  {props.user ? (
                    <>
                      <li>
                        <a href="/admin">Admin Page</a>
                      </li>
                      <li>
                        <button onClick={handleLogout}>Logout</button>
                      </li>
                    </>
                  ) : (
                    <>
                      <li>
                        <a href={route('login')}>Login</a>
                      </li>
                      <li>
                        <a href={route('register')}>Register</a>
                      </li>
                    </>
                  )}
                </ul>
              </details>
            </li>
          </ul>
        </div>
      </div>
    </nav>
  )
}

export default Navbar
