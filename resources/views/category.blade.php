@extends('layouts.app')

@section('content')

    <div class="container" style="width: 100%">
         @if(session()->has('status'))
            <div class="alert alert-success">
                {{ session()->get('status') }}
            </div>
        @endif
        
        <div class="col-sm-2">
        @if(isset($categories))
            <div  style="top:8%; position: absolute; left: 0 ">
                <h2>Categories</h2>
                <div class="list-group" style="max-height: 680px; width: 250px; left: 5%;">
                @foreach($categories as $category)
                    <a style='text-decoration: none;' class="list-group-item" href="/categories/{{$category->id}}">{{ $category->category_title }}</a>
                @endforeach
                </div>
            </div> 
            
        @endif
        </div>
    

        <div class="col-sm-8 row posts">
            @if(isset($category_post))
                @foreach($category_post as $post)
                    <div class="post col-sm-3">
                        <div class="post_image"><img src="../image/{{$post->image}}" /></div>
                        <div class="post_title">{{$post->title}}</div>
                        <div class="post_text"><p>{{$post->text}}</p></div> 
                    </div>    
                @endforeach
            @endif
            
        </div>


        <div class="add_post col-sm-1"  data-toggle="modal" data-target="#addPost">
            <div style="float:right;margin-right: 20px;">
                <button type="button" class="btn btn-success">Add Post</button>
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
        
    
@endsection




