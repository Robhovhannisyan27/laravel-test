import React, { Component } from 'react';
import PropTypes from 'prop-types';
 
class DeleteCategoryButton extends Component {
    render() {
        return (                  
            <div id={this.props.modal_id} className="modal fade" role="dialog">
                <div className="modal-dialog">
                    <div className="modal-content">
                        <div className="modal-header">
                            <button type="button" className="close" data-dismiss="modal">&times;</button>
                            <h4 className="modal-title">Delete Category</h4>
                        </div>
                        <div className="modal-body">
                            <p>Remove a category <span id='delete_category'></span> ?</p>
                            <input type="submit" id='delete_click' onClick={this.props.handleClick} value="Yes" data-dismiss="modal" /> 
                            <button type="button" style={{marginLeft: 15+'px'}} data-dismiss="modal">Cancel</button>
                        </div>
                    </div>
                </div>
            </div>        
        );
    }
}

DeleteCategoryButton.propTypes = {
    handleClick: PropTypes.func
};

export default DeleteCategoryButton;
