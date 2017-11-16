import React, { Component } from 'react';
import PropTypes from 'prop-types';

class EditPostButton extends Component {
    render() {
        return (
            <div>
                <div id="edit_post" className="modal fade" role="dialog">
                    <div className="modal-dialog">
                        <div className="modal-content">
                            <div className="modal-header">
                                <button type="button" className="close" data-dismiss="modal">&times;</button>
                                <h4 className="modal-title">Update Post</h4>
                            </div>
                            <div className="modal-body">
                                <input type="text" id="post_title" onChange={this.props.getUpdatedPostTitle} value={this.props.updated_post_title} name="title" style={{width: 250 + 'px'}} />
                                <textarea className="form-control" onChange={this.props.getUpdatedPostText} value={this.props.updated_post_text} rows="4" name="longtext"></textarea>
                                <input name='image' type="file" onChange={this.props.onFileChange} className="image form-control" />
                                <input type="submit" value="Update"  onClick={this.props.updatePost}  id="edit_post_click" data-dismiss="modal" />
                                <button type="button" style={{margiLeft: 5 + 'px'}} data-dismiss="modal">Cancel</button>
                            </div>           
                        </div>
                    </div>
                </div>
            </div>  
        );
    }
}

EditPostButton.propTypes = {
    getUpdatedPostTitle: PropTypes.func,
    updated_post_title: PropTypes.string,
    updated_post_text: PropTypes.string,
    getUpdatedPostText: PropTypes.func,
    onFileChange: PropTypes.func,
    updatePost: PropTypes.func,
};

export default EditPostButton;