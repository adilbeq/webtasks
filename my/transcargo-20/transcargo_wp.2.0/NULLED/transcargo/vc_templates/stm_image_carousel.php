<?php
$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );

$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, vc_shortcode_custom_css_class( $css, ' ' ) );

if( $grayscale ){
	$css_class .= ' grayscale';
}

wp_enqueue_script( 'owl.carousel' );
wp_enqueue_style( 'transcargo-owl.carousel.css' );

$owl_id     = uniqid( 'owl-' );
$owl_nav_id = uniqid( 'owl-nav-' );

if ( '' === $images ) {
	$images = '-1,-2,-3';
}

$images = explode( ',', $images );

?>

<div class="vc_image_carousel_wr<?php echo esc_attr( $css_class ); ?>">
	<div class="vc_image_carousel" id="<?php echo esc_attr( $owl_id ); ?>">
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
			</div>
		<?php endforeach; ?>
	</div>
	<script type="text/javascript">
		jQuery(document).ready(function ($) {
			$("#<?php echo esc_js( $owl_id ); ?>").owlCarousel({
				<?php if( $autoplay ): ?>
				autoplay: true,
				<?php endif; ?>
				dots: false,
				<?php if( $loop ): ?>
				loop: true,
				<?php endif; ?>
				autoplayTimeout: <?php echo esc_js( $timeout ); ?>,
				smartSpeed: <?php echo esc_js( $smart_speed ); ?>,
				responsive: {
					0: {
						items: <?php echo esc_js( $items_mobile ); ?>
					},
					768: {
						items: <?php echo esc_js( $items_tablet ); ?>
					},
					980: {
						items: <?php echo esc_js( $items_small_desktop ); ?>
					},
					1199: {
						items: <?php echo esc_js( $items ); ?>
					}
				}
			});
		});
	</script>
</div>