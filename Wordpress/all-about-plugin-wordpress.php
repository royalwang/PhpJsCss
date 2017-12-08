<?php
/*
Plugin Name:  Blastex Plugin
Plugin URI:   https://plugins.breakermind.com
Description:  Basic WordPress Plugin Header Comment
Version:      20171206
Author:       Breakermind.com
Author URI:   https://breakermind.com
License:      GPL2
License URI:  https://www.gnu.org/licenses/gpl-2.0.html
Text Domain:  blastex_wp
Domain Path:  /languages
*/

/*
License:
1) Commercial use only after 10USD Donation on PayPal account: hello@breakermind.com
2) Private use for Free (0.00 USD)
*/
ob_start();
// header('Content-Type: text/html; charset=utf-8');
defined( 'ABSPATH' ) or die( 'No script kiddies please!' );

$attachments = array( 'path/to/file1' , 'path/to/file2' );

// Get user info
// $info = get_userdata(1);

$Blastex_wp_minimalRequiredPhpVersion = '5.0';

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
	    // register_post_type( 'book', ['public' => 'true'] );
	}
	add_action( 'init', 'blastex_wp' );
	 
	function blastex_wp_install()
	{
	    // trigger our function that registers the custom post type
	    // blastex_wp_setup_post_type();
	 
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
	    function wp_mail( $to, $subject, $message, $attachments = array() ) {
	    	// Here override wp_mail function to send email from my client !!!!		

	        register_setting( 'wp_mail_settings', 'wp_mail_blastex' );	        
	        add_option('blastex_one', '1');
			update_option('blastex_one', '3');
			get_option('blastex_one');

			// Include smtp class Blastex
			require_once( dirname( __FILE__ ) . '/blastex.php' );

			// Create object
			$m = new Blastex();
			// Show logs
			$m->Debug(1);			
			// hello hostname
			$m->addHeloHost("local.host");			
				
			// Send from email
			$from = get_userdata(1)->user_email;
			$fromName = get_userdata(1)->user_name;
			if (!filter_var($from, FILTER_VALIDATE_EMAIL)) {
				return '<div class="err">Invalid From email!</div>';
			}
			// Add from
			$m->addFrom($from, $fromName);
			// Message
			$subject = $_POST['subject'];
			$msg = $_POST['msg'];
			// Add to blastex
			$m->addText("See html message!");
			$m->addHtml($msg);
			$m->addSubject($subject);

			// Recipients
			$to = $_POST['to'];
			$toList = explode(',', $to);
			foreach ($toList as $email) {				
				if (!filter_var(trim($email), FILTER_VALIDATE_EMAIL)) {
					return '<div class="err">Invalid email format</div>';
				}		
				// Blastex add to email
				// Add to
				$m->addTo($email);		
			}		

			// Add attachments
			foreach ($attachments as $file) {
				if(file_exists($file)){
					$m->addFile($file);
				}else{
					return '<div class="err">File does not exist! '.$file.'</div>';
				}
			}

			// Send email			
			$ok = $m->Send();
			if($ok == 1){
				if(function_exists('mb_convert_encoding')){
					$err = mb_convert_encoding($m->lastError, "UTF-8", "auto");
				}else{
					$err = $m->lastError;
				}
				return  '<div class="err">Email has been sent!!! '.$err.' From: ' . $from . ' To: ' . $to . '</div>';
			}else{
				if(function_exists('mb_convert_encoding')){
					$err = mb_convert_encoding($m->lastError, "UTF-8", "auto");
				}else{
					$err = $m->lastError;
				}
				return '<div class="err">Email send error! '.$err.'</div>';
			}

	    }
	}
	// add_filter( 'wp_mail', 'wp_mail' );
	 
	// dd@ddd.ddd, aaa@aaa.aaa

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
    	//require_once( dirname( __FILE__ ) . '/admin/plugin-name-admin.php' );
	    //include_once( plugin_dir_path( __FILE__ ) . 'includes/admin-functions.php' );
	} else {
	    //include_once( plugin_dir_path( __FILE__ ) . 'includes/front-end-functions.php' );
	}
}

// Add function with high priority (bigger number run later 10, next 20, then 30 ... override functions)
function my_child_theme_function() {
    // Code of your child theme function
}
add_action('after_setup_theme', 'my_child_theme_function', 20);

//plugin url
$plugin_folder_path =  dirname(__FILE__);
$wp_url = home_url();
$url = plugins_url().'/'.strtolower('blastex_wp');    
// load style css from plugin url
wp_register_style( 'style', $url.'/style.css' );
wp_enqueue_style('style');


/**
 * Registers a setting.
 */
function wpdocs_register_my_setting() {
    register_setting( 'my_options_group', 'my_option_name', 'intval' ); 
} 
add_action( 'admin_init', 'wpdocs_register_my_setting' );


/** Step 2 (from text above). */
add_action( 'admin_menu', 'blastex_wp_plugin_menu' );

/** Step 1. */
function blastex_wp_plugin_menu() {
	add_options_page( 'Blastex', 'Blastex SMTP Plugin', 'manage_options', 'blastex_wp', 'blastex_wp_plugin_options' );
}

/** Step 3. */
function blastex_wp_plugin_options() {

	echo '<div class="wrap">';

	if(!empty($_POST['send'])){	
		// Send email	
		echo wp_mail($_POST['to'], $_POST['subject'], $_POST['msg']);
	}

	if ( !current_user_can( 'manage_options' ) )  {
		wp_die( __( 'You do not have sufficient permissions to access this page.' ) );
	}
	
	echo $html = '
	<div class="box">
	<h1>Send email</h1>	
		<form method="post" action="" name="form">
		<label>Recipients (email@domena.com, email@example.org)</label>
		<input type="text" name="to" title="Recipient emails list (comma separated)">
		<label>Message subject</label>
		<input type="text" name="subject" title="Message subject">
		<label>Message text</label>
		<textarea name="msg" title="Message content html or text"></textarea>
		<input type="submit" name="send" value="Send message">	
		</form>
	</div>
	';

	echo '<div class="box">
	<h1>Blastex smtp email client plugin</h1>
	<p>Sending email without SMTP server. Enable in php.ini file sockets extension:</p>
		<code>
		;extension=php_sockets.dll <br>
		;extension=php_mbstring.dll
		</code> 
	<p> Change to </p>
		<code>
		extension=php_sockets.dll <br>
		extension=php_mbstring.dll
		</code> <br><br>	
	</div>';

	echo '</div>';
}

?>

