<?php
/**
 * The template used for displaying featured slider called from the header.php
 *
 * @package progression
 * @since progression 1.0
 */
?>
<?php
$room_type = get_the_term_list( $post->ID, 'rooms_type' );
$roomloop = new WP_Query(array(
    'paged'          => get_query_var('paged'),
    'post_type'      => 'rooms',
    'posts_per_page' => -1,
    'tax_query'      => array(
        // Note: tax_query expects an array of arrays!
        array(
            'taxonomy' => 'rooms_type', // my guess
            'field'    => 'name',
            'terms'    => $room_type
        ),
    ),
));
?>
<div id="page-title">
	<div class="flexslider" id="homepage-slider">
	<ul class="slides">
		
	<?php while ( $roomloop->have_posts() ) : $roomloop->the_post(); ?>
		<li><?php if(get_post_meta($post->ID, 'roomoptions_externallink', true)): ?><a href="<?php echo get_post_meta($post->ID, 'roomoptions_externallink', true) ?>"><?php endif; ?>
			<div class="flex-caption">
				<div class="width-container">
				<div class="slider-container">
					<div class="caption-text"><?php the_title(); ?></div>
					<?php $cc = get_the_content(); if($cc != '') { ?><div class="caption-highlight"><?php the_content(); ?></div><?php } ?>
				</div><!-- close .slider-container -->
				</div><!-- close .width-container -->
			</div><!-- close .flex-caption -->
			
			<?php if(has_post_thumbnail()): ?>
				<?php the_post_thumbnail('progression-slider'); ?>
			<?php endif; ?>
			<?php if(get_post_meta($post->ID, 'roomoptions_externallink', true)): ?></a><?php endif; ?>
		</li>
	<?php endwhile; // end of the loop. ?>
	
	</ul>
</div><!-- close .flexslider -->
</div><!-- #page-title -->
<div class="clearfix"></div>