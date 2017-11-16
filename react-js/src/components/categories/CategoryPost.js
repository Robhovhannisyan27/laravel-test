import React, { Component } from 'react';
import {Route, Link} from 'react-router-dom';
import axios from 'axios';
import './categories.css';
import AddPost from '../posts/AddPost';

class CategoryPost extends Component {
    constructor(props){
        super(props);
        this.state = {
            posts: []
        }
        this.addPost = this.addPost.bind(this);
        this.categoryPosts = this.categoryPosts.bind(this);
    }
    componentWillReceiveProps(nextProps){
        if(nextProps.match.params.id !== this.props.match.params.id)
        {
            this.categoryPosts(nextProps.match.params.id);
        }
    }
    categoryPosts(id){
        axios.get('/api/categories/' + id + '/posts').then((response) => {
            this.setState({ posts: response.data[0].data})
            }).catch((err)=>{
                    
        })
    }
    addPost(post){
        let posts = this.state.posts;
        posts.unshift(post);
        this.setState({ posts });
    }
    componentDidMount(){
        this.categoryPosts(this.props.match.params.id);
    }

    render() {
        return (
            <div>
                <div className='col-sm-8 postsList'>
                {
                    this.state.posts.map((val, index) => {
                        return (
                            <div className='' key={val.id}>
                                <Link to={'/posts/' + val.id}>
                                    <div className="post col-sm-3">
                                        <div className="post_image"><img src={'../../image/' + val.image} /></div>
                                        <div className="post_title">{val.title}</div>
                                        <div className="post_text"><p>{val.text}</p></div>
                                    </div>
                                </Link>
                            </div>    
                        );
                    })
                }
                </div>
                <AddPost addPost={this.addPost} />
            </div>  
        );
    }
}

export default CategoryPost;
