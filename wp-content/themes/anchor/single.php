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
	<?php get_template_part( 'title', 'blog' ); ?>
</div><!-- #page-title -->
<div class="clearfix"></div>
<div class="width-container"><!-- leave open as it is closed in footer.php -->
	
<div id="content-container">
	<div class="content-container-anchor overlay-container-anchor">
		<?php $page_for_posts = get_option('page_for_posts'); ?>
		<h2 class="title-anchor title-heading"><?php echo get_the_title($page_for_posts); ?></h2>
			
	<?php while ( have_posts() ) : the_post(); ?>
		
		<?php get_template_part( 'content', 'single' ); ?>
		<?php
			// If comments are open or we have at least one comment, load up the comment template
			if ( comments_open() || '0' != get_comments_number() )
				comments_template();
		?>
		
	<?php endwhile; // end of the loop. ?>
	
		<div class="clearfix"></div>
		</div><!-- close .content-container-anchor -->
</div><!-- close #content-container -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>