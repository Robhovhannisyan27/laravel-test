import React, { Component } from 'react';
import {Route, Link} from 'react-router-dom';
import axios from 'axios';
import '../css/Menu.css';
import AddCategories from './AddCategories';

class AllCategories extends Component {
  	constructor(props){
      super(props);
      this.state = {
        categories:  [],
        addCategory: ''
      }
      this.handleClick = this.handleClick.bind(this);
    }
    componentWillReceiveProps(nextProps){
      if(nextProps.addCategory !== this.props.addCategory){
        this.state.categories.push(nextProps.addCategory);
      }
      if(nextProps.editCategory !== this.props.editCategory){
        console.log(1);
        this.state.categories.map((val,index) => {
          if(val.id == nextProps.editCategory.id){
            val.category_title = nextProps.editCategory.category_title;
          }
        }) 
      }
      if(nextProps.deleteCategory !== this.props.deleteCategory){
        console.log(2);
        this.state.categories.map((val,index) => {
          if(val.id == nextProps.deleteCategory){
            this.state.categories.splice(index,1);
          }
        })
      }
    }
    componentWillMount(){
      axios.get('/api/categories').then((response) => {
          this.setState({ categories: Object.values(response.data)[0]});
        }).catch((err)=>{

      })

        
    }
    handleClick(){
      this.props.allCategories(this.state.categories);
    }
    
    render() {
        var handleClick = this.handleClick;
        return (
            <div  className="col-sm-2">
   
                <div className='categories'>
                    <h2>Categories</h2>
                    <div className="list-group cat_div">
                    {
                       this.state.categories.map(function(val, index){ 
                          return <Link to={'/categories/'+val.id} onClick={handleClick} className="list-group-item" key={val.id}>{val.category_title}</Link>;
                       })                      
                    }
                    </div>
                </div> 
                  
            </div>

          
	    );
  	}
}

export default AllCategories;
