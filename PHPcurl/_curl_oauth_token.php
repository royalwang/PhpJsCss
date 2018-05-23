<?php

function sms_send($params, $token)
{

    static $content;    
    $url = 'http://localhost/_curl_oauth_api.php';

    $c = curl_init();
    curl_setopt($c, CURLOPT_URL, $url);
    curl_setopt($c, CURLOPT_POST, true);
    curl_setopt($c, CURLOPT_POSTFIELDS, $params);
    curl_setopt($c, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($c, CURLOPT_HTTPHEADER, array(
        "Authorization: Bearer $token"
    ));

    $content = curl_exec($c);
    $http_status = curl_getinfo($c, CURLINFO_HTTP_CODE);
    if ($http_status != 200) {        
        sms_send($params, $token);
    }
    curl_close($c);
    return $content;
}

$token = "wygenerowany_token"; //https://ssl.smsapi.com/webapp#/oauth/manage

$params = array(
    'to' => '900000000', //numery odbiorców rozdzielone przecinkami
    'from' => 'Info', //pole nadawcy
    'message' => "Hello world!" //treść wiadomości
);

echo sms_send($params, $token);

?>
