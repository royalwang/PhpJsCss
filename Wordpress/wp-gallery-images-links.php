<div id="container">
	<div id="single">
		<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>		

			<h1><?php echo the_title() ?></h1>
			<?php the_post_thumbnail('full'); ?>

	        <div id="content-single">
	        	<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	            <?php 
	            	$content = strip_shortcode_gallery( get_the_content() );                                        
            		$content = str_replace( ']]>', ']]&gt;', apply_filters( 'the_content', $content ) ); 
	            	echo $content; 
	            ?>
	            </div>
	        </div> <!-- id="content" -->

	        <div id="gallery">
	            <?php 

				$gallery = get_post_gallery( $post, false );
				$ids = explode( ",", $gallery['ids'] );
				$image_list = '<ul id="slider">';
				foreach( $ids as $id ) {
				   $link   = wp_get_attachment_url( $id );
				   if (!empty($link)) {
				   		$image_list = $image_list.'<li class="item"><img src="' . $link . '" alt="" rel="lightbox" class="showimg"></li>';
				   }				   
				} 
				echo $image_list.'</ul><div id="imgbox"></div>';

	            ?>
	        </div> <!-- id="gallery" -->
	        
			<div class="postavatar">
			<label>Autor artykułu:---</label>
			<?php echo get_avatar( get_the_author_meta( 'ID' ), 128 ); ?>
			<a class="avatarlink" href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ), get_the_author_meta( 'user_nicename' ) ); ?>">
				<?php echo get_the_author_meta('first_name').' '.get_the_author_meta('last_name').' '; ?> (<?php the_author(); ?>) </a>	
			</div>
			

		<?php endwhile; ?>	    
		<?php else: echo __("Brak nowych wiadomości", 'maxy');?>
		<?php endif; ?> 	
	</div>

	<?php //$the_query = new WP_Query( array ( 'orderby' => 'rand', 'posts_per_page' => '4', 'suppress_filters' => true, 'category_name' => 'sport') ); ?>
	<?php $the_query = new WP_Query( array ( 'orderby' => 'rand', 'posts_per_page' => '8') ); ?>
	<div id="related" style="padding: 0px; margin-bottom: 20px;">
	<h1> <?php echo __('Podobne posty', 'maxy');?></h1>
		<ul id="da-thumbs" class="da-thumbs">	
		<?php while ( $the_query->have_posts() ) : $the_query->the_post(); ?>	
			<li>
				<a href="<?php echo the_permalink() ?>">
					<?php the_post_thumbnail('size2'); ?>
					<div><span><?php echo the_title() ?></span></div>
				</a>
				<a class="comments-count animated bounce"> <i class="fa fa-comments" ></i> <?php echo get_comments_number(); ?></a>
			</li>	
	<?php 
		endwhile;
		// Reset Post Data
		wp_reset_postdata();
	?>
	</ul>
	</div>

	<div id="single">
		<h1>Komentarze</h1>
		<?php comments_template('', true); ?>	
	</div>

</div>

<div id="sidebar">

<?php do_shortcode('[fxstar_items_on]'); ?>
<?php //do_shortcode('[fxstar_search_on]'); ?>

<?php get_sidebar(); ?>
</div>
<div id="slidershop">
	<?php //echo do_shortcode("[wpcs id='238']"); ?>
</div>

<div class="navigation">
	<?php posts_nav_link(); ?>				
</div>

<style>
#imgbox{
  float: left;
  background: rgba(0,0,0,0.9);
  display: none; position: fixed; 
  top: 0px; left: 0px;
  height: 100%; width: 100%; 
  text-align: center; 
  z-index: 9999; 
  box-sizing: border-box; 
  overflow: hidden; 
}
#imgbox .imgshow{border: 10px solid #fff; float: left; overflow: hidden; box-sizing: border-box; max-height: 95%; max-width: 95%; width: auto;
  position: absolute;
  left: 50%;
  top: 50%;
  transform: translate(-50%, -50%);  
}
#gallery{margin: 0 auto; width: 100%; overflow: hidden;}
.gallery-item{padding: 10px; border: 0px;}
.gallery-item .gallery-icon a img{border: 0px;}
#gallery #slider{float: left; width: 100%; overflow: hidden; padding: 0px;}
#gallery #slider li{ float: left; padding: 5px; max-width: 25%; box-sizing: border-box; float: left; display: inline-block; overflow: hidden;}
#gallery #slider li img{ width: 100%; border: 0px;}
</style>
