import React, { Component } from 'react';
import {Route, Switch} from 'react-router-dom';
import Menu from './Menu';
import Login from './Login';
import Home from './Home';
import Register from './Register';


class Routing extends Component {
  userLogin(){
  	this.po
  }
  render() {
    return (
    	<Switch>
    		<Route exact path="/login"  render={() => <Login /> }/>
    		<Route path="/register" component={Register} />
    	</Switch>
    );
  }
}

export default Routing;

