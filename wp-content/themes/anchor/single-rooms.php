<?php
/**
 * The Template for displaying all single posts.
 *
 * @package progression
 * @since progression 1.0
 */

get_header(); ?>
</div><!-- close .width-container -->
<div id="page-title">
	<div id="page-title-page"></div>
	<?php if(of_get_option('rooms_posts_bg')): ?>
	<script type='text/javascript'>
	jQuery(document).ready(function($) {  
		$("#page-title-page").backstretch([
			"<?php echo of_get_option('rooms_posts_bg'); ?>"
			], {duration: 8000, fade: 500});
		 });
	</script>
	<?php endif; ?>
</div><!-- #page-title -->
<div class="clearfix"></div>
<div class="width-container"><!-- leave open as it is closed in footer.php -->
	
<?php if(of_get_option('room_sidebar_single', '1')): ?><div id="content-container"><?php endif; ?>
	<div class="content-container-anchor overlay-container-anchor">
		<?php while ( have_posts() ) : the_post(); ?>
		<h2 class="title-anchor title-heading"><?php the_title(); ?><?php if(get_post_meta($post->ID, 'roomoptions_room-price', true)): ?><span class="price-room"><?php echo get_post_meta($post->ID, 'roomoptions_room-price', true) ?> <?php if(get_post_meta($post->ID, 'roomoptions_room-duration', true)): ?><?php echo get_post_meta($post->ID, 'roomoptions_room-duration', true) ?><?php endif; ?></span><?php endif; ?></h2>
		<?php get_template_part( 'content', 'rooms_post' ); ?>
	<?php endwhile; // end of the loop. ?>
	
		<div class="clearfix"></div>
		</div><!-- close .content-container-anchor -->
<?php if(of_get_option('room_sidebar_single', '1')): ?></div><!-- close #content-container --><?php endif; ?>

<?php if(of_get_option('room_sidebar_single', '1')): ?>
	<div id="sidebar">
		<div class="content-container-anchor overlay-container-anchor">
			<?php if(get_post_meta($post->ID, 'roomoptions_sidebar_rooms_heading', true)): ?>
			<h5 class="widget-title"><?php echo get_post_meta($post->ID, 'roomoptions_sidebar_rooms_heading', true) ?></h5>
			<?php if(get_post_meta($post->ID, 'roomoptions_sidebar_rooms_content', true)): ?>
				<?php echo get_post_meta($post->ID, 'roomoptions_sidebar_rooms_content', true) ?>
			<?php endif; ?>
			<div class="sidebar-divider"></div>
			<?php endif; ?>
			<?php if ( ! dynamic_sidebar( 'rooms-1' ) ) : ?>
			<?php endif; // end sidebar widget area ?>
		</div><!-- close .content-container-anchor -->
	</div><!-- close #sidebar -->	
<?php endif; ?>
<?php get_footer(); ?>