@extends('layouts.app')

 @section('content')
    <div class="container">
         @if(session()->has('status'))
            <div class="alert alert-success">
                {{ session()->get('status') }}
            </div>
        @endif
       
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
                            <input type="submit" value="create">
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>


        @if(isset($categories))
            <div class="container" style="margin-top: 20px; position: absolute; left: 2% ">
                <h2>Categories</h2>
                <div class="list-group" style="border:1px solid black;width:200px;height:300px;overflow:scroll; left: 5%;">
                @foreach($categories as $category)
                    <a style='text-decoration: none;' class="list-group-item" href="/categories/{{$category->id}}">{{ $category->category_title }}</a>
                @endforeach
                </div>
            </div> 
            

        @endif
        


    </div>
 @endsection


