<?php
error_reporting('E_ALL');
ini_set('display_errors', '1');
ini_set("default_charset", "UTF-8");
header('Content-Type: text/html; charset=utf-8');

?>
<!DOCTYPE html>
<html>
<head>
<title>JSON js tutorial</title>
<meta charset="utf-8">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.2/jquery.min.js"></script>

<script type="text/javascript">
$(document).ready(function(){

	// getJSON example
    $(".btn1").click(function(){
        $.getJSON("json-obj.php", function(data, status, xhr){
            $.each(data.users, function(i, users){
                $("div").append(users.firstName + " " + users.lastName + "<br>");
            });
        }).fail(function(xhr, d, e){
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
		});
    });

  // ajax JSON example  
  $(".btn2").click(function(){
	  $.ajax({
	    url: 'json-obj.php',
	    dataType: 'json',
	    success: function( data ) {
	      //alert( "SUCCESS:  " + data );
	      $.each(data.users, function(j, obj) {
	      	$("p").append(obj.firstName + " " + obj.lastName + "<br>");
	      });
	    },
	    error: function( xhr, d, e ) {
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
  });


    // ajax upload file example
    $("#btn").click(function(){
    var formData = new FormData($("form")[0]);

      $.ajax({
        url: 'js-upload.php',
        type: 'POST',
        dataType: false,
        enctype: 'multipart/form-data',
        data: formData,
        cache: false,
        contentType: false,
        processData: false,
        success: function( data ) {
            alert("DATA from js-upload.php " +data);
            $(".upload1").html(data);
        },
        error: function( xhr, d, e ) {
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
    });


    // multiple file upload example
    $("#upload").on('submit',(function(e) { 
    e.preventDefault();
    $.ajax({
        url: "js-upload.php",
        type: "POST",
        data: new FormData(this),
        contentType: false,
        cache: false,
        processData:false,
        success: function(data)
        {
            alert("DATA from js-upload.php" + data);
            $(".upload2").html(data);
        },
        error: function( xhr, d, e ) {
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
    }));



});	



</script>
</head>
<body>

<button class="btn1">GetJSON</button>
<button class="btn2">ajax JSON</button>

<div>getJSON</div>
<p>AJAX</p>


<span>File upload ajax</span>
<form action="" method="post" enctype="multipart/form-data">
<input type="file" id="file" name="file" >
<input id="btn" type="button" value="Upload" >
<div class="upload1"></div>
</form>

<span>Multi File upload ajax</span>
<form id="upload" action="" method="post" enctype="multipart/form-data">  
<input type="file" name="file[]" id="file" multiple>
<input id="szukaj" type="submit" value="Dodaj zdjęcie" class="submit">
<div class="upload2"></div>
</form>

</body>
</html>
