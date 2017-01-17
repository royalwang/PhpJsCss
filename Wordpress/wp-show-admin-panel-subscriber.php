<?php
Add this to functions.php 

// Allow admin panel for subscriber with Woocommerce
add_filter('woocommerce_disable_admin_bar', '_wc_disable_admin_bar', 10, 1); 
function _wc_disable_admin_bar($prevent_admin_access) { return false;} 
add_filter('woocommerce_prevent_admin_access', '_wc_prevent_admin_access', 10, 1); 
function _wc_prevent_admin_access($prevent_admin_access) { return false; }
?>
