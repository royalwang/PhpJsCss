
<!DOCTYPE html>
<html>
<head>
	<title>Fast notyfications</title>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">  
	<meta name="viewport" content="width=device-width, initial-scale=1">	
	<meta name="description" content="">
	<meta name="keywords" content="Notyfication system" />

    	<!-- Socket.IO <script src="https://cdnjs.cloudflare.com/ajax/libs/socket.io/1.3.5/socket.io.js"></script> -->
    	<!-- JQUERY <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script> -->
    	
    	<!-- FONTS -->
	<link href='https://fonts.googleapis.com/css?family=Open+Sans:400,300,700,800,800italic,700italic,600italic,600,400italic,300italic&subset=latin,latin-ext' rel='stylesheet' type='text/css'>
	<link href='https://fonts.googleapis.com/css?family=Abel' rel='stylesheet' type='text/css'>
	<link href='https://fonts.googleapis.com/css?family=Roboto+Condensed:400,300,700&subset=latin,latin-ext' rel='stylesheet' type='text/css'>

	<!-- font awesome -->
  	<link rel="stylesheet" href="http://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.4.0/css/font-awesome.min.css">
  	<!-- style.css -->
	<link rel="stylesheet" type="text/css" href="style.css">
	<!-- animate.css -->
	<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.5.2/animate.css">
	<!-- or local -->
	<link rel="stylesheet" type="text/css" href="css/animate.css">

	<!-- jquery -->
	<script src="js/jquery.min.js"></script>
	<!-- my plugins -->
	<script src="js/jquery.plugin.js"></script>	

	<script type="text/javascript">

		// blend hex and rgb color
		function Blend(p,c0,c1) {
		    var n=p<0?p*-1:p,u=Math.round,w=parseInt;
		    if(c0.length>7){
		        var f=c0.split(","),t=(c1?c1:p<0?"rgb(0,0,0)":"rgb(255,255,255)").split(","),R=w(f[0].slice(4)),G=w(f[1]),B=w(f[2]);
		        return "rgb("+(u((w(t[0].slice(4))-R)*n)+R)+","+(u((w(t[1])-G)*n)+G)+","+(u((w(t[2])-B)*n)+B)+")"
		    }else{
		        var f=w(c0.slice(1),16),t=w((c1?c1:p<0?"#000000":"#FFFFFF").slice(1),16),R1=f>>16,G1=f>>8&0x00FF,B1=f&0x0000FF;
		        return "#"+(0x1000000+(u(((t>>16)-R1)*n)+R1)*0x10000+(u(((t>>8&0x00FF)-G1)*n)+G1)*0x100+(u(((t&0x0000FF)-B1)*n)+B1)).toString(16).slice(1)
		    }
		}

		// use blend color
		var color = "rgb(234,47,120)";		
			color = '#ff0000';
		    color = Blend(0.2,color);


	    $(function(){
	      $('#testDiv').slimscroll({
	        height: '100%'
	      }).parent().css({
	        background: 'transparent',
	        border: '0px solid #ff0'
	      });

			$('.close').click(function(){
				$('.searchbox').fadeOut(500);
				$('.searchbox').hide();
			});

			$('.searchbtn').click(function(){
				$('.searchbox').fadeIn(500);
				$('.searchbox').show();
			});


		  // toggle button
		  $("body").on('click', '.toggle-button', function() {
		    $(this).toggleClass('toggle-button-selected'); 
		    var id = $(this).attr('title');
		    if (id == 0) {		    	
		    	$(this).attr('title', '1');
		    	alert("Prywatna wiadomość");
		    }else{		    	
		    	$(this).attr('title', '0');
		    	alert('Publiczna wiadomość');
		    }
		  });


	      $("input").keyup(function(){
	      	var id = $("#searchinput").val();
	      	$.post("j-search.php", {id: id}, function(data, status){
	      		//var lines = data.split('###');
	      		//var out = "";
				//$.each(lines, function(key, line) { })
	      		$('#users').html(data);
	      	});	      		
	      });

	      //$('.addkontakt').click(function(){
	      $('body').on('click','.addkontakt',function(e){
	      	var id = $(this).attr('data-addkontakt');
	      	$.post("addkontakt.php", {id: id}, function(data, status){
	      		if (data == 1) {
        			$("body").PopUp("Kontakt został dodany", 0);
  					$('.popup').delay(2000).fadeOut(300);
  				}else{
        			$("body").PopUp("Błąd! Kontakt nie został dodany", 1);
  					$('.popup').delay(2000).fadeOut(300);  					
  				}
    		});
	      });

	      // show new msg window
	      $('.newpostbtn').click(function(e){
	      	$('#newpost').show();
	      });
	    
	      $('#addfoto').click(function(e){
	      	$('#upload').click();
	      });
	    	    
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

	      $('body').on('click', '.fotos1',function(){
	      	var id = $(this).attr('data-file');
	      	$.post("js-upload-post.php", {del: id}, function(data, status){
	      		if (data != 0) {
        			//alert("DELETE " +data);            
            		$(".post-img").show();
            		$("#loadimages").html(data);
  				}else{
  					//alert("DELETE " +data);
  					$("#loadimages").html(data);
        			$("body").PopUp("Brak zdjęć do usuniecia", 0);
  					$('.popup').delay(2000).fadeOut(300);  					
  				}
    		});
	      });

	      $('#opublikuj').click(function(){
	      	var msg = $('#msg').val();
	      	var priv = $('.toggle-button').attr('title');
	      	$.post("js-upload-post.php", {msg: msg, priv: priv}, function(data, status){
	      		if (data != 0) {        		            		
            		$("body").PopUp("Wiadomosć została wysłana.", 0);
            		setTimeout(location.reload(), 500);
  				}else{
  					//alert("DELETE " +data);
  					//$("#loadimages").html(data);
        			$("body").PopUp("Wiadomosć już została wysłana. Odśwież stronę.", 1);
  					$('.popup').delay(2000).fadeOut(300);
  					setTimeout(location.reload(), 500);
  				}
    		});
	      });


	      // like user profil    	      
	      $('body').on('click', '.likebtn',function(){
	      	<?php if ($_SESSION['loged'] == 1) { echo "var on = 1;"; }else{ echo "var on = 1;"; } ?>

	      	if (on == 1) {	      	
	      	var mid = $(this).attr('data-hash');	
	      	$.post("js-user-like.php", {likeid: mid}, function(data, status){	  
			if (parseInt(data) == 1) {        			
            		$("body").PopUp('<i class="fa fa-star"></i> Obserwujesz użytkownika', 0);
            		$('.popup').delay(2000).fadeOut(300);            		
  				}
  			if (parseInt(data) == 0) {
        			$("body").PopUp('<i class="fa fa-star"></i> Już nie obserwujesz użytkownika.', 0);
  					$('.popup').delay(2000).fadeOut(300);
 				}
    		});
	      	}
	      });

	      // like post	      	      
	      $('body').on('click', '.coment-delete',function(){
	      	<?php if ($_SESSION['loged'] == 1) { echo "var on = 1;"; }else{ echo "var on = 1;"; } ?>

	      	if (on == 1) {	      	
	      	var mid = $(this).attr('data-hash');	      		      	
	      	$.post("js-post-del.php", {cid: mid}, function(data, status){	  
	      		
			if (parseInt(data) == 1) {        			
            		$("body").PopUp('<i class="fa fa-thumbs-up"></i> Komentarz usunięty', 0);
            		$('.popup').delay(2000).fadeOut(300);            		
					
					// refresh comments
					mid = $('#coment-msg-hidden').val();
			      	$.post("js-coments-load.php", {hash: mid}, function(data, status){	 
			      	$('#coment-show').html(data);
					if (parseInt(data) > 0) {
		        			//alert("ADD " +data);            
		            		$("body").PopUp('<i class="fa fa-thumbs-up"></i> Komentarze.', 0);
		            		$('.popup').delay(2000).fadeOut(300);
		            	}
		  			if (parseInt(data) == 0) {
		  					//alert("DELETE " +data);
		  					$("#loadimages").html(data);
		        			$("body").PopUp('<i class="fa fa-thumbs-down"></i>Brak komentarzy.', 0);
		  					$('.popup').delay(2000).fadeOut(300);  					            		
		            	}
		  			});              		
  				}
  			if (parseInt(data) == 0) {
        			$("body").PopUp('<i class="fa fa-thumbs-down"></i> Nie można usunąć, komentarz nie istnieje.', 0);
  					$('.popup').delay(2000).fadeOut(300);  					
 				}
    		});
	      	}
	      });

	      // like post	      	      
	      $('body').on('click', '.post-del',function(){
	      	<?php if ($_SESSION['loged'] == 1) { echo "var on = 1;"; }else{ echo "var on = 1;"; } ?>

	      	if (on == 1) {	      	
	      	var mid = $(this).attr('data-hash');	      		      	
	      	$.post("js-post-del.php", {del: mid}, function(data, status){	  
	      		alert(data);
			if (parseInt(data) == 1) {        			
            		$("body").PopUp('<i class="fa fa-thumbs-up"></i> Post usunięty', 0);
            		$('.popup').delay(2000).fadeOut(300);
            		setTimeout(location.reload(), 500);
  				}
  			if (parseInt(data) == 0) {
        			$("body").PopUp('<i class="fa fa-thumbs-down"></i> Nie można usunąć, post nie istnieje.', 0);
  					$('.popup').delay(2000).fadeOut(300);  					
 				}
    		});
	      	}
	      });

	      // like post	      	      
	      $('body').on('click', '.likes',function(){
	      	<?php if ($_SESSION['loged'] == 1) { echo "var on = 1;"; }else{ echo "var on = 1;"; } ?>

	      	if (on == 1) {
	      	var ile = 0;	      	
	      	var mid = $(this).attr('data-hash');	      
	      	var span = $(this).find('span');
	      	ile = parseInt(span.html());		      	
	      	$.post("js-like.php", {like: mid}, function(data, status){	  
			if (parseInt(data) == 1) {
        			//alert("ADD " +data);            
            		$("body").PopUp('<i class="fa fa-thumbs-up"></i> Polubiłeś ...', 0);
            		$('.popup').delay(2000).fadeOut(300);
            		ile = ile + 1;            		
  				}
  			if (parseInt(data) == 0) {
  					//alert("DELETE " +data);
  					$("#loadimages").html(data);
        			$("body").PopUp('<i class="fa fa-thumbs-down"></i> Już nie lubisz ...', 0);
  					$('.popup').delay(2000).fadeOut(300);  					            		
            		ile = ile - 1;            		
  				}
  				if (ile < 0) { ile = 0;}
  				span.html(ile);
    		});
	      	}
	      });

	      $('body').on('click', '.closeit',function(){	      	
	      	$('.black').fadeOut(500);
	      });


	      // load right tab users
	      	$.post("js-coments-load-rand.php", {hash: 'rand'}, function(data, status){	 
	      	$('#news').html(data);
			if (parseInt(data) > 0) {
            		//$("body").PopUp('<i class="fa fa-thumbs-up"></i> Komentarze.', 0);
            		//$('.popup').delay(2000).fadeOut(300);
            	}
  			if (parseInt(data) == 0) {
  					$("#news").html(data);
        			//$("body").PopUp('<i class="fa fa-thumbs-down"></i>Brak komentarzy.', 0);
  					//$('.popup').delay(2000).fadeOut(300);  					            		
            	}
  			});

	      // load right tab most popular hashtags
	      	$.post("js-load-hashtags.php", {hash: 'rand'}, function(data, status){	 
	      	$('#news').append(data);
			if (parseInt(data) > 0) {
            		//$("body").PopUp('<i class="fa fa-thumbs-up"></i> Komentarze.', 0);
            		//$('.popup').delay(2000).fadeOut(300);
            	}
  			if (parseInt(data) == 0) {
  					$("#news").html(data);
        			//$("body").PopUp('<i class="fa fa-thumbs-down"></i>Brak komentarzy.', 0);
  					//$('.popup').delay(2000).fadeOut(300);  					            		
            	}
  			});

	      $('body').on('click', '.coment',function(){
	      	var mid = $(this).attr('data-hash');	      	
	      	$('#coment-msg-hidden').val(mid);
	      	$('.black').fadeIn(600);
	      	//alert($('#coment-msg-hidden').val());
	      	$.post("js-coments-load.php", {hash: mid}, function(data, status){	 
	      	$('#coment-show').html(data);
			if (parseInt(data) > 0) {
            		//$("body").PopUp('<i class="fa fa-thumbs-up"></i> Komentarze.', 0);
            		//$('.popup').delay(2000).fadeOut(300);
            	}
  			if (parseInt(data) == 0) {
  					$("#loadimages").html(data);
        			//$("body").PopUp('<i class="fa fa-thumbs-down"></i>Brak komentarzy.', 0);
  					//$('.popup').delay(2000).fadeOut(300);  					            		
            	}
  			});
	      });

	      // coment post	      	      
	      $('body').on('click', '#coments',function(){
	      	<?php if ($_SESSION['loged'] == 1) { echo "var on = 1;"; }else{ echo "var on = 1;"; } ?>
	      	if (on == 1) {
	      	//var mid = $(this).attr('data-hash');
	      	//var span = $(this).find('span');
	      	mid = $('#coment-msg-hidden').val();
	      	
	      	var msg = $('#coment-msg').val();
	      	$.post("js-coments.php", {msg: msg, hash: mid}, function(data, status){	  
			if (parseInt(data) == 1) {
        			//alert("ADD " +data);            
            		$("body").PopUp('<i class="fa fa-thumbs-up"></i> Komentarz dodany.', 0);
            		$('.popup').delay(2000).fadeOut(300);
					
					// refresh comments
			      	$.post("js-coments-load.php", {hash: mid}, function(data, status){	 
			      	$('#coment-show').html(data);
					if (parseInt(data) > 0) {
		        			//alert("ADD " +data);            
		            		$("body").PopUp('<i class="fa fa-thumbs-up"></i> Komentarze.', 0);
		            		$('.popup').delay(2000).fadeOut(300);
		            	}
		  			if (parseInt(data) == 0) {
		  					//alert("DELETE " +data);
		  					$("#loadimages").html(data);
		        			$("body").PopUp('<i class="fa fa-thumbs-down"></i>Brak komentarzy.', 0);
		  					$('.popup').delay(2000).fadeOut(300);  					            		
		            	}
		  			});            		
            	}
  			if (parseInt(data) == 0) {
  					//alert("DELETE " +data);
  					$("#loadimages").html(data);
        			$("body").PopUp('<i class="fa fa-thumbs-down"></i>Twój komentarz o tej treści jest już dodany.', 0);
  					$('.popup').delay(2000).fadeOut(300);  					            		
            	}
  			});
	      	}
	      });

	      $('.delkontakt').click(function(){
	      	var id = $(this).attr('data-delkontakt');
	      	$.post("delkontakt.php", {id: id}, function(data, status){
	      		if (data == 1) {
        			$("body").PopUp("Kontakt został usuniety", 0);
  					$('.popup').delay(2000).fadeOut(300);
  					setTimeout(location.reload(), 500);
  				}else{
        			$("body").PopUp("Błąd! Kontakt nie istnieje", 1);
  					$('.popup').delay(2000).fadeOut(300);  					
  				}
    		});
	      });

	      $('.msgdelete').click(function(){	      	
	      	var id = $(this).attr('data-msgdelete');
	      	$.post("msgdelete.php", {id: id}, function(data, status){
	      		if (data == 1) {
        			$("body").PopUp("Wiadomosć przeniesiona do kosza", 0);
  					$('.popup').delay(2000).fadeOut(300);
  					setTimeout(location.reload(), 500);
  				}else{
        			$("body").PopUp("Błąd! Wiadomosć nie przeniesiona", 1);
  					$('.popup').delay(2000).fadeOut(300);  					
  				}
    		});
	      });

	      $('.msgdelete1').click(function(){	      	
	      	var id = $(this).attr('data-msgdelete');
	      	$.post("msgdelete1.php", {id: id}, function(data, status){

	      		if (data == 1) {
        			$("body").PopUp("Wiadomosć usunięta", 0);
  					$('.popup').delay(2000).fadeOut(300);
  					setTimeout(location.reload(), 500);
  				}else{
        			$("body").PopUp("Błąd! Wiadomosć nie usunieta", 1);
  					$('.popup').delay(2000).fadeOut(300);  					
  				}
    		});
	      });

	      $('.msgdelete2').click(function(){	      	
	      	var id = $(this).attr('data-msgdelete');
	      	$.post("msgdelete2.php", {id: id}, function(data, status){
	      		if (data == 1) {
        			$("body").PopUp("Wiadomosć usunięta", 0);
  					$('.popup').delay(2000).fadeOut(300);
  					setTimeout(location.reload(), 500);
  				}else{
        			$("body").PopUp("Błąd! Wiadomosć nie usunieta", 1);
  					$('.popup').delay(2000).fadeOut(300);  					
  				}
    		});
	      });

	      $('.msgpriv').click(function(){	      	
	      	var id = $(this).attr('data-msgpriv');
	      	$.post("msgprivate.php", {id: id}, function(data, status){
	      		if (data == 1) {
        			$("body").PopUp("Wiadomosć przeniesiona", 0);
  					$('.popup').delay(2000).fadeOut(300);
  					setTimeout(location.reload(), 500);
  				}else{
        			$("body").PopUp("Błąd! Wiadomosć nie przeniesiona", 1);
  					$('.popup').delay(2000).fadeOut(300);  					
  				}
    		});
	      });

	      $('.msgpriv1').click(function(){	      	
	      	var id = $(this).attr('data-msgpriv');
	      	$.post("msgprivate1.php", {id: id}, function(data, status){
	      		if (data == 1) {
        			$("body").PopUp("Wiadomosć przeniesiona do ulubionych", 0);
  					$('.popup').delay(2000).fadeOut(300);
  					setTimeout(location.reload(), 500);
  				}else{
        			$("body").PopUp("Błąd! Wiadomosć nie przeniesiona do ulubionych", 1);
  					$('.popup').delay(2000).fadeOut(300);  					
  				}
    		});
	      });
	    });

		/* resize iframe to inner content height */
		function setIframeHeight(iframe) {
			if (iframe) {
				var iframeWin = iframe.contentWindow || iframe.contentDocument.parentWindow;
				if (iframeWin.document.body) {
					iframe.height = iframeWin.document.documentElement.scrollHeight || iframeWin.document.body.scrollHeight;
				}
			}
		};
		window.onload = function () {
			setIframeHeight(document.getElementById('iframe'));
			setIframeHeight(document.getElementsByClassName('iframe'));
		};
		        /* show links from i frame in new tabs */
        $('.iframe').ready(function() { 
            $('.iframe').contents().find("a").attr('target','_blank');                  
        }); 
	</script>
</head>
