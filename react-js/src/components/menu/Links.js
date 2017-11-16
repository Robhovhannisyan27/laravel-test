import React, { Component } from 'react';
import {HashRouter, Route, Link} from 'react-router-dom';
import Login from '../auth/Login';
import Register from '../auth/Register';



class Links extends Component {
    render() {
        return (
            <div>
                <ul className="nav navbar-nav navbar-right">
                    <li>
                        <Link to="/login">Login</Link>
                    </li>
                    <li>
                        <Link to="/register">Register</Link>
                    </li>
                </ul>
            </div>  
        );
    }
}

export default Links;