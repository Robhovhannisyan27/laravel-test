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
            updated_post_title: '',
            updated_post_text: ''
        }
        this.getUpdatedPostTitle = this.getUpdatedPostTitle.bind(this);
        this.getUpdatedPostText = this.getUpdatedPostText.bind(this);
        this.updatePost = this.updatePost.bind(this);
        this.onFileChange = this.onFileChange.bind(this);
    }
    getUpdatedPostTitle(e){
        this.setState({'updated_post_title': e.target.value});
    }
    getUpdatedPostText(e){
        this.setState({'updated_post_text': e.target.value});
    }
    updatePost(){
        let data = new FormData();
        data.append('image', this.state.image.name);
        data.append('title', this.state.updated_post_title);
        data.append('longtext', this.state.updated_post_text);
        data.append('_method', 'PUT');
        axios.post('/api/me/posts/' + this.props.post_id, data).then((response) => {
            let data = response.data[0][0];
            this.setState({updated_post_title: data.title, updated_post_text: data.text, image: data.image});
            this.props.updatePost(data.title,data.text,data.image);
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
                    getUpdatedPostTitle={this.getUpdatedPostTitle}
                    updated_post_title={this.state.updated_post_title}
                    getUpdatedPostText={this.getUpdatedPostText}
                    updated_post_text={this.state.updated_post_text}
                    onFileChange={this.onFileChange}
                    updatePost={this.updatePost}
                />
            </div>  
        );
    }
}

EditPost.propTypes = {
    post_id: PropTypes.string,
};

export default EditPost;