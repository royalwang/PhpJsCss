<?php
//echo '{ "users" : [{ "firstName":"John" , "lastName":"Doe" },{ "firstName":"Anna" , "lastName":"Smith" },{ "firstName":"Peter" , "lastName":"Jones" } ]}';
// or
$user = array(
    "users" => array(
        array(
            "firstName" => "Jon",
            "lastName" => "Doe"
        ),
        array(
            "firstName" => "Alice",
            "lastName" => "Wonderland"
        ),
        array(
            "firstName" => "Yorro",
            "lastName" => "Bohaterski"
        )
    )
);
echo json_encode($user);
?>
