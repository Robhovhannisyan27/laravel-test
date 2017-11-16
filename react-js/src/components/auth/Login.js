import React, { Component } from 'react';
import axios from 'axios';
import {Redirect} from 'react-router';
import {HashRouter as Router, Route, Link} from 'react-router-dom';
import Home from '../menu/Home';
import PropTypes from 'prop-types';

class Login extends Component {
    constructor(props){
        super(props);
        this.state = {
            email: '',
            password: '',
            error: '',
            id: null,
            user: '',
            name: ''
        }
        this.changeEmail = this.changeEmail.bind(this);
        this.doLogin = this.doLogin.bind(this);
        this.changePassword = this.changePassword.bind(this);
    }
        

    doLogin(event){
        event.preventDefault();
        if(this.state.email == ''){
            this.setState({ error: 'Email filed is required'})
            return false;
        } else if(this.state.password == ''){
            this.setState({ error: 'Password filed is required'})
            return false;
        } 
        axios.post('/api/login', {email: this.state.email, password: this.state.password}).then((response) => {
            this.setState({ id:response.data.user.id, name:sessionStorage.getItem('name'), error: ''});
            sessionStorage.setItem('user_id', this.state.id);
            sessionStorage.setItem('name', response.data.user.name);
            this.props.userLogin(this.state.id);
        }).catch((err) => {
            this.setState({ error: 'Incorect Login or Password'});
        })
        return false;  
    }
     
    changeEmail(e){
        this.setState({email: e.target.value});
    }

    changePassword(e){
        this.setState({password: e.target.value});
    }

    render() {
        let main;
        if(this.state.id){
            main = <Redirect to='/' />;
        }
    return (
        <div className="container">
            <div className="row">
                <div className="col-md-8 col-md-offset-2">
                    <div className="panel panel-default">
                        <div className="panel-heading">Login</div>

                            <div className="panel-body">
                                <form className="form-horizontal" role='form'>
                                    <div id='error'>{this.state.error}</div>
                                    <div className="form-group">
                                        <label htmlFor="email" className="col-md-4 control-label">E-Mail Address</label>

                                        <div className="col-md-6">
                                            <input id="email" type="email" className="form-control" name="email" onChange={this.changeEmail} value={this.state.email} required autoFocus />
                                        </div>
                                    </div>

                                    <div className="form-group">
                                        <label htmlFor="password" className="col-md-4 control-label">Password</label>

                                        <div className="col-md-6">
                                            <input id="password" type="password" className="form-control" onChange={this.changePassword} value={this.state.password} name="password" required />
                                        </div>
                                    </div>

                                    <div className="form-group">
                                        <div className="col-md-6 col-md-offset-4">
                                            <div className="checkbox">
                                                <label>
                                                    <input type="checkbox" name="remember" /> Remember Me
                                                </label>
                                            </div>
                                        </div>
                                    </div>

                                    <div className="form-group">
                                        <div className="col-md-8 col-md-offset-4">
                                            <button type="submit" className="btn btn-primary" onClick={this.doLogin}>
                                                Login
                                                <div>
                                                    {main}
                                                </div>    
                                            </button>
                                            <a className="btn btn-link" href="#">
                                                Forgot Your Password?
                                            </a>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        );
    }  
}

Login.propTypes = {
    userLogin: PropTypes.func,
};

export default Login;


