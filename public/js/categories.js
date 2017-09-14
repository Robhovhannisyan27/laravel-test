
$('.editButton').click(function() {
	var id = $(this).attr('data-id');
	var title = $(this).attr('data-title');
	var category= $('#editForm').attr('action');
	category = category.concat('/');
	id = category.concat(id);
	$('#editForm').attr('action',id);
	$('#category_title').attr('value',title);

})

$('.deleteButton').click(function(){
	var id = $(this).attr('data-id');
	var title = $(this).attr('data-title');
	var delete_category= $('#deleteForm').attr('action');
	delete_category = delete_category.concat('/');
	id = delete_category.concat(id);
	$('#deleteForm').attr('action',id);
	$('#delete_category').html(title);
})

