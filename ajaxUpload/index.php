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

  // ajax upload file 
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
            alert(data);
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


});	
</script>
</head>
<body>

<span>File upload ajax</span>

<form action="" method="post" enctype="multipart/form-data">
<input type="file" id="file" name="file" >
<input id="btn" type="button" value="Upload" >
</form>

</body>
</html>

