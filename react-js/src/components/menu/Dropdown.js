import React, { Component } from 'react';
import {HashRouter, Route, Link} from 'react-router-dom';
import Login from '../auth/Login';
import Register from '../auth/Register';
import axios from 'axios';


class Drowdown extends Component {
    logOut(){
        sessionStorage.clear();
        axios.get('/api/logout' ).then((response) => {
            }).catch((err)=>{
        })
    }
    render() {
        return (
            <div>
                <ul className="nav navbar-nav navbar-right">
                    <li className="dropdown">
                        <a href="#" className="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                            {this.props.name} <span className="caret"></span>
                        </a>

                        <ul className="dropdown-menu" role="menu">
                            <li>
                                <Link to="/my-categories">My Categories</Link>
                                <Link to='/my-posts/'>My Posts</Link>
                                <Link to="/login" onClick={this.logOut}>Logout</Link>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>  
        );
        }
}
export default Drowdown;






