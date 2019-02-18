<?php
$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );

$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, vc_shortcode_custom_css_class( $css, ' ' ) );

?>
<?php if ( comments_open() || get_comments_number() ) : ?>
	<div class="stm_post_comments<?php echo esc_attr( $css_class ); ?>">
		<?php comments_template(); ?>
	</div>
<?php endif; ?>