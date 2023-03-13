

import React, { useState, useEffect } from "react";
// import { Container } from 'react-bootstrap';
import axios from 'axios';
// import { useNavigate } from 'react-router-dom';
import Header from '../../components/Header/Header';
import Footer from '../../components/Footer/Footer';
import './Home.css';
import './Slider.css';
import './SliderThem.css';

export default function Home() {
  const [books, setBooks] = useState([]);
  // const navigate = useNavigate();

  useEffect(() => {
    getBooks();
  }, []);
 
  function getBooks() {
    axios.get(`http://localhost/Bookly-main/backend/books.php`)
      .then((response) => {
        setBooks(response.data);
        // console.log(books,'books');
      })
      .catch((error) => {
        console.log(error);
      });
  }
  
  return (
    <>
      <Header />
      <div className="home-container">
        <div className="home-content">
          <h1 className="home-heading ">Find Your Next Favorite Books?</h1>
          <p className="home-description ">
            You are in the right place. Tell us what titles or genres you have enjoyed
            in the past, and we will give you surprisingly insightful recommendations.
          </p>
        </div>
        <div className="top-rated-books-container ">
          <div className="top-rated-books-header-container">
            <h1 className="top-rated-books-heading "> All Books</h1>
            <a href="/AddBookForm">
              <button type="button" className="find-books-desktop-btn botn">
                Add Books
              </button>
            </a>
          </div>
          <div className="slick-container">
            <div className="slick-slider slick-initialized" dir="ltr">
              <button
                type="button"
                data-role="none"
                className="slick-arrow slick-prev"
                style={{ display: "block", backgroundColor: "black" }}
              >
                {" "}
                Previous
              </button>
              <div className="slick-list">
                <div
                  className="slick-track"
                  style={{
                    width: 2360,
                    opacity: 1,
                    transform: "translate3d(-708px, 0px, 0px)"
                  }}
                >
                  {books.map((item, index) => (
                    <div key={index}>
                      <div
                        data-index={0}
                        className="slick-slide"
                        tabIndex={-1}
                        aria-hidden="true"
                        style={{ outline: "none", width: 236 }}
                      >
                        <div>
                          <a
                            className="slider-nav-link"
                            tabIndex={-1}
                            href="/home"
                            style={{ width: "100%", display: "inline-block" }}
                          >
                            <div className="slick-item">
                              <img
                                // src={require(`../../images/${item.cover_image}`)}
                                className="cover-pic"
                                alt="book cover"
                              />
                              <h1 className="book-title ">{item.title}</h1>
                              <p className="book-author-name ">{item.author}</p>
                              <p className="book-author-name ">{item.description}</p>
                            </div>
                          </a>
                        </div>
                      </div>
                    </div>
                  ))}
                </div>
              </div>
              <button
                type="button"
                data-role="none"
                className="slick-arrow slick-next"
                style={{ display: "block", backgroundColor: "black" }}
              >
                {" "}
                Next
              </button>
            </div>
          </div>
          <Footer />
        </div>
      </div>
    </>
  );
}