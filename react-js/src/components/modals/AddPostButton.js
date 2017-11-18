import React, { Component } from 'react';
import PropTypes from 'prop-types';

class AddPostButton extends Component {
    render() {
        return (
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
                                        <input type="text" className="form-control" id="title" name="title" placeholder="Title" onChange={this.props.getPostTitle} value={this.props.new_post_title} />
                                    </div>
                                </div>
                                <div className="form-group">
                                    <div className="col-sm-9">
                                        <textarea className="form-control" id='text' rows="4" name="longtext" onChange={this.props.getPostText} value={this.props.new_post_text} placeholder="Text" ></textarea>
                                    </div>
                                </div>
                                <div className="form-group">
                                    <div className="col-sm-9">
                                        <input name='image'  type="file"  id='image' onChange={this.props.onFileChange} className="form-control" />
                                    </div>
                                </div>
                                <div className="form-group" style={{marginLeft: 10 + '%'}}>
                                    <label htmlFor='category' style={{float: 'left'}}>Choose a category</label>
                                    <select name='category_id' id='select_category' onChange={this.props.changeSelect} value={this.props.select_categories} className="col-sm-4" >
                                        <option></option>
                                        {
                                            this.props.categories.map((val, index) => { 
                                                return (
                                                    <option key={index} value={val.id}>{val.category_title}</option>
                                                );
                                            })    
                                        }
                                    </select>
                                </div>
                                <div className="form-group" style={{marginLeft: 70 + 'px'}}>
                                    <div className="col-sm-7 col-sm-offset-2">
                                        <input className="submit" type="submit" id="test" value="Add Post"  onClick={this.props.handleUpdate} className="btn btn-primary" data-dismiss="modal" />
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
        );
    }
}

AddPostButton.propTypes = {
    getPostTitle: PropTypes.func,
    new_post_title: PropTypes.string,
    new_post_text: PropTypes.string,
    
    getPostText: PropTypes.func,
    onFileChange: PropTypes.func,
    changeSelect: PropTypes.func,
    handleUpdate: PropTypes.func,
    categories: PropTypes.array
};

export default AddPostButton;


