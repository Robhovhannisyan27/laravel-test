import React, { Component } from 'react';
import {Route, Link} from 'react-router-dom';
import axios from 'axios';
import './categories.css';
import AddCategories from './AddCategories';
import EditCategories from './EditCategories';
import DeleteCategories from './DeleteCategories';
import AddPost from '../posts/AddPost';
import PropTypes from 'prop-types';

class MyCategories extends Component {
	constructor(props){
    super(props);
    this.state = {
      categories: []
    }
    this.addCategory = this.addCategory.bind(this);
    this.deleteCategory = this.deleteCategory.bind(this);
    this.changeCategoryName = this.changeCategoryName.bind(this);
  }
  componentWillMount(){
    axios.get('/api/user/' + sessionStorage.getItem('user_id') + '/categories').then((response) => {
      let categories = Object.values(response.data)[0];
       this.setState({ categories: categories})
       
      }).catch((err)=>{
        
    })
  }
  addCategory(category){
    this.state.categories.push(category);
    this.setState({ categories: this.state.categories});
    this.props.addCategory(category);
  }
  changeCategoryName(category){
    this.setState({'category': category});
    this.state.categories.map((val,index) => {
      if(val.id == category.id){
        val.category_title = category.category_title;
      }
    })
    this.componentWillMount();
    this.render();
    this.props.changeCategoryName(category);
  }
  deleteCategory(category){
    this.state.categories.map((val,index) => {
      if(val.id == category){
        this.state.categories.splice(index,1);
      }
    })
    this.componentWillMount();
    this.render();
    this.props.deleteCategory(category);
  }
  render() {
    const changeCategoryName = this.changeCategoryName;
    const deleteCategory = this.deleteCategory;
    return (
      <div>
        <div className="myCategories">
          <div>
              <h2>My Categories</h2>
              <div className="comp_div">
              {
                this.state.categories.map(function(val, index){ 
                    return (
                      <div key={index} className='div'>
                        <div className='cat_name'><Link to={'/categories/'+val.id}  className="list-group-item" >{val.category_title}</Link></div>
                        <EditCategories  key={val.id} id={val.id} changeCategoryName={changeCategoryName} />
                        <DeleteCategories  id={val.id} deleteCategory={deleteCategory} />
                      </div>
                      );
                })    
              }
              </div>
          </div> 
        </div>
        <AddPost categories={this.state.categories} />
        <AddCategories addCategory={this.addCategory}/>
      </div>
        
    );
	}
}

MyCategories.propTypes = {
  addCategory: PropTypes.func,
  changeCategoryName: PropTypes.func,
  deleteCategory: PropTypes.func
};

export default MyCategories;
