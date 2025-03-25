import axios from 'axios';
import React, { useEffect, useState } from 'react'
import { FaSearch } from "react-icons/fa";
const Search = () => {

    const [domaines,setDomaines]=useState([]);
    const [administrations,setAdministrations]=useState([]);
    const [grades,setGrades]=useState([]);

    useEffect(() => {
        const getData = async () => {
            await axios.get("http://127.0.0.1:8000/api/domaine/getAll")
            .then((response) => {
                setDomaines(response.data);
            })
            .catch((err) => {
                setError(err.message);
            });

        };
        getData();

    }, []);

    useEffect(() => {

        const getData = async () => {
            await axios.get("http://127.0.0.1:8000/api/administration/getAll")
            .then((response) => {
                setAdministrations(response.data);
            })
            .catch((err) => {
                setError(err.message);
            });

        };
        
        getData();

        

     

    }, []);


    useEffect(() => {
        
        const getData = async () => {
            await axios.get("http://127.0.0.1:8000/api/grade/getAll")
            .then((response) => {
                setGrades(response.data);
            })
            .catch((err) => {
                setError(err.message);
            });

        };
        
        getData();
    }, []);

  
    const handleSubmit = (e)=>{
        e.preventDefault();
    }



  return (
    <>

    <form action="" onSubmit={handleSubmit} className='max-w-[1000px] bg-[#fff1] rounded-xl mx-auto px-10 h-[125px]'>
        <h1 className='flex justify-center py-2 md:text-3xl text-2xl'>Trouver un Concour par filter</h1>
        <div className='flex justify-around items-center '>
        <div>
        <select defaultValue="Filiere" className="select select-pink-600 md:w-64 w-full">
        <option disabled={true}>Filiere</option>
            {domaines.map((domaine,i)=>
                <option key={i} value={domaine.id}>{domaine.domain_name}</option>
            )
            }

        </select>
        </div>

        <div>
            <select defaultValue="Grade" className="select select-pink-600 md:w-64 w-full">
                <option disabled={true}>Grade</option>
                {grades.map((grade,i)=>
                <option key={i} value={grade.id}>{grade.grade_name}</option>
            )
            }
            </select>   
        </div>

        <div>
        <select defaultValue="Administration" className="select select-pink-600 md:w-64 w-full">
            <option disabled={true}>Administration</option>
            {administrations.map((administration,i)=>
                <option key={i} value={administration.id}>{administration.administration_name}</option>
            )
            }
        </select>
        </div>

        <div className="indicator">
            {/* <span className="indicator-item badge badge-secondary"></span> */}
            <button type='submit' className="btn join-item rounded-full"><FaSearch/></button>
        </div>
        </div>
        
    </form>


    </>

        )
}

export default Search