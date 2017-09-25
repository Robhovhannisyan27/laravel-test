<div id="Delete_Category" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Delete Category</h4>
            </div>
            <div class="modal-body">
                <p>Remove a category <span id=delete_category></span> ?</p>
                <form method="post" id='delete_form' style='float: left;' action="{{url('/categories/')}}">
                    {{ csrf_field() }}
                    <input type="hidden" name="_method" value="DELETE">
                    <input type="submit" id='delete_click' value="Yes">
                </form>
                <button type="button" style="margin-left: 15px;" data-dismiss="modal">Cancel</button>
            </div>
            
        </div>
    </div>
</div>