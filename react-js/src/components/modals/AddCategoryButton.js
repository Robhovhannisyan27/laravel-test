import React, { Component } from 'react';
import PropTypes from 'prop-types';

class AddCategoryButton extends Component {
    render() {
        return (
            <div>
                <div id="myModal" className="modal fade" role="dialog">
                    <div className="modal-dialog">
                        <div className="modal-content">
                            <div className="modal-header">
                                <button type="button" className="close" data-dismiss="modal">&times;</button>
                                <h4 className="modal-title">Add Category</h4>
                            </div>
                            <div className="modal-body">                        
                                <input type="text" name="category_title" onChange={this.props.changeName} value={this.props.name} placeholder="Enter category name" className='addCategoryName' />
                                <input type="submit" value="Create" onClick={this.props.handleClick} data-dismiss="modal" />
                                <button type="button" style={{ marginLeft: 2 + 'px' }} data-dismiss="modal">Cancel</button>    
                            </div>
                        </div>
                    </div>
                </div>
            </div>          
        );
    }
}

AddCategoryButton.propTypes = {
    changeName: PropTypes.func,
    name: PropTypes.string,
    handleClick: PropTypes.func
};

export default AddCategoryButton;
