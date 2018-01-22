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
    @if(isset($posts))
   <div class="col-sm-8">
        @foreach($posts as $post)
            <div class="large_post_image"><img src="../image/{{$post->image}}" /></div>
            <div class="large_post_title">{{$post->title}}</div>
            <div class="large_post_text"><p>{{$post->longtext}}</p></div>
        @endforeach 
   </div>
   @endif

    <div class='col-sm-2 row'>      
        @foreach($posts as $post)
            @if(Gate::allows('update-post', $post))
            <div style="float:right;" data-toggle="modal" data-target="#edit_post">
                <button type="button" data-id="{{$post->id}}" data-title="{{$post->title}}" class="edit_post_button btn btn-success">Edit Post</button>
            </div>
            <div style="float:right;margin-right: 20px;" data-toggle="modal" data-target="#delete_post" >
                <button type="button" data-id="{{$post->id}}" data-title="{{$post->title}}"  class="delete_post_button btn btn-success">Delete Post</button>
            </div>
            @endif
        @endforeach             
    </div> 
           
 </div>       
    @include('modals.delete_post')
    @include('modals.edit_post')
@endsection




