import React, { Component } from 'react';
import {Route, Link} from 'react-router-dom';
import axios from 'axios'
import './posts.css';
import AddPost from './AddPost';


class MyPosts extends Component {
  	constructor(props){
      super(props);
      this.state = {
        posts: []
      }
      this.addPost = this.addPost.bind(this);
    }
    componentWillMount(){
      axios.get('/api/user/' + sessionStorage.getItem('user_id') + '/posts').then((response) => {
        let posts = Object.values(response.data[1].data);
        this.setState({ posts: posts});
        }).catch((err)=>{

      })
    }
    addPost(post){
      this.state.posts.unshift(post);
      this.setState({ posts: this.state.posts});
      this.render();
    }
    render() {
	    return (
        <div>
          <div className="col-sm-8 row posts" id='addPosts'>
            {
              this.state.posts.map(function(val, index){ 
                  return (
                    <div key={val.id}>
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

export default MyPosts;
