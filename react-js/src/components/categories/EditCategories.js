import React, { Component } from 'react';
import {Route, Link} from 'react-router-dom';
import axios from 'axios';
import './categories.css';
import EditCategoryButton from '../modals/EditCategoryButton';
import PropTypes from 'prop-types';

class EditCategories extends Component {
  constructor(props){
    super(props);
    this.state = {
      name: '',
      cat_id: '',
      cat_name: ''
    }
    this.handleUpdate = this.handleUpdate.bind(this);
    this.editClick = this.editClick.bind(this);
    this.changeName = this.changeName.bind(this);
    this.modal_id = `edit${this.props.id}`;
  }
  changeName(e){
    this.setState({ name: e.target.value });
  }
  editClick(){
      $(`#${this.modal_id}`).modal();
  }
  handleUpdate(){
  	if(this.state.name != ''){
    	axios.put('/api/user/' + sessionStorage.getItem('user_id') + '/categories/' + this.props.id,{'category_title':this.state.name}).then((response) => {
        this.setState({'cat_name':response.data[0][0]});
        this.render();
        this.props.changeCategoryName(this.state.cat_name);
      }).catch((err)=>{
        
    	})
  	
    } 
    this.setState({'name': ''})
  }
    
    render() {
      return (
        <div className='cat_edit'>      
          <div className="col-sm-2" data-toggle="modal">
            <button type="button" onClick={this.editClick} className="edit_button btn btn-success">Edit Category</button>
          </div>
          <EditCategoryButton 
            modal_id={this.modal_id}
            body_id={this.props.id} 
            changeName={this.changeName} 
            name={this.state.name} 
            handleUpdate={this.handleUpdate} 
          />
        </div>          
      );
    }
}

EditCategories.propTypes = {
  changeCategoryName: PropTypes.func,
  id: PropTypes.number,
};

export default EditCategories;
