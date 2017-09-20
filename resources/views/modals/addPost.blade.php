<div id="addPost" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content" >
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Add Post</h4>
            </div>
            <div class="modal-body">
                {{-- @if(session()->has('status'))
                    <div class="alert alert-success">
                        {{ session()->get('status') }}
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

                @endif --}}
                <form class="form-horizontal post_form" role="form" style="margin-left: 20%; margin-top: 30px;" enctype="multipart/form-data" method="post" action="/posts/" id="post_form">
                    {{ csrf_field() }}
                    <div class="form-group">
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="title" name="title" placeholder="Title" value="" >
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-9">
                            <textarea class="form-control" id='text' rows="4" name="longtext" placeholder="Text"></textarea>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-9">
                            <input name='image' type="file"  id='image' class="form-control" >
                        </div>
                    </div>
                    <div class="form-group" style="margin-left: 10%;">
                        <label for='category' style="float: left; ">Choose a category</label>
                        <select name='category_id' id='select_category' class="col-sm-4" >
                            <option></option>
                            @if(isset($categories))
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->category_title }}</option>
                                @endforeach
                            @endif  
                        </select>

                    </div>
                    <div class="form-group" style="margin-left: 70px;">
                        <div class="col-sm-7 col-sm-offset-2">
                            <input class="submit" type="submit" id="test" value="Add Post" class="btn btn-primary">
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