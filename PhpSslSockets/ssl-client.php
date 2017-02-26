<?php
// http://www.devdungeon.com/content/how-use-ssl-sockets-php
$socket = stream_socket_client("ssl://192.168.1.2:5522", $errno, $errstr);
if ($socket) {
	echo fread($socket, 2000);
}
?>

<?php
// Or
$host = '192.168.1.2';
$port = 5522;
$timeout = 30;
$cert = 'e:\www\workspace\php\sockets\server.pem'; // Path to certificate
$context = stream_context_create(
    array('ssl'=>array('local_cert'=> $cert))
);
if ($socket = stream_socket_client(
        'ssl://'.$host.':'.$port,
        $errno,
        $errstr,
        30,
        STREAM_CLIENT_CONNECT,
        $context)
) {
    fwrite($socket, "\n");
    echo fread($socket,8192);
    fclose($socket);
} else {
   echo "ERROR: $errno - $errstr\n";
}
?>
