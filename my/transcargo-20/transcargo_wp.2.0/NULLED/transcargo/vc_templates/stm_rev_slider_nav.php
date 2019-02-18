<?php
$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );

$icon_style = array();

if ( $icon_height ) {
	$margin_top = $icon_height + 28;
	$icon_style['font-size'] = 'font-size: ' . esc_attr( $icon_height ) . 'px;';
	$icon_style['margin-top'] = 'margin-top: -' . esc_attr( $margin_top ) . 'px;';
	$icon_style['height'] = 'height: ' . esc_attr( $margin_top ) . 'px;';
}


?>

<?php if ( $slider_id ): ?>

	<a href="#" onclick="revapi<?php echo esc_js( $slider_id ); ?>.revshowslide(<?php echo esc_js( $slide_number ); ?>);" class="rev_slider_nav rev_slider_<?php echo esc_attr( $slider_id ); ?> rev_slide_<?php echo esc_js( $slide_number ); ?>">
		<?php if ( ! empty( $icon ) ): ?>
			<span<?php echo ( $icon_style ) ? ' style="' . implode( ' ', $icon_style ) . '"' : ''; ?> class="icon">
			<i class="<?php echo esc_attr( $icon ); ?>"></i>
		</span>
		<?php endif; ?>
		<?php if ( ! empty( $title ) ): ?>
			<span class="title">
				<?php echo esc_html( $title ); ?>
			</span>
		<?php endif; ?>
	</a>

<?php endif; ?>