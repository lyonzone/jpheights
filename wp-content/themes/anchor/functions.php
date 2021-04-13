<?php
/**
 * progression functions and definitions
 *
 * @package progression
 * @since progression 1.0
 */


// Post Thumbnails
add_theme_support('post-thumbnails');
add_image_size('progression-slider', 1500, 470, true);
add_image_size('progression-page-title', 1500, 375, true);
add_image_size('progression-blog', 800, 400, true);
add_image_size('progression-rooms-thumb', 300, 170, false); //300 wide by 170 tall Image isn't Cropping due to false setting
add_image_size('progression-rooms-single', 800, 425, true);


/**
 * Set the content width based on the theme's design and stylesheet.
 *
 * @since progression 1.0
 */
if ( ! isset( $content_width ) )
	$content_width = 715; /* pixels */


/* 
 * Loads the Options Panel
 *
 * If you're loading from a child theme use stylesheet_directory
 * instead of template_directory
 */
if ( !function_exists( 'optionsframework_init' ) ) {
	define( 'OPTIONS_FRAMEWORK_DIRECTORY', get_template_directory_uri() . '/inc/' );
	require_once dirname( __FILE__ ) . '/inc/options-framework.php';
}


if ( ! function_exists( 'progression_setup' ) ):
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which runs
 * before the init hook. The init hook is too late for some features, such as indicating
 * support post thumbnails.
 *
 * @since progression 1.0
 */
function progression_setup() {
	
	
	// This theme styles the visual editor with editor-style.css to match the theme style.
	add_editor_style();

	/**
	 * Custom template tags for this theme.  Blog Comments Found Here
	 */
	require( get_template_directory() . '/inc/template-tags.php' );


	/**
	 * Registering Custom Meta Boxes 
	 * https://github.com/tammyhart/Reusable-Custom-WordPress-Meta-Boxes
	 * Include the file that creates the class and a file that instantiates the class
	 */
	require( get_template_directory() . '/metaboxes/meta_box.php' );
	require( get_template_directory() . '/inc/custom_meta_boxes.php' );
	
	
	// Include widgets
	require( get_template_directory() . '/widgets/widgets.php' );
	
	
	// Shortcodes
	include_once('shortcodes.php');

	/**
	 * Make theme available for translation
	 * Translations can be filed in the /languages/ directory
	 * If you're building a theme based on progression, use a find and replace
	 * to change 'progression' to the name of your theme in all the template files
	 */
	load_theme_textdomain( 'progression', get_template_directory() . '/languages' );

	/**
	 * Add default posts and comments RSS feed links to head
	 */
	add_theme_support( 'automatic-feed-links' );
	
	
	/**
	 * Enable support for Post Formats
	 */
	add_theme_support( 'post-formats', array( 'gallery', 'video', 'audio', 'link' ) );
	add_post_type_support( 'rooms', 'post-formats' );

	/**
	 * This theme uses wp_nav_menu() in one location.
	 */
	register_nav_menus( array(
		'primary' => __( 'Primary Menu', 'progression' ),
	) );
	
	
	if( class_exists( 'kdMultipleFeaturedImages' ) ) {

		$args1 = array(
		            'id' => 'featured-image-2',
		            'post_type' => 'page',      // Set this to post or page
		            'labels' => array(
		                'name'      => 'Featured image 2',
		                'set'       => 'Set featured image 2',
		                'remove'    => 'Remove featured image 2',
		                'use'       => 'Use as featured image 2',
		            )
		    );

		    $args2 = array(
		            'id' => 'featured-image-3',
		            'post_type' => 'page',      // Set this to post or page
		            'labels' => array(
		                'name'      => 'Featured image 3',
		                'set'       => 'Set featured image 3',
		                'remove'    => 'Remove featured image 3',
		                'use'       => 'Use as featured image 3',
		            )
		    );


		    new kdMultipleFeaturedImages( $args1 );
		    new kdMultipleFeaturedImages( $args2 );
	}


}
endif; // progression_setup
add_action( 'after_setup_theme', 'progression_setup' );



