import axios from 'axios'
import React, { useEffect, useState } from 'react'


const useDatafetcher = () => {
    const API_URL = "http://127.0.0.1:8000/api/concours/index?page=1";
    const totalPages=200;

    const [loading,setLoading]=useState(true);
    const [pages,setPages]=useState([]);
    const [currentPage,setCurrentPage]=useState(0);

    useEffect(()=>{
        const fetchData=async ()=>{
            const page =Math.min(currentPage+1,totalPages);
            const result = await axios.get(`${API_URL}&page=${page}`)
            setPages(result.data);
            setLoading(false);
        }
        fetchData();
    },[currentPage]);

  return {
    loading,
    pages:pages.data,totalPages,
    currentPage,
    setCurrentPage
  }
}

export default useDatafetcher