<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>CKEditor</title>
        <script src="//cdn.ckeditor.com/4.5.11/full/ckeditor.js"></script>
    </head>
    <body>
        <textarea name="editor1"></textarea>
        <script>
            CKEDITOR.replace( 'editor1' , {
                filebrowserBrowseUrl: 'browse.php?type=Files',
                filebrowserUploadUrl: 'upload.php?type=Files'
            });
        </script>
    </body>
</html>
