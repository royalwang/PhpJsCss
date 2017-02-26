<?php
// http://www.devdungeon.com/content/how-use-ssl-sockets-php
// Get port and IP address
$service_port = getservbyname('www', 'tcp');
$address = gethostbyname('www.google.com');

// Bind socket
$socket = socket_create(AF_INET, SOCK_STREAM, SOL_TCP);
if ($socket === false) {
    echo "socket_create() failed: reason: " . socket_strerror(socket_last_error()) . "\n";
}

// Connect
$result = socket_connect($socket, $address, $service_port);
if ($result === false) {
    echo "socket_connect() failed.\nReason: ($result) " . socket_strerror(socket_last_error($socket)) . "\n";
}

// Create HTTP request
$in = "HEAD / HTTP/1.1\r\n";
$in .= "Host: www.google.com\r\n";
$in .= "Connection: Close\r\n\r\n";
$out = '';

// Send HTTP request
socket_write($socket, $in, strlen($in));

// Read and output response
while ($out = socket_read($socket, 2048)) {
    echo $out;
}

// Close socket
socket_close($socket);
?>
