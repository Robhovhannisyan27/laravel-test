
$('.editButton').click(function() {
	var id = $(this).attr('data-id');
	var title = $(this).attr('data-title');
	var category= $('#editForm').attr('action');
	$('#category_title').attr('value',title);
	$('#edit_click').click(function(){
		category = category.concat('/');
		id = category.concat(id);
		$('#editForm').attr('action',id);
		
	})
})

$('.deleteButton').click(function(){
	var id = $(this).attr('data-id');
	var title = $(this).attr('data-title');
	var delete_category= $('#deleteForm').attr('action');
	$('#delete_category').html(title);
	$('#delete_click').click(function(){
		delete_category = delete_category.concat('/');
		id = delete_category.concat(id);
		$('#deleteForm').attr('action',id);
		
	})

})

if($('.list-group').height() + 'px' == $('.list-group').css('max-height')){
	$('.list-group').css('overflow','scroll');
}