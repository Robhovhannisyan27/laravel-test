@extends('layouts.app')

@section('content')

<div class="container" style="width: 100%">
    @if(session()->has('success'))
        <div class="alert alert-success">
            {{ session()->get('success') }}
        </div>
    @endif
    @if ( isset($errors) && count($errors) > 0)
    <div class="col-sm-12">
        <div class="alert alert-danger col-sm-8 col-sm-offset-2">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
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
        @if(isset($category_posts))
            @foreach($category_posts as $post)
                <a href="/posts/{{$post->id}}">
                    <div class="post col-sm-3">
                        <div class="post_image"><img src="../image/{{$post->image}}" /></div>
                        <div class="post_title">{{$post->title}}</div>
                        <div class="post_text"><p>{{$post->text}}</p></div>
                    </div>  
                </a>  
            @endforeach
        @endif
        

    </div>

    @guest
    
    @else
    <div class="add_post col-sm-1"  data-toggle="modal" data-target="#addPost">
        <div style="float:right;margin-right: 20px;">
            <button type="button" class="btn btn-success">Add Post</button>
        </div>
    </div> 
    @endguest
</div>
    <div class="paginate">{{ $category_posts->links() }}</div>
    @include('modals.add_post')               
        
    
@endsection




