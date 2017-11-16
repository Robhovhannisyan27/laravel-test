import React, { Component } from 'react';
import {Route, Link} from 'react-router-dom';
import axios from 'axios';
import './posts.css';
import AddPostButton from '../modals/AddPostButton';
import PropTypes from 'prop-types';

class AddPost extends Component {
    constructor(props){
        super(props);
        this.state = {
            categories: [],
            new_post_title: '',
            new_post_text: '',
            select_categories: '',
            image: '',
            success: ''
        }
        this.handleUpdate = this.handleUpdate.bind(this);
        this.getPostTitle = this.getPostTitle.bind(this);
        this.getPostText = this.getPostText.bind(this);
        this.changeSelect = this.changeSelect.bind(this);
        this.onFileChange = this.onFileChange.bind(this);
    }
    handleUpdate(){
        let data = new FormData();
        data.append('image', this.state.image);
        data.append('title', this.state.new_post_title);
        data.append('longtext', this.state.new_post_text);
        data.append('category_id', this.state.select_categories);
            
        axios.post('/api/me/posts', data).then((response) => {
            this.props.addPost(response.data.post);    
            }).catch((err)=>{

        })
    }
    getPostTitle(e){
        this.setState({'new_post_title': e.target.value});
    }
    getPostText(e){
        this.setState({'new_post_text': e.target.value});
    }
    changeSelect(e){
        this.setState({'select_categories': e.target.value});
    }
    componentWillMount(){
        axios.get('/api/me/categories').then((response) => {
            let categories = Object.values(response.data)[0];
            if(this.props.categories){
                this.setState({ categories: this.props.categories});
            } else{    
                this.setState({ categories: categories});
            }
                
            }).catch((err)=>{
                this.setState({error: Object.values(err.response.data.errors)[0], success: ''});
        })
    }

    onFileChange(event) {
        this.setState({image: event.target.files[0]});
    }

    render() {
        return (
            <div>
                <div className='modal_div' data-toggle="modal" data-target="#addPost">
                    <button type="button"  className="btn btn-success">Add Post</button>
                </div>
                <AddPostButton 
                    getPostTitle={this.getPostTitle}
                    getPostText={this.getPostText}
                    new_post_text={this.state.new_post_text}
                    onFileChange = {this.onFileChange}
                    changeSelect = {this.changeSelect}
                    select_categories = {this.state.select_categories}
                    categories={this.state.categories}
                    handleUpdate={this.handleUpdate}
                />
            </div>
        );
    }
}

AddPost.propTypes = {
    categories: PropTypes.array,
    addPost: PropTypes.func,
};

export default AddPost;


