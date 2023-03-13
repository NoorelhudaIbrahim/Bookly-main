import React, { useEffect, useState } from 'react';
import axios from 'axios';

function BookList() {
  const [books, setBooks] = useState([]);
  useEffect(() => {
    axios.get('http://localhostBookly-main/backend/books.php')
      .then((response) => {
        console.log(response.data);
        setBooks(response.data);
      })
      .catch((error) => {
        console.error(error);
        // Handle error
      });
  }, []);

  function handleDelete(bookId) {
    axios.delete('http://localhostBookly-main/backend/books.php', {
      data: { id: bookId }
    })
      .then((response) => {
        console.log(response.data);
        // Do something after successful delete
      })
      .catch((error) => {
        console.error(error);
        // Handle error
      });
  }

  return (
    <ul>
      {books.map((book) => (
        <li key={book.id}>
          <h3>{book.title}</h3>
          <p>{book.author}</p>
          <p>{book.description}</p>
          <img src={book.cover_image} alt={book.title} />
          <p>User ID: {book.user_id}</p>
          <button onClick={() => handleDelete(book.id)}>Delete</button>
        </li>
      ))}
    </ul>
  );
}

export default BookList;
