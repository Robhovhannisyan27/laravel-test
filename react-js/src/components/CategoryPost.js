import React, { Component } from 'react';
import {Route, Link} from 'react-router-dom';
import axios from 'axios';
import '../css/Menu.css';
import AddPost from './AddPost';



class CategoryPost extends Component {
  	constructor(props){
      super(props);
      this.state = {
        category_id: this.props.match.params.id,
        posts: []
      }
      this.addPostCategory = this.addPostCategory.bind(this);
    }
    componentWillReceiveProps(nextProps){
      if(nextProps.match.params.id !== this.props.match.params.id)
      {
        this.state.category_id =  nextProps.match.params.id;
      }
      this.componentWillMount();
    }
    addPostCategory(post){
      this.state.posts.unshift(post);
      this.setState({ posts: this.state.posts});
      console.log(this.state.posts);
      console.log(12414);
      this.render();
    }
    componentWillMount(){
      axios.get('/api/categoryPosts/' + this.state.category_id).then((response) => {
        // let categories = Object.values(response.data)[0];
        this.setState({ posts: response.data[0].data})
        console.log(response);
         
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
          <AddPost addPostCategory={this.addPostCategory} />
        </div>  
	    );
  	}
}

export default CategoryPost;
