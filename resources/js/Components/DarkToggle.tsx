import { useState } from 'react'
import { FaMoon, FaSun } from 'react-icons/fa'
import { MdOutlineComputer } from 'react-icons/md'

// type Props = {
//   className?: string
//   size?: number
// }

type Mode = 'dark' | 'light' | 'default'

const DarkToggle = () => {
  const mode = window ? localStorage.getItem('mode') as 'dark' | 'light' : 'default'
  const [currentMode, setCurrentMode] = useState(mode)
  if (typeof window !== 'undefined' && mode) document.querySelector('html')?.setAttribute('data-theme', mode)

  const handleMode = (mode: Mode) => {
    if (mode === 'default') {
      document.querySelector('html')?.removeAttribute('data-theme')
      window.localStorage.removeItem('mode')
    } else {
      window.localStorage.setItem('mode', mode)
      document.querySelector('html')?.setAttribute('data-theme', mode)
    }
    setCurrentMode(mode)
  }

  return (
    <div className="join rounded-full p-1 bg-base-200 w-max">
      {/* <input type="radio" name="theme-buttons" className="btn theme-controller join-item" aria-label="Default" value="default" /> */}
      <button className={`btn btn-sm join-item !rounded-full btn-ghost ${currentMode == 'light' ? ' bg-base-100':''}`} onClick={() => handleMode('light')}>
        <FaSun />
      </button>
      <button className={`btn btn-sm join-item !rounded-full btn-ghost ${!currentMode ? ' bg-base-100':''}`} onClick={() => handleMode('default')}>
        <MdOutlineComputer />
      </button>
      <button className={`btn btn-sm join-item !rounded-full btn-ghost ${currentMode == 'dark' ? ' bg-base-100':''}`} onClick={() => handleMode('dark')}>
        <FaMoon />
      </button>
      {/* <input type="radio" name="theme-buttons" className="btn theme-controller join-item" aria-label="Light" value="light" />
      <input type="radio" name="theme-buttons" className="btn theme-controller join-item" aria-label="Dark" value="dark" /> */}
    </div>
  )
}

export default DarkToggle
