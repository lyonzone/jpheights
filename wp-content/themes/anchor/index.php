<?php
/**
 * The main template file.
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
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
<?php if ( have_posts() ) : ?>
			
			<?php $page_for_posts = get_option('page_for_posts'); ?>
			<h2 class="title-anchor title-heading"><?php echo get_the_title($page_for_posts); ?></h2>
			
			<?php /* Start the Loop */ ?>
			<?php while ( have_posts() ) : the_post(); ?>
				<?php
					/* Include the Post-Format-specific template for the content.
					 * If you want to overload this in a child theme then include a file
					 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
					 */
					get_template_part( 'content', get_post_format() );
				?>
			<?php endwhile; ?>
			
		<div class="clearfix"></div>
		<?php kriesi_pagination($pages = '', $range = 2); ?>
		<!--div><?php posts_nav_link(); // default tag ?></div-->
<?php elseif ( current_user_can( 'edit_posts' ) ) : ?>
	<?php get_template_part( 'no-results', 'index' ); ?>
<?php endif; ?>

</div><!-- close .content-container-anchor -->
</div><!-- close #content-container -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>