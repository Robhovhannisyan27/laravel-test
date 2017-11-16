import React, { Component } from 'react';
import {Route, Link} from 'react-router-dom';
import axios from 'axios';
import './categories.css';
import AddCategories from './AddCategories';
import PropTypes from 'prop-types';

class Categories extends Component {
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
			let categories = this.state.categories;
			categories.push(nextProps.addCategory);
			this.setState({categories});
		}
		if(nextProps.editCategory !== this.props.editCategory){
			let categories = this.state.categories;
			categories.map((val,index) => {
				if(val.id == nextProps.editCategory.id){
					val.category_title = nextProps.editCategory.category_title;
				}
			})
			this.setState({categories}); 
		}
		if(nextProps.deleteCategory !== this.props.deleteCategory){
			let deleteCategories = this.state.categories;
			deleteCategories.map((val,index) => {
				if(val.id == nextProps.deleteCategory){
					let categories = this.state.categories;
					categories.splice(index,1);
					this.setState({categories});
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
		const handleClick = this.handleClick;
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

Categories.propTypes = {
	allCategories: PropTypes.func,
};

export default Categories;
