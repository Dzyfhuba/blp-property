import { Column, SearchValue } from '@/types/search-option'
import { Action, action, createStore } from 'easy-peasy'

export interface GlobalState {
  searchValue: SearchValue
  setSearchValue: Action<GlobalState, { column: Column, value: string | number }>
}

const store = createStore<GlobalState>({
  searchValue: (JSON.parse(localStorage.getItem('searchValue') || '{}')) as SearchValue,
  setSearchValue: action((state, payload) => {
    state.searchValue[payload.column] = payload.value

    localStorage.setItem('searchValue', JSON.stringify(state.searchValue))
  }) 
})

export default store