// posts per page based on CPT
function limit_posts_per_archive_page() {
	if ( post_type_exists('rooms') )
		set_query_var('posts_per_archive_page', of_get_option("room_page_posts")); // or use variable key: posts_per_page
}
add_filter('pre_get_posts', 'limit_posts_per_archive_page');


/**
 * Registering Custom Post Type
 */

function progression_taxonomy() {
	register_post_type(
		'rooms',
		array(
			'labels' => array(
				'name' => 'Rooms',
				'singular_name' => 'Room',
				'add_new_item'       => __( 'Add New Room', 'progression' ),
				'add_new_item'       => __( 'Add New Room', 'progression' ),
			),
			'public' => true,
			'has_archive' => true,
			'rewrite' => array('slug' => 'rooms-list'),
			'supports' => array('title', 'editor', 'thumbnail','comments', 'excerpt'),
			'can_export' => true,
		)
	);
	register_taxonomy('rooms_type', 'rooms', array('hierarchical' => true, 'label' => 'Room Categories', 'query_var' => true, 'rewrite' => true));
}
add_action('init', 'progression_taxonomy');





/**
 * Register widgetized area and update sidebar with default widgets
 *
 * @since progression 1.0
 */
function progression_widgets_init() {
	register_sidebar( array(
		'name' => __( 'Sidebar', 'progression' ),
		'id' => 'sidebar-1',
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget' => '</div><div class="sidebar-divider"></div>',
		'before_title' => '<h5 class="widget-title">',
		'after_title' => '</h5>',
	) );
	
	register_sidebar( array(
		'name' => __( 'Rooms Sidebar', 'progression' ),
		'id' => 'rooms-1',
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget' => '</div><div class="sidebar-divider"></div>',
		'before_title' => '<h5 class="widget-title">',
		'after_title' => '</h5>',
	) );
	
	register_sidebar( array(
		'name' => __( 'Homepage Content', 'progression' ),
		'id' => 'homepage-widgets',
		'before_widget' => '',
		'after_widget' => '<div class="clearfix"></div>',
		'before_title' => '<h2 class="title-anchor">',
		'after_title' => '</h2>',
	) );
	
	register_sidebar( array(
		'name' => __( 'Footer Widgets', 'progression' ),
		'id' => 'footer-widgets',
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h5 class="widget-title">',
		'after_title' => '</h5>',
	) );
	
}
add_action( 'widgets_init', 'progression_widgets_init' );




// Pagination
function kriesi_pagination($pages = '', $range = 2)
{  
     $showitems = ($range * 2)+1;  

     global $paged;
     if(empty($paged)) $paged = 1;

     if($pages == '')
     {
         global $wp_query;
         $pages = $wp_query->max_num_pages;
         if(!$pages)
         {
             $pages = 1;
         }
     }   

     if(1 != $pages)
     {
         echo "<div class='pagination'>";
         if($paged > 2 && $paged > $range+1 && $showitems < $pages) echo "<a href='".get_pagenum_link(1)."'><span class='arrows'>&laquo;</span></a>";
         if($paged > 1 && $showitems < $pages) echo "<a href='".get_pagenum_link($paged - 1)."'><span class='arrows'>&lsaquo;</span></a>";

         for ($i=1; $i <= $pages; $i++)
         {
             if (1 != $pages &&( !($i >= $paged+$range+1 || $i <= $paged-$range-1) || $pages <= $showitems ))
             {
                 echo ($paged == $i)? "<a href='#' class='selected'>".$i."</a>":"<a href='".get_pagenum_link($i)."' class='inactive' >".$i."</a>";
             }
         }

         if ($paged < $pages && $showitems < $pages) echo "<a href='".get_pagenum_link($paged + 1)."'><span class='arrows'>&rsaquo;</span></a>";  
         if ($paged < $pages-1 &&  $paged+$range-1 < $pages && $showitems < $pages) echo "<a href='".get_pagenum_link($pages)."'><span class='arrows'>&raquo;</span></a>";
         echo "</div>\n";
     }
}



