import React, { Component } from 'react';
import axios from 'axios';
import './categories.css';
import DeleteCategoryButton from '../modals/DeleteCategoryButton';
import PropTypes from 'prop-types';

class DeleteCategories extends Component {
    constructor(props){
        super(props);
        this.state = {
            name: '',
        }
        this.deleteCategory = this.deleteCategory.bind(this);
        this.openDeleteCategoriesModal = this.openDeleteCategoriesModal.bind(this);
        this.modal_id = `delete_category${this.props.id}`;
    }
    changeName(e){
        this.setState({ name: e.target.value });
    }
    openDeleteCategoriesModal(){
        $(`#${this.modal_id}`).modal();
    }
    deleteCategory(){
        axios.delete('/api/me/categories/' + this.props.id).then((response) => {
            this.props.deleteCategory(this.props.id);
            }).catch((err)=>{
                
        })
    }
    render() {
        return (
            <div className='cat_delete'>         
                <div data-toggle="modal">   
                    <button type="button" onClick={this.openDeleteCategoriesModal} className=" delete_button btn btn-success">Delete Category</button>
                </div>       
                <DeleteCategoryButton modal_id={this.modal_id} deleteCategory={this.deleteCategory} />
            </div>          
        );
    }
}

DeleteCategories.propTypes = {
    deleteCategory: PropTypes.func,
    id: PropTypes.number
};

export default DeleteCategories;
