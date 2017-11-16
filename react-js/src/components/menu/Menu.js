import React, { Component } from 'react';
import Links from './Links';
import Home from './Home';
import Dropdown from './Dropdown';

class Menu extends Component {

	render() {
		let userLogin;
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
