<?php
// Template Name: Portfolio 3 Column
/**
 *
 * @package progression
 * @since progression 1.0
 */

get_header(); ?>

<?php while(have_posts()): the_post(); ?>
	
</div><!-- close .width-container -->
<div id="highlight-container">
	<div class="width-container">
		<?php get_template_part( 'child-page', 'navigation' ); ?>
		<h1 class="page-title"><?php the_title(); ?></h1>
		<div class="clearfix"></div>
	</div>
</div><!-- close #highlight-container -->
<div class="width-container">
	
	
	<?php $cc = get_the_content(); if($cc != '') { ?>
	<div class="content-container">
		<div class="container-spacing">		
		<?php the_content(); ?>	
		<div class="clearfix"></div>
		</div><!-- close .content-container-spacing -->
	</div><!-- close .content-container -->
	<?php } ?>
<?php endwhile; ?>



<div id="mason-layout" class="transitions-enabled fluid">
	
<?php
$port_number_posts = of_get_option('portfolio_page_posts',6);
$portfolio_type = get_the_term_list( $post->ID, 'portfolio_type' );
$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
$portfolioloop = new WP_Query(array(
	'posts_per_page' => $port_number_posts,
    'paged'          => $paged,
    'post_type'      => 'portfolio',
    'tax_query'      => array(
        // Note: tax_query expects an array of arrays!
        array(
            'taxonomy' => 'portfolio_type', // my guess
            'field'    => 'name',
            'terms'    => $portfolio_type
        )
    ),
));

?>

<?php if ( have_posts() ) : while ( $portfolioloop->have_posts() ) : $portfolioloop->the_post(); ?>
	
	<div class="boxed-mason col3">
		<?php get_template_part( 'content', 'portfolio' ); ?>
	</div>

<?php endwhile; // end of the loop. ?>




</div><!-- close #mason-layout -->
<div class="clearfix"></div>


<!-- normal pagination -->
<?php kriesi_pagination($portfolioloop->max_num_pages, $range = 2); ?>
<!-- end normal pagination -->


<?php endif; ?>



<?php if(of_get_option('page_comments_default', '0')): ?><?php comments_template( '', true ); ?><?php endif; ?>


<div class="clearfix"></div>
<?php get_footer(); ?>