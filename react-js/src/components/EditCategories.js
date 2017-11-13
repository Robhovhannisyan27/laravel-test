import React, { Component } from 'react';
import {Route, Link} from 'react-router-dom';
import axios from 'axios';
import '../css/Menu.css';

class EditCategories extends Component {
    constructor(props){
      super(props);
      this.state = {
        name: '',
        cat_id: '',
        cat_name: ''
      }
      this.handleUpdate = this.handleUpdate.bind(this);
      this.editClick = this.editClick.bind(this);
      this.changeName = this.changeName.bind(this);
      this.modal_id = `edit${this.props.id}`;
    }
    changeName(e){
      this.setState({ name: e.target.value });
    }

    editClick(){
        $(`#${this.modal_id}`).modal();
    }
    handleUpdate(){
    	if(this.state.name != ''){
      	axios.put('/api/editCategory/' + this.props.id,{'category_title':this.state.name}).then((response) => {
            this.setState({'cat_name':response.data[0][0]});
            this.render();
            this.props.changeCategoryName(this.state.cat_name);
        }).catch((err)=>{

      	})
    	
      } 
      this.setState({'name': ''})

    }
    
    render() {

      return (
            <div className='cat_edit'>
                
                <div className="col-sm-2" data-toggle="modal">
                    <button type="button" onClick={this.editClick} className="edit_button btn btn-success">Edit Category</button>
                </div>
                <div id={this.modal_id} className="modal fade" role="dialog">
				    <div className="modal-dialog">
				        <div className="modal-content">
				            <div className="modal-header">
				                <button type="button" className="close" data-dismiss="modal">&times;</button>
				                <h4 className="modal-title">Update Category</h4>
				            </div>
				            <div className="modal-body" ref={(input)=>this.testInput=input} id={this.props.id}>   
			                    <input type="text"  id="category_title" onChange={this.changeName} value={this.state.name} name="category_title" placeholder="Enter category name" style={{width: 250+'px'}} />
			                    <input type="submit" onClick={this.handleUpdate} value="Update" id="edit_click" data-dismiss="modal" />
			                    <button type="button" data-dismiss="modal">Cancel</button>
				            </div>
				        </div>
				    </div>
				</div>
            </div>          
      );
    }
}

export default EditCategories;
