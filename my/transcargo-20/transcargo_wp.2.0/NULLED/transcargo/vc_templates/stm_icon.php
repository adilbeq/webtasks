<?php
global $wp_filesystem;

if ( empty( $wp_filesystem ) ) {
	require_once ABSPATH . '/wp-admin/includes/file.php';
	WP_Filesystem();
}

if ( ! wp_is_mobile() ) {
	wp_enqueue_script( 'vivus' );
}

$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );

$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, vc_shortcode_custom_css_class( $css, ' ' ) );

if( $align ){
	$css_class .= ' ' . $align;
}

if( $icon_position ){
	$css_class .= ' ' . $icon_position;
}

$link = vc_build_link( $link );

$icon_style = array();
$title_style = array();
$text_style = array();

$icon_div_id = uniqid( 'icon_wr_' );
$icon_id = uniqid( 'icon_' );

if( $icon_size ){
	$icon_style['font-size'] = 'font-size: ' . $icon_size . 'px;';
}

if( $icon_position == 'icon_position_top' ){
	if( $icon_height ){
		$icon_style['height'] = 'height: ' . $icon_height . 'px;';
	}
}else{
	if( $icon_width ){
		$icon_style['width'] = 'width: ' . $icon_width . 'px;';
	}
}

if( $icon_color ){
	$icon_style['color'] = 'color: ' . $icon_color . ';';
}

if( $title_font_size ){
	$title_style['font-size'] = 'font-size: ' . $title_font_size . 'px;';
}

if( $title_font_weight ){
	$title_style['font-weight'] = 'font-weight: ' . $title_font_weight . ';';
}

if( $title_color ){
	$title_style['color'] = 'color: ' . $title_color . ';';
}

if( $text_color ){
	$text_style['color'] = 'color: ' . $text_color . ';';
}

?>

<?php if( $icon || $drawing_icon ): ?>
<div class="stm_icon<?php echo esc_attr( $css_class ); ?>">
	<?php if( $icon ): ?>
		<div class="icon"<?php echo( ( $icon_style ) ? ' style="' . esc_attr( implode( ' ', $icon_style ) ) . '"' : '' ); ?>>
			<i class="<?php echo esc_attr( $icon ); ?>"></i>
		</div>
	<?php elseif( $drawing_icon ): ?>
		<div id="<?php echo esc_attr( $icon_div_id ); ?>" class="icon"<?php echo( ( $icon_style ) ? ' style="' . esc_attr( implode( ' ', $icon_style ) ) . '"' : '' ); ?>>
			<?php echo $wp_filesystem->get_contents( get_template_directory() . '/assets/images/drawing_icons/' . esc_attr( $drawing_icon ) . '.svg' ); ?>
		</div>
	<?php endif; ?>
	<div class="icon_text">
		<?php if( $title ): ?>
			<div class="title"<?php echo( ( $title_style ) ? ' style="' . esc_attr( implode( ' ', $title_style ) ) . '"' : '' ); ?>>
				<?php if ( ! empty( $link['url'] ) ): ?>
					<?php
					if ( ! $link['target'] ) {
						$link['target'] = '_self';
					}
					?>
					<a<?php echo( ( $title_style ) ? ' style="' . esc_attr( implode( ' ', $title_style ) ) . '"' : '' ); ?> href="<?php echo esc_url( $link['url'] ) ?>" target="<?php echo esc_attr( $link['target'] ); ?>"><?php echo esc_html( $title ); ?></a>
				<?php else: ?>
					<?php echo wp_kses( $title, array( 'br' => array() ) ); ?>
				<?php endif; ?>
			</div>
		<?php endif; ?>
		<?php if( $text ): ?>
			<div class="text"<?php echo( ( $text_style ) ? ' style="' . esc_attr( implode( ' ', $text_style ) ) . '"' : '' ); ?>>
				<p><?php echo wp_kses( $text, array( 'br' => array() ) ); ?></p>
			</div>
		<?php endif; ?>
	</div>
</div>
<?php if( $drawing_icon ): ?>
	<style type="text/css" scoped>
		<?php echo "#" . esc_attr( $icon_id ); ?>{
		<?php
			if( $icon_size ){
				echo "height: " . esc_attr( $icon_size ) . "px;\n";
			}
			if( $icon_width_svg ){
				echo "width: " . esc_attr( $icon_width_svg ) . "px;\n";
			}
			if( $icon_color ){
				echo "stroke: " . esc_attr( $icon_color ) . ";\n";
			}
		?>
		}
	</style>
	<?php if ( ! wp_is_mobile() ): ?>
		<script type="text/javascript">
			jQuery(document).ready(function ($) {
				<?php if( $drawing_icon ): ?>
				$("#<?php echo esc_js( $icon_div_id ); ?> svg").attr( 'id', '<?php echo esc_js( $icon_id ); ?>' );
				new Vivus('<?php echo esc_js( $icon_id ); ?>', {
					type: 'async',
					duration: 150,
					animTimingFunction: Vivus['EASE_OUT']
				});
				<?php endif; ?>
			});
		</script>
	<?php endif; ?>
<?php endif; ?>
<?php endif; ?>