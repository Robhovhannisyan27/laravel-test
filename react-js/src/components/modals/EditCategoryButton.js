import React, { Component } from 'react';
import PropTypes from 'prop-types';

class EditCategoryButton extends Component {
	render() {
		return (
			<div id={this.props.modal_id} className="modal fade" role="dialog">
				<div className="modal-dialog">
					<div className="modal-content">
						<div className="modal-header">
							<button type="button" className="close" data-dismiss="modal">&times;</button>
							<h4 className="modal-title">Update Category</h4>
						</div>
						<div className="modal-body" id={this.props.body_id}>   
							<input type="text"  id="category_title" onChange={this.props.changeName} value={this.props.name} name="category_title" placeholder="Enter category name" style={{width: 250+'px'}} />
							<input type="submit" onClick={this.props.handleUpdate} value="Update" id="edit_click" data-dismiss="modal" />
							<button type="button" data-dismiss="modal">Cancel</button>
						</div>
					</div>
				</div>
			</div>        
		);
	}
}

EditCategoryButton.propTypes = {
	modal_id: PropTypes.string,
	body_id: PropTypes.number,
	name: PropTypes.string,
	handleClick: PropTypes.func,
	changeName: PropTypes.func,
	handleUpdate: PropTypes.func,
};

export default EditCategoryButton;
