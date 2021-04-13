<?php
/**
 * @package progression
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
		<?php if(get_post_meta($post->ID, 'videoembed_videoembed', true)): ?>
			<div class="blog-featured blog-video-sensica">
				<?php echo apply_filters('the_content', get_post_meta($post->ID, 'videoembed_videoembed', true)); ?>
			</div>
		<?php endif; ?>
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
					<?php $thumbnail = wp_get_attachment_image_src($attachment->ID, 'progression-blog'); ?>
					<?php $image = wp_get_attachment_image_src($attachment->ID, 'large'); ?>
					<li><a href="<?php echo $image[0]; ?>" rel="prettyPhoto[gallery]"><img src="<?php echo $thumbnail[0]; ?>" alt="gallery-image" /></a></li>
					<?php endforeach; endif; ?>
				</ul>
			</div>
			</div>
		<?php else: ?>
		<?php if(has_post_thumbnail()): ?>
		<div class="blog-featured">
			<?php if(get_post_meta($post->ID, 'videoembed_externallink', true)): ?><a href="<?php echo get_post_meta($post->ID, 'videoembed_externallink', true) ?>"><?php else: ?><a href="<?php the_permalink(); ?>" rel="bookmark"><?php endif; ?><?php the_post_thumbnail('progression-blog'); ?></a>
		</div><!-- close .blog-featured -->
		<?php endif; ?>
		<?php endif; ?>
		
		<h3 class="entry-title"><?php if(get_post_meta($post->ID, 'videoembed_externallink', true)): ?><a href="<?php echo get_post_meta($post->ID, 'videoembed_externallink', true) ?>"><?php else: ?><a href="<?php the_permalink(); ?>" rel="bookmark"><?php endif; ?><?php the_title(); ?></a></h3>
		<?php if ( 'post' == get_post_type() ) : ?>
		<div class="post-meta">
			<?php progression_posted_on(); ?> <span>&bull;</span>
			<?php _e( 'By', 'progression' ); ?> <?php the_author_posts_link(); ?> <span>&bull;</span> 
			<?php _e( 'Posted in', 'progression' ); ?> <?php the_category(', '); ?> <span>&bull;</span> 
			<?php comments_popup_link( '<span class="leave-reply">' . __( 'No Comments', 'progression' ) . '</span>', _x( '1 Comment', 'comments number', 'progression' ), _x( '% Comments', 'comments number', 'progression' ) ); ?>
		</div><!-- .post-meta -->
		<?php endif; ?>
		
		<?php if ( is_search() ) : // Only display Excerpts for Search ?>
		<div class="index-excerpt">
			<?php the_excerpt(); ?>
		</div><!-- .index-excerpt -->
		<?php else : ?>
		<div class="index-excerpt">
			<?php the_content( __( 'Continue reading <span class="meta-nav">&raquo;</span>', 'progression' ) ); ?>
			<?php
				wp_link_pages( array(
					'before' => '<div class="page-links">' . __( 'Pages:', 'progression' ),
					'after'  => '</div>',
				) );
			?>
		</div><!-- .index-excerpt -->
		<?php endif; ?>
		<div class="clearfix"></div>
</article><!-- #post-## -->
<hr>
