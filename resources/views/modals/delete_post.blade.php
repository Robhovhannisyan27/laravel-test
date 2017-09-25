<div id="delete_post" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Delete Post</h4>
            </div>
            <div class="modal-body">
                <p>Remove a post <span id="delete_post"></span> ?</p>
                <form method="post" id='delete_post_form' style='float: left;' action="{{url('/posts/')}}">
                    {{ csrf_field() }}
                    <input type="hidden" name="_method" value="DELETE">
                    <input type="submit" id='delete_click_post' value="Yes">
                </form>
                <button type="button" style="margin-left: 15px;" data-dismiss="modal">Cancel</button>
            </div>
            
        </div>
    </div>
</div>