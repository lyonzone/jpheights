<?php
/**
 * The template for displaying image attachments.
 *
 * @package progression
 */

get_header();
?>
</div><!-- close .width-container -->

	<div class="content-area image-attachment">

		<?php while ( have_posts() ) : the_post(); ?>
			
			<div id="page-title">
				<div id="page-title-page"></div>
				<?php get_template_part( 'title', 'page' ); ?>
			</div><!-- #page-title -->
			<div class="clearfix"></div>
			<div class="width-container"><!-- leave open as it is closed in footer.php -->
				
				<div class="content-container-anchor overlay-container-anchor">
					
					
			<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
				<h2 class="title-anchor title-heading"><?php the_title(); ?></h2>
					<div class="post-meta">
						<?php
							$metadata = wp_get_attachment_metadata();
							printf( __( 'Published<span class="entry-date"><time class="entry-date" datetime="%1$s">%2$s</time></span>at <a href="%3$s" title="Link to full-size image">%4$s &times; %5$s</a> in <a href="%6$s" title="Return to %7$s" rel="gallery">%8$s</a>', 'progression' ),
								esc_attr( get_the_date( 'c' ) ),
								esc_html( get_the_date() ),
								wp_get_attachment_url(),
								$metadata['width'],
								$metadata['height'],
								get_permalink( $post->post_parent ),
								esc_attr( strip_tags( get_the_title( $post->post_parent ) ) ),
								get_the_title( $post->post_parent )
							);

							edit_post_link( __( 'Edit', 'progression' ), '<span class="edit-link">', '</span>' );
						?>
					<div role="navigation" id="image-navigation" class="navigation-image">
						<span class="nav-previous"><?php previous_image_link( false, __( '<span class="meta-nav">&larr;</span> Previous', 'progression' ) ); ?></span>
						<span class="nav-next"><?php next_image_link( false, __( 'Next <span class="meta-nav">&rarr;</span>', 'progression' ) ); ?></span>
					</div><!-- #image-navigation -->
				</header><!-- .entry-header -->

				<div class="index-excerpt">
					<div class="entry-attachment">
						<div class="attachment">
							<div class="blog-featured">
							<?php progression_the_attached_image(); ?>
							</div>
						</div><!-- .attachment -->

						<?php if ( has_excerpt() ) : ?>
						<div class="entry-caption">
							<?php the_excerpt(); ?>
						</div><!-- .entry-caption -->
						<?php endif; ?>
					</div><!-- .entry-attachment -->

					<?php
						the_content();
						wp_link_pages( array(
							'before' => '<div class="page-links">' . __( 'Pages:', 'progression' ),
							'after'  => '</div>',
						) );
					?>
				</div><!-- .index-excerpt -->

				<div class="entry-meta">
					<?php
						if ( comments_open() && pings_open() ) : // Comments and trackbacks open
							printf( __( '<a class="comment-link" href="#respond" title="Post a comment">Post a comment</a> or leave a trackback: <a class="trackback-link" href="%s" title="Trackback URL for your post" rel="trackback">Trackback URL</a>.', 'progression' ), get_trackback_url() );
						elseif ( ! comments_open() && pings_open() ) : // Only trackbacks open
							printf( __( 'Comments are closed, but you can leave a trackback: <a class="trackback-link" href="%s" title="Trackback URL for your post" rel="trackback">Trackback URL</a>.', 'progression' ), get_trackback_url() );
						elseif ( comments_open() && ! pings_open() ) : // Only comments open
							 _e( 'Trackbacks are closed, but you can <a class="comment-link" href="#respond" title="Post a comment">post a comment</a>.', 'progression' );
						elseif ( ! comments_open() && ! pings_open() ) : // Comments and trackbacks closed
							_e( 'Both comments and trackbacks are currently closed.', 'progression' );
						endif;

						edit_post_link( __( 'Edit', 'progression' ), ' <span class="edit-link">', '</span>' );
					?>
				</div><!-- .entry-meta -->
			</article><!-- #post-## -->
<hr>
			<?php
				// If comments are open or we have at least one comment, load up the comment template
				if ( comments_open() || '0' != get_comments_number() )
					comments_template();
			?>
		</div><!-- close #content-container -->
		<?php endwhile; // end of the loop. ?>

</div>

<?php get_footer(); ?>