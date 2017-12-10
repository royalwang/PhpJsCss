<?php

  // Step 1 Create wordpress admin menu with different sub menu titles
	add_action( 'admin_menu', 'blastex_plugin_menu' );

	// Step 2 menu function
	function blastex_plugin_menu() {
		// Create Submenu Page in Settings tab for administrator
		// add_options_page( 'Blastex', 'Blastex SMTP Plugin', 'manage_options', 'blastex', 'blastex_plugin_options' );		

		// Show only if administrator
	    if (current_user_can('administrator')) {		    
		    // add_submenu_page( string $parent_slug, string $page_title, string $menu_title, string $capability, string $menu_slug, callable $function = '' );
		    
        // Create top level menu for administrator
		    add_menu_page('Blastex SMTP', 'Blastex SMTP', 'manage_options', 'mymenu', 'blastex_options_page' , 'http://icons.iconarchive.com/icons/custom-icon-design/pretty-social-media/16/email-icon.png' );
		    // create sub menu page in top level menu
		    add_submenu_page( 'mymenu', 'Send email', 'Send email', 'manage_options', 'mymenu', 'blastex_options_page');
		    add_submenu_page( 'mymenu', 'About plugin', 'About plugin', 'manage_options', 'mymenu2', 'blastex_about_page');
	    }
	}

	// Step 3 submenu functions
	function blastex_options_page() {
		echo '<div class="wrap"> Hello </div>';
  }
  
  function blastex_about_page() {
		echo '<div class="wrap"> About page </div>';
  }
  
?>
