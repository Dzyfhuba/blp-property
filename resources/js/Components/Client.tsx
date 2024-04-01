import store from '@/State/store'
import { StoreProvider } from 'easy-peasy'
import { HTMLAttributes } from 'react'

interface Props extends HTMLAttributes<HTMLElement> {}

const Client = (props: Props) => {


  return (
    <StoreProvider store={store}>
      {props.children}
    </StoreProvider>
  )
}

export default Client