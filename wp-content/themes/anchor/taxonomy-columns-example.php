<?php
/**
 * The template for displaying Rooms Archive pages.
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package progression
 * @since progression 1.0
 */

get_header(); ?>
</div><!-- close .width-container -->
<div id="page-title">
	<div id="page-title-page"></div>
	<?php if(of_get_option('rooms_category_bg')): ?>
	<script type='text/javascript'>
	jQuery(document).ready(function($) {  
		$("#page-title-page").backstretch([
			"<?php echo of_get_option('rooms_category_bg'); ?>"
			], {duration: 8000, fade: 500});
		 });
	</script>
	<?php endif; ?>
</div><!-- #page-title -->
<div class="clearfix"></div>
<div class="width-container"><!-- leave open as it is closed in footer.php -->

<?php if(of_get_option('room_sidebar_cat', '0')): ?><div id="content-container"><?php endif; ?>
		<div class="content-container-anchor overlay-container-anchor">
		<?php if ( have_posts() ) : ?>
					<h2 class="title-anchor title-heading"><?php if(post_type_exists('rooms') ) : ?>
						<?php
							printf( __( '%s', 'progression' ), '' . single_cat_title( '', false ) . '' );
						?>
					<?php endif; ?></h2>
					<div id="category-description-rooms"><?php echo category_description( ); ?></div>
			<?php /* Start the Loop */ ?>
			<?php
			$count = 1;
			$count_2 = 1;
			 while ( have_posts() ) : the_post();
			if($count >= 4) { $count = 1; }
			 ?>
			<div class="grid3column <?php if($count == 3): echo ' lastcolumn'; endif; ?>">
				<?php get_template_part( 'content', 'rooms' ); ?>
			</div>
			<?php if($count == 3): ?><div class="clearfix"></div><?php endif; ?>
			<?php $count ++; $count_2++; endwhile; ?>
			<div class="clearfix"></div>
			<?php kriesi_pagination($pages = '', $range = 2); ?>

		<?php else : ?>
			<?php get_template_part( 'no-results', 'archive' ); ?>
		<?php endif; ?>
	</div><!-- close .content-container-anchor -->
<?php if(of_get_option('room_sidebar_cat', '0')): ?></div><!-- close #content-container --><?php endif; ?>

<?php if(of_get_option('room_sidebar_cat', '0')): ?><div id="sidebar">
	<div class="content-container-anchor overlay-container-anchor">
		<?php if ( ! dynamic_sidebar( 'rooms-1' ) ) : ?>
		<?php endif; // end sidebar widget area ?>
	</div><!-- close .content-container-anchor -->
</div><!-- close #sidebar --><?php endif; ?>
<?php get_footer(); ?>