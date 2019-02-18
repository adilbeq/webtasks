<?php
$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );

$css_class    = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, vc_shortcode_custom_css_class( $css, ' ' ) );
if ( function_exists('icl_object_id') ) {
	$post_sidebar = get_post(icl_object_id($sidebar, 'stm_vc_sidebar', false));
}else{
	$post_sidebar = get_post( $sidebar );
}
if ( empty( $post_sidebar ) || $sidebar == '0' ) {
	return;
}
?>

<div class="stm_sidebar<?php echo esc_attr( $css_class ); ?>">
	<style type="text/css" scoped>
		<?php echo get_post_meta( $sidebar, '_wpb_shortcodes_custom_css', true ); ?>
	</style>
	<?php echo apply_filters( 'the_content', $post_sidebar->post_content ); ?>
</div>