<?php

// Add custom page from plugis folder
add_filter( 'page_template', 'yellowpage_template' );
function yellowpage_template( $page_template )
{
    // page slug
    if ( is_page( 'yellowpage' ) ) {
        $page_template = dirname( __FILE__ ) . '/yellowpage-template.php';
    }
    return $page_template;
}
?>
