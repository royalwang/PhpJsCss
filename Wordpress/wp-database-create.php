<?php
// Link https://samelh.com/blog/2015/08/13/create-mysql-database-table-wordpress-insert-data-wpdb-html-form/
function elh_insert_into_db() {
 
    global $wpdb;
    // creates my_table in database if not exists
    $table = $wpdb->prefix . "my_table"; 
    $charset_collate = $wpdb->get_charset_collate();
    $sql = "CREATE TABLE IF NOT EXISTS $table (
        `id` mediumint(9) NOT NULL AUTO_INCREMENT,
        `name` text NOT NULL,
    UNIQUE (`id`)
    ) $charset_collate;";
    require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
    dbDelta( $sql );
    // starts output buffering
    ob_start();
    ?>
    <form action="#v_form" method="post" id="v_form">
        <label for="visitor_name"><h3>Hello there! What is your name?</h3></label>
        <input type="text" name="visitor_name" id="visitor_name" />
        <input type="submit" name="submit_form" value="submit" />
    </form>
    <?php
    $html = ob_get_clean();
    // does the inserting, in case the form is filled and submitted
    if ( isset( $_POST["submit_form"] ) && $_POST["visitor_name"] != "" ) {
        $table = $wpdb->prefix."my_table";
        $name = strip_tags($_POST["visitor_name"], "");
        $wpdb->insert( 
            $table, 
            array( 
                'name' => $name
            )
        );
        $html = "<p>Your name <strong>$name</strong> was successfully recorded. Thanks!!</p>";
    }
    // if the form is submitted but the name is empty
    if ( isset( $_POST["submit_form"] ) && $_POST["visitor_name"] == "" )
        $html .= "<p>You need to fill the required fields.</p>";
    // outputs everything
    return $html;
     
}
// adds a shortcode you can use: [elh-db-insert]
add_shortcode('elh-db-insert', 'elh_insert_into_db');

?>
