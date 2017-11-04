## Php smtp ssl socket client with STARTTLS
Php email client example with ssl sockets (gmail.com with authentication)

## Php
```php

<?php
// Login email and password
$login = "your-email@cool.xx";
$pass = "123456";
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
$ctx = stream_context_create();
stream_context_set_option($ctx, 'ssl', 'verify_peer', false);
stream_context_set_option($ctx, 'ssl', 'verify_peer_name', false);
try{
    // with only ssl
    // echo $socket = stream_socket_client('ssl://smtp.gmail.com:587', $err, $errstr, 
        60, STREAM_CLIENT_CONNECT, $ctx);
        
    // tcp no ssl
    echo $socket = stream_socket_client('tcp://smtp.gmail.com:587', $err, $errstr, 
        60, STREAM_CLIENT_CONNECT, $ctx);
        
    if (!$socket) {
        print "Failed to connect $err $errstr\n";
        return;
    }else{
        // Http
        // fwrite($socket, "GET / HTTP/1.0\r\nHost: www.example.com\r\nAccept: */*\r\n\r\n");
        // Smtp
        echo fread($socket,8192);
        echo fwrite($socket, "EHLO cool.xx\r\n");
        echo fread($socket,8192);
        // Start tls connection
        echo fwrite($socket, "STARTTLS\r\n");
        echo fread($socket,8192);
        
        // tcp enable tls encryption
        echo stream_socket_enable_crypto($socket, true, STREAM_CRYPTO_METHOD_SSLv23_CLIENT);
        
        // Send ehlo
        echo fwrite($socket, "EHLO cool.xx\r\n");
        echo fread($socket,8192);
        // echo fwrite($socket, "MAIL FROM: <hello@cool.com>\r\n");
        // echo fread($socket,8192);
        echo fwrite($socket, "AUTH LOGIN\r\n");
        echo fread($socket,8192);
        
        echo fwrite($socket, base64_encode($login)."\r\n");
        echo fread($socket,8192);
        echo fwrite($socket, base64_encode($pass)."\r\n");
        echo fread($socket,8192);
        echo fwrite($socket, "rcpt to: <to-email@boome.com>\r\n");
        echo fread($socket,8192);
        echo fwrite($socket, "DATA\n");
        echo fread($socket,8192);
        
        echo fwrite($socket, "Date: ".time()."\r\nTo: <to-email@boome.com>\r\nFrom:<zour-email@cool.xx\r\nSubject:Hello from php socket tls\r\n.\r\n");
        echo fread($socket,8192);
        echo fwrite($socket, "QUIT \n");
        echo fread($socket,8192);
        /* Turn off encryption for the rest */
        // stream_socket_enable_crypto($fp, false);
        fclose($socket);
    }
}catch(Exception $e){
    echo $e;
}
?>

```
