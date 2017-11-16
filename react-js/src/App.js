import React, { Component } from 'react';
import './App.css';
import {Route} from 'react-router-dom';
import Menu from './components/menu/Menu';
import Login from './components/auth/Login';
import Register from './components/auth/Register';
import Categories from './components/categories/Categories';
import MyCategories from './components/categories/MyCategories';
import AddCategories from './components/categories/AddCategories';
import MyPosts from './components/posts/MyPosts';
import CategoryPost from './components/categories/CategoryPost';
import Post from './components/posts/Post';


class App extends Component {
    constructor(props){
        super(props);
        this.state = {
            userLogin: false,
            name: '',
            category: '',
            editCategoryName: '',
            deleteCategory: '',
            allCategories: []
        }
        this.userLogin = this.userLogin.bind(this);
        this.userRegister = this.userRegister.bind(this);
        this.addCategory = this.addCategory.bind(this);
        this.changeCategoryName = this.changeCategoryName.bind(this);
        this.deleteCategory = this.deleteCategory.bind(this);
        this.allCategories = this.allCategories.bind(this);
    }
    userLogin(user){
        this.setState({ name: user });
    }
    userRegister(user){
        this.setState({ name: user });
    }
    addCategory(category){
        this.setState({ category: category});
    }
    changeCategoryName(category){
        this.setState({ editCategoryName: category});
    }
    deleteCategory(category){
        this.setState({ deleteCategory: category});
    }
    allCategories(allCategories){
        this.setState({ allCategories });
    }
    render() {
        let userName;
        if(sessionStorage.getItem('user_id')){
            userName = (
                <Categories 
                    addCategory= {this.state.category} 
                    editCategory={this.state.editCategoryName} 
                    deleteCategory={this.state.deleteCategory} 
                    allCategories={this.allCategories} 
                >
                </Categories>
            );
        }
        return(
            <div id="app">
                <nav className="navbar navbar-default navbar-static-top">
                    <div className="container">
                        <div className="collapse navbar-collapse" id="app-navbar-collapse">
                            <ul className="nav navbar-nav">
                                &nbsp;
                            </ul>
                            <Menu name={this.state.name} />
                        </div>
                    </div>
                </nav>
            <div>
                {userName}
                <Route exact path="/login"  render={() => <Login userLogin={this.userLogin} /> }/>
                <Route path="/register" render={() => <Register userRegister={this.userRegister} /> } />
                <Route path='/my-categories' render={()=> <MyCategories addCategory={this.addCategory} changeCategoryName={this.changeCategoryName} deleteCategory={this.deleteCategory} />} />
                <Route path='/my-posts' render={()=> <MyPosts />} />
                <Route path={'/categories/:id'} component={CategoryPost} />
                <Route path={'/posts/:post_id'} component={Post} />
            </div>
        </div>
        );
    }
}

export default App;
