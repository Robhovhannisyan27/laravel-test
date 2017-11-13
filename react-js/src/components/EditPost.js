import React, { Component } from 'react';
import {Route, Link} from 'react-router-dom';
import axios from 'axios'
import '../css/Menu.css';
import AddPost from './AddPost';


class EditPost extends Component {
  	constructor(props){
      super(props);
      this.state = {
        posts: [],
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
      console.log(this.props.post_id)
      let data = new FormData();
      data.append('image', this.state.image.name);
      data.append('title', this.state.title);
      data.append('longtext', this.state.text);
      data.append('_method', 'PUT');
      axios.post('/api/editPost/' + this.props.post_id, data).then((response) => {
        let data = response.data[0][0];
        console.log(response.data[0][0]);
        this.setState({title: data.title, text: data.text, image: data.image});
        this.props.editPost(data.title,data.text,data.image);
        // console.log(this.state.image);
        // console.log(this.state.text);
        // console.log(this.state.title);
        // this.setState({ post: response.data[0].data})
        // console.log(response);
         
        }).catch((err)=>{
          console.log(err);
      })
    }
    
    onFileChange(event) {
        this.setState({image: event.target.files[0]});
        console.log(this.state.image)
    }
   
    
    render() {
	    return (
        <div>
          <div className='addCategory' data-toggle="modal" data-target="#edit_post">
              <button type="button" className="edit_post_button btn btn-success">Edit Post</button>
          </div>

          <div id="edit_post" className="modal fade" role="dialog">
              <div className="modal-dialog">
                  <div className="modal-content">
                      <div className="modal-header">
                          <button type="button" className="close" data-dismiss="modal">&times;</button>
                          <h4 className="modal-title">Update Post</h4>
                      </div>
                      <div className="modal-body">
                          <input type="text" id="post_title" onChange={this.changeTitle} value={this.state.title} name="title" style={{width: 250 + 'px'}} />
                          <textarea className="form-control" onChange={this.changeText} value={this.state.text} rows="4" name="longtext"></textarea>
                          <input name='image' type="file" onChange={this.onFileChange} className="image form-control" />
                          <input type="submit" value="Update"  onClick={this.handleClick}  id="edit_post_click" data-dismiss="modal" />
                          <button type="button" style={{margiLeft: 5 + 'px'}} data-dismiss="modal">Cancel</button>
                      </div>
                      
                  </div>
              </div>
          </div>
          
        </div>  
	    );
  	}
}

export default EditPost;
