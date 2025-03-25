import React, { useState } from 'react';
import logo from '../assets/logo.png';
import {AiOutlineClose,AiOutlineMenu} from 'react-icons/ai'


const Navbar = () => {
  const [nav,setNav] =useState(true);
  const handleNav=()=>{
    setNav(!nav);
  }

  return (
    <div className='flex justify-between items-center h-24 max-w-[1240px] mx-auto px-4'>
      <img src={logo} alt="logo" className='w-[160px]' /> {/* Adjust width and height as needed */}

      <ul className='hidden md:flex'>
        <li className='p-4 hover:text-gray-400'>Blogs</li>
        <li className='p-4 hover:text-gray-400'>Home</li>
        <li className='p-4 hover:text-gray-400'>About</li>
        <li className='p-4 hover:text-gray-400'>Contact Us</li>
      </ul>
      <div onClick={handleNav} className='block md:hidden'>
        {!nav ? <AiOutlineClose size={20}/> :<AiOutlineMenu size={20}/>}
      </div>
      <div className={!nav ? 'fixed left-0 top-0 bg-[#fff] z-10 w-[60%] h-full border-r border-r-[#01497c] border-r-[2px] ease-in-out duration-500':'fixed left-[-100%]'}>
        <ul className='px-4 py-24 uppercase'>
          <li className='p-4 border-b border-[#212529] text-4 hover:text-[#468faf]'>Blogs</li>
          <li className='p-4 border-b border-[#212529] text-4 hover:text-[#468faf]'>Home</li>
          <li className='p-4 border-b border-[#212529] text-4 hover:text-[#468faf]'>About</li>
          <li className='p-4 text-4 hover:text-[#468faf]'>Contact Us</li>
        </ul>
      </div>
    </div>
  );
};

export default Navbar;