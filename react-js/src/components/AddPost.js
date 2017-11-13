import React, { Component } from 'react';
import {Route, Link} from 'react-router-dom';
import axios from 'axios';
import '../css/Menu.css';

class AddPost extends Component {
    constructor(props){
      super(props);
      this.state = {
          categories: [],
          title: '',
          text: '',
          select: '',
          image: '',
          success: ''
      }
      this.handleClick = this.handleClick.bind(this);
      this.changeTitle = this.changeTitle.bind(this);
      this.changeText = this.changeText.bind(this);
      this.changeSelect = this.changeSelect.bind(this);
      this.onFileChange = this.onFileChange.bind(this);
    }
    handleClick(){
      var data = new FormData();
      data.append('image', this.state.image);
      data.append('title', this.state.title);
      data.append('longtext', this.state.text);
      data.append('category_id', this.state.select);
      axios.post('/api/addPost/' + sessionStorage.getItem('user_id'), data).then((response) => {
        this.props.addPostCategory(response.data.post);
        }).catch((err)=>{

      })
      axios.post('/api/addPost/' + sessionStorage.getItem('user_id'), data).then((response) => {
          this.props.addPost(response.data.post);    
          }).catch((err)=>{

        })
    }
    changeTitle(e){
      this.setState({'title': e.target.value});
    }
    changeText(e){
      this.setState({'text': e.target.value});
    }
    changeSelect(e){
      this.setState({'select': e.target.value});
    }
    componentWillMount(){
      axios.get('/api/myCategories/' + sessionStorage.getItem('user_id')).then((response) => {
          let categories = Object.values(response.data)[0];
          if(this.props.categories){
            this.setState({ categories: this.props.categories});
          }
          else{    
            this.setState({ categories: categories});
          }
          
        }).catch((err)=>{
          this.setState({error: Object.values(err.response.data.errors)[0], success: ''});
      })
    }

    onFileChange(event) {
        this.setState({image: event.target.files[0]});
        console.log(this.state.image)
    }

    render() {
      var testInput = this.testInput;
      return (
            <div>
              <div className='modal_div' data-toggle="modal" data-target="#addPost">
                  <button type="button"  className="btn btn-success">Add Post</button>
              </div>

              <div id="addPost" className="modal fade" role="dialog">
                <div className="modal-dialog">

               
                <div className="modal-content">
                  <div className="modal-header">
                    <button type="button" className="close" data-dismiss="modal">&times;</button>
                    <h4 className="modal-title">Add Post</h4>
                  </div>
                  <div className="modal-body">
                    
                    <div className='post_form'>
                        
                        <div className="form-group">
                          <div className="col-sm-9">
                            <input type="text" className="form-control" id="title" name="title" placeholder="Title" onChange={this.changeTitle} value={this.state.title} />
                          </div>
                        </div>
                        <div className="form-group">
                          <div className="col-sm-9">
                            <textarea className="form-control" id='text' rows="4" name="longtext" onChange={this.changeText} value={this.state.text} placeholder="Text" ></textarea>
                          </div>
                        </div>
                        <div className="form-group">
                          <div className="col-sm-9">
                            <input name='image'  type="file"  id='image' onChange={this.onFileChange} className="form-control" />
                          </div>
                        </div>
                        <div className="form-group" style={{marginLeft: 10 + '%'}}>
                          <label htmlFor='category' style={{float: 'left'}}>Choose a category</label>
                          <select name='category_id'  ref={(option)=>{testInput = option}} id='select_category' onChange={this.changeSelect} value={this.state.select} className="col-sm-4" >
                            <option></option>
                            {
                              this.state.categories.map(function(val, index){ 
                                return (
                                  <option key={index} value={val.id}>{val.category_title}</option>
                                );
                              })    
                            }
                          </select>

                        </div>
                        <div className="form-group" style={{marginLeft: 70 + 'px'}}>
                          <div className="col-sm-7 col-sm-offset-2">
                            <input className="submit" type="submit" id="test" value="Add Post"  onClick={this.handleClick} className="btn btn-primary" data-dismiss="modal" />
                          </div>
                        </div>
                    
                    </div>
                  </div>
                  <div className="modal-footer">
                    <button type="button" className="btn btn-default" data-dismiss="modal">Close</button>
                  </div>
                </div>

              </div>
            </div>
          </div>
      );
    }
}

export default AddPost;


