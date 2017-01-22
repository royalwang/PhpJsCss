<?php  
error_reporting(0);
// Wordpress disable all updates.
add_filter( 'automatic_updater_disabled', '__return_true' );
// or this
add_filter( 'allow_dev_auto_core_updates', '__return_false' );
add_filter( 'auto_update_plugin', '__return_false' );
add_filter( 'auto_update_theme', '__return_false' );

// show admin top toolbar
//add_filter('show_admin_bar', '__return_true');

// Allow admin panel for subscriber with Woocommerce
add_filter('woocommerce_disable_admin_bar', '_wc_disable_admin_bar', 10, 1); 
function _wc_disable_admin_bar($prevent_admin_access) { return false;} 
add_filter('woocommerce_prevent_admin_access', '_wc_prevent_admin_access', 10, 1); 
function _wc_prevent_admin_access($prevent_admin_access) { return false; }

?>

<?php include('func-options.php'); ?>

<?php
// remove price range in variable products
add_filter('woocommerce_variable_price_html', 'custom_variation_price', 10, 2);
function custom_variation_price( $price, $product ) {
     $price = '';
     $price .= woocommerce_price($product->get_price());
     return $price;
}

// change button text
//add_filter( 'woocommerce_product_add_to_cart_text' , 'custom_woocommerce_product_add_to_cart_text' );
function custom_woocommerce_product_add_to_cart_text() {
	global $product;
	$product_type = $product->product_type;
	switch ( $product_type ) {
		case 'external':
			return __( 'Buy product', 'woocommerce' );
		break;
		case 'grouped':
			return __( 'View products', 'woocommerce' );
		break;
		case 'simple':
			return __( 'Add to cart', 'woocommerce' );
		break;
		case 'variable':
			return __( 'Select options', 'woocommerce' );
		break;
		default:
			return __( 'Read more', 'woocommerce' );
	}
}
?>


<?php comments_template('comments.php', true); ?>

<?php
// change login logo image
function my_login_logo() { ?>
    <style type="text/css">
        #login h1 a, .login h1 a {
            background-image: url(<?php echo get_stylesheet_directory_uri(); ?>/img/citypress.png);
            padding-bottom: 5px;
        }
    </style>
<?php }
add_action( 'login_enqueue_scripts', 'my_login_logo' );
?>

<?php
// get custom length
function get_excerpt($len = 180){
$excerpt = get_the_content();
$excerpt = preg_replace(" ([.*?])",'',$excerpt);
$excerpt = strip_shortcodes($excerpt);
$excerpt = strip_tags($excerpt);
$excerpt = substr($excerpt, 0, $len);
$excerpt = $excerpt.' [...]';
//$excerpt = substr($excerpt, 0, strripos($excerpt, " "));
//$excerpt = trim(preg_replace( '/s+/', ' ', $excerpt));
//$excerpt = $excerpt.'... <a href="'.$permalink.'">more</a>';
return $excerpt;
}
?>

<?php  
// exclude category from homepage display
function exclude_category_home( $query ) {
if ( $query->is_home ) {
$query->set( 'cat', '-999, -9999' );
}
return $query;
}
add_filter( 'pre_get_posts', 'exclude_category_home' );
?>

<?php
// custom fields plugin
//require get_template_directory() . '/fields-init.php';

// add custom admin tab recommended to single product
//require get_template_directory() . '/functions-product-custom-recommended.php';

function najnowsze_posty_init()
{
    require get_template_directory() . '/new_posts/new_posts.php';
    register_widget( 'New_posts' );
}
//add_action( 'widgets_init', 'najnowsze_posty_init' );


if ( ! isset( $content_width ) ) $content_width = 900;

// load language packet lang/phonex.po and languages/de_DE.mo use loco-translate plugin
//load_theme_textdomain( 'phonex', get_template_directory() . '/lang');

