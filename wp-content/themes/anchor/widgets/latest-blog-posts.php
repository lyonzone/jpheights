<?php
add_action('widgets_init', 'pyre_homepage_blog_load_widgets');

function pyre_homepage_blog_load_widgets()
{
	register_widget('Pyre_Latest_Blog_Media_Widget');
}

class Pyre_Latest_Blog_Media_Widget extends WP_Widget {
	
	function Pyre_Latest_Blog_Media_Widget()
	{
		$widget_ops = array('classname' => 'pyre_homepage_media', 'description' => 'Latest Blog Posts');

		$control_ops = array('id_base' => 'pyre_homepage_media-widget');

		$this->WP_Widget('pyre_homepage_media-widget', 'Progression Home: Blog Posts', $widget_ops, $control_ops);
	}
	
	function widget($args, $instance)
	{
		global $post;
		
		extract($args);
		
		$title = apply_filters('widget_title', $instance['title']);
		$categories = $instance['categories'];
		$posts = $instance['posts'];
		$columns = $instance['columns'];
		
		echo $before_widget;
	 ?>
		
		<div class="homepage-widget">
		<?php if($title): ?>
			<h2 class="title-anchor"><?php echo $title; ?></h2>
		<?php endif; ?>

		<?php 
		global $more;    // Declare global $more (before the loop).
		?>
		<?php
		$recent_posts = new WP_Query(array(
			'showposts' => $posts,
			'cat' => $categories,
			'tax_query' => array(
				array(
					'taxonomy' => 'category',
					'field' => 'slug',
					'terms' => 'blankcategory',
					'operator' => 'NOT IN'
				)
			)
		));
		if($recent_posts->have_posts()):
			$count = 1;
			$count_2 = 1;
		?>
		<?php while($recent_posts->have_posts()): $recent_posts->the_post(); 
		if($count >= $columns+1) { $count = 1; }
		?>
		<?php 
		$more = 0;       // Set (inside the loop) to display content above the more tag.
		?>
		<div class="grid<?php echo $columns; ?>column<?php if($count == $columns): echo ' lastcolumn'; endif; ?>">
			<?php get_template_part( 'content', 'blog' ); ?>
		</div>
		<?php if($count == $columns): ?><div class="clearfix"></div><?php endif; ?>
		<?php $count ++; $count_2++; endwhile; ?>
		
		<div class="clearfix"></div>
		
	
		
		</div><!-- close .homepage-widget -->
		
		<?php endif; ?>
		<?php
		echo $after_widget;
	}
	
	function update($new_instance, $old_instance)
	{
		$instance = $old_instance;
		
		$instance['title'] = $new_instance['title'];
		$instance['categories'] = $new_instance['categories'];
		$instance['posts'] = $new_instance['posts'];
		$instance['columns'] = $new_instance['columns'];
		
		return $instance;
	}

	function form($instance)
	{
		
		$defaults = array('title' => 'Latest Articles', 'categories' => 'all', 'posts' => 1, 'columns' => 1);
		$instance = wp_parse_args((array) $instance, $defaults); ?>
		<p>
			<label for="<?php echo $this->get_field_id('title'); ?>">Title:</label>
			<input class="widefat" style="width: 216px;" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" value="<?php echo $instance['title']; ?>" />
		</p>

		<p>
			<label for="<?php echo $this->get_field_id('categories'); ?>">Filter by Category:</label> 
			<select id="<?php echo $this->get_field_id('categories'); ?>" name="<?php echo $this->get_field_name('categories'); ?>" class="widefat categories" style="width:100%;">
				<option value='all' <?php if ('all' == $instance['categories']) echo 'selected="selected"'; ?>>all categories</option>
				<?php $categories = get_categories('hide_empty=0&depth=1&type=post'); ?>
				<?php foreach($categories as $category) { ?>
				<option value='<?php echo $category->term_id; ?>' <?php if ($category->term_id == $instance['categories']) echo 'selected="selected"'; ?>><?php echo $category->cat_name; ?></option>
				<?php } ?>
			</select>
		</p>
		<p>
			<label for="<?php echo $this->get_field_id('posts'); ?>">Number of posts:</label>
			<input class="widefat" style="width: 30px;" id="<?php echo $this->get_field_id('posts'); ?>" name="<?php echo $this->get_field_name('posts'); ?>" value="<?php echo $instance['posts']; ?>" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id('columns'); ?>">Number of columns (1-4):</label>
			<input class="widefat" style="width: 30px;" id="<?php echo $this->get_field_id('columns'); ?>" name="<?php echo $this->get_field_name('columns'); ?>" value="<?php echo $instance['columns']; ?>" />
		</p>
	<?php }
}
?>