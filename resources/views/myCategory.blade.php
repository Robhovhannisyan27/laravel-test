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
        <div id="addPost" class="modal fade" role="dialog">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <h4 class="modal-title">Add Post</h4>
                        </div>
                        <div class="modal-body">
                            <form class="form-horizontal post_form" role="form" style="margin-left: 20%; margin-top: 30px;" enctype="multipart/form-data" method="post" action="/posts/my">
                                {{ csrf_field() }}
                                <div class="form-group">
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" id="title" name="title" placeholder="Title" value="">
                                        <label style='display: none;' for="title" class="error" >Enter the name of the post</label>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-sm-9">
                                        <textarea class="form-control" rows="4" name="text" placeholder="Text"></textarea>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-sm-9">
                                        <input name='photo' type="file" class="form-control" >
                                    </div>
                                </div>
                                <div class="form-group" style="margin-left: 10%;">
                                    <label for='category' style="float: left; ">Choose a category</label>
                                    <select name='select' class="col-sm-4">
                                        <option></option>
                                        @if(isset($allCategories))
                                            @foreach($allCategories as $category)
                                                <option>{{ $category->category_title }}</option>
                                            @endforeach
                                        @endif  
                                    </select>
                                </div>
                                <div class="form-group" style="margin-left: 70px;">
                                    <div class="col-sm-7 col-sm-offset-2">
                                        <input id="submit" name="submit" type="submit" value="Add Post" class="btn btn-primary">
                                    </div>
                                </div>
                            
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
        </div>               

    </div>
 @endsection


