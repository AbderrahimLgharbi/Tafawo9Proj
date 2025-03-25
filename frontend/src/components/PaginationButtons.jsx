import React from 'react'
import ReactPaginate from 'react-paginate'
import logo from '../assets/con1.png'
import {BsChevronLeft,BsChevronRight} from 'react-icons/bs';
import {motion} from 'framer-motion';
import useDatafetcher from './useDatafetcher';


const PaginationButtons = () => {
  const {loading,pages,totalPages,currentPage,setCurrentPage}=useDatafetcher();

  const handlePageClick=({selected})=>{
      setCurrentPage(selected);
  }


  const paginationVariants={
    hidden:{
      opacity:0,
      y:100,
    },
    visible: {
      opacity:1,
      y:0,
      transition:{
        type:"spring",
        stiffness:260,
        damping:20,
        duration:2
      }
    }
  }

  const showNextButton = currentPage !== totalPages-1;
  const showPrevButton =currentPage!==0;


  return (

    <>

    {
      loading ? (
        <div className='text-center text-5xl'>Loading...</div>
      ):(
        <div className="grid sm:grid-cols-2 md:grid-cols-3 gap-4 max-w-[1000px] mx-auto flex flex-col justify-center w-full h-full">
          {
            pages.map((page,i)=>{
              return (
                <div key={i} className="card bg-base-100 bg-gray-900 md:w-70 shadow-sm">
                <figure className="px-10 pt-10">
                <img
                    src={logo}
                    alt="Shoes"
                    className="rounded-xl" />
                </figure>
                <div className="card-body items-center text-center">
                <h2 className="card-title">{page.counc_name}</h2>
                <p>{page.feedback}</p>
                <div className="card-actions">
                    <button className="btn btn-primary">click here</button>
                </div>
                </div>
            </div>
            )
         })

        }
        </div>
      )
    }
    
    <motion.div variants={paginationVariants} initial="hidden" animate="visible">
      <ReactPaginate
        breakLabel={<span className='mr-4'>...</span>}
        nextLabel={
          showNextButton ? (<span className='w-10 h-10 flex items-center justify-center bg-[#000] rounded-md'>
          <BsChevronRight/>
      </span>) :null
        }
        onPageChange={handlePageClick}
        pageRangeDisplayed={1}
        pageCount={2}
        previousLabel={
          showPrevButton ? (<span className='w-10 h-10 flex items-center justify-center bg-[#000] rounded-md'>
          <BsChevronLeft/>
        </span>) :null
         }
        containerClassName='flex items-center justify-center mt-8 mb-4'
        pageClassName='block border- border-solid border-[#000] hover:bg-[#000] w-10 h-10 flex items-center justify-center rounded-md mr-4'
        activeClassName='bg-[#0a0a] text-white'
        />
    </motion.div>
    </>



  )
}

export default PaginationButtons