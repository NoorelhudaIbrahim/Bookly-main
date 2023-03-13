import Signup from './Register';
import Login from "./Login";
import CreateBook from "./pages/AddBook/AddBookForm";

import { Provider } from 'react-redux';
import store from './store';
import React from 'react'
import './App.css'
// import Footer from './components/Footer/Footer'
import Header from './components/Header/Header'
import ProfilePicture from './components/ProfilePicture/ProfilePicture'
import Home from './pages/Home/Home'
import MyProfile from './pages/MyProfile/MyProfile'

import {Routes,BrowserRouter, Route,Link} from "react-router-dom";
// import Users from "./users";



function App() {
  return (
    <BrowserRouter>
    <>
    <Provider store={store}>
<Header />
      <Routes>
        <Route path="/profile" element={<MyProfile />}/>
        <Route path="/login" element={<Login />}/>
        <Route path="/register" element={<Signup />}/>
        <Route path="/AddBookForm" element={<CreateBook />}/>

        {/* <Route path="/user" element={<Users />}/> */}
        <Route path="/home" element={<Home/>}></Route>
        </Routes>
        </Provider>
        </>

    </BrowserRouter>
  );
}

export default App;
