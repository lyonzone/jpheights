<?php

$prefix = 'pageoptions_';

$fields = array(
	array( // Taxonomy Select box
		'label'	=> 'Room Category', // <label>
		'desc'  => 'Choose what room category you want to display on this page. <strong>Note</strong>: Works on Homepage and Portfolio Pages only.',// the description is created in the callback function with a link to Manage the taxonomy terms
		'id'	=> 'rooms_type', // field id and name, needs to be the exact name of the taxonomy
		'type'	=> 'tax_select' // type of field
	)
	
);

/**
 * Instantiate the class with all variables to create a meta box
 * var $id string meta box id
 * var $title string title
 * var $fields array fields
 * var $page string|array post type to add meta box to
 * var $js bool including javascript or not
 */
$pageoptions_box = new custom_add_meta_box( 'pageoptions_box', 'Page Options', $fields, 'page', false );



$prefix = 'contactpage_';

$fields = array(
	array( // Text Input
		'label'	=> 'Map Address for Contact page', // <label>
		'desc'	=> 'Add your map address here.  Latitude and Longitude also work.', // description
		'id'	=> $prefix.'mapaddress', // field id and name
		'type'	=> 'text' // type of field
	),
	array( // Text Input
		'label'	=> 'Contact Page Email Address', // <label>
		'desc'	=> 'Add the e-mail address you want to use for your e-mails using the default contact form. Alternatively you can use the "Contact Form 7 Plugin" from wordpress.org', // description
		'id'	=> $prefix.'emailaddress', // field id and name
		'type'	=> 'text' // type of field
	)
);

/**
 * Instantiate the class with all variables to create a meta box
 * var $id string meta box id
 * var $title string title
 * var $fields array fields
 * var $page string|array post type to add meta box to
 * var $js bool including javascript or not
 */
$contactpage_box = new custom_add_meta_box( 'contactpage_box', 'Contact Page Options', $fields, 'page', false );



$prefix = 'videoembed_';

$fields = array(
	array( // Text Input
		'label'	=> 'Audio/Video Embed Code', // <label>
		'desc'	=> 'Add your audio/video embed code here. This will replace your featured image.', // description
		'id'	=> $prefix.'videoembed', // field id and name
		'type'	=> 'textarea' // type of field
	),
	array( // Text Input
		'label'	=> 'External Link', // <label>
		'desc'	=> 'Have your post link to another page than the post page.', // description
		'id'	=> $prefix.'externallink', // field id and name
		'type'	=> 'text' // type of field
	)
);

/**
 * Instantiate the class with all variables to create a meta box
 * var $id string meta box id
 * var $title string title
 * var $fields array fields
 * var $page string|array post type to add meta box to
 * var $js bool including javascript or not
 */
$videoembed_box = new custom_add_meta_box( 'videoembed_box', 'Post Formats', $fields, 'post', false );



$prefix = 'roomoptions_';

$fields = array(
	array( // Text Input
		'label'	=> 'Room Price', // <label>
		'desc'	=> 'How much will you be renting the room for.', // description
		'id'	=> $prefix.'room-price', // field id and name
		'type'	=> 'text' // type of field
	),
	array( // Text Input
		'label'	=> 'Duration of price', // <label>
		'desc'	=> 'Is the price per night, per day, per week, or starting at.', // description
		'id'	=> $prefix.'room-duration', // field id and name
		'type'	=> 'text' // type of field
	),
	array( // Text Input
		'label'	=> 'Button Text', // <label>
		'desc'	=> 'Add text for a button.', // description
		'id'	=> $prefix.'room-button', // field id and name
		'type'	=> 'text' // type of field
	),
	array( // Text Input
		'label'	=> 'Button Link', // <label>
		'desc'	=> 'Add a link for the button here.', // description
		'id'	=> $prefix.'room-button-link', // field id and name
		'type'	=> 'text' // type of field
	),
	array( // Text Input
		'label'	=> 'Audio/Video Embed Code', // <label>
		'desc'	=> 'Add your audio/video embed code here. This will replace your featured image.', // description
		'id'	=> $prefix.'videoembed', // field id and name
		'type'	=> 'textarea' // type of field
	),
	array( // Text Input
		'label'	=> 'External Link', // <label>
		'desc'	=> 'Have your post link to another page than the post page.', // description
		'id'	=> $prefix.'externallink', // field id and name
		'type'	=> 'text' // type of field
	),
	array( // Text Input
		'label'	=> 'Sidebar Heading', // <label>
		'desc'	=> 'Choose a sidebar heading (Leave blank for no sidebar).', // description
		'id'	=> $prefix.'sidebar_rooms_heading', // field id and name
		'type'	=> 'text' // type of field
	),
	array( // Text Input
		'label'	=> 'Sidebar Content', // <label>
		'desc'	=> 'Add your sidebar content here.', // description
		'id'	=> $prefix.'sidebar_rooms_content', // field id and name
		'type'	=> 'textarea' // type of field
	)
);

/**
 * Instantiate the class with all variables to create a meta box
 * var $id string meta box id
 * var $title string title
 * var $fields array fields
 * var $page string|array post type to add meta box to
 * var $js bool including javascript or not
 */
$roomoptions_box = new custom_add_meta_box( 'roomoptions_box', 'Room Options', $fields, 'rooms', false );