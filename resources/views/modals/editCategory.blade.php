<div id="Edit" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Update Category</h4>
            </div>
            <div class="modal-body">
                <form  id='editForm' method="post" action="{{url('/categories')}}">
                    {{ csrf_field() }}
                    <input type="hidden" name="_method" value="PUT">
                    <input type="text" id="category_title" name="category_title" placeholder="Enter category name" style="width: 250px;"  value=""/>
                    <input type="submit" value="Update" id="edit_click">
                    <button type="button" style="margin-left: 5px;" data-dismiss="modal">Cancel</button>
                </form>
            </div>
            
        </div>
    </div>
</div>