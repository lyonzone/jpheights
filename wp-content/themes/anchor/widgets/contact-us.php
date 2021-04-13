<?php
add_action('widgets_init', 'our_hours_load_widgets');

function our_hours_load_widgets()
{
	register_widget('Our_Hours_Widget');
}

class Our_Hours_Widget extends WP_Widget {
	
	function Our_Hours_Widget()
	{
		$widget_ops = array('classname' => 'hours', 'description' => 'Easily create lists of contact information.');

		$control_ops = array('id_base' => 'our-hours-widget');

		$this->WP_Widget('our-hours-widget', 'Progression: Booking/Contact', $widget_ops, $control_ops);
	}
	
	function widget($args, $instance)
	{
		extract($args);
		$title = apply_filters('widget_title', $instance['title']);
		$text_contact_1 = $instance['text_contact_1'];
		$text_link_1 = $instance['text_link_1'];
		
		$text_contact_2 = $instance['text_contact_2'];
		$text_link_2 = $instance['text_link_2'];
		
		$text_contact_3 = $instance['text_contact_3'];
		$text_link_3 = $instance['text_link_3'];
		
		$text_contact_4 = $instance['text_contact_4'];
		$text_link_4 = $instance['text_link_4'];
		
		$text_contact_5 = $instance['text_contact_5'];
		$text_link_5 = $instance['text_link_5'];
		
		$text_contact_6 = $instance['text_contact_6'];
		$text_link_6 = $instance['text_link_6'];

		echo $before_widget;

		if($title) {
			echo  $before_title.$title.$after_title;
		} ?>
			

			<ul class="contact">
				<?php if($text_contact_1): ?><li><?php if($text_link_1): ?><a href="<?php echo $text_link_1; ?>"><?php endif; ?><?php echo $text_contact_1; ?><?php if($text_link_1): ?></a><?php endif; ?></li><?php endif; ?>
				<?php if($text_contact_2): ?><li><?php if($text_link_2): ?><a href="<?php echo $text_link_2; ?>"><?php endif; ?><?php echo $text_contact_2; ?><?php if($text_link_2): ?></a><?php endif; ?></li><?php endif; ?>
				<?php if($text_contact_3): ?><li><?php if($text_link_3): ?><a href="<?php echo $text_link_3; ?>"><?php endif; ?><?php echo $text_contact_3; ?><?php if($text_link_3): ?></a><?php endif; ?></li><?php endif; ?>
				<?php if($text_contact_4): ?><li><?php if($text_link_4): ?><a href="<?php echo $text_link_4; ?>"><?php endif; ?><?php echo $text_contact_4; ?><?php if($text_link_4): ?></a><?php endif; ?></li><?php endif; ?>
				<?php if($text_contact_5): ?><li><?php if($text_link_5): ?><a href="<?php echo $text_link_5; ?>"><?php endif; ?><?php echo $text_contact_5; ?><?php if($text_link_5): ?></a><?php endif; ?></li><?php endif; ?>
				<?php if($text_contact_6): ?><li><?php if($text_link_6): ?><a href="<?php echo $text_link_6; ?>"><?php endif; ?><?php echo $text_contact_6; ?><?php if($text_link_6): ?></a><?php endif; ?></li><?php endif; ?>
			</ul>
	
		
		
		<?php echo $after_widget;
	}
	
	function update($new_instance, $old_instance)
	{
		$instance = $old_instance;

		$instance['title'] = strip_tags($new_instance['title']);
		$instance['text_contact_1'] = $new_instance['text_contact_1'];
		$instance['text_link_1'] = $new_instance['text_link_1'];
		$instance['text_contact_2'] = $new_instance['text_contact_2'];
		$instance['text_link_2'] = $new_instance['text_link_2'];
		$instance['text_contact_3'] = $new_instance['text_contact_3'];
		$instance['text_link_3'] = $new_instance['text_link_3'];
		$instance['text_contact_4'] = $new_instance['text_contact_4'];
		$instance['text_link_4'] = $new_instance['text_link_4'];
		$instance['text_contact_5'] = $new_instance['text_contact_5'];
		$instance['text_link_5'] = $new_instance['text_link_5'];
		$instance['text_contact_6'] = $new_instance['text_contact_6'];
		$instance['text_link_6'] = $new_instance['text_link_6'];
		
		return $instance;
	}

