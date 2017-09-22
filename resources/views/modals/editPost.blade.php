<div id="edit_post" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Update Post</h4>
            </div>
            <div class="modal-body">
                <form  method="post" id='editPostForm'  action="{{url('/posts')}}">
                    {{ csrf_field() }}
                    @foreach($myPosts as $post)
                        <input type="hidden" name="_method" value="PUT">
                        <input type="text" id="post_title" name="title" value="{{$post->title}}" style="width: 250px;" />
                        <textarea class="form-control" rows="4" name="longtext">{{$post->text}}</textarea>
                        <input name='image' type="file"  class="image form-control" >
                        <input type="submit" value="Update" id="edit_post_click">
                        <button type="button" style="margin-left: 5px;" data-dismiss="modal">Cancel</button>
                    @endforeach
                </form>
            </div>
            
        </div>
    </div>
</div>