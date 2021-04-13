<?php
/**
 * A unique identifier is defined to store the options in the database and reference them from the theme.
 * By default it uses the theme name, in lowercase and without spaces, but this can be changed if needed.
 * If the identifier changes, it'll appear as if the options have been reset.
 */

function optionsframework_option_name() {

	// This gets the theme name from the stylesheet
	$themename = get_option( 'stylesheet' );
	$themename = preg_replace("/\W/", "_", strtolower($themename) );

	$optionsframework_settings = get_option( 'optionsframework' );
	$optionsframework_settings['id'] = $themename;
	update_option( 'optionsframework', $optionsframework_settings );
}

/**
 * Defines an array of options that will be used to generate the settings page and be saved in the database.
 * When creating the 'id' fields, make sure to use all lowercase and no spaces.
 *
 * If you are making your theme translatable, you should replace 'progression'
 * with the actual text domain for your theme.  Read more:
 * http://codex.wordpress.org/Function_Reference/load_theme_textdomain
 */

function optionsframework_options() {

	// Test data
	$animations = array(
		'fade' => __('Fade', 'progression'),
		'slide' => __('Slide', 'progression')
	);
	

	
	$animation_true = array(
		'true' => __('On', 'progression'),
		'false' => __('Off', 'progression')
	);
	

	// Multicheck Array
	$multicheck_array = array(
		'one' => __('French Toast', 'progression'),
		'two' => __('Pancake', 'progression'),
		'three' => __('Omelette', 'progression'),
		'four' => __('Crepe', 'progression'),
		'five' => __('Waffle', 'progression')
	);

	// Multicheck Defaults
	$multicheck_defaults = array(
		'one' => '1',
		'five' => '1'
	);

	// Background Defaults
	$background_defaults = array(
		'color' => '',
		'image' => '',
		'repeat' => 'repeat',
		'position' => 'top center',
		'attachment'=>'scroll' );

	// Typography Defaults
	$typography_defaults = array(
		'size' => '15px',
		'face' => 'georgia',
		'style' => 'bold',
		'color' => '#bada55' );
		
	// Typography Options
	$typography_options = array(
		'sizes' => array( '6','12','14','16','20' ),
		'faces' => array( 'Helvetica Neue' => 'Helvetica Neue','Arial' => 'Arial' ),
		'styles' => array( 'normal' => 'Normal','bold' => 'Bold' ),
		'color' => false
	);

	// Pull all the categories into an array
	$options_categories = array();
	$options_categories_obj = get_categories();
	foreach ($options_categories_obj as $category) {
		$options_categories[$category->cat_ID] = $category->cat_name;
	}
	
	// Pull all tags into an array
	$options_tags = array();
	$options_tags_obj = get_tags();
	foreach ( $options_tags_obj as $tag ) {
		$options_tags[$tag->term_id] = $tag->name;
	}


	// Pull all the pages into an array
	$options_pages = array();
	$options_pages_obj = get_pages('sort_column=post_parent,menu_order');
	$options_pages[''] = 'Select a page:';
	foreach ($options_pages_obj as $page) {
		$options_pages[$page->ID] = $page->post_title;
	}

	// If using image radio buttons, define a directory path
	$imagepath =  get_template_directory_uri() . '/images/';

	$options = array();

	$options[] = array(
		'name' => __('Basic', 'progression'),
		'type' => 'heading');
		
	
	$options[] = array(
		'name' => __('Copyright', 'progression'),
		'desc' => __('Choose your copyright text here. ', 'progression'),
		'id' => 'copyright_textarea',
		'std' => '&copy; 2013 All Rights Reserved.  Developed by Progression Studios',
		'type' => 'textarea');
	
	
	$options[] = array(
		'name' => __('Header Contact Information', 'progression'),
		'desc' => __('Choose your contact text here that displays in the header. ', 'progression'),
		'id' => 'contact_text',
		'std' => '<strong>Address:</strong> <em>156 University Ave. Palo Alto, Ca</em>  &nbsp;&nbsp; <strong>Reservation Line:</strong> <em>1-800-244-2525</em>',
		'type' => 'textarea');
	

	$options[] = array(
		'name' => __('Display Sidebar on Blog, Archives, and Search', 'progression'),
		'desc' => __('Select this checkbox to display the sidebar in the blog pages.', 'progression'),
		'id' => 'blog_sidebar',
		'std' => '1',
		'type' => 'checkbox');
	
	
	$options[] = array(
		'name' => __('Display Sidebar on Blog Post pages', 'progression'),
		'desc' => __('Select this checkbox to display the sidebar in the blog post pages.', 'progression'),
		'id' => 'blog_sidebar_single',
		'std' => '1',
		'type' => 'checkbox');	
	
	
	$options[] = array(
		'name' => __('Display Comments on Pages', 'progression'),
		'desc' => __('Select this checkbox to enable the comments on pages.  Once selected you can also manually enable/disable comments on a page-by-page basis via the Discussion Screen Option.', 'progression'),
		'id' => 'page_comments_default',
		'std' => '0',
		'type' => 'checkbox');
	
	
	$options[] = array(
		'name' => __('Footer Widget Column Count', 'progression'),
		'desc' => __('Choose how many columns you want to use for our footer widgets (1-4 Columns).', 'progression'),
		'id' => 'footer_widgets_column',
		'std' => '4',
		'class' => 'mini',
		'type' => 'text');
	
	$options[] = array(
		'name' => __('Homepage Child page Column Count', 'progression'),
		'desc' => __('Choose how many columns you want to use if using child pages on homepage (1-4 Columns).', 'progression'),
		'id' => 'child_pages_column',
		'std' => '3',
		'class' => 'mini',
		'type' => 'text');
	
	
	$options[] = array(
		'name' => __('Rooms', 'progression'),
		'type' => 'heading');
	
	
	$options[] = array(
		'name' => __('Rooms Posts Per Page', 'progression'),
		'desc' => __('Choose how many room posts show per page.', 'progression'),
		'id' => 'room_page_posts',
		'std' => '12',
		'class' => 'mini',
		'type' => 'text');
	
	$options[] = array(
		'name' => __('Display Sidebar on Room Category List', 'progression'),
		'desc' => __('Select this checkbox to display the sidebar in the room category pages.', 'progression'),
		'id' => 'room_sidebar_cat',
		'std' => '0',
		'type' => 'checkbox');

	$options[] = array(
		'name' => __('Display Sidebar on Room Post pages', 'progression'),
		'desc' => __('Select this checkbox to display the sidebar in the room post pages.', 'progression'),
		'id' => 'room_sidebar_single',
		'std' => '1',
		'type' => 'checkbox');
	
	
		

	
	$options[] = array(
		'name' => __('Background Image on Rooms Category', 'progression'),
		'desc' => __('Use the upload button to add your your page title background.', 'progression'),
		'id' => 'rooms_category_bg',
		"std" => "",
		'type' => 'upload');

	
	$options[] = array(
		'name' => __('Background Image on Rooms Posts', 'progression'),
		'desc' => __('Use the upload button to add your your page title background.', 'progression'),
		'id' => 'rooms_posts_bg',
		"std" => "",
		'type' => 'upload');
	

	
	
	
	
	
	

		
		
	$options[] = array(
		'name' => __('Social', 'progression'),
		'type' => 'heading');
		
		
	$options[] = array(
		'name' => __('Header Social Icons', 'progression'),
		'desc' => __('These icons will display in the header of your theme.  Leave the text area blank and the icon will disappear automatically.', 'progression'),
		'type' => 'info');
	
	
	$options[] = array(
		'name' => __('RSS Link', 'progression'),
		'desc' => __('Social Icon will display/hide automatically in the header & footer.', 'progression'),
		'id' => 'rss_link',
		'std' => '',
		'type' => 'text');


	$options[] = array(
		'name' => __('Facebook Link', 'progression'),
		'desc' => __('Social Icon will display/hide automatically in the header & footer.', 'progression'),
		'id' => 'facebook_link',
		'std' => '',
		'type' => 'text');

	$options[] = array(
		'name' => __('Twitter Link', 'progression'),
		'desc' => __('Social Icon will display/hide automatically in the header & footer.', 'progression'),
		'id' => 'twitter_link',
		'std' => '',
		'type' => 'text');

	$options[] = array(
		'name' => __('Vimeo Link', 'progression'),
		'desc' => __('Social Icon will display/hide automatically in the header & footer.', 'progression'),
		'id' => 'vimeo_link',
		'std' => '',
		'type' => 'text');


	$options[] = array(
		'name' => __('Pinterest Link', 'progression'),
		'desc' => __('Social Icon will display/hide automatically in the header & footer.', 'progression'),
		'id' => 'pinterest_link',
		'std' => '',
		'type' => 'text');


	$options[] = array(
		'name' => __('Youtube Link', 'progression'),
		'desc' => __('Social Icon will display/hide automatically in the header & footer.', 'progression'),
		'id' => 'youtube_link',
		'std' => '',
		'type' => 'text');	


	$options[] = array(
		'name' => __('Dribbble Link', 'progression'),
		'desc' => __('Social Icon will display/hide automatically in the header & footer.', 'progression'),
		'id' => 'dribbble_link',
		'std' => '',
		'type' => 'text');


	$options[] = array(
		'name' => __('WordPress Link', 'progression'),
		'desc' => __('Social Icon will display/hide automatically in the header & footer.', 'progression'),
		'id' => 'wordpress_link',
		'std' => '',
		'type' => 'text');


	$options[] = array(
		'name' => __('Flickr Link', 'progression'),
		'desc' => __('Social Icon will display/hide automatically in the header & footer.', 'progression'),
		'id' => 'flickr_link',
		'std' => '',
		'type' => 'text');


	$options[] = array(
		'name' => __('Google Link', 'progression'),
		'desc' => __('Social Icon will display/hide automatically in the header & footer.', 'progression'),
		'id' => 'google_link',
		'std' => '',
		'type' => 'text');


	$options[] = array(
		'name' => __('LinkedIn Link', 'progression'),
		'desc' => __('Social Icon will display/hide automatically in the header & footer.', 'progression'),
		'id' => 'linkedin_link',
		'std' => '',
		'type' => 'text');


	$options[] = array(
		'name' => __('Tumblr Link', 'progression'),
		'desc' => __('Social Icon will display/hide automatically in the header & footer.', 'progression'),
		'id' => 'tumblr_link',
		'std' => '',
		'type' => 'text');

	$options[] = array(
		'name' => __('Footer/Widget Social Icons', 'progression'),
		'desc' => __('These icons will display in the footer of your theme (And Social Icons Widget).  Leave the text area blank and the icon will disappear automatically.', 'progression'),
		'type' => 'info');

	$options[] = array(
		'name' => __('RSS Link', 'progression'),
		'desc' => __('Social Icon will display/hide automatically in the header & footer.', 'progression'),
		'id' => 'rss_link_widget',
		'std' => '',
		'type' => 'text');


	$options[] = array(
		'name' => __('Facebook Link', 'progression'),
		'desc' => __('Social Icon will display/hide automatically in the header & footer.', 'progression'),
		'id' => 'facebook_link_widget',
		'std' => '',
		'type' => 'text');

	$options[] = array(
		'name' => __('Twitter Link', 'progression'),
		'desc' => __('Social Icon will display/hide automatically in the header & footer.', 'progression'),
		'id' => 'twitter_link_widget',
		'std' => '',
		'type' => 'text');

	$options[] = array(
		'name' => __('Vimeo Link', 'progression'),
		'desc' => __('Social Icon will display/hide automatically in the header & footer.', 'progression'),
		'id' => 'vimeo_link_widget',
		'std' => '',
		'type' => 'text');


	$options[] = array(
		'name' => __('Pinterest Link', 'progression'),
		'desc' => __('Social Icon will display/hide automatically in the header & footer.', 'progression'),
		'id' => 'pinterest_link_widget',
		'std' => '',
		'type' => 'text');


	$options[] = array(
		'name' => __('Youtube Link', 'progression'),
		'desc' => __('Social Icon will display/hide automatically in the header & footer.', 'progression'),
		'id' => 'youtube_link_widget',
		'std' => '',
		'type' => 'text');	


	$options[] = array(
		'name' => __('Dribbble Link', 'progression'),
		'desc' => __('Social Icon will display/hide automatically in the header & footer.', 'progression'),
		'id' => 'dribbble_link_widget',
		'std' => '',
		'type' => 'text');


	$options[] = array(
		'name' => __('WordPress Link', 'progression'),
		'desc' => __('Social Icon will display/hide automatically in the header & footer.', 'progression'),
		'id' => 'wordpress_link_widget',
		'std' => '',
		'type' => 'text');


	$options[] = array(
		'name' => __('Flickr Link', 'progression'),
		'desc' => __('Social Icon will display/hide automatically in the header & footer.', 'progression'),
		'id' => 'flickr_link_widget',
		'std' => '',
		'type' => 'text');


	$options[] = array(
		'name' => __('Google Link', 'progression'),
		'desc' => __('Social Icon will display/hide automatically in the header & footer.', 'progression'),
		'id' => 'google_link_widget',
		'std' => '',
		'type' => 'text');


	$options[] = array(
		'name' => __('LinkedIn Link', 'progression'),
		'desc' => __('Social Icon will display/hide automatically in the header & footer.', 'progression'),
		'id' => 'linkedin_link_widget',
		'std' => '',
		'type' => 'text');


	$options[] = array(
		'name' => __('Tumblr Link', 'progression'),
		'desc' => __('Social Icon will display/hide automatically in the header & footer.', 'progression'),
		'id' => 'tumblr_link_widget',
		'std' => '',
		'type' => 'text');
	
	
	
	
	
	$options[] = array(
		'name' => __('Appearance', 'progression'),
		'type' => 'heading');
	
	$options[] = array(
		'name' => __('Logo', 'progression'),
		'desc' => __('Use the upload button to upload your sites logo and then click <strong>Use this image</strong>.', 'progression'),
		'id' => 'logo',
		"std" => get_template_directory_uri() . "/images/logo.png",
		'type' => 'upload');
	
	
	$options[] = array(
		'name' => __('Logo Width', 'progression'),
		'desc' => __('Choose your logo width in pixels.  Default is 116.', 'progression'),
		'id' => 'logo_width',
		'std' => '116',
		'class' => 'mini',
		'type' => 'text');
	

	
	$options[] = array(
		'name' => __('FavIcon', 'progression'),
		'desc' => __('Use the upload button to upload your favicon (bookmark icon) and then click <strong>Use this image</strong>.', 'progression'),
		'id' => 'favicon',
		'type' => 'upload');
	
	

	
	$options[] = array(
		'name' => __('Main Body Font', 'progression'),
		'desc' => __('Choose a Main Body Font. Default font is <strong>Helvetica Neue</strong>', 'progression'),
		'id' => 'main_font',
		'std' => 'Helvetica Neue',
		'class' => 'mini',
		'type' => 'text');

	
	$options[] = array(
		'name' => __('Custom Font', 'progression'),
		'desc' => __('Choose the custom font used in the theme.  Default font is <strong>Tinos</strong>', 'progression'),
		'id' => 'navigation_font',
		'std' => 'Tinos',
		'class' => 'mini',
		'type' => 'text');
	
	
	

	$options[] = array(
		'name' => __('Tools', 'progression'),
		'type' => 'heading');
	
	

		
	
	$options[] = array(
		'name' => __('Tracking Code', 'progression'),
		'desc' => __('Paste your tracking code here e.g. Google Analytics etc... without &lt;script&gt; &lt;/script&gt; tags.', 'progression'),
		'id' => 'tracking_code',
		'std' => '',
		'type' => 'textarea');
		
	
	$options[] = array(
		'name' => __('Custom CSS Code', 'progression'),
		'desc' => __('Paste custom JavaScript code here without &lt;style&gt;&lt;/style&gt; tags.', 'progression'),
		'id' => 'custom_css',
		'std' => '',
		'type' => 'textarea');
	
	
	$options[] = array(
		'name' => __('Custom Javascript Code', 'progression'),
		'desc' => __('Paste custom JavaScript code here without &lt;script&gt;&lt;s/cript&gt; tags.', 'progression'),
		'id' => 'custom_js',
		'std' => '',
		'type' => 'textarea');
	
	$options[] = array(
		'name' => __('Slider', 'progression'),
		'type' => 'heading');
	
	

	$options[] = array(
		'name' => __('Featured Slider Animation', 'progression'),
		'desc' => __('Choose your slider animation between fade and slide.', 'progression'),
		'id' => 'slider_animation',
		'std' => 'fade',
		'type' => 'select',
		'class' => 'mini', //mini, tiny, small
		'options' => $animations);
		

	$options[] = array(
		'name' => __('Featured Slider Autoplay', 'progression'),
		'desc' => __('Choose to have your slide show autoplay or not.', 'progression'),
		'id' => 'slider_autoplay_play',
		'std' => 'true',
		'type' => 'select',
		'class' => 'mini', //mini, tiny, small
		'options' => $animation_true);
	
	
	$options[] = array(
		'name' => __('Featured Slider Autoplay Speed', 'progression'),
		'desc' => __('Choose how long each slide will show (in milliseconds)', 'progression'),
		'id' => 'slider_autoplay',
		'std' => '8500',
		'class' => 'mini',
		'type' => 'text');
		
	
	$options[] = array(
		'name' => __('Featured Slider Next / Previous Buttons', 'progression'),
		'desc' => __('Choose to turn the next/previous buttons on or off. ', 'progression'),
		'id' => 'slider_navigation',
		'std' => 'true',
		'type' => 'select',
		'class' => 'mini', //mini, tiny, small
		'options' => $animation_true);
		

	
	$options[] = array(
		'name' => __('Featured Slider Thumbnail Navigation Buttons', 'progression'),
		'desc' => __('Choose to display the navigation bullets on the bottom left of the slideshow. ', 'progression'),
		'id' => 'slider_bullets',
		'std' => 'true',
		'type' => 'select',
		'class' => 'mini', //mini, tiny, small
		'options' => $animation_true);
	
	
	
		
		
		
	return $options;
}

/*
 * This is an example of how to add custom scripts to the options panel.
 * This example shows/hides an option when a checkbox is clicked.
 */

add_action('optionsframework_custom_scripts', 'optionsframework_custom_scripts');

function optionsframework_custom_scripts() { ?>



<?php
}