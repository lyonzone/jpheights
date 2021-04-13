<?php
/**
 * @package progression
 */
?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<?php if(get_post_meta($post->ID, 'roomoptions_videoembed', true)): ?>
		<div class="room-featured blog-video-sensica">
			<?php echo apply_filters('the_content', get_post_meta($post->ID, 'roomoptions_videoembed', true)); ?>
		</div>
	<?php else: ?>
	<?php if( has_post_format( 'gallery' ) ): ?>
		<div class="room-featured">
		<div class="flexslider gallery-anchor">
	      	<ul class="slides">
				<?php
				$args = array(
				    'post_type' => 'attachment',
				    'numberposts' => '-1',
				    'post_status' => null,
				    'post_parent' => $post->ID,
					'orderby' => 'menu_order',
					'order' => 'ASC'
				);
				$attachments = get_posts($args);
				?>
				<?php 
				if($attachments):
				    foreach($attachments as $attachment):
				?>
				<?php $thumbnail = wp_get_attachment_image_src($attachment->ID, 'progression-rooms-single'); ?>
				<?php $image = wp_get_attachment_image_src($attachment->ID, 'large'); ?>
				<li><a href="<?php echo $image[0]; ?>" rel="prettyPhoto[gallery]"><img src="<?php echo $thumbnail[0]; ?>" alt="gallery-image" /></a></li>
				<?php endforeach; endif; ?>
			</ul>
		</div>
		</div>
	<?php else: ?>
	<?php if(has_post_thumbnail()): ?>
	<div class="blog-featured">
		<?php $image = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), 'large'); ?>
		<a href="<?php echo $image[0]; ?>" rel="prettyPhoto"><?php the_post_thumbnail('progression-rooms-single'); ?></a>
	</div><!-- close .blog-featured -->
	<?php endif; ?>
	<?php endif; ?>
	<?php endif; ?>
	
	<div class="index-excerpt">
		<?php the_content(); ?>
		
		<?php
			wp_link_pages( array(
				'before' => '<div class="page-links">' . __( 'Pages:', 'progression' ),
				'after'  => '</div>',
			) );
		?>
	</div><!-- .entry-content -->
</article><!-- #post-## -->
