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


    <form class="form-horizontal" role="form" style="margin-left: 20%; margin-top: 30px;" method="post" action="/posts">
		<div class="form-group">
			<div class="col-sm-7">
				<input type="text" class="form-control" id="title" name="title" placeholder="Title" value="">
			</div>
		</div>
		<div class="form-group">
			<div class="col-sm-7">
				<textarea class="form-control" rows="4" name="message" placeholder="Text"></textarea>
			</div>
		</div>
		<div class="form-group">
			<div class="col-sm-7">
				<input type="file" class="form-control" >
			</div>
		</div>
		<div class="form-group" style="margin-left: 10%;">
			<label for='select' style="float: left; ">Choose a category</label>
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
@endsection




