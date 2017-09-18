@extends('layouts.app')

 @section('content')
    <div class="container">
        @if(session()->has('status'))
            <div class="alert alert-success">
                {{ session()->get('status') }}
            </div>
        @endif
        <div class='row'>
            <div style="float:right;" data-toggle="modal" data-target="#myModal">
                <button type="button" class="btn btn-success">Add Category</button>
            </div>
            <div style="float:right;margin-right: 20px;" data-toggle="modal" data-target="#addPost">
                <button type="button" class="btn btn-success">Add Post</button>
            </div>               
        </div>


        @if(isset($categories))
            <div  style="top:8%; position: absolute; left: 0 ">
                <h2>Categories</h2>
                <div class="list-group" style=" overflow:; max-height: 680px; width: 250px; left: 5%;">
                @foreach($categories as $category)
                    <a style='text-decoration: none;' class="list-group-item" href="/categories/{{$category->id}}">{{ $category->category_title }}</a>
                @endforeach
                </div>
            </div> 
            
        @endif
        @if(isset($allCategories))
            <div  style="margin-top: -3%; width: 50%; margin-left: 30%;">
                <h2>My Categories</h2>
                @foreach($allCategories as $category)
                    <div style="float: left;">
                        <div style="float: left;"><a style='text-decoration: none; width: 250px;' class="list-group-item" href="/categories/{{$category->id}}">{{ $category->category_title }}</a></div>
                        <div data-toggle="modal" data-target="#Edit" style="float: left; margin-left: 20px;" >
                            <button type="button" class="editButton btn btn-success" data-id="{{$category->id}}" data-title="{{$category->category_title}}">Edit Category</button>
                        </div>
                        <div data-toggle="modal" data-target="#DeleteCategory" style="float: left; margin-left: 20px;">   
                            <button type="button" class=" deleteButton btn btn-success" data-id="{{$category->id}}" data-title="{{$category->category_title}}">Delete Category</button>
                        </div> 
                    </div>   
                @endforeach
            </div> 
            

        @endif         


        
        
        
                       

    </div>
    @include('modals.deleteCategory')
    @include('modals.addCategory')
    @include('modals.editCategory')
    @include('modals.addPost') 
 @endsection


