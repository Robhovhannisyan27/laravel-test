@extends('layouts.app')

@section('content')

    <div class="container">
         @if(session()->has('status'))
            <div class="alert alert-success">
                {{ session()->get('status') }}
            </div>
        @endif
        <div class='row'>
        	{{-- <h1>{{$category->category_title}}   (created at {{$category->created_at}}) </h1> --}}
            

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

        <div class='row'>
            <div style="float:right;margin-right: 20px;">
                <a href="../posts/add"><button type="button" class="btn btn-success">Add Post</button></a>
            </div>               
        </div>
        
    </div>  
@endsection




