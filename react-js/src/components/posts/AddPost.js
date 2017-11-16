import React, { Component } from 'react';
import {Route, Link} from 'react-router-dom';
import axios from 'axios';
import './posts.css';
import AddPostButton from '../modals/AddPostButton';
import PropTypes from 'prop-types';

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
        let data = new FormData();
        data.append('image', this.state.image);
        data.append('title', this.state.title);
        data.append('longtext', this.state.text);
        data.append('category_id', this.state.select);
            
        axios.post('/api/me/posts', data).then((response) => {
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
        axios.get('/api/me/categories').then((response) => {
            let categories = Object.values(response.data)[0];
            if(this.props.categories){
                this.setState({ categories: this.props.categories});
            } else{    
                this.setState({ categories: categories});
            }
                
            }).catch((err)=>{
                this.setState({error: Object.values(err.response.data.errors)[0], success: ''});
        })
    }

    onFileChange(event) {
        this.setState({image: event.target.files[0]});
    }

    render() {
        let testInput = this.testInput;
        return (
            <div>
                <div className='modal_div' data-toggle="modal" data-target="#addPost">
                    <button type="button"  className="btn btn-success">Add Post</button>
                </div>
                <AddPostButton 
                    changeTitle={this.changeTitle}
                    changeText={this.changeText}
                    text={this.state.text}
                    onFileChange = {this.onFileChange}
                    changeSelect = {this.changeSelect}
                    selecet = {this.state.select}
                    categories={this.state.categories}
                    handleClick={this.handleClick}
                />
            </div>
        );
    }
}

AddPost.propTypes = {
    categories: PropTypes.array,
    addPost: PropTypes.func,
};

export default AddPost;


