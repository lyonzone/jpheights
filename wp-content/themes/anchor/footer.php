<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the id=main div and all content after
 *
 * @package progression
 * @since progression 1.0
 */
?>
<div class="clearfix"></div>
</div><!-- close .width-container -->
</div><!-- close #main -->

<footer>
	<div id="footer-widgets">
		<div class="width-container footer-<?php echo of_get_option('footer_widgets_column', '4'); ?>-column">
			<?php if ( ! dynamic_sidebar( 'Footer Widgets' ) ) : ?>
			<?php endif; // end sidebar widget area ?>
			<div class="clearfix"></div>
		</div><!-- close .width-container -->
	</div><!-- close #footer-widgets -->
	<div id="copyright">
		<div class="width-container">
			<div class="grid2column">
				<?php echo of_get_option('copyright_textarea', '&copy; 2013 All Rights Reserved.  Developed by Progression Studios'); ?>
			</div>
			<div class="grid2column lastcolumn">
				<?php get_template_part( 'social', 'footer' ); ?>
			</div>
			<div class="clearfix"></div>
		</div>
	</div><!-- close #copyright -->
</footer>
<?php wp_footer(); ?>
</body>
</html>