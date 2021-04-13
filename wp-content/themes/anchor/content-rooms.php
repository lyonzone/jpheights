<?php
/**
 * @package progression
 */
?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<div class="grid4columnbig">
		<div class="grid3column">
			<?php if(has_post_thumbnail()): ?><?php if(get_post_meta($post->ID, 'roomoptions_externallink', true)): ?><a href="<?php echo get_post_meta($post->ID, 'roomoptions_externallink', true) ?>"><?php else: ?><a href="<?php the_permalink(); ?>" rel="bookmark"><?php endif; ?><?php the_post_thumbnail('progression-rooms-thumb'); ?></a><?php endif; ?>
		</div>
		<div class="grid3columnbig lastcolumn">
			<h3><?php if(get_post_meta($post->ID, 'roomoptions_externallink', true)): ?><a href="<?php echo get_post_meta($post->ID, 'roomoptions_externallink', true) ?>"><?php else: ?><a href="<?php the_permalink(); ?>" rel="bookmark"><?php endif; ?><?php the_title(); ?></a></h3>
			<?php the_excerpt(); ?>
		</div>
		<div class="clearfix"></div>
	</div><!-- close .grid4columnbig -->
	
	<div class="grid4column lastcolumn room-list-side">
		<?php if(get_post_meta($post->ID, 'roomoptions_room-price', true)): ?><h5 class="price-rooms"><?php echo get_post_meta($post->ID, 'roomoptions_room-price', true) ?></h5><?php endif; ?>
		<?php if(get_post_meta($post->ID, 'roomoptions_room-duration', true)): ?><div class="rooms-per-night"><?php echo get_post_meta($post->ID, 'roomoptions_room-duration', true) ?></div> <?php endif; ?>
		<?php if(get_post_meta($post->ID, 'roomoptions_room-button', true)): ?><a href="<?php echo get_post_meta($post->ID, 'roomoptions_room-button-link', true) ?>" class="button-anchor"><?php echo get_post_meta($post->ID, 'roomoptions_room-button', true) ?></a><?php endif; ?>
	</div><!-- close .grid4column -->
	<div class="clearfix"></div>
</article><!-- #post-## -->

<hr><!-- line divider -->