/* register sidebars */
add_action( 'widgets_init', 'theme_phonex_widgets_init' );
function theme_phonex_widgets_init() {	
	register_sidebar(array(
			'name' => 'Sidebar right',
			'id' => 'sidebar-right',
			'class'         => 'nav-list',
			'description' => 'Sidebar right',
			'before_widget' => '<div class="sidebar-right">',
			'after_widget' => '</div>'
	));

	register_sidebar(array(
			'name' => 'Sidebar shop',
			'id' => 'sidebar-shop',
			'description' => 'Sidebar shop',
			'before_widget' => '<div class="sidebar-shop">',
			'after_widget' => '</div>'
	));

	register_sidebar(array(
			'name' => 'Sidebar shop search',
			'id' => 'sidebar-shop-search',
			'description' => 'Sidebar shop search',
			'before_widget' => '<div class="sidebar-shop-search">',
			'after_widget' => '</div>'
	));

	register_sidebar(array(
			'name' => 'Sidebar single post',
			'id' => 'sidebar-single-post',
			'description' => 'Sidebar single post',
			'before_widget' => '<div class="sidebar-single-post">',
			'after_widget' => '</div>'
	));

	register_sidebar(array(
			'name' => 'Sidebar social',
			'id' => 'sidebar-social',
			'description' => 'Sidebar top',
			'before_widget' => '<div class="sidebar-social">',
			'after_widget' => '</div>'
	));

	register_sidebar(array(
			'name' => 'Sidebar page',
			'id' => 'sidebar-page',
			'description' => 'Sidebar page',
			'before_widget' => '<div class="sidebar-page">',
			'after_widget' => '</div>'
	));	

	register_sidebar(array(
			'name' => 'Sidebar Ads top',
			'id' => 'sidebar-ads-top',
			'description' => 'Ads sidebar',
			'before_widget' => '<div class="sidebar-ads-top">',
			'after_widget' => '</div>'
	));		
}

function show_video(){
	// display youtube video like first image
	if ( !has_post_thumbnail() | has_post_thumbnail()) { 
	    $text = get_the_content('');
	 	$m = "";
	 	$t = "";
	 	if(preg_match_all(
	    '@(https?://)?(?:www\.)?(youtu(?:\.be/([-\w]+)|be\.com/watch\?v=([-\w]+)))\S*@im', $text, $m)){
	 		// matches found in $m
	 		$t = $m[0][0];
		}
	    $text = strip_shortcodes( $t );
		return preg_replace("/\s*[a-zA-Z\/\/:\.]*youtube.com\/watch\?v=([a-zA-Z0-9\-_]+)([a-zA-Z0-9\/\*\-\_\?\&\;\%\=\.]*)/i","<iframe width=\"560\" height=\"315\" src=\"//www.youtube.com/embed/$1\" frameborder=\"0\" allowfullscreen onload=\"resizeIframe(this)\"></iframe>",$t);
	}	
}

/* title tag */
add_action( 'after_setup_theme', 'theme_phonex_setup' );
function theme_phonex_setup() {
	add_theme_support( 'title-tag' );
}

	add_action( 'after_setup_theme', 'register_my_menu' );
	function register_my_menu() {
		register_nav_menu('primary', __( 'Primary Menu', 'phonex' ));
	}


 //print_r(get_registered_nav_menus());

/* REQUIRED feed-links */
add_theme_support( 'automatic-feed-links' );
add_theme_support( 'custom-logo' );
add_theme_support( 'custom-background' );
add_theme_support( 'custom-header' );

// featured images
add_theme_support('post-thumbnails');
set_post_thumbnail_size(600, 300, array( 'center', 'center'));
add_image_size( 'size1', 200, 150, true );
add_image_size( 'size2', 400, 300, true );
add_image_size( 'size3', 600, 400, true );
// how use in index.php 
// the_post_thumbnail( 'size1' );

// post types
add_theme_support( 'post-formats', array(
	'aside', 'image', 'video', 'quote', 'link', 'gallery', 'status', 'audio', 'chat'
));

// add woocommerce support
add_action( 'after_setup_theme', 'woocommerce_support' );
function woocommerce_support() {
    add_theme_support( 'woocommerce' );
}

// strip gallery from post
function strip_shortcode_gallery( $content ) {
    preg_match_all( '/' . get_shortcode_regex() . '/s', $content, $matches, PREG_SET_ORDER );

    if ( ! empty( $matches ) ) {
        foreach ( $matches as $shortcode ) {
            if ( 'gallery' === $shortcode[2] ) {
                $pos = strpos( $content, $shortcode[0] );
                if( false !== $pos ) {
                    return substr_replace( $content, '', $pos, strlen( $shortcode[0] ) );
                }
            }
        }
    }

    return $content;
}


/*
add_action('woocommerce_before_main_content', 'my_theme_wrapper_start', 1);
add_action('woocommerce_after_main_content', 'my_theme_wrapper_end', 1);

function my_theme_wrapper_start() {
  echo '<div id="container">';
}

function my_theme_wrapper_end() {
  echo '</div>';
}
*/

/**
 * Registers an editor stylesheet for the theme.
 */
function wpdocs_theme_add_editor_styles() {
    add_editor_style( 'editor-style.css' );
}
add_action( 'admin_init', 'wpdocs_theme_add_editor_styles' );
/*
body#tinymce.wp-editor { 
    font-family: Arial, Helvetica, sans-serif; 
    margin: 10px; 
}
 
body#tinymce.wp-editor a {
    color: #4CA6CF;
}
*/
?>

