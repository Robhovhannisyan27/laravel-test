import React, { Component } from 'react';
import {Route, Link, Redirect} from 'react-router-dom';
import axios from 'axios'
import '../css/Menu.css';


class DeletePost extends Component {
  	constructor(props){
      super(props);
      this.state = {
        delete: false
      }
      this.handleClick = this.handleClick.bind(this);
    }
    
    handleClick(){
      console.log(this.props.post_id)
      axios.delete('/api/deletePost/' + this.props.post_id).then((response) => {
        console.log(response);
        // this.setState({ post: response.data[0].data})
        // console.log(response);
        this.setState({ delete: true });
        this.render();
        }).catch((err)=>{

      })
    }
    
    render() {
      var a;
      if(this.state.delete){
        a = <Redirect to='/my-posts' />;
      }
	    return (
        <div>
          {a}
          <div className='deletePost' data-toggle="modal" data-target="#delete_post" >
              <button type="button" className="delete_post_button btn btn-success">Delete Post</button>
          </div>

          <div id="delete_post" className="modal fade" role="dialog">
              <div className="modal-dialog">
                  <div className="modal-content">
                      <div className="modal-header">
                          <button type="button" className="close" data-dismiss="modal">&times;</button>
                          <h4 className="modal-title">Delete Post</h4>
                      </div>
                      <div className="modal-body">
                          <p>Remove a post <span id="delete_post"></span> ?</p>
                          <input type="submit" id='delete_click_post' onClick={this.handleClick} data-dismiss="modal" value="Yes" />
                          <button type="button" style={{ marginLeft: 15+'px'}} data-dismiss="modal">Cancel</button>
                      </div>
                      
                  </div>
              </div>
          </div>
          
        </div>  
	    );
  	}
}

export default DeletePost;
