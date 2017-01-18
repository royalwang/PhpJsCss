<?php
/*
 Plugin Name: Fxstar settings
 Description: Settings
 Version: 1.0
 Author: fxstar.eu
 */

// use in your template with
// $o = get_option('fx_option_name');
// $address = $o[address];

// create custom plugin settings menu
add_action('admin_menu', 'fxstar_plugin_create_menu');

function fxstar_plugin_create_menu() {

    //create new top-level menu
    add_menu_page('My Cool Plugin Settings', 'Fxstar Settings', 'administrator', __FILE__, 'fxstar_plugin_settings_page' , 'https://cdn4.iconfinder.com/data/icons/seo-and-data/500/gear-tools-settings-20.png' );

    //call register settings function
    add_action( 'admin_init', 'register_fxstar_plugin_settings' );
}


function register_fxstar_plugin_settings() {
    //register our settings
    register_setting( 'my-cool-plugin-settings-group', 'fx_option_name' );
}

function fxstar_plugin_settings_page() {
?>
<div class="wrap">
<h1>Fxstar theme settings</h1>
<p>Use in template: $options = get_option('fx_option_name');</p>

<form method="post" action="options.php">
    <?php settings_fields( 'my-cool-plugin-settings-group' ); ?>
    <?php do_settings_sections( 'my-cool-plugin-settings-group' ); ?>
    
    <?php $o = get_option('fx_option_name'); ?>
    <style type="text/css">
        #wpcontent{ background: #fff; }
        .button-primary{background: #f60 !important; color: #fff !important; text-shadow: none !important; border: 0px !important; border-radius: 0px !important}

        h1{color: #fff; background: #f60; font-weight: bold; border: 1px solid #f60; padding: 5px !important; font-weight: 300}
    </style>
    <h1>Company</h1>
    <table class="form-table">
        <tr valign="top">
        <th scope="row">Company</th>
        <td><input type="text" name="fx_option_name[company]" value="<?php echo esc_attr( $o[company] ); ?>" /></td>
        </tr>
         
        <tr valign="top">
        <th scope="row">City</th>
        <td><input type="text" name="fx_option_name[city]" value="<?php echo esc_attr( $o[city] ); ?>" /></td>
        </tr>

        <tr valign="top">
        <th scope="row">Address</th>
        <td><input type="text" name="fx_option_name[address]" value="<?php echo esc_attr( $o[address] ); ?>" /></td>
        </tr>

        <tr valign="top">
        <th scope="row">Phone</th>
        <td><input type="text" name="fx_option_name[phone]" value="<?php echo esc_attr( $o[phone] ); ?>" /></td>
        </tr>

        <tr valign="top">
        <th scope="row">Mobile</th>
        <td><input type="text" name="fx_option_name[mobile]" value="<?php echo esc_attr( $o[mobile] ); ?>" /></td>
        </tr>

        <tr valign="top">
        <th scope="row">Email</th>
        <td><input type="text" name="fx_option_name[email]" value="<?php echo esc_attr( $o[email] ); ?>" /></td>
        </tr>

        <tr valign="top">
        <th scope="row">Www <br> (http://fxstar.eu)</th>
        <td><input type="text" name="fx_option_name[www]" value="<?php echo esc_attr( $o[www] ); ?>" /></td>
        </tr>

        <tr valign="top">
        <th scope="row">Www shop (http://sklep.fxstar.eu)</th>
        <td><input type="text" name="fx_option_name[shop]" value="<?php echo esc_attr( $o[shop] ); ?>" /></td>
        </tr>

        <tr valign="top">
        <th scope="row">Map marker Lat,Lng ( 53.02119,20.88006 )</th>
        <td><input type="text" name="fx_option_name[marker]" value="<?php echo esc_attr( $o[marker] ); ?>" /></td>
        </tr>

    </table>
 

 <h1>Social links</h1>   
     <table class="form-table">

        <tr valign="top">
        <th scope="row">Youtube</th>
        <td><input type="text" name="fx_option_name[youtube]" value="<?php echo esc_attr( $o[youtube] ); ?>" /></td>
        </tr>

        <tr valign="top">
        <th scope="row">Facebook</th>
        <td><input type="text" name="fx_option_name[facebook]" value="<?php echo esc_attr( $o[facebook] ); ?>" /></td>
        </tr>
         
        <tr valign="top">
        <th scope="row">Twitter</th>
        <td><input type="text" name="fx_option_name[twitter]" value="<?php echo esc_attr( $o[twitter] ); ?>" /></td>
        </tr>

        <tr valign="top">
        <th scope="row">Pinterest</th>
        <td><input type="text" name="fx_option_name[pinterest]" value="<?php echo esc_attr( $o[pinterest] ); ?>" /></td>
        </tr>

        <tr valign="top">
        <th scope="row">Google</th>
        <td><input type="text" name="fx_option_name[google]" value="<?php echo esc_attr( $o[google] ); ?>" /></td>
        </tr>

        <tr valign="top">
        <th scope="row">Github</th>
        <td><input type="text" name="fx_option_name[github]" value="<?php echo esc_attr( $o[github] ); ?>" /></td>
        </tr>

        <tr valign="top">
        <th scope="row">Instagram</th>
        <td><input type="text" name="fx_option_name[instagram]" value="<?php echo esc_attr( $o[instagram] ); ?>" /></td>
        </tr>

        <tr valign="top">
        <th scope="row">Behance</th>
        <td><input type="text" name="fx_option_name[behance]" value="<?php echo esc_attr( $o[behance] ); ?>" /></td>
        </tr>

    </table>

    <?php submit_button(); ?>

</form>
</div>
<?php } ?>
