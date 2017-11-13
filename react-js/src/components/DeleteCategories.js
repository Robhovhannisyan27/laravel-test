import React, { Component } from 'react';
import {Route, Link} from 'react-router-dom';
import axios from 'axios';
import '../css/Menu.css';

class DeleteCategories extends Component {
  constructor(props){
    super(props);
    this.state = {
      name: '',
      category: ''
    }
    this.handleClick = this.handleClick.bind(this);
    this.deleteClick = this.deleteClick.bind(this);
    this.modal_id = `delete_category${this.props.id}`;
  }
  changeName(e){
    this.setState({ name: e.target.value });
  }
  deleteClick(){
    $(`#${this.modal_id}`).modal();
  }
  handleClick(){
    axios.delete('/api/deleteCategory/' + this.props.id).then((response) => {
          this.props.deleteCategory(this.props.id);
      }).catch((err)=>{
        console.log(err);
    })
  }
  render() {
    return (
      <div className='cat_delete'>         
        <div data-toggle="modal">   
          <button type="button" onClick={this.deleteClick} className=" delete_button btn btn-success">Delete Category</button>
        </div>       
        <div id={this.modal_id} className="modal fade" role="dialog">
          <div className="modal-dialog">
            <div className="modal-content">
              <div className="modal-header">
                <button type="button" className="close" data-dismiss="modal">&times;</button>
                <h4 className="modal-title">Delete Category</h4>
              </div>
              <div className="modal-body">
                <p>Remove a category <span id='delete_category'></span> ?</p>
                <input type="submit" id='delete_click' onClick={this.handleClick} value="Yes" data-dismiss="modal" /> 
                <button type="button" style={{marginLeft: 15+'px'}} data-dismiss="modal">Cancel</button>
              </div>
            </div>
          </div>
        </div>
      </div>          
    );
  }
}

export default DeleteCategories;
