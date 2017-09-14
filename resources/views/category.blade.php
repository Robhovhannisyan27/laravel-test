@extends('layouts.app')

@section('content')

    <div class="container">
         @if(session()->has('status'))
            <div class="alert alert-success">
                {{ session()->get('status') }}
            </div>
        @endif
        <div class='row'>
        	<h1>{{$category->category_title}}   (created at {{$category->created_at}}) </h1>
            

        </div>


        
    </div>  
@endsection




