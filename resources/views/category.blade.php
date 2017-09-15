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
            {{-- <div class="post col-sm-3">
                <div class="post_image"><img src="../image/cat.png" /></div>
                <div class="post_title">Title</div>
                <div class="post_text"><p>Lorem ipspum</p></div> 
            </div>    
            <div class="post col-sm-3">
                <div class="post_image"><img src="../image/cat.png" /></div>
                <div class="post_title">Title</div>
                <div class="post_text"><p>Lorem ipspum</p></div> 
            </div>
            <div class="post col-sm-3">
                <div class="post_image"><img src="../image/cat.png" /></div>
                <div class="post_title">Title</div>
                <div class="post_text"><p>Lorem ipspum</p></div> 
            </div>
            <div class="post col-sm-3">
                <div class="post_image"><img src="../image/cat.png" /></div>
                <div class="post_title">Title</div>
                <div class="post_text"><p>Lorem ipspum</p></div> 
            </div>      --}}
        </div>


        <div class="add_post col-sm-1">
            <div style="float:right;margin-right: 20px;">
                <a href="../posts/add"><button type="button" class="btn btn-success">Add Post</button></a>
            </div>               
        </div> 
        
    
@endsection




