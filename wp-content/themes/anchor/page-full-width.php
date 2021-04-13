<?php
// Template Name: Full Width
/**
 *
 * @package progression
 * @since progression 1.0
 */

get_header(); ?>
</div><!-- close .width-container -->

<?php while ( have_posts() ) : the_post(); ?>
	<div id="page-title">
		<div id="page-title-page"></div>
		<?php get_template_part( 'title', 'page' ); ?>
	</div><!-- #page-title -->
	<div class="clearfix"></div>
	<div class="width-container"><!-- leave open as it is closed in footer.php -->
		

		<div class="content-container-anchor overlay-container-anchor">
			<h2 class="title-anchor title-heading"><?php the_title(); ?></h2>
			<?php the_content(); ?>		
			<?php wp_link_pages( array( 'before' => '<div class="page-links">' . __( 'Pages:', 'progression' ), 'after' => '</div>' ) ); ?>
			<?php if(of_get_option('page_comments_default', '0')): ?><?php comments_template( '', true ); ?><?php endif; ?>
		</div><!-- close .content-container-anchor -->
<?php endwhile; // end of the loop. ?>

<?php get_footer(); ?>