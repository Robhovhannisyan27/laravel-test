import React, { Component } from 'react';
import {Route, Link} from 'react-router-dom';
import axios from 'axios'
import './posts.css';
import AddPost from './AddPost';
import EditPostButton from '../modals/EditPostButton';
import PropTypes from 'prop-types';

class EditPost extends Component {
	constructor(props){
		super(props);
		this.state = {
			image: '',
			title: '',
			text: ''
		}
		this.changeTitle = this.changeTitle.bind(this);
		this.changeText = this.changeText.bind(this);
		this.handleClick = this.handleClick.bind(this);
		this.onFileChange = this.onFileChange.bind(this);
	}
	changeTitle(e){
		this.setState({'title': e.target.value});
	}
	changeText(e){
		this.setState({'text': e.target.value});
	}
	handleClick(){
		let data = new FormData();
		data.append('image', this.state.image.name);
		data.append('title', this.state.title);
		data.append('longtext', this.state.text);
		data.append('_method', 'PUT');
		axios.post('/api/me/posts/' + this.props.post_id, data).then((response) => {
			let data = response.data[0][0];
			this.setState({title: data.title, text: data.text, image: data.image});
			this.props.editPost(data.title,data.text,data.image);
			}).catch((err)=>{
				
		})
	}
		
	onFileChange(event) {
		this.setState({image: event.target.files[0]});
	}
	 
	
	render() {
		return (
			<div>
				<div className='addCategory' data-toggle="modal" data-target="#edit_post">
					<button type="button" className="edit_post_button btn btn-success">Edit Post</button>
				</div>

				<EditPostButton 
					changeTitle={this.changeTitle}
					title={this.state.title}
					changeText={this.changeText}
					text={this.state.text}
					onFileChange={this.onFileChange}
					handleClick={this.handleClick}
				/>
			</div>  
		);
	}
}

EditPost.propTypes = {
	post_id: PropTypes.string,
	editPost: PropTypes.func,
};

export default EditPost;