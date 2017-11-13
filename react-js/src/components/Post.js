import React, { Component } from 'react';
import {Route, Link} from 'react-router-dom';
import axios from 'axios'
import '../css/Menu.css';
import AddPost from './AddPost';
import EditPost from './EditPost';
import DeletePost from './DeletePost';


class Post extends Component {
	constructor(props){
    super(props);
    this.state = {
      posts: [],
      post_id: this.props.match.params.post_id,
      post: '',
      image: '',
      title: '',
      text: '',
      user_id: ''
    }
    this.editPost = this.editPost.bind(this);
  }
  componentWillReceiveProps(nextProps){
  	console.log(nextProps.match.params.post_id)
    if(nextProps.match.params.post_id !== this.props.match.params.post_id)
    {
      this.state.post_id =  nextProps.match.params.post_id;
    }
    this.componentWillMount();
  }

  componentWillMount(){
  	axios.get('/api/posts/' + this.state.post_id).then((response) => {
    	var data = response.data.post[0];
    	this.setState({ image: data.image, title: data.title, text: data.longtext, user_id: data.user_id});
    	}).catch((err)=>{
        console.log(err);
  	})
  }
  editPost(title,text,image){
  	this.setState({'title': title, 'text': text, 'image': image});
  	this.render();
  }
    render() {
    	var myPosts;
    	if(this.state.user_id == sessionStorage.getItem('user_id')){
    		myPosts = (
    			<div>
	    			<EditPost post_id={this.state.post_id} editPost={this.editPost} />
	          		<DeletePost post_id={this.state.post_id} />
          		</div>
    		);
    	}
	    return (
        <div>
        	<div className="col-sm-8">
	            <div className="large_post_image"><img src={'/image/' + this.state.image } /></div>
	            <div className="large_post_title">{this.state.title}</div>
	            <div className="large_post_text"><p>{this.state.text}</p></div>	
          	</div>
          	{myPosts}
        </div>  
	    );
  	}
}

export default Post;