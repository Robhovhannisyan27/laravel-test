@extends('layouts.app')

@section('content')

<div class="container" style="width: 100%">
    @if(session()->has('status'))
        <div class="alert alert-success">
            {{ session()->get('status') }}
        </div>
    @endif
    @if(isset($posts))
   <div class="col-sm-8">
        @foreach($posts as $post)
            <div class="large_post_image"><img src="../image/{{$post->image}}" /></div>
            <div class="large_post_title">{{$post->title}}</div>
            <div class="large_post_text"><p>{{$post->text}}</p></div>
        @endforeach 
   </div>
   @endif

    
           
        
    
@endsection




