import React, { Component } from 'react';
import {Route, Link, Redirect} from 'react-router-dom';
import axios from 'axios'
import './posts.css';
import DeletePostButton from '../modals/DeletePostButton'

class DeletePost extends Component {
    constructor(props){
        super(props);
        this.state = {
            delete: false
        }
        this.deletePost = this.deletePost.bind(this);
    }
        
    deletePost(){
        axios.delete('/api/me/posts/' + this.props.post_id).then((response) => {
            this.setState({ delete: true });
            }).catch((err)=>{

        })
    }
        
    render() {
        let go_to_posts;
        if(this.state.delete){
            go_to_posts = <Redirect to='/my-posts' />;
        }
        return (
            <div>
                {go_to_posts}
                <div className='deletePost' data-toggle="modal" data-target="#delete_post" >
                    <button type="button" className="delete_post_button btn btn-success">Delete Post</button>
                </div>
                <DeletePostButton deletePost={this.deletePost} />    
            </div>  
        );
    }
}

export default DeletePost;
