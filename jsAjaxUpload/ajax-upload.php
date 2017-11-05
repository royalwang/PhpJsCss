$(document).ready(function (e) {
    $('#upload').click(function(){
        alert("Upload file");
        var files = new FormData($("#file")[0]);
        $.ajax({
            url: "upload.php", 
            type: "POST",
            data: files,
            enctype: 'multipart/form-data',
            processData: false, // tell jQuery not to process the data
            contentType: false, // tell jQuery not to set contentType
            success: function (data) {
                //some code if you want
                alert(data);
            },
            error: function (error) {
                // handle error
                alert("Error upload");
            },
            xhr: function () {
                var myXhr = $.ajaxSettings.xhr();
                if (myXhr.upload) {
                    myXhr.upload.addEventListener('progress', that.progressHandling, false);
                }
                return myXhr;
            }
        });
    });    
});

/*

<input  class="form-control" type="file" name="file" id="file" accept="image/*">
<button id="upload" type="submit">Upload</button>

<?php
session_start();
// loged users only
if(empty($_SESSION['mailboxid']) || $_SESSION['mailboxid'] < 0){
    header('Location: logout.php');
    die();
}
$dir = 'files/'.(int)$_SESSION['mailboxid'].'/attachments';
if (!file_exists($dir)) {
    mkdir($dir);
}

function upload($dir) {

    ini_set('upload_max_filesize', '200M');
    ini_set('post_max_size', '500M');
    ini_set('max_input_time', 0);
    ini_set('max_execution_time', 0);

    $fname = date('l-j-m-Y').'-'.rand(1,1000000);
    $fname = $_FILES['file']['name'];
    $size = $_FILES['file']['size'];
    $ftype = $_FILES['file']['type'];
    $temp = $_FILES['file']['tmp_name'];
    $type = array();
    $type = explode("/", $ftype);
    $filename = $dir ."/". $fname . "." . $type[1];
    $index = 0;
    while (file_exists($filename)) {
        $filename = $dir ."/". $fname . "." . $type[1];
        $index++;
    }
    move_uploaded_file($temp, $filename);
    return $fname;
}
// return filename
echo upload($dir);
?>
*/               
