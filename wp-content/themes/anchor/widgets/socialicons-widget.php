<?php
add_action('widgets_init', 'socialicons_load_widgets');

function socialicons_load_widgets()
{
	register_widget('Socialicons_Widget');
}

class Socialicons_Widget extends WP_Widget {
	
	function Socialicons_Widget()
	{
		$widget_ops = array('classname' => 'socialicons', 'description' => '');

		$control_ops = array('id_base' => 'socialicons-widget');

		$this->WP_Widget('socialicons-widget', 'Progression: Social Icons', $widget_ops, $control_ops);
	}
	
	function widget($args, $instance)
	{
		extract($args);
		$title = apply_filters('widget_title', $instance['title']);

		echo $before_widget;

		if($title) {
			echo  $before_title.$title.$after_title;
		} ?>
		<!-- social icons -->
		<div class="icons">
			<?php if(of_get_option('rss_link_widget')): ?>
			<a href="<?php echo of_get_option('rss_link_widget'); ?>" class="rss-ico" target="_blank"><div alt="f413" class="genericon genericon-feed"></div></a>
			<?php endif; ?>
			<?php if(of_get_option('facebook_link_widget')): ?>
			<a href="<?php echo of_get_option('facebook_link_widget'); ?>" class="facebook-ico" target="_blank"><div alt="f204" class="genericon genericon-facebook-alt"></div></a>
			<?php endif; ?>
			<?php if(of_get_option('twitter_link_widget')): ?>
			<a href="<?php echo of_get_option('twitter_link_widget'); ?>" class="twitter-ico" target="_blank"><div alt="f202" class="genericon genericon-twitter"></div></a>
			<?php endif; ?>
			<?php if(of_get_option('vimeo_link_widget')): ?>
			<a href="<?php echo of_get_option('vimeo_link_widget'); ?>" class="vimeo-ico" target="_blank"><div alt="f212" class="genericon genericon-vimeo"></div></a>
			<?php endif; ?>
			<?php if(of_get_option('pinterest_link_widget')): ?>
			<a href="<?php echo of_get_option('pinterest_link_widget'); ?>" class="pinterest-ico" target="_blank"><div alt="f210" class="genericon genericon-pinterest-alt"></div></a>
			<?php endif; ?>
			<?php if(of_get_option('youtube_link_widget')): ?>
			<a href="<?php echo of_get_option('youtube_link_widget'); ?>" class="youtube-ico" target="_blank"><div alt="f213" class="genericon genericon-youtube"></div></a>
			<?php endif; ?>
			<?php if(of_get_option('dribbble_link_widget')): ?>
			<a href="<?php echo of_get_option('dribbble_link_widget'); ?>" class="dribbble-ico" target="_blank"><div alt="f201" class="genericon genericon-dribbble"></div></a>
			<?php endif; ?>
			<?php if(of_get_option('wordpress_link_widget')): ?>
			<a href="<?php echo of_get_option('wordpress_link_widget'); ?>" class="wordpress-ico" target="_blank"><div alt="f205" class="genericon genericon-wordpress"></div></a>
			<?php endif; ?>
			<?php if(of_get_option('flickr_link_widget')): ?>
			<a href="<?php echo of_get_option('flickr_link_widget'); ?>" class="flickr-ico" target="_blank"><div alt="f211" class="genericon genericon-flickr"></div></a>
			<?php endif; ?>
			<?php if(of_get_option('google_link_widget')): ?>
			<a href="<?php echo of_get_option('google_link_widget'); ?>" class="google-ico" target="_blank"><div alt="f206" class="genericon genericon-googleplus"></div></a>
			<?php endif; ?>
			<?php if(of_get_option('linkedin_link_widget')): ?>
			<a href="<?php echo of_get_option('linkedin_link_widget'); ?>" class="linkedin-ico" target="_blank"><div alt="f208" class="genericon genericon-linkedin-alt"></div></a>
			<?php endif; ?>
			<?php if(of_get_option('tumblr_link_widget')): ?>
			<a href="<?php echo of_get_option('tumblr_link_widget'); ?>" class="tumblr-ico" target="_blank"><div alt="f214" class="genericon genericon-tumblr"></div></a>
			<?php endif; ?>
		</div>

		<?php echo $after_widget;
	}
	
	function update($new_instance, $old_instance)
	{
		$instance = $old_instance;

		$instance['title'] = strip_tags($new_instance['title']);

		return $instance;
	}

	function form($instance)
	{
		$defaults = array('title' => 'Social Icons');
		$instance = wp_parse_args((array) $instance, $defaults); ?>
		
		<p>
			<label for="<?php echo $this->get_field_id('title'); ?>">Title (Select icons in Theme Options):</label>
			<input class="widefat" style="width: 216px;" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" value="<?php echo $instance['title']; ?>" />
		</p>
	<?php
	}
}
?>