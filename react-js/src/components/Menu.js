import React, { Component } from 'react';
import Links from './Links';
import Home from './Home';
import Dropdown from './Dropdown';
import axios from 'axios';

class Menu extends Component {
	constructor(props){
		super(props)
	}

	render() {
  	var userLogin;
  	if(sessionStorage.getItem('user_id')){
  		userLogin = <Dropdown name={sessionStorage.getItem('name')} />;
  	} else{
  		userLogin = <Links />
  	}
    return (
      <div>
        <Home />
    		{userLogin}
      </div> 
    );
  }
}

export default Menu;