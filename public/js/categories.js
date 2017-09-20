// $(document).ready(function(){
// 	$.ajaxSetup({
// 		headers: {
// 			'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
// 		        }
// 	});

// 	$('#test').click(function(ev){
// 		ev.preventDefault();
// 		var title = $('#title').val();
// 		var text = $('#text').val();
// 		var image = $('#image').val();
// 		var select = $('#select_category').val();
// 		alert($select);
// 		$.ajax({
// 			url: '/posts',
// 			cache: false,
//         	data: {'title': title, 'text': text, '$image':image, 'category_id':select }, 
//         	type: "POST",
//         	success: function (data) {
//         	    alert('ok');
//         	} 
// 		})
// 	})
// });

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

$('.delete_post_button').click(function(){
	var id = $(this).attr('data-id');
	var title = $(this).attr('data-title');
	var delete_post= $('#deletePostForm').attr('action');
	//$('#delete_post').html(title);
	$('#delete_click_post').click(function(){
		delete_post = delete_post.concat('/');
		id = delete_post.concat(id);
		$('#deletePostForm').attr('action',id);
		
	})

})

$('.edit_post_button').click(function() {
	var id = $(this).attr('data-id');
	var title = $(this).attr('data-title');
	var post= $('#editPostForm').attr('action');
	//$('#category_title').attr('value',title);
	$('#edit_post_click').click(function(){
		post = post.concat('/');
		id = post.concat(id);
		$('#editPostForm').attr('action',id);
	})
})

