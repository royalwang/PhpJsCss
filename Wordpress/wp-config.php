<?php
/* Settings wordpress config */
@ini_set( 'log_errors', 'On' );
@ini_set( 'display_errors', 'On' );

define('WP_DEBUG', true);

// disable cron jobs
define('DISABLE_WP_CRON', true);

// disable all updates
define( 'AUTOMATIC_UPDATER_DISABLED', true );

// disable auto update
define( 'WP_AUTO_UPDATE_CORE', false );

// debug logs
define( 'WP_DEBUG_LOG', true );
define( 'WP_DEBUG_DISPLAY', true );
define( 'SCRIPT_DEBUG', true );
?>
