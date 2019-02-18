<?php
$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );

$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, vc_shortcode_custom_css_class( $css, ' ' ) );

$link = vc_build_link( $link );

if( ! empty( $link['url'] ) ){
	$css_class .= ' ' . 'has_link';
}

?>


<div class="pricing_table<?php echo esc_attr( $css_class ); ?>">
	<div class="pricing_table_wr">
		<div class="header">
			<?php if( $title ): ?>
				<div class="title"><?php echo esc_html( $title ); ?></div>
			<?php endif; ?>
			<?php if( $sticker ): ?>
				<div class="sticker"><?php echo esc_html( $sticker_title ); ?></div>
			<?php endif; ?>
			<div class="price_wr">
				<?php if( $prefix ): ?>
					<div class="prefix"><?php echo esc_html( $prefix ); ?></div>
				<?php endif; ?>
				<?php if( $price ): ?>
					<div class="price"><?php echo esc_html( $price ); ?></div>
				<?php endif; ?>
				<?php if( $suffix ): ?>
					<div class="suffix"><?php echo esc_html( $suffix ); ?></div>
				<?php endif; ?>
			</div>
		</div>
		<div class="content wpb_text_column">
			<?php echo wpb_js_remove_wpautop( $content, true ); ?>
			<?php if ( ! empty( $link['url'] ) && ! empty( $link['title'] ) ): ?>
				<?php
				if ( ! $link['target'] ) {
					$link['target'] = '_self';
				}
				?>
				<div class="buy_now">
					<a class="button icon_right" href="<?php echo esc_url( $link['url'] ) ?>" target="<?php echo esc_attr( $link['target'] ); ?>">
						<?php echo esc_html( $link['title'] ); ?>
						<i class="stm-arrow-next"></i>
					</a>
				</div>
			<?php endif; ?>
		</div>
	</div>
</div>