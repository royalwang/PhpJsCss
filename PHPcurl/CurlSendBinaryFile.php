<form method="post" action="index.php" enctype="multipart/form-data">
    <input name="file" type="file" />
    <input type="submit" value="Upload" />
</form>

<?php
// Send binary content
$url = 'http://some-server.com/api';
$header = array('Content-Type: multipart/form-data');
$fields = array('file' => '@' . $_FILES['file']['tmp_name'][0]);
$token = 'NfxoS9oGjA6MiArPtwg4aR3Cp4ygAbNA2uv6Gg4m';
 
$resource = curl_init();
curl_setopt($resource, CURLOPT_URL, $url);
curl_setopt($resource, CURLOPT_HTTPHEADER, $header);
curl_setopt($resource, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($resource, CURLOPT_POST, 1);
curl_setopt($resource, CURLOPT_POSTFIELDS, $fields);
curl_setopt($resource, CURLOPT_COOKIE, 'apiToken=' . $token);
$result = json_decode(curl_exec($resource));
curl_close($resource);


// Retrieve the binary contents via cURL
$resource = curl_init();
curl_setopt($resource, CURLOPT_URL, $url);
curl_setopt($resource, CURLOPT_HEADER, 1);
curl_setopt($resource, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($resource, CURLOPT_BINARYTRANSFER, 1);
curl_setopt($resource, CURLOPT_COOKIE, 'apiToken=' . $token);
$file = curl_exec($resource);
curl_close($resource);

// Give the file back to the user
$file_array = explode("\n\r", $file, 2);
$header_array = explode("\n", $file_array[0]);
foreach($header_array as $header_value) {
    $header_pieces = explode(':', $header_value);
    if(count($header_pieces) == 2) {
        $headers[$header_pieces[0]] = trim($header_pieces[1]);
    }
}
header('Content-type: ' . $headers['Content-Type']);
header('Content-Disposition: ' . $headers['Content-Disposition']);
echo substr($file_array[1], 1);

// tutorial from here: 
// http://ryansechrest.com/2012/07/send-and-receive-binary-files-using-php-and-curl/

?>
