
$(document).ready(function(){
	$.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
        }
    })
	$('#test').click(function(event)
	{
		event.preventDefault();
		var title = $('#title').val();
		var text = $('#text').val();
		var image = document.getElementById("image").files[0];
		var category_id = $('#select_category').val();
		
		var formData = new FormData();
		
		
		if(title == '')
		{
			$('#error_title').css('display', 'block');
		}
		else
		{
			$('#error_title').css('display', 'none');
		} 

		if(text == '')
		{
			$('#error_text').css('display', 'block');
		}
		else
		{
			$('#error_text').css('display', 'none');
		}
		
		if(category_id == '')
		{
			$('#error_category').css('display', 'block');
		}
		else
		{
			$('#error_category').css('display', 'none');
		}
		
		if(image !== undefined)
		{
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
		
		
		if($('#error_title').css('display')=='none' && $('#error_text').css('display')=='none' && $('#error_category').css('display')== 'none' && $('#error_image').css('display')== 'none' )
		{
			formData.append("title",title);
			formData.append("longtext",text);
			if(image !== undefined)
			{
				formData.append("image",image);
			}
			formData.append("category_id",category_id);
				
			
			$.ajax({
				url: '/posts',
	        	type: "POST",
	        	processData: false,
	        	contentType: false,
	        	data: formData, 
	        	success: function (response) 
	        	{
	        	    // console.log(response);
	        		$('#addPost').modal('hide');
	        	    
	        	    var add_posts="<a href='/posts/" + response.post.id + " ' ><div class='post col-sm-3'>";
	        	    add_posts += "<div class='post_image'><img src='../image/" + response.post.image + "'></div>";
	                add_posts += "<div class='post_title'>" + response.post.title + "</div>";
	                add_posts += "<div class='post_text'><p>" + response.post.longtext + "</p></div></div></a>"; 	
	                    	
	        	    $('#addPosts').prepend(add_posts);
	        	    window.location.reload();
	    
	        	}
			})
		}
	})
	
	$('.edit_button').click(function() 
	{
		var id = $(this).attr('data-id');
		var title = $(this).attr('data-title');
		var action = $('#edit_form').attr('action');
		$('#edit_form').attr('action', action + '/' + id);
		$('#category_title').attr('value', title);
	})

	$('.delete_button').click(function()
	{
		var id = $(this).attr('data-id');
		var title = $(this).attr('data-title');
		var action = $('#delete_form').attr('action');
		$('#delete_form').attr('action', action + '/' + id);
		$('#delete_category').html(title);

	})

	if($('.list-group').height() + 'px' == $('.list-group').css('max-height'))
	{
		$('.list-group').css('overflow','scroll');
	}

	$('.delete_post_button').click(function(){
		var id = $(this).attr('data-id');
		var title = $(this).attr('data-title');
		var action = $('#delete_post_form').attr('action');
		$('#delete_post_form').attr('action', action + '/' + id);

	})

	$('.edit_post_button').click(function() {
		var id = $(this).attr('data-id');
		var title = $(this).attr('data-title');
		var action = $('#edit_post_form').attr('action');
		$('#edit_form').attr('action', action + '/' + id);
		//$('#category_title').attr('value',title);
	})

});