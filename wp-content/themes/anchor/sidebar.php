<?php
/**
 * The Sidebar containing the main widget areas.
 *
 * @package progression
 * @since progression 1.0
 */
?>

<div id="sidebar">
	<div class="content-container-anchor overlay-container-anchor">
	<?php if ( ! dynamic_sidebar( 'sidebar-1' ) ) : ?>
	<?php endif; // end sidebar widget area ?>
	</div><!-- close .content-container-anchor -->
</div><!-- close #sidebar -->
