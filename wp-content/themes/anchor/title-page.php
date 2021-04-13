<?php if(has_post_thumbnail()): ?>
<?php $image = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), 'progression-page-title'); ?>
<script type='text/javascript'>
jQuery(document).ready(function($) {  
	$("#page-title-page").backstretch([
		"<?php echo $image[0]; ?>"
		<?php if( class_exists( 'kdMultipleFeaturedImages' ) ) {
			if( kd_mfi_get_featured_image_url( 'featured-image-2', 'page', 'progression-page-title', $thePostID ) != "" ) {
			    echo ',"', kd_mfi_get_featured_image_url( 'featured-image-2', 'page', 'progression-page-title', $thePostID ) , '"';
			}
			if( kd_mfi_get_featured_image_url( 'featured-image-3', 'page', 'progression-page-title', $thePostID ) != "" ) {
			    echo ',"', kd_mfi_get_featured_image_url( 'featured-image-3', 'page', 'progression-page-title', $thePostID ) , '"';
			}
		}
 		?>
		], {duration: 4500, fade: 500});
	 });
</script>
<?php endif; ?>