import React, { Component } from 'react';
import Links from './Links';
import Home from './Home';
import Dropdown from './Dropdown';

class Menu extends Component {

    render() {
        let is_user_logged_in;
        if(sessionStorage.getItem('user_id')){
            is_user_logged_in = <Dropdown name={sessionStorage.getItem('name')} />;
        } else{
            is_user_logged_in = <Links />
        }
        return (
            <div>
                <Home />
                {is_user_logged_in}
            </div> 
        );
    }
}

export default Menu;
