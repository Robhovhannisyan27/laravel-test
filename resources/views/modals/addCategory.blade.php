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
                    <input type="submit" value="Create">
                    <button type="button" style="margin-left: 2px;" data-dismiss="modal">Cancel</button>
                </form>
            </div>
        </div>
    </div>
</div>