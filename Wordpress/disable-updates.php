<?php  
// Add this to functions.php

// error reporting 0 or "E_ALL"
error_reporting(0);
// Wordpress disable all updates.
add_filter( 'automatic_updater_disabled', '__return_true' );
// or this
add_filter( 'allow_dev_auto_core_updates', '__return_false' );
add_filter( 'auto_update_plugin', '__return_false' );
add_filter( 'auto_update_theme', '__return_false' );

// show admin top toolbar in user mode
// add_filter('show_admin_bar', '__return_true');

// Allow admin panel for subscriber with Woocommerce
add_filter('woocommerce_disable_admin_bar', '_wc_disable_admin_bar', 10, 1); 
function _wc_disable_admin_bar($prevent_admin_access) { return false;} 
add_filter('woocommerce_prevent_admin_access', '_wc_prevent_admin_access', 10, 1); 
function _wc_prevent_admin_access($prevent_admin_access) { return false; }
?>
