<?php
add_action('widgets_init', 'pyre_homepage_portfolio_load_widgets');

function pyre_homepage_portfolio_load_widgets()
{
	register_widget('Pyre_Latest_Portfolio_Media_Widget');
}

class Pyre_Latest_Portfolio_Media_Widget extends WP_Widget {
	
	function Pyre_Latest_Portfolio_Media_Widget()
	{
		$widget_ops = array('classname' => 'pyre_homepage_media-port', 'description' => 'Latest Room Posts');

		$control_ops = array('id_base' => 'pyre_homepage_media-widget-port');

		$this->WP_Widget('pyre_homepage_media-widget-port', 'Progression Home: Room Posts ', $widget_ops, $control_ops);
	}
	
	function widget($args, $instance)
	{
		global $post;
		
		extract($args);
		
		$title = apply_filters('widget_title', $instance['title']);
		$posts = $instance['posts'];
		$columns = $instance['columns'];
		$portfolioslug = $instance['portfolioslug'];
		
		echo $before_widget;
	 ?>
		
		
		
			
		<div class="homepage-widget">
		<?php if($title): ?>
			<h2 class="title-anchor"><?php echo $title; ?></h2>
		<?php endif; ?>

		<?php
		$portfolio_type = get_post_meta($post->ID, 'pyre_portfolio_type', true);
		$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
		$args = array(
			'showposts' => $posts,
			'post_type' => 'rooms',
			'tax_query' => array(
				array(
					'taxonomy' => 'rooms_type',
					'field' => 'slug',
					'terms' => $portfolioslug,
				)
			),
			'paged' => $paged
		);
		$portfolio = new WP_Query($args);
		$portfolio_count = $portfolio->post_count;
		$count = 1;
		$count_2 = 1;
		while($portfolio->have_posts()): $portfolio->the_post();
			if($count >= $columns+1) { $count = 1; }
		?>
		<div class="home-child-boxes grid<?php echo $columns; ?>column<?php if($count == $columns): echo ' lastcolumn'; endif; ?>">
			<?php if(has_post_thumbnail()): ?><div class="home-image"><a href="<?php the_permalink(); ?>"><?php the_post_thumbnail('progression-rooms-single'); ?></a></div><?php endif; ?>
			<h4 class="home-child-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>
			<?php the_excerpt(); ?>
		</div><!-- close .grid -->
		<?php if($count == $columns): ?><div class="clearfix"></div><?php endif; ?>
		<?php $count ++; $count_2++; endwhile; ?>
		
		<div class="clearfix"></div>
		</div><!-- close .homepage-widget -->
	
			
		<?php
		echo $after_widget;
	}
	
	function update($new_instance, $old_instance)
	{
		$instance = $old_instance;
		
		$instance['title'] = $new_instance['title'];
		$instance['posts'] = $new_instance['posts'];
		$instance['columns'] = $new_instance['columns'];
		$instance['portfolioslug'] = $new_instance['portfolioslug'];
		
		return $instance;
	}

	function form($instance)
	{
		
		$defaults = array('title' => 'Featured Packages', 'posts' => 3, 'columns' => 3, 'portfolioslug' => 'featured');
		$instance = wp_parse_args((array) $instance, $defaults); ?>
		<p>
			<label for="<?php echo $this->get_field_id('title'); ?>">Title:</label>
			<input class="widefat" style="width: 216px;" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" value="<?php echo $instance['title']; ?>" />
		</p>
		

		
		<p>
			<label for="<?php echo $this->get_field_id('posts'); ?>">Number of posts:</label>
			<input class="widefat" style="width: 30px;" id="<?php echo $this->get_field_id('posts'); ?>" name="<?php echo $this->get_field_name('posts'); ?>" value="<?php echo $instance['posts']; ?>" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id('columns'); ?>">Number of columns (2-4):</label>
			<input class="widefat" style="width: 30px;" id="<?php echo $this->get_field_id('columns'); ?>" name="<?php echo $this->get_field_name('columns'); ?>" value="<?php echo $instance['columns']; ?>" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id('portfolioslug'); ?>">Room Category Slug:</label>
			<input class="widefat" style="width: 216px;" id="<?php echo $this->get_field_id('portfolioslug'); ?>" name="<?php echo $this->get_field_name('portfolioslug'); ?>" value="<?php echo $instance['portfolioslug']; ?>" />
		</p>
	<?php }
}
?>