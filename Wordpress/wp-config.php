<?php
/* Settings wordpress config */
@ini_set( 'log_errors', 'On' );
@ini_set( 'display_errors', 'On' );

define('WP_DEBUG', true);
// force SSL secure mode login
define('FORCE_SSL_ADMIN',true);
define('FORCE_SSL_LOGIN', true);
// memory limit
define('WP_MEMORY_LIMIT','512M');

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

// trash media
define( 'MEDIA_TRASH', true );

// allow all files uplad
define( 'ALLOW_UNFILTERED_UPLOADS', true );

// wp-content dont change when update
define( 'CORE_UPGRADE_SKIP_NEW_BUNDLED', true );

// default theame
// define( 'WP_DEFAULT_THEME', 'nasz-motyw' );

// dont allow change theme
// define('DISALLOW_FILE_MODS',true); 

// disable edit
// define('DISALLOW_FILE_EDIT',true);
?>

// Plik .htaccess - wp-config folder(directory)
<files wp-config.php>
    order allow,deny
    deny from all
</files>
