<?php
$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );

$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, vc_shortcode_custom_css_class( $css, ' ' ) );

if ( empty( $img_size ) ) {
	$img_size = '350x220';
}

?>

<div class="vc_service_info<?php echo esc_attr( $css_class ); ?>">
	<?php
	if ( $image > 0 ):
		$post_thumbnail = wpb_getImageBySize( array(
			'attach_id'  => $image,
			'thumb_size' => $img_size,
		) );
		$thumbnail = $post_thumbnail['thumbnail'];
	?>
	<div class="service_thumbnail">
		<?php echo $thumbnail; ?>
	</div>
	<?php endif; ?>
	<div class="service_info">
		<?php if( $title ): ?>
			<h6><?php echo esc_html( $title ); ?></h6>
		<?php endif; ?>
		<div class="content wpb_text_column">
			<?php echo wpb_js_remove_wpautop( $content, true ); ?>
		</div>
	</div>
</div>