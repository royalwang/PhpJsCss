<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$ctx = stream_context_create();
stream_context_set_option($ctx, 'ssl', 'verify_peer', false);
stream_context_set_option($ctx, 'ssl', 'verify_peer_name', false);
try{
    echo $socket = stream_socket_client('ssl://127.0.0.1:587', $err, $errstr, 60, STREAM_CLIENT_CONNECT, $ctx);
    if (!$socket) {
        print "Failed to connect $err $errstr\n";
        return;
    }else{
        // Http
        // fwrite($socket, "GET / HTTP/1.0\r\nHost: www.example.com\r\nAccept: */*\r\n\r\n");
        // Smtp
        echo fread($socket,8192);
        echo fwrite($socket, "Hello localhost \n");
        echo fread($socket,8192);
        echo fwrite($socket, "QUIT \n");
        echo fread($socket,8192);
        fclose($socket);    
    }
}catch(Exception $e){
    echo $e;
}
die();
?>
