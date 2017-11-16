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
								<input type="text" id="post_title" onChange={this.props.changeTitle} value={this.props.title} name="title" style={{width: 250 + 'px'}} />
								<textarea className="form-control" onChange={this.props.changeText} value={this.props.text} rows="4" name="longtext"></textarea>
								<input name='image' type="file" onChange={this.props.onFileChange} className="image form-control" />
								<input type="submit" value="Update"  onClick={this.props.handleClick}  id="edit_post_click" data-dismiss="modal" />
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
	changeTitle: PropTypes.func,
	title: PropTypes.string,
	text: PropTypes.string,
	changeText: PropTypes.func,
	onFileChange: PropTypes.func,
	handleClick: PropTypes.func,
};

export default EditPostButton;