<?php
$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );

$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, vc_shortcode_custom_css_class( $css, ' ' ) );

if( ! $img_size ){
	$img_size = 'full';
}

if( ! $video ){
	return false;
}

wp_enqueue_script( 'jquery.fancybox' );
wp_enqueue_style( 'transcargo-jquery.fancybox.css' );

?>

<div class="stm_video_popup<?php echo esc_attr( $css_class ); ?>">
	<?php
		if ( $image > 0 ) {
			$thumbnail = wpb_getImageBySize( array(
					'attach_id' => $image,
					'thumb_size' => $img_size
			) );
		} else {
			$thumbnail = array();
			$thumbnail['thumbnail'] = '<img src="' . vc_asset_url( 'vc/no_image.png' ) . '" />';
			$thumbnail['p_img_large'][0] = vc_asset_url( 'vc/no_image.png' );
		}
		$video_thumbnail = $thumbnail['thumbnail'];
	?>
	<a href="<?php echo esc_url( $video ); ?>" class="fancy_video"><?php echo $video_thumbnail; ?></a>
	<script type="text/javascript">
		jQuery(document).ready(function ($) {
			$(".fancy_video").fancybox({
				type: 'iframe',
				openEffect: 'elastic',
				closeEffect: 'elastic'
			});
		});
	</script>
</div>