	      $("#upload").on('change',function() {	      	
	         if($("#upload")[0].files.length > 4){
	            alert("Możesz dodać maksymalnie 4 pliki");
	         } else {
	         	  var files = $("#upload")[0].files;
	         	  $('.post-img').html("");
				  for (var i = 0; i < files.length; i++) {
				  	//alert(files[i].name);
					}

				
				$('.loader').css('visibility', 'inherit');	
		    	var formData = new FormData($("form")[0]);
		      	$.ajax({
			        url: 'js-upload-post.php',
			        type: 'POST',
			        dataType: false,
			        enctype: 'multipart/form-data',
			        data: formData,
			        cache: false,
			        contentType: false,
			        processData: false,
			        success: function( data ) {
			            //alert("DATA from js-upload.php " +data);            
			            $(".post-img").show();
			            $("#loadimages").html(data);		          
			            $('.loader').css('visibility', 'hidden');
			            files.value = '';
			        },
			        error: function( xhr, d, e ) {
			        	$('.loader').css('visibility', 'hidden');
			            alert("Something goes wrong " + d);
			            switch (xhr.status) {
			                case 404:
			                    alert(xhr.statusText + " error " + xhr.status);
			                    break;
			                case 405:
			                    alert(xhr.statusText + " error " + xhr.status);
			                    break;
			                case 403:
			                    alert(xhr.statusText + " error " + xhr.status);
			                    break;
			                case 500:
			                    alert(xhr.statusText + " error " + xhr.status);
			                    break;
			                case 503:
			                    alert(xhr.statusText + " error " + xhr.status);
			                    break;                  
			            }
			        }
		      	});
		      }
	      });
