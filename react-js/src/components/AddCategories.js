import React, { Component } from 'react';
import {Route, Link} from 'react-router-dom';
import axios from 'axios';
import '../css/Menu.css';

class AddCategories extends Component {
  constructor(props){
    super(props);
    this.state = {
      name: '',
      category: ''
    }
    this.changeName = this.changeName.bind(this);
    this.handleClick = this.handleClick.bind(this);
  }

  changeName(e){
    this.setState({ name: e.target.value });
  }
  handleClick(){
    
    axios.post('/api/addCategory/' + sessionStorage.getItem('user_id'), {'category_title': this.state.name}).then((response) => {
      this.setState({'category': response.data.category});
      this.props.addCategory(this.state.category);
       }).catch((err)=>{

      })
    }
  render() {
    return (
      <div>
        <div className='row'>
          <div className=' addCategory' data-toggle="modal" data-target="#myModal">
            <button type="button" className="btn btn-success">Add Category</button>
          </div>
        </div>    
        <div id="myModal" className="modal fade" role="dialog">
          <div className="modal-dialog">
            <div className="modal-content">
              <div className="modal-header">
                <button type="button" className="close" data-dismiss="modal">&times;</button>
                <h4 className="modal-title">Add Category</h4>
              </div>
              <div className="modal-body">                        
                <input type="text" name="category_title" onChange={this.changeName} value={this.state.name} placeholder="Enter category name" className='addCategoryName' />
                <input type="submit" value="Create" onClick={this.handleClick} data-dismiss="modal" />
                <button type="button" style={{ marginLeft: 2 + 'px' }} data-dismiss="modal">Cancel</button>    
              </div>
            </div>
          </div>
        </div>
      </div>          
    );
  }
}

export default AddCategories;
