<?php
/*
Plugin Name:  Blastex_wp Plugin
Plugin URI:   https://developer.wordpress.org/plugins/blastex_wp/
Description:  Blastex_wp example plugin
Version:      20171206
Author:       Breakermind
Author URI:   https://blastex.breakermind.com
License:      GPL2
License URI:  https://www.gnu.org/licenses/gpl-2.0.html
Text Domain:  blastex_wp
Domain Path:  /languages
*/

defined( 'ABSPATH' ) or die( 'No script kiddies please!' );

$Blastex_wp_minimalRequiredPhpVersion = '7.0';

/**
 * Check the PHP version and give a useful error message if the user's version is less than the required version
 * @return boolean true if version check passed. If false, triggers an error which WP will handle, by displaying
 * an error message on the Admin page
 */
function Blastex_wp_noticePhpVersionWrong() {
    global $Blastex_wp_minimalRequiredPhpVersion;
    echo '<div class="updated fade">' .
      __('Error: plugin "Blastex_WP" requires a newer version of PHP to be running.',  'blastex_wp').
            '<br/>' . __('Minimal version of PHP required: ', 'blastex_wp') . '<strong>' . $Blastex_wp_minimalRequiredPhpVersion . '</strong>' .
            '<br/>' . __('Your server\'s PHP version: ', 'blastex_wp') . '<strong>' . phpversion() . '</strong>' .
         '</div>';
}


function Blastex_wp_PhpVersionCheck() {
    global $Blastex_wp_minimalRequiredPhpVersion;
    if (version_compare(phpversion(), $Blastex_wp_minimalRequiredPhpVersion) < 0) {
        add_action('admin_notices', 'Blastex_wp_noticePhpVersionWrong');
        return false;
    }
    return true;
}


/**
 * Initialize internationalization (i18n) for this plugin.
 * References:
 *      http://codex.wordpress.org/I18n_for_WordPress_Developers
 *      http://www.wdmac.com/how-to-create-a-po-language-translation#more-631
 * @return void
 */
function Blastex_wp_i18n_init() {
	// Relative to WP_PLUGIN_DIR
    $pluginDir = dirname(plugin_basename(__FILE__));    
    load_plugin_textdomain('blastex_wp', false, $pluginDir . '/languages/');
}
// Initialize i18n
add_action('plugins_loaded','Blastex_wp_i18n_init');

// Run the version check.
// If it is successful, continue with initialization for this plugin
if (Blastex_wp_PhpVersionCheck()) {

	function blastex_wp()
	{
	    // register the "book" custom post type
	    register_post_type( 'book', ['public' => 'true'] );
	}
	add_action( 'init', 'blastex_wp' );
	 
	function blastex_wp_install()
	{
	    // trigger our function that registers the custom post type
	    blastex_wp_setup_post_type();
	 
	    // clear the permalinks after the post type has been registered
	    flush_rewrite_rules();
	}
	register_activation_hook( __FILE__, 'blastex_wp_install' );


	function blastex_wp_deactivation()
	{
	    // our post type will be automatically removed, so no need to unregister it
	 
	    // clear the permalinks to remove our post type's rules
	    flush_rewrite_rules();
	}
	register_deactivation_hook( __FILE__, 'blastex_wp_deactivation' );

	// uninstall plugin function 
	// or create /plugin_name/uninstall.php
	// register_uninstall_hook(__FILE__, 'blastex_wp_uninstall_function');

	//Create a function called "wporg_init" if it doesn't already exist
	if ( !function_exists( 'wp_mail' ) ) {
	    function wp_mail() {
	        register_setting( 'wp_mail_settings', 'wp_mail_blastex' );
	        
	        add_option('blastex_one', '1');
			update_option('blastex_one', '3');
			get_option('blastex_one');

	        // Here override wp_mail function to send email from my client !!!!

	    }
	}
	 
	//Create a function called if it doesn't already exist
	if ( !function_exists( 'wp_mail_blastex' ) ) {
	    function wp_mail_blastex() {
	        return get_option( 'wp_mail_blastex' );
	    }
	}

	// Include all files from plugin folder
	// foreach ( glob( plugin_dir_path( __FILE__ ) . "subfolder/*.php" ) as $file ) { include_once $file; }
	
	// Define plugin path
	define( 'BLASTEX_WP_PATH', plugin_dir_path( __FILE__ ) );

	if ( is_admin() ) {
		// we are in admin mode
    	require_once( dirname( __FILE__ ) . '/admin/plugin-name-admin.php' );
	    include_once( plugin_dir_path( __FILE__ ) . 'includes/admin-functions.php' );
	} else {
	    include_once( plugin_dir_path( __FILE__ ) . 'includes/front-end-functions.php' );
	}
}

// Add function with high priority (bigger number run later 10, next 20, then 30 ... override functions)
function my_child_theme_function() {
    // Code of your child theme function
}
add_action('after_setup_theme', 'my_child_theme_function', 20);


/**
 * Registers a setting.
 */
function wpdocs_register_my_setting() {
    register_setting( 'my_options_group', 'my_option_name', 'intval' ); 
} 
add_action( 'admin_init', 'wpdocs_register_my_setting' );

?>

<?php
/** Step 2 (from text above). */
add_action( 'admin_menu', 'blastex_wp_plugin_menu' );

/** Step 1. */
function blastex_wp_my_plugin_menu() {
	add_options_page( 'My Plugin Options', 'My Plugin', 'manage_options', 'blastex_wp', 'blastex_wp_plugin_options' );
}

/** Step 3. */
function blastex_wp_plugin_options() {
	if ( !current_user_can( 'manage_options' ) )  {
		wp_die( __( 'You do not have sufficient permissions to access this page.' ) );
	}
	echo '<div class="wrap">';
	echo '<p>Here is where the form would go if I actually had options.</p>';
	echo '</div>';
}
?>
