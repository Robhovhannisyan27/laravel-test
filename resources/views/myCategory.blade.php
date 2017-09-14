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
            <div style="float:right;margin-right: 20px;">
                <a href="posts/add"><button type="button" class="btn btn-success">Add Post</button></a>
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


         

        <div id="Edit" class="modal fade" role="dialog">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">Update Category</h4>
                    </div>
                    <div class="modal-body">
                        <form  id='editForm' method="post" action="{{url('/categories')}}">
                            {{ csrf_field() }}
                            <input type="hidden" name="_method" value="PUT">
                            <input type="text" id="category_title" name="category_title" placeholder="Enter category name" style="width: 250px;"  value=""/>
                            <input type="submit" value="Update" id="edit_click">
                            <button type="button" style="margin-left: 5px;" data-dismiss="modal">Cancel</button>
                        </form>
                    </div>
                    
                </div>
            </div>
        </div>


        <div id="DeleteCategory" class="modal fade" role="dialog">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">Delete Category</h4>
                    </div>
                    <div class="modal-body">
                        <p>Remove a category <span id=delete_category></span> ?</p>
                        <form method="post" id='deleteForm' style='float: left;' action="{{url('/categories/')}}">
                            {{ csrf_field() }}
                            <input type="hidden" name="_method" value="DELETE">
                            <input type="submit" id='delete_click' value="Yes">
                        </form>
                        <button type="button" style="margin-left: 15px;" data-dismiss="modal">Cancel</button>
                    </div>
                    
                </div>
            </div>
        </div>
        
        <div id="myModal" class="modal fade" role="dialog">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">Add Category</h4>
                    </div>
                    <div class="modal-body">
                        <form method="post" action="/categories/store">
                            {{ csrf_field() }}
                            <input type="text" name="category_title" placeholder="Enter category name" style="width: 250px;" />
                            <input type="submit" value="Create">
                            <button type="button" style="margin-left: 2px;" data-dismiss="modal">Cancel</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        

    </div>
 @endsection


