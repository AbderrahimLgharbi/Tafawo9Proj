import { useState } from 'react'
import './App.css'
import Navbar from './components/Navbar'
import Banners from './components/Banners'
import Concours from './components/Concours'
import Search from './components/Search'
import PaginationButtons from './components/PaginationButtons'

function App() {

  return (
    <>
    <Navbar/>
    <Banners/>
    <Search/>
    <Concours/>
    <PaginationButtons/>

    </>
  )
}

export default App
