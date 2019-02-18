<?php
$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );

$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, vc_shortcode_custom_css_class( $css, ' ' ) );

if( $vertical_navigation ){
	$css_class .= ' vertical_navigation';
}

wp_enqueue_script( 'owl.carousel' );
wp_enqueue_style( 'transcargo-owl.carousel.css' );
wp_enqueue_script( 'imagesloaded' );

$owl_id     = uniqid( 'owl-' );
$owl_nav_id = uniqid( 'owl-nav-' );

if ( '' === $images ) {
	$images = '-1,-2,-3';
}

$images = explode( ',', $images );

?>
<div<?php echo ( $gallery_width ) ? ' style="width: ' . esc_attr( $gallery_width ) . 'px;"' : ''; ?> class="vc_image_gallery_wr<?php echo esc_attr( $css_class ); ?>">
	<div class="vc_image_gallery" id="<?php echo esc_attr( $owl_id ); ?>">
		<?php foreach ( $images as $attach_id ) :  ?>
			<?php
			if ( $attach_id > 0 ) {
				$post_thumbnail = wpb_getImageBySize( array(
					'attach_id' => $attach_id,
					'thumb_size' => $img_size,
				) );
			} else {
				$post_thumbnail = array();
				$post_thumbnail['thumbnail'] = '<img src="' . vc_asset_url( 'vc/no_image.png' ) . '" />';
				$post_thumbnail['p_img_large'][0] = vc_asset_url( 'vc/no_image.png' );
			}
			$thumbnail = $post_thumbnail['thumbnail'];
			?>
			<div class="item">
				<?php echo $thumbnail; ?>
				<?php if( $image_title ): ?>
					<p><?php echo esc_html( get_post($attach_id)->post_excerpt ); ?></p>
				<?php endif; ?>
			</div>
		<?php endforeach; ?>
	</div>
	<div class="owl-dots-wr">
		<div class="owl-dots" id="<?php echo esc_attr( $owl_nav_id ); ?>"></div>
	</div>
	<script type="text/javascript">
		jQuery(document).ready(function ($) {
			$("#<?php echo esc_js( $owl_id ); ?>").imagesLoaded().progress(function () {
				$("#<?php echo esc_js( $owl_id ); ?>").owlCarousel({
					items: 1,
					margin: 80,
					<?php if( $autoplay ): ?>
					autoplay: true,
					<?php endif; ?>
					dots: true,
					dotsContainer: '#<?php echo esc_js( $owl_nav_id ); ?>',
					<?php if( $loop ): ?>
					loop: true,
					<?php endif; ?>
					autoHeight:true,
					autoplayTimeout: <?php echo esc_js( $timeout ); ?>,
					smartSpeed: <?php echo esc_js( $smart_speed ); ?>
				});
			});
		});
	</script>
</div>