<?php
// Add product image */
function woocommerce_product_image($product) {
	 global $product;
	 $attachment_ids = $product->get_gallery_attachment_ids();
	foreach( $attachment_ids as $attachment_id ) 
	{
		return  $link = '<img src="'.wp_get_attachment_url( $attachment_id ).'">';
	}
}
?>

<?php 
// Allow custom post pages (single-post-type.php) rewrite single-gallery.php
add_filter('single_template', function($single){
  global $post;
  $post_type = get_post_format();  
  $base_name = 'single-' . $post_type . '.php';
  $template = locate_template($base_name);
  if ($template && ! empty($template)) return $template;
  return $single;
});
?>


<?php 
// FILTERS AND ACTIONS HOOKS

/* woocommerce product page add autor */
function wc_show_author_on_single_product() {
	echo "<p>Product from <strong>" . get_the_author() . "</strong><p>";
}
//add_action( 'woocommerce_single_product_summary', 'wc_show_author_on_single_product' , 15 );
?>

<?php
/* products are sold */
add_action( 'woocommerce_single_product_summary', 'wc_product_sold_count', 11 );
function wc_product_sold_count() {
	global $product;
	$units_sold = get_post_meta( $product->id, 'total_sales', true );
	echo '<p>' . sprintf( __( 'Units Sold: %s', 'phonex' ), $units_sold ) . '</p>';
}
?>

<?php
// Add save percent next to sale item prices.
add_filter( 'woocommerce_sale_price_html', 'woocommerce_custom_sales_price', 10, 2 );
function woocommerce_custom_sales_price( $price, $product ) {
	$percentage = round( ( ( $product->regular_price - $product->sale_price ) / $product->regular_price ) * 100 );
	return $price .'<span class="savetab">'. sprintf( __(' Oszczędzasz %s', 'phonex' ), $percentage . '%' ).'</span>';
}
?>

<?php
/// hoooki ('@acction', @hooked function in @action ) dla mądrej moki
// SINGLE PRODUKT PAGE
// remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_title', 5);
// remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_rating', 10);
// remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_price', 10);
// remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_excerpt', 20);
// remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_add_to_cart', 30);
// remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_meta', 40);
// remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_sharing', 50);

// SINGLE PRODUCT REMOVE TABS AND RELATED PRODUCTs
// remove_action('woocommerce_after_single_product_summary', 'woocommerce_output_product_data_tabs', 10);
 remove_action('woocommerce_after_single_product_summary', 'woocommerce_output_related_products', 20);
// ADD WITH DIFERENT POSITIONS
// add_action('woocommerce_after_single_product_summary', 'woocommerce_output_product_data_tabs', 20);
// add_action('woocommerce_after_single_product_summary', 'woocommerce_output_related_products', 10);
?>

<?php
// Override theme default specification for product # per row
function loop_columns() {
return 3; // 5 products per row
}
//add_filter('loop_shop_columns', 'loop_columns', 999);
?>

<?php 
// add floating shopping cart
function get_cart_content() {
	$content = WC()->cart->cart_contents;
	$output = '<div id="cart-box"> <a class="cart-contents" href="'.wc_get_cart_url().'"> <i class="fa fa-shopping-cart"></i> Cart '.sprintf ( _n( '%d item', '%d items', WC()->cart->get_cart_contents_count(), 'phonex' ), WC()->cart->get_cart_contents_count() ).' '.WC()->cart->get_cart_total().'</a>';
	foreach( $content as $item ) {
		// Get the image and your specified image size.
		$image = get_the_post_thumbnail($item['product_id'], 'small_thumb' );	
		$output .=' <div class="top-cart-item clearfix">
                        <div class="top-cart-item-image">
                            <a href="'. get_the_permalink($item['product_id']) .'">'. $image .'</a>
                        </div>
                        <div class="top-cart-item-desc">
                            <a href="'. get_the_permalink($item['product_id']) .'">'. get_the_title( $item['product_id'] ) .'</a>
                            <span class="top-cart-item-price">'. $item['data']->price .' </span>
                            <span class="top-cart-item-quantity">x '. $item['quantity'] .'</span>
                       </div>
                    </div>';
	}
	return $output.'</div>';
}
?>

