<?php  
// Add this to functions.php

// error reporting 0 or "E_ALL"
error_reporting(0);
// Wordpress disable all updates.
add_filter( 'allow_dev_auto_core_updates', '__return_false' );
add_filter( 'auto_update_plugin', '__return_false' );
add_filter( 'auto_update_theme', '__return_false' );

// disable all updates
add_filter( 'automatic_updater_disabled', '__return_true' );
?>
