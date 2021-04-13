<?php
/**
 * The template for displaying 404 pages (Not Found).
 *
 * @package progression
 * @since progression 1.0
 */

get_header(); ?>

</div><!-- close .width-container -->

	<div id="page-title">
		<div id="page-title-page"></div>
	</div><!-- #page-title -->
	<div class="clearfix"></div>
	<div class="width-container"><!-- leave open as it is closed in footer.php -->
		
	<div id="content-container">
		<div class="content-container-anchor overlay-container-anchor">
			<h2 class="title-anchor title-heading"><?php _e( 'Oops! That page can&rsquo;t be found.', 'progression' ); ?></h2>
			<p><?php _e( 'It looks like nothing was found at this location. Maybe try one of the links below.', 'progression' ); ?></p>
			
			<?php the_widget( 'WP_Widget_Recent_Posts' ); ?>
			
			<?php if ( progression_categorized_blog() ) : // Only show the widget if site has multiple categories. ?>
				<br>
			<div class="widget widget_categories">
				<h2 class="widgettitle"><?php _e( 'Most Used Categories', 'progression' ); ?></h2>
				<ul>
				<?php
					wp_list_categories( array(
						'orderby'    => 'count',
						'order'      => 'DESC',
						'show_count' => 1,
						'title_li'   => '',
						'number'     => 10,
					) );
				?>
				</ul>
			</div><!-- .widget -->
			<Br>
			<?php endif; ?>
			
			
			<?php
			/* translators: %1$s: smiley */
			$archive_content = '<p>' . sprintf( __( 'Try looking in the monthly archives. %1$s', 'progression' ), convert_smilies( ':)' ) ) . '</p>';
			the_widget( 'WP_Widget_Archives', 'dropdown=1', "after_title=</h2>$archive_content" );
			?>
			
		</div><!-- close .content-container-anchor -->
	</div><!-- close #content-container -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>