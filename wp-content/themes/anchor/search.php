<?php
/**
 * The template for displaying Search Results pages.
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

			<h2 class="title-anchor title-heading"><?php printf( __( 'Search Results for: %s', 'progression' ), '<span>' . get_search_query() . '</span>' ); ?></h2>
			</header><!-- .page-header -->

			<?php /* Start the Loop */ ?>
			<?php while ( have_posts() ) : the_post(); ?>

				<?php get_template_part( 'content', 'search' ); ?>

			<?php endwhile; ?>

			<?php kriesi_pagination($pages = '', $range = 2); ?>

		<?php else : ?>

			<?php get_template_part( 'no-results', 'search' ); ?>

		<?php endif; ?>
	</div><!-- close .content-container-anchor -->
</div><!-- close #content-container -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>