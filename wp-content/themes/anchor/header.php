<?php
/**
 * The Header for our theme.
 *
 * @package progression
 * @since progression 1.0
 */
?><!doctype html>
<!--[if lt IE 7]> <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang="en"> <![endif]-->
<!--[if IE 7]> <html class="no-js lt-ie9 lt-ie8" lang="en"> <![endif]-->
<!--[if IE 8]>  <html class="no-js lt-ie9" lang="en"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" <?php language_attributes(); ?>> <!--<![endif]-->
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<meta name="viewport" content="width=device-width">

	<title><?php wp_title( '|', true, 'right' ); ?></title>
	<?php if(of_get_option('favicon')): ?><link href="<?php echo of_get_option('favicon'); ?>" rel="shortcut icon" /><?php endif; ?>
	<link rel="profile" href="http://gmpg.org/xfn/11">
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
	
	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<header>
	<div class="width-container">
		<h1 id="logo"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home"><img src="<?php echo of_get_option('logo', get_template_directory_uri() . '/images/logo.png'); ?>" alt="<?php bloginfo('name'); ?>" width="<?php echo of_get_option('logo_width', '116'); ?>" /></a></h1>
		<nav>
			<?php wp_nav_menu( array('theme_location' => 'primary', 'depth' => 4, 'menu_class' => 'sf-menu') ); ?>
		</nav>
		
		<div id="header-search">
			<?php get_template_part( 'social', 'header' ); ?>
			<?php get_search_form(); ?>
		</div>
		<div class="clearfix"></div>
	</div><!-- close .width-container -->
</header>

<div id="contact-header">
	<div class="width-container"><div id="contact-header-text"><?php echo of_get_option('contact_text', '<strong>Address:</strong> <em>156 University Ave. Palo Alto, Ca</em>  &nbsp;&nbsp; <strong>Reservation Line:</strong> <em>1-800-244-2525</em>'); ?></div></div><!-- close .width-container -->
</div>

<?php if( is_page_template('homepage.php') || is_page_template('page-blog-slider.php') ): ?>
	<?php get_template_part( 'slider', 'progression' ); ?>
<?php endif; ?>

<div id="main" class="site-main">
	<div class="width-container">