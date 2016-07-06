# ajax upload examples and json request from javascript and jquery

links with XMLhttprequests and js communication examples
https://developer.tizen.org/dev-guide/web/2.3.0/org.tizen.mobile.web.appprogramming/html/tutorials/w3c_tutorial/comm_tutorial/upload_ajax.htm
or here with progress bar
http://stackoverflow.com/questions/6211145/upload-file-with-ajax-xmlhttprequest


<form>
<input type="file" id="uploadfile" name="uploadfile" />
<input type="button" value="upload" onclick="upload()" />
</form>

<script>
   var client = new XMLHttpRequest();
  
   function upload() 
   {
      var file = document.getElementById("uploadfile");
      /* Create a FormData instance */
      var formData = new FormData();
      /* Add the file */ 
      formData.append("upload", file.files[0]);
      
      client.open("post", "/upload", true);
      client.setRequestHeader("Content-Type", "multipart/form-data");
      client.send(formData);  /* Send to server */ 
   }
     
   /* Check the response status */  
   client.onreadystatechange = function() 
   {
      if (client.readyState == 4 && client.status == 200) 
      {
         alert(client.statusText);
      }
   }
</script>