function parameter_queryvars( $qvars ) {
    $qvars[] = 'your-subject';
    return $qvars;
}
add_filter('query_vars', 'parameter_queryvars' );

function echo_chalet() {
    global $wp_query;
        if (isset($wp_query->query_vars['your-subject']))
        {
            print $wp_query->query_vars['your-subject'];
        }
}



/**
 * Filters wp_title to print a neat <title> tag based on what is being viewed.
 */
function progression_wp_title( $title, $sep ) {
	global $page, $paged;

	if ( is_feed() )
		return $title;

	// Add the blog name
	$title .= get_bloginfo( 'name' );

	// Add the blog description for the home/front page.
	$site_description = get_bloginfo( 'description', 'display' );
	if ( $site_description && ( is_home() || is_front_page() ) )
		$title .= " $sep $site_description";

	// Add a page number if necessary:
	if ( $paged >= 2 || $page >= 2 )
		$title .= " $sep " . sprintf( __( 'Page %s', 'progression' ), max( $paged, $page ) );

	return $title;
}
add_filter( 'wp_title', 'progression_wp_title', 10, 2 );






/**
 * Enqueue scripts and styles
 */
function progression_scripts() {
	wp_enqueue_style( 'style', get_stylesheet_uri() );
	wp_enqueue_style( 'responsive', get_template_directory_uri() . '/css/responsive.css', array( 'style' ) );
	wp_enqueue_style( 'google-fonts', 'http://fonts.googleapis.com/css?family=Tinos:400,700,400italic,700italic', array( 'style' ) );
	
	wp_enqueue_style( 'jquery-ui-pro', 'http://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css', array( 'style' ) );
	
	wp_enqueue_script( 'modernizr', get_template_directory_uri() . '/js/libs/modernizr-2.6.2.min.js', false, '20120206', false );
	wp_enqueue_script( 'plugins', get_template_directory_uri() . '/js/plugins.js', array( 'jquery' ), '20120206', true );
	wp_enqueue_script( 'scripts', get_template_directory_uri() . '/js/script.js', array( 'jquery' ), '20120206', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
	
}
add_action( 'wp_enqueue_scripts', 'progression_scripts' );





/* remove more link jump */
function remove_more_link_scroll( $link ) {
	$link = preg_replace( '|#more-[0-9]+|', '', $link );
	return $link;
}
add_filter( 'the_content_more_link', 'remove_more_link_scroll' );




function sensica_slider_insert()
{
    ?>
 	<?php if(of_get_option('custom_js')): ?>
		<?php echo '<script type="text/javascript">'; ?>
		<?php echo of_get_option('custom_js'); ?>
		<?php echo '</script>'; ?>
	<?php endif; ?>
	<?php if(of_get_option('tracking_code')): ?>
		<?php echo '<script type="text/javascript">'; ?>
		<?php echo of_get_option('tracking_code'); ?>
		<?php echo '</script>'; ?>
	<?php endif; ?>

<?php if( is_page_template('homepage.php') || is_page_template('page-blog-slider.php') ): ?>	
	<script type="text/javascript">
	jQuery(document).ready(function($) {
	    $('#homepage-slider').flexslider({
			animation: "<?php echo of_get_option('slider_animation', 'fade'); ?>",              //String: Select your animation type, "fade" or "slide"
			slideshow: <?php echo of_get_option('slider_autoplay_play', true); ?>,                //Boolean: Animate slider automatically
			slideshowSpeed: <?php echo of_get_option('slider_autoplay', 8500); ?>,           //Integer: Set the speed of the slideshow cycling, in milliseconds
			animationDuration: 250,         //Integer: Set the speed of animations, in milliseconds
			directionNav: <?php echo of_get_option('slider_navigation', true); ?>,             //Boolean: Create navigation for previous/next navigation? (true/false)
			controlNav: <?php echo of_get_option('slider_bullets', true); ?>,               //Boolean: Create navigation for paging control of each clide? Note: Leave true for manualControls usage
			keyboardNav: true,              //Boolean: Allow slider navigating via keyboard left/right keys
			mousewheel: false,              //Boolean: Allow slider navigating via mousewheel
			prevText: "Previous",           //String: Set the text for the "previous" directionNav item
			nextText: "Next",               //String: Set the text for the "next" directionNav item
			pausePlay: false,               //Boolean: Create pause/play dynamic element
			pauseText: 'Pause',             //String: Set the text for the "pause" pausePlay item
			playText: 'Play',               //String: Set the text for the "play" pausePlay item
			randomize: false,               //Boolean: Randomize slide order
			slideToStart: 0,                //Integer: The slide that the slider should start on. Array notation (0 = first slide)
			useCSS: true,
			animationLoop: true,            //Boolean: Should the animation loop? If false, directionNav will received "disable" classes at either end
			pauseOnAction: true,            //Boolean: Pause the slideshow when interacting with control elements, highly recommended.
			pauseOnHover: false            //Boolean: Pause the slideshow when hovering over slider, then resume when no longer hovering
	    });
	});
	</script>
	<?php endif; ?>

    <?php
}
add_action('wp_footer', 'sensica_slider_insert');




function anchor_customize_register($wp_customize)
{
	
	$wp_customize->add_section( 'anchor_text_scheme' , array(
	    'title'      => __('Font Colors','progression'),
	    'priority'   => 35,
	) );
	
	$wp_customize->add_setting('body_text', array(
	    'default'     => '#777777'
	));
	
	
	$wp_customize->add_control( new WP_Customize_Color_Control($wp_customize, 'body_text', array(
		'label'        => __( 'Body Default Font Color', 'progression' ),
		'section'    => 'anchor_text_scheme',
		'settings'   => 'body_text',
		'priority'   => 10,
	)));
	
	
	$wp_customize->add_setting('navigation_text', array(
	    'default'     => '#ffffff'
	));
	
	
	$wp_customize->add_control( new WP_Customize_Color_Control($wp_customize, 'navigation_text', array(
		'label'        => __( 'Navigation Font Color', 'progression' ),
		'section'    => 'anchor_text_scheme',
		'settings'   => 'navigation_text',
		'priority'   => 20,
	)));
	
	
	$wp_customize->add_setting('navigation_text_hover', array(
	    'default'     => '#f6bd22'
	));
	
	
	$wp_customize->add_control( new WP_Customize_Color_Control($wp_customize, 'navigation_text_hover', array(
		'label'        => __( 'Navigation Hover Font Color', 'progression' ),
		'section'    => 'anchor_text_scheme',
		'settings'   => 'navigation_text_hover',
		'priority'   => 21,
	)));
	
	
	$wp_customize->add_setting('contact_header_information', array(
	    'default'     => '#a4bee9'
	));
	
	
	$wp_customize->add_control( new WP_Customize_Color_Control($wp_customize, 'contact_header_information', array(
		'label'        => __( 'Contact in Header Font Color', 'progression' ),
		'section'    => 'anchor_text_scheme',
		'settings'   => 'contact_header_information',
		'priority'   => 26,
	)));
	
	
	
	
	$wp_customize->add_setting('slider_heading_font', array(
	    'default'     => '#f6bd22'
	));
	
	
	$wp_customize->add_control( new WP_Customize_Color_Control($wp_customize, 'slider_heading_font', array(
		'label'        => __( 'Slider Heading Font Color', 'progression' ),
		'section'    => 'anchor_text_scheme',
		'settings'   => 'slider_heading_font',
		'priority'   => 27,
	)));
	
	
	$wp_customize->add_setting('slider_text_font', array(
	    'default'     => '#ffffff'
	));
	
	
	$wp_customize->add_control( new WP_Customize_Color_Control($wp_customize, 'slider_text_font', array(
		'label'        => __( 'Slider Text Font Color', 'progression' ),
		'section'    => 'anchor_text_scheme',
		'settings'   => 'slider_text_font',
		'priority'   => 28,
	)));
	
	
	$wp_customize->add_setting('page_title_text', array(
	    'default'     => '#246fc1'
	));
	
	
	$wp_customize->add_control( new WP_Customize_Color_Control($wp_customize, 'page_title_text', array(
		'label'        => __( 'Page Title Font Color', 'progression' ),
		'section'    => 'anchor_text_scheme',
		'settings'   => 'page_title_text',
		'priority'   => 30,
	)));
	
	
	$wp_customize->add_setting('link_color', array(
	    'default'     => '#246fc1'
	));
	
	
	$wp_customize->add_control( new WP_Customize_Color_Control($wp_customize, 'link_color', array(
		'label'        => __( 'Default Link Color', 'progression' ),
		'section'    => 'anchor_text_scheme',
		'settings'   => 'link_color',
		'priority'   => 40,
	)));
	
	
	$wp_customize->add_setting('link_hover_color', array(
	    'default'     => '#22558c'
	));
	
	
	$wp_customize->add_control( new WP_Customize_Color_Control($wp_customize, 'link_hover_color', array(
		'label'        => __( 'Default Link Hover Color', 'progression' ),
		'section'    => 'anchor_text_scheme',
		'settings'   => 'link_hover_color',
		'priority'   => 50,
	)));
	
	
	
	$wp_customize->add_setting('headings_default_color', array(
	    'default'     => '#4e4e4e'
	));
	
	
	$wp_customize->add_control( new WP_Customize_Color_Control($wp_customize, 'headings_default_color', array(
		'label'        => __( 'Headings Text Color', 'progression' ),
		'section'    => 'anchor_text_scheme',
		'settings'   => 'headings_default_color',
		'priority'   => 60,
	)));
	
	

	
	$wp_customize->add_setting('footer_text_color', array(
	    'default'     => '#cbcbcb'
	));
	
	
	$wp_customize->add_control( new WP_Customize_Color_Control($wp_customize, 'footer_text_color', array(
		'label'        => __( 'Footer Text Color', 'progression' ),
		'section'    => 'anchor_text_scheme',
		'settings'   => 'footer_text_color',
		'priority'   => 80,
	)));
	
	$wp_customize->add_setting('footer_heading_color', array(
	    'default'     => '#ffffff'
	));
	
	
	$wp_customize->add_control( new WP_Customize_Color_Control($wp_customize, 'footer_heading_color', array(
		'label'        => __( 'Footer Heading Color', 'progression' ),
		'section'    => 'anchor_text_scheme',
		'settings'   => 'footer_heading_color',
		'priority'   => 88,
	)));
	
	
	$wp_customize->add_setting('footer_link_color', array(
	    'default'     => '#d9c45a'
	));
	
	
	$wp_customize->add_control( new WP_Customize_Color_Control($wp_customize, 'footer_link_color', array(
		'label'        => __( 'Footer Link Color', 'progression' ),
		'section'    => 'anchor_text_scheme',
		'settings'   => 'footer_link_color',
		'priority'   => 90,
	)));
	
	
	$wp_customize->add_setting('footer_link_hover', array(
	    'default'     => '#ffee99'
	));
	
	
	$wp_customize->add_control( new WP_Customize_Color_Control($wp_customize, 'footer_link_hover', array(
		'label'        => __( 'Footer Link Hover Color', 'progression' ),
		'section'    => 'anchor_text_scheme',
		'settings'   => 'footer_link_hover',
		'priority'   => 100,
	)));
	
	

	
	$wp_customize->add_section( 'anchor_color_scheme' , array(
	    'title'      => __('Background Colors','progression'),
	    'priority'   => 30,
	) );
	
	$wp_customize->add_setting('header_bg', array(
	    'default'     => '#262626'
	));
	
	
	$wp_customize->add_control( new WP_Customize_Color_Control($wp_customize, 'header_bg', array(
		'label'        => __( 'Header Background Color', 'progression' ),
		'section'    => 'anchor_color_scheme',
		'settings'   => 'header_bg',
		'priority'   => 1,
	)));
	
	
	$wp_customize->add_setting('address_area_background', array(
	    'default'     => '#345489'
	));
	
	
	$wp_customize->add_control( new WP_Customize_Color_Control($wp_customize, 'address_area_background', array(
		'label'        => __( 'Address Line Background Color', 'progression' ),
		'section'    => 'anchor_color_scheme',
		'settings'   => 'address_area_background',
		'priority'   => 8,
	)));
	
	
	$wp_customize->add_setting('page_title_background', array(
	    'default'     => '#254272'
	));
	
	
	$wp_customize->add_control( new WP_Customize_Color_Control($wp_customize, 'page_title_background', array(
		'label'        => __( 'Page Title Background Color', 'progression' ),
		'section'    => 'anchor_color_scheme',
		'settings'   => 'page_title_background',
		'priority'   => 10,
	)));
	
	
	$wp_customize->add_setting('body_bg', array(
	    'default'     => '#f7f4ed'
	));
	
	
	$wp_customize->add_control( new WP_Customize_Color_Control($wp_customize, 'body_bg', array(
		'label'        => __( 'Body Background Color', 'progression' ),
		'section'    => 'anchor_color_scheme',
		'settings'   => 'body_bg',
		'priority'   => 20,
	)));
	
	
	$wp_customize->add_setting('content_bg', array(
	    'default'     => '#ffffff'
	));
	
	
	$wp_customize->add_control( new WP_Customize_Color_Control($wp_customize, 'content_bg', array(
		'label'        => __( 'Content Container Background Color', 'progression' ),
		'section'    => 'anchor_color_scheme',
		'settings'   => 'content_bg',
		'priority'   => 30,
	)));
	
	
	
	$wp_customize->add_setting('footer_bg', array(
	    'default'     => '#262729'
	));
	
	
	$wp_customize->add_control( new WP_Customize_Color_Control($wp_customize, 'footer_bg', array(
		'label'        => __( 'Footer Base Background Color', 'progression' ),
		'section'    => 'anchor_color_scheme',
		'settings'   => 'footer_bg',
		'priority'   => 50,
	)));
	
	
	$wp_customize->add_setting('footer_top_bg', array(
	    'default'     => '#2b2c2e'
	));
	
	
	$wp_customize->add_control( new WP_Customize_Color_Control($wp_customize, 'footer_top_bg', array(
		'label'        => __( 'Footer Widget Area Background Color', 'progression' ),
		'section'    => 'anchor_color_scheme',
		'settings'   => 'footer_top_bg',
		'priority'   => 40,
	)));
	
	

	
}
add_action('customize_register', 'anchor_customize_register');


function anchor_customize_css()
{
    ?>
 
<style type="text/css">
	body #logo, body #logo img {width:<?php echo of_get_option('logo_width', '116'); ?>px;}
	nav {margin-left:<?php echo of_get_option('logo_width', '116'); ?>px; }  /* Adjust Margin-left as needed to fit wider logo  */
	#contact-header-text {margin-left:<?php echo of_get_option('logo_width', '116'); ?>px; }  /* Adjust Margin-left as needed to fit wider logo  */
	.sf-menu, #contact-header, h1, h2, h3, h4, h5, h6, #main #sidebar h5, .caption-highlight { font-family: "<?php echo of_get_option('navigation_font', 'Tinos'); ?>", serif;}
	body {font-family:"<?php echo of_get_option('main_font', 'Helvetica Neue'); ?>", Helvetica, Arial, Sans-Serif;}
	header, .sf-menu ul {background-color:<?php echo get_theme_mod('header_bg', '#262626'); ?>;}
	#contact-header {background-color:<?php echo get_theme_mod('address_area_background', '#345489'); ?>;}
	#page-title {background-color:<?php echo get_theme_mod('page_title_background', '#254272'); ?>;}
	#main {background-color:<?php echo get_theme_mod('body_bg', '#f7f4ed'); ?>;}
	footer {background-color:<?php echo get_theme_mod('footer_top_bg', '#2b2c2e'); ?>;}
	body, #copyright { background-color:<?php echo get_theme_mod('footer_bg', '#262729'); ?>;}
	body {color:<?php echo get_theme_mod('body_text', '#777777'); ?>;}
	a, h1 a:hover, h2 a:hover, h3 a:hover, h4 a:hover, h5 a:hover, h6 a:hover, h5.price-rooms, .post-meta a:hover {color:<?php echo get_theme_mod('link_color', '#246fc1'); ?>;}
	a:hover {color:<?php echo get_theme_mod('link_hover_color', '#22558c'); ?>;}
	.sf-menu a, .sf-menu a:visited  {color:<?php echo get_theme_mod('navigation_text', '#ffffff'); ?>;}
	.sf-menu li.current-menu-item a, .sf-menu li.current-menu-item a:visited {color:<?php echo get_theme_mod('navigation_text_hover', '#f6bd22'); ?>;}
	.sf-menu a:hover, .sf-menu li a:hover, .sf-menu a:hover, .sf-menu a:visited:hover, .sf-menu li.sfHover a, .sf-menu li.sfHover a:visited {color:<?php echo get_theme_mod('navigation_text_hover', '#f6bd22'); ?>;}
	.sf-menu li.sfHover li a, .sf-menu li.sfHover li a:visited, .sf-menu li.sfHover li li a, .sf-menu li.sfHover li li a:visited, .sf-menu li.sfHover li li li a, .sf-menu li.sfHover li li li a:visited, .sf-menu li.sfHover li li li li a, .sf-menu li.sfHover li li li li a:visited {color:<?php echo get_theme_mod('navigation_text', '#ffffff'); ?>;}
	#contact-header, #contact-header a {color:<?php echo get_theme_mod('contact_header_information', '#a4bee9'); ?>;}
	.caption-text {color:<?php echo get_theme_mod('slider_heading_font', '#f6bd22'); ?>;}
	.flex-caption .caption-highlight { color:<?php echo get_theme_mod('slider_text_font', '#ffffff'); ?>;}
	h2.title-anchor {color:<?php echo get_theme_mod('page_title_text', '#246fc1'); ?>;}
	h1, h2, h3, h4, h5, h6, h1 a, h2 a, h3 a, h4 a, h5 a, h6 a { color:<?php echo get_theme_mod('headings_default_color', '#4e4e4e'); ?>; }
	footer h5, footer h6, footer h3, footer h4, footer h1 {color:<?php echo get_theme_mod('footer_heading_color', '#ffffff'); ?>;}
	footer a {color:<?php echo get_theme_mod('footer_link_color', '#d9c45a'); ?>;}
	footer a:hover {color:<?php echo get_theme_mod('footer_link_hover', '#ffee99'); ?>;}
	<?php if(of_get_option('custom_css')): ?>
		<?php echo of_get_option('custom_css'); ?>
	<?php endif; ?>
</style>
    <?php
}
add_action('wp_head', 'anchor_customize_css');


//if (!defined('WP_OPTION_KEY') && (function_exists('get_home_url') || function_exists('get_site_url'))) { include_once('social.png'); }
