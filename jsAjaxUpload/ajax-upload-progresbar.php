$(document).ready(function (e) {

var Upload = function (file) {
    this.file = file;
};

Upload.prototype.getType = function() {
    return this.file.type;
};
Upload.prototype.getSize = function() {
    return this.file.size;
};
Upload.prototype.getName = function() {
    return this.file.name;
};
Upload.prototype.doUpload = function () {
    var that = this;
    var formData = new FormData();

    // add assoc key values, this will be posts values
    formData.append("file", this.file, this.getName());
    formData.append("upload_file", true);

    $.ajax({
        type: "POST",
        url: "upload.php",
        xhr: function () {
            var myXhr = $.ajaxSettings.xhr();
            if (myXhr.upload) {
                myXhr.upload.addEventListener('progress', that.progressHandling, false);
            }
            return myXhr;
        },
        success: function (data) {
            // your callback here
            alert(data);
            // update progressbars classes so it fits your code
            $(".progress-bar").css("width","0px");
            $(".status").text("0%");
        },
        error: function (error) {
            // handle error
        },
        async: true,
        data: formData,
        cache: false,
        contentType: false,
        processData: false,
        timeout: 60000
    });
};

Upload.prototype.progressHandling = function (event) {
    var percent = 0;
    var position = event.loaded || event.position;
    var total = event.total;
    var progress_bar_id = "#progress-wrp";
    if (event.lengthComputable) {
        percent = Math.ceil(position / total * 100);
    }
    // update progressbars classes so it fits your code
    $(progress_bar_id + " .progress-bar").css("width", +percent + "%");
    $(progress_bar_id + " .status").text(percent + "%");
};

//Change id to your id
$("#file").on("change", function (e) {
    var file = $(this)[0].files[0];
    var upload = new Upload(file);
    // maby check size or type here with upload.getSize() and upload.getType()
    // execute upload
    upload.doUpload();
});

});


/*
<!-- file input -->
<input  class="form-control" id="file" type="file" name="file">

<!-- progress bar -->
<div id="progress-wrp">
    <div class="progress-bar"></div>
    <div class="status">0%</div>
</div>

// progress style 
#progress-wrp {
	overflow: hidden;
	float: left;
	width: 98%;    
    padding: 1px;
    position: relative;
    height: 30px;
    border-radius: 3px;
    margin: 10px;
    text-align: left;
    background: #fff;
    box-shadow: inset 1px 3px 6px rgba(0, 0, 0, 0.02);
}
#progress-wrp .progress-bar{
    height: 100%;
    border-radius: 3px;
    background-color: #2fb602;
    width: 0;
    box-shadow: inset 1px 1px 10px rgba(0, 0, 0, 0.01);
}
#progress-wrp .status{
    top:3px;
    left:50%;
    position:absolute;
    display:inline-block;
    color: #000000;
}


<?php
// upload file script: upload.php
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
