
$(document).ready(function(){
	$.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
        }
    })
	$('#test').click(function(event){
		event.preventDefault();
		var title = $('#title').val();
		var text = $('#text').val();
		var image = document.getElementById("image").files[0];
		var category_id = $('#select_category').val();
		
		var formData = new FormData();
		// 
		
		if(title == ''){
			$('#error_title').css('display', 'block');
		}
		else{
			$('#error_title').css('display', 'none');
		} 

		if(text == '')
		{
			$('#error_text').css('display', 'block');
		}
		else{
			$('#error_text').css('display', 'none');
		}
		
		if(category_id == ''){
			$('#error_category').css('display', 'block');
		}
		else{
			$('#error_category').css('display', 'none');
		}
		
		if(image !== undefined){
			var koord=image.name.indexOf('.');
			var format=image.name.substr(koord+1);
			if(format!='jpg' && format!='png')
			{
				$('#error_image').css('display', 'block');
			}
			else
			{
				$('#error_image').css('display', 'none');
			}
		}	
		
		
		if($('#error_title').css('display')=='none' && $('#error_text').css('display')=='none' && $('#error_category').css('display')== 'none' && $('#error_image').css('display')== 'none' ){
			formData.append("title",title);
			formData.append("longtext",text);
			if(image !== undefined){
				formData.append("image",image);
			}
			formData.append("category_id",category_id);
				
			
			$.ajax({
				url: '/posts',
	        	type: "POST",
	        	processData: false,
	        	contentType: false,
	        	data: formData, 
	        	success: function (response) {
	        	    
	        	    
	        	    // console.log(response);
	        		$('#addPost').modal('hide');
	        	    
	        	    var addPosts="<a href='/posts/" + response.post.id + " ' ><div class='post col-sm-3'>";
	        	    addPosts += "<div class='post_image'><img src='../image/" + response.post.image + "'></div>";
	                addPosts += "<div class='post_title'>" + response.post.title + "</div>";
	                addPosts += "<div class='post_text'><p>" + response.post.longtext + "</p></div></div></a>"; 	
	                    	
	        	    $('#addPosts').prepend(addPosts);
	        	    window.location.reload();
	    
	        	} ,
	        	error: function(response){
	        		//console.log(response.responseText.message);
	        		
	        	    

	        		
	        	}
			})
		}
	})
	
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

});