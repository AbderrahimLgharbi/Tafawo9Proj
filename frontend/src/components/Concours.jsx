import React, { useEffect, useState } from 'react'
import axios from 'axios';
import logo from '../assets/con1.png'


const Concours = ({counc_name,feedback}) => {


    // console.log(data);

  return (
    <div name="concours" className="w-full text-gray-300 bg-[#1d232a]">
        <div className="max-w-[1000px] mx-auto flex flex-col justify-center w-full h-full">
        <div className="pb-8">
            <p className="text-4xl font-bold inline border-b-4 text-gray-300 border-pink-600">
            Concours
            </p>
        </div>

        {/* <div className="card bg-base-100 bg-gray-900 md:w-70 shadow-sm">
                        <figure className="px-10 pt-10">
                        <img
                            src={logo}
                        alt="Shoes"
                        className="rounded-xl" />
            </figure>
                <div className="card-body items-center text-center">
                    <h2 className="card-title">{counc_name}</h2>
                    <p>{feedback}</p>
                    <div className="card-actions">
                        <button className="btn btn-primary">click here</button>
                    </div>
                </div>
        </div> */}

        </div>
    </div>
  )
}

export default Concours