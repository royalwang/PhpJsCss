<?php
// SET UTC time zone as default
$defaultTimeZone='UTC';
if(date_default_timezone_get()!=$defaultTimeZone) date_default_timezone_set($defaultTimeZone);

// utc timestamp
$timestamp = time();

// show date
echo date('Y-m-d h:i:s', $time);
?>