<?php
// Ensure cart contents update when products are added to the cart via AJAX (place the following in functions.php) refresh shoping cart
add_filter('add_to_cart_fragments', 'woocommerce_header_add_to_cart_fragment'); 
function woocommerce_header_add_to_cart_fragment( $fragments ) {
	global $woocommerce;
	
	ob_start();

	$content = WC()->cart->cart_contents;
	$output = '<div id="cart-box"> <a class="cart-contents" href="'.wc_get_cart_url().'"> <i class="fa fa-shopping-cart"></i> Cart '.sprintf ( _n( '%d item', '%d items', WC()->cart->get_cart_contents_count(), 'phonex'), WC()->cart->get_cart_contents_count() ).' '.WC()->cart->get_cart_total().'</a>';
	foreach( $content as $item ) {
		// Get the image and your specified image size.
		$image = get_the_post_thumbnail($item['product_id'], 'small_thumb' );	
		$output .=' <div class="top-cart-item clearfix">
                        <div class="top-cart-item-image">
                            <a href="'. get_the_permalink($item['product_id']) .'">'. $image .'</a>
                        </div>
                        <div class="top-cart-item-desc">
                            <a href="'. get_the_permalink($item['product_id']) .'">'. get_the_title( $item['product_id'] ) .'
                            <span class="top-cart-item-price">'. $item['data']->price .' </span>
                            <span class="top-cart-item-quantity">x '. $item['quantity'] .'</span>
                       </div>
                    </div>';
	}

	echo $output;

	$fragments['a.cart-contents'] = ob_get_clean();
	return $fragments;
}
?>

<?php
// disable updates
add_filter( 'automatic_updater_disabled', '__return_true' );
add_filter( 'auto_update_core', '__return_false' );
add_filter( 'auto_update_translation', '__return_false' );
// To disable these update notification emails
add_filter( 'auto_core_update_send_email', '__return_false' );			
// Plugin update disabled
add_filter( 'auto_update_plugin', '__return_false' );
// themes updates disabled
add_filter( 'auto_update_theme', '__return_false' );

// or allow
// add_filter( 'allow_dev_auto_core_updates', '__return_true' );           // Enable development updates 
// add_filter( 'allow_minor_auto_core_updates', '__return_true' );         // Enable minor updates
// add_filter( 'allow_major_auto_core_updates', '__return_true' );         // Enable major updates
?>

<?php
// disable update notifications
add_action('after_setup_theme','remove_core_updates');
function remove_core_updates()
{
if(! current_user_can('update_core')){return;}
add_action('init', create_function('$a',"remove_action( 'init', 'wp_version_check' );"),2);
add_filter('pre_option_update_core','__return_null');
add_filter('pre_site_transient_update_core','__return_null');
}

// plugin
remove_action('load-update-core.php','wp_update_plugins');
add_filter('pre_site_transient_update_plugins','__return_null');

// all
function remove_core_updates_all(){
global $wp_version;return(object) array('last_checked'=> time(),'version_checked'=> $wp_version,);
}
add_filter('pre_site_transient_update_core','remove_core_updates_all');
add_filter('pre_site_transient_update_plugins','remove_core_updates_all');
add_filter('pre_site_transient_update_themes','remove_core_updates_all');
?>

<?php
add_action( 'pre_get_posts', 'custom_pre_get_posts_query' );

function custom_pre_get_posts_query( $q ) {

	if ( ! $q->is_main_query() ) return;
	if ( ! $q->is_post_type_archive() ) return;
	
	if ( ! is_admin() && is_shop() ) {

		$q->set( 'tax_query', array(array(
			'taxonomy' => 'product_cat',
			'field' => 'slug',
			'terms' => array( 'sale' ), // Don't display products in the knives category on the shop page
			'operator' => 'NOT IN'
		)));
	
	}

	remove_action( 'pre_get_posts', 'custom_pre_get_posts_query' );

}
?>

<?php 
// send data from post form
function prefix_send_email_to_admin() {
	// send mail here
}
//add_action( 'admin_post_nopriv_contact_form', 'prefix_send_email_to_admin' );
//add_action( 'admin_post_contact_form', 'prefix_send_email_to_admin' );

?>

<?php 
function yourtheme_woocommerce_image_dimensions() {
    global $pagenow;

    if ( ! isset( $_GET['activated'] ) || $pagenow != 'themes.php' ) {
        //return;
    }
    $catalog = array(
        'width'     => '300',   // px
        'height'    => '400',   // px
        'crop'      => array( 'center', 'top' ) // New crop options to try.
    );
    /* $single = array(
        'width'     => '600',   // px
        'height'    => '600',   // px
        'crop'      => 1        // true
    );
    $thumbnail = array(
        'width'     => '120',   // px
        'height'    => '120',   // px
        'crop'      => 0        // false
    ); */
    // Image sizes
    update_option( 'shop_catalog_image_size', $catalog );       // Product category thumbs
    /* update_option( 'shop_single_image_size', $single );      // Single product image
    update_option( 'shop_thumbnail_image_size', $thumbnail );   // Image gallery thumbs */
}
add_action( 'after_switch_theme', 'yourtheme_woocommerce_image_dimensions', 1 );
?>
