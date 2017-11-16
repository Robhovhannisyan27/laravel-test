import React, { Component } from 'react';
import {Route, Link} from 'react-router-dom';
import axios from 'axios';
import './categories.css';
import AddCategoryButton from '../modals/AddCategoryButton';
import PropTypes from 'prop-types';

class AddCategories extends Component {
    constructor(props){
        super(props);
        this.state = {
            name: '',
            category: ''
        }
        this.changeName = this.changeName.bind(this);
        this.handleClick = this.handleClick.bind(this);
    }

    changeName(e){
        this.setState({ name: e.target.value });
    }
    handleClick(){
        axios.post('/api/me/categories', {'category_title': this.state.name}).then((response) => {
            this.setState({'category': response.data.category});
            this.props.addCategory(this.state.category);
             }).catch((err)=>{

            })
        }
    render() {
        return (
            <div>
                <div className='row'>
                    <div className=' addCategory' data-toggle="modal" data-target="#myModal">
                        <button type="button" className="btn btn-success">Add Category</button>
                    </div>
                </div>    
                <AddCategoryButton 
                    changeName={this.changeName} 
                    handleClick={this.handleClick} 
                    name={this.state.name}
                />
            </div>          
        );
    }
}

AddCategories.propTypes = {
    addCategory: PropTypes.func,
}

export default AddCategories;