	function form($instance)
	{
		$defaults = array('title' => 'Booking', 'text_contact_1' => '', 'text_link_1' => '', 'text_contact_2' => '', 'text_link_2' => '', 'text_contact_3' => '', 'text_link_3' => '', 'text_contact_4' => '', 'text_link_4' => '', 'text_contact_5' => '', 'text_link_5' => '', 'text_contact_6' => '', 'text_link_6' => '');
		$instance = wp_parse_args((array) $instance, $defaults); ?>
		
		<p>
			<label for="<?php echo $this->get_field_id('title'); ?>">Title:</label>
			<input class="widefat" style="width: 216px;" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" value="<?php echo $instance['title']; ?>" />
		</p>
		
		<p>
			<label for="<?php echo $this->get_field_id('text_contact_1'); ?>">List Item 1 Text:</label>
			<input class="widefat" style="width: 216px;" id="<?php echo $this->get_field_id('text_contact_1'); ?>" name="<?php echo $this->get_field_name('text_contact_1'); ?>" value="<?php echo $instance['text_contact_1']; ?>" />
		</p>
		
		<p>
			<label for="<?php echo $this->get_field_id('text_link_1'); ?>">List Item 1 Link:</label>
			<input class="widefat" style="width: 216px;" id="<?php echo $this->get_field_id('text_link_1'); ?>" name="<?php echo $this->get_field_name('text_link_1'); ?>" value="<?php echo $instance['text_link_1']; ?>" />
		</p>
		
		<p>
			<label for="<?php echo $this->get_field_id('text_contact_2'); ?>">List Item 2 Text:</label>
			<input class="widefat" style="width: 216px;" id="<?php echo $this->get_field_id('text_contact_2'); ?>" name="<?php echo $this->get_field_name('text_contact_2'); ?>" value="<?php echo $instance['text_contact_2']; ?>" />
		</p>

		<p>
			<label for="<?php echo $this->get_field_id('text_link_2'); ?>">List Item 2 Link:</label>
			<input class="widefat" style="width: 216px;" id="<?php echo $this->get_field_id('text_link_2'); ?>" name="<?php echo $this->get_field_name('text_link_2'); ?>" value="<?php echo $instance['text_link_2']; ?>" />
		</p>
		
		<p>
			<label for="<?php echo $this->get_field_id('text_contact_3'); ?>">List Item 3 Text:</label>
			<input class="widefat" style="width: 216px;" id="<?php echo $this->get_field_id('text_contact_3'); ?>" name="<?php echo $this->get_field_name('text_contact_3'); ?>" value="<?php echo $instance['text_contact_3']; ?>" />
		</p>

		<p>
			<label for="<?php echo $this->get_field_id('text_link_3'); ?>">List Item 3 Link:</label>
			<input class="widefat" style="width: 216px;" id="<?php echo $this->get_field_id('text_link_3'); ?>" name="<?php echo $this->get_field_name('text_link_3'); ?>" value="<?php echo $instance['text_link_3']; ?>" />
		</p>
		
		<p>
			<label for="<?php echo $this->get_field_id('text_contact_4'); ?>">List Item 4 Text:</label>
			<input class="widefat" style="width: 216px;" id="<?php echo $this->get_field_id('text_contact_4'); ?>" name="<?php echo $this->get_field_name('text_contact_4'); ?>" value="<?php echo $instance['text_contact_4']; ?>" />
		</p>

		<p>
			<label for="<?php echo $this->get_field_id('text_link_4'); ?>">List Item 4 Link:</label>
			<input class="widefat" style="width: 216px;" id="<?php echo $this->get_field_id('text_link_4'); ?>" name="<?php echo $this->get_field_name('text_link_4'); ?>" value="<?php echo $instance['text_link_4']; ?>" />
		</p>
		
		<p>
			<label for="<?php echo $this->get_field_id('text_contact_5'); ?>">List Item 5 Text:</label>
			<input class="widefat" style="width: 216px;" id="<?php echo $this->get_field_id('text_contact_5'); ?>" name="<?php echo $this->get_field_name('text_contact_5'); ?>" value="<?php echo $instance['text_contact_5']; ?>" />
		</p>

		<p>
			<label for="<?php echo $this->get_field_id('text_link_5'); ?>">List Item 5 Link:</label>
			<input class="widefat" style="width: 216px;" id="<?php echo $this->get_field_id('text_link_5'); ?>" name="<?php echo $this->get_field_name('text_link_5'); ?>" value="<?php echo $instance['text_link_5']; ?>" />
		</p>
		
		<p>
			<label for="<?php echo $this->get_field_id('text_contact_6'); ?>">List Item 6 Text:</label>
			<input class="widefat" style="width: 216px;" id="<?php echo $this->get_field_id('text_contact_6'); ?>" name="<?php echo $this->get_field_name('text_contact_6'); ?>" value="<?php echo $instance['text_contact_6']; ?>" />
		</p>

		<p>
			<label for="<?php echo $this->get_field_id('text_link_6'); ?>">List Item 6 Link:</label>
			<input class="widefat" style="width: 216px;" id="<?php echo $this->get_field_id('text_link_6'); ?>" name="<?php echo $this->get_field_name('text_link_6'); ?>" value="<?php echo $instance['text_link_6']; ?>" />
		</p>
		
	<?php
	}
}
?>