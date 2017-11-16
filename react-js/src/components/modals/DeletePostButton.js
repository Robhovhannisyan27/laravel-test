import React, { Component } from 'react';
import PropTypes from 'prop-types';


class DeletePostButton extends Component {
	render() {
		return (
			<div>
				<div id="delete_post" className="modal fade" role="dialog">
					<div className="modal-dialog">
						<div className="modal-content">
							<div className="modal-header">
								<button type="button" className="close" data-dismiss="modal">&times;</button>
								<h4 className="modal-title">Delete Post</h4>
							</div>
							<div className="modal-body">
								<p>Remove a post <span id="delete_post"></span> ?</p>
								<input type="submit" id='delete_click_post' onClick={this.props.handleClick} data-dismiss="modal" value="Yes" />
								<button type="button" style={{ marginLeft: 15+'px'}} data-dismiss="modal">Cancel</button>
							</div> 
						</div>
					</div>
				</div>      
			</div>  
		);
	}
}

DeletePostButton.propTypes = {
	handleClick: PropTypes.func
};

export default DeletePostButton;
