<?php
// smsapi.pl dodaj kontakt z php api
// RESTfull API smsapi.pl
// http://dev.smsapi.pl/#!/contacts/post_contacts

// OAuthTOken do utworzenia w admin panelu
$token = "OAuthToken-generate-in-smsapi-panel";

// Add contakt to database
function addContact($params, $token, $backup = false) {
    static $content;
    // Contacts
    $url = 'https://api.smsapi.pl/contacts';
    
    // Contacts group
    // $url = 'https://api.smsapi.pl/contacts/groups';

    $c = curl_init();
    curl_setopt( $c, CURLOPT_URL, $url );
    curl_setopt( $c, CURLOPT_POST, true );
    curl_setopt( $c, CURLOPT_POSTFIELDS, http_build_query($params) );
    // curl_setopt( $c, CURLOPT_POSTFIELDS, $params );
    // curl_setopt( $c, CURLOPT_POSTFIELDS, json_encode($params) );
    curl_setopt( $c, CURLOPT_RETURNTRANSFER, true );
    curl_setopt( $c,CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt( $c, CURLOPT_HTTPHEADER, array(
       "Authorization: Bearer $token"
       // ,'Content-Type: application/x-www-form-urlencoded'
       // ,'Content-Type: application/json'
    ));

    $content = curl_exec( $c );
    $http_status = curl_getinfo($c, CURLINFO_HTTP_CODE);

    if($http_status != 200){
        echo "RESPONSE ".$http_status;
    }

    curl_close( $c );    
    return $content;
}

// Dodaj grupę
// $params = array( 'name' => 'BioCash', 'message' => 'Hello !!!' );

// Dodaj kontakt
$params = array(
     'phone_number' => '48000000000',
     'email' => "Bax@fxstar.eu",
     'first_name' => "Bax",
     'last_name' => "Baxiński",
     'gender' => 'male',
     'birthday_date' => '11-05-2017',
     'description' => 'Hello Bax',
     'city' => 'Miasteczko',
);

// Dodaj kontakt do bazy kontaktów
echo addContact($params, $token);

// ERROR 201 - ALL OK
// Add contact OK !!!
// {"id":"5919b8b9a788490628f5e2c5","first_name":"Bax","last_name":"Bax","birthday_date":"2017-05-11","phone_number":"48123123111","email":"Bax1@fxstar.eu","gender":"male","city":"Miasto","country":"Poland","date_created":"2017-05-15T16:18:33+02:00","date_updated":"2017-05-15T16:18:33+02:00","description":"Hello Bax","groups":[{"id":"59187a37a788490628f5bf99","name":"default","date_created":"2017-05-14T17:39:35+02:00","date_updated":"2017-05-14T17:39:35+02:00","description":"","created_by":"hi.mail.xx","idx":null,"contact_expire_after":null,"contacts_count":null}]}

// ERROR 409 - Kontakt istnieje
// {"message":"Contact already exists","error":"contact_conflict","code":409,"errors":[],"developer_description":null}

// ERROR 400 - Coś nie tak z nagłówkami :x trzeba dodać http_build_query($params) a nie json_encode() i bez content type: 'Content-Type: application/json'
// {"message":"Phone number or email required","error":"required_phone_number","code":400,"errors":[{"message":"Phone number or email required","error":"required_phone_number","path":"phone_number","value":null},{"message":"Phone number or email required","error":"required_email","path":"email","value":null}],"developer_description":null}

?>
