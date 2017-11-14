import React, { Component } from 'react';
import {Route, Link} from 'react-router-dom';
import axios from 'axios';
import './categories.css';
import AddPost from '../posts/AddPost';

class CategoryPost extends Component {
	constructor(props){
    super(props);
    this.state = {
      category_id: this.props.match.params.id,
      posts: []
    }
    this.addPost = this.addPost.bind(this);
  }
  componentWillReceiveProps(nextProps){
    if(nextProps.match.params.id !== this.props.match.params.id)
    {
      this.state.category_id =  nextProps.match.params.id;
    }
    this.componentWillMount();
  }
  addPost(post){
    this.state.posts.unshift(post);
    this.setState({ posts: this.state.posts});
    this.render();
  }
  componentWillMount(){
    axios.get('/api/categories/' + this.state.category_id + '/posts').then((response) => {
      this.setState({ posts: response.data[0].data})
      }).catch((err)=>{
        
    })
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
