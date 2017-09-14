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
            <div data-toggle="modal" data-target="#EditCategory" style="float: left;" >
                <button type="button" class="btn btn-success">Edit Category</button>
            </div>
            <div data-toggle="modal" data-target="#DeleteCategory" style="float: left; margin-left: 20px;">   
                <button type="button" class="btn btn-success">Delete Category</button>
            </div>  

        </div>


        <div id="EditCategory" class="modal fade" role="dialog">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">Update Category</h4>
                    </div>
                    <div class="modal-body">
                        <form method="post" action="{{url('/categories/'.$category->id)}}">
                            {{ csrf_field() }}
                            <input type="hidden" name="_method" value="PUT">
                            <input type="text" name="category_title" placeholder="Enter category name" style="width: 250px;"  value="{{$category->category_title}}"/>
                            <input type="submit" value="Update">
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
                    	<p>Remove a category?</p>
                    	<form method="post" style='float: left;' action="{{url('/categories/'.$category->id)}}">
                            {{ csrf_field() }}
                            <input type="hidden" name="_method" value="DELETE">
                        	<input type="submit" value="Yes">
                        </form>
                        <button type="button" style="margin-left: 15px;" data-dismiss="modal">Cancel</button>
                    </div>
                    
                </div>
            </div>
        </div>
    </div>  
@endsection




