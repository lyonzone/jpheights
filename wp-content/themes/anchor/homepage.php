<?php
// Template Name: HomePage
/**
 *
 * @package progression
 * @since progression 1.0
 */

get_header(); ?>
	
	<!-- The featured slider is called from the header.php located in the slider-progression.php file -->
	
	<!-- display homepage widgets -->
	<?php if ( is_active_sidebar( 'homepage-widgets' ) ) : ?>
		<div class="content-container-anchor overlay-container-anchor">
			<?php dynamic_sidebar( 'homepage-widgets' ); ?>
		</div>
	<?php endif; ?>
	
	<!-- homepage widgets end -->
	
	<!-- this code pull in the homepage content -->
	<?php while(have_posts()): the_post(); ?>
		<div class="content-container-anchor <?php if ( is_active_sidebar( 'homepage-widgets' ) ) : ?><?php else : ?>overlay-container-anchor<?php endif; ?>">
			<h2 class="title-anchor"><?php the_title(); ?></h2>
				<?php the_content(); ?>	
				<!-- Homepage Child Pages Start -->
				<?php
				$args = array(
					'post_type' => 'page',
					'numberposts' => -1,
					'post' => null,
					'post_parent' => $post->ID,
				    'order' => 'ASC',
				    'orderby' => 'menu_order'
				);
				$features = get_posts($args);
				$features_count = count($features);
				if($features):
					$count = 1;
					foreach($features as $post): setup_postdata($post);
						$image_id = get_post_thumbnail_id();
						$image_url = wp_get_attachment_image_src($image_id, 'large');
						if($count >= of_get_option('child_pages_column', '3')+1) { $count = 1; }
				?>
					<div class="home-child-boxes grid<?php echo of_get_option('child_pages_column', '3'); ?>column <?php if($count == of_get_option('child_pages_column', '3')): ?>lastcolumn<?php endif; ?>">
						<?php if($image_url[0]): ?><div class="home-image"><img src="<?php echo $image_url[0]; ?>" alt="<?php the_title(); ?>"></div><?php endif; ?>
						<h4 class="home-child-title"><?php the_title(); ?></h4>
						<?php the_content(); ?>
					</div>
				<?php if($count == of_get_option('child_pages_column', '3')): ?><div class="clearfix"></div><?php endif; ?>
				<?php $count ++; endforeach; ?>
				<?php endif; ?>
				<!-- Homepage Child Pages End -->
			<div class="clearfix"></div>
		</div><!-- close .content-container-anchor -->
	<?php endwhile; ?>
	
<?php get_footer(); ?>