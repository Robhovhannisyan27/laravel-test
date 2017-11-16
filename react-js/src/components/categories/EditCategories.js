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
            category_name: ''
        }
        this.handleUpdate = this.handleUpdate.bind(this);
        this.openEditCategoriesModal = this.openEditCategoriesModal.bind(this);
        this.getName = this.getName.bind(this);
        this.modal_id = `edit${this.props.id}`;
    }
    getName(e){
        this.setState({ name: e.target.value });
    }
    openEditCategoriesModal(){
        $(`#${this.modal_id}`).modal();
    }
    handleUpdate(){
        if(this.state.name != ''){
            axios.put('/api/me/categories/' + this.props.id,{'category_title':this.state.name}).then((response) => {
                this.setState({'category_name':response.data[0][0]});
                this.props.changeCategoryName(this.state.category_name);
            }).catch((err)=>{
                
            })
        
        } 
        this.setState({'name': ''})
    }
        
    render() {
        return (
            <div className='cat_edit'>      
                <div className="col-sm-2" data-toggle="modal">
                    <button type="button" onClick={this.openEditCategoriesModal} className="edit_button btn btn-success">Edit Category</button>
                </div>
                <EditCategoryButton 
                    modal_id={this.modal_id}
                    body_id={this.props.id} 
                    getName={this.getName} 
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
