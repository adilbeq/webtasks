<?php
global $wp_filesystem;

if ( empty( $wp_filesystem ) ) {
	require_once ABSPATH . '/wp-admin/includes/file.php';
	WP_Filesystem();
}

$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );

$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, vc_shortcode_custom_css_class( $css, ' ' ) );

if( $el_class ){
	$css_class = ' ' . $el_class;
}

if ( ! wp_is_mobile() ) {
	wp_enqueue_script( 'countUp' );
	wp_enqueue_script( 'jquery.appear' );
	if( $drawing ){
		wp_enqueue_script( 'vivus' );
	}
}

$counter_id = uniqid( 'counter_' );
$icon_div_id = uniqid( 'icon_wr_' );
$icon_id = uniqid( 'icon_' );
$icon_style = array();
$title_style = array();

if( $icon_color ){
	$icon_style['color'] = 'color: ' . $icon_color . ';';
}

if( $icon_width ){
	$icon_style['width'] = 'width: ' . $icon_width . 'px;';
}

if( $icon_size ){
	$icon_style['font-size'] = 'font-size: ' . $icon_size . 'px;';
}

if( $font_color ){
	$title_style['color'] = 'color: ' . $font_color . ';';
}

?>
<?php if( $counter_value ): ?>
	<div class="stm_counter<?php echo esc_attr( $css_class ); ?>">
		<?php if( $icon ): ?>
			<div class="icon"<?php echo( ( $icon_style ) ? ' style="' . esc_attr( implode( ' ', $icon_style ) ) . '"' : '' ); ?>>
				<i class="<?php echo esc_attr( $icon ); ?>"></i>
			</div>
		<?php elseif( $drawing_icon ): ?>
			<div id="<?php echo esc_attr( $icon_div_id ); ?>" class="icon"<?php echo( ( $icon_style ) ? ' style="' . esc_attr( implode( ' ', $icon_style ) ) . '"' : '' ); ?>>
				<?php echo $wp_filesystem->get_contents( get_template_directory() . '/assets/images/drawing_icons/' . esc_attr( $drawing_icon ) . '.svg' ); ?>
			</div>
		<?php endif; ?>
		<div class="text">
			<?php if ( wp_is_mobile() ) { ?>
				<div class="value"<?php echo( ( $title_style ) ? ' style="' . esc_attr( implode( ' ', $title_style ) ) . '"' : '' ); ?> id="<?php echo esc_attr( $counter_id ); ?>"><?php echo esc_attr( $counter_value_pre ); ?><?php echo esc_attr( $counter_value ); ?><?php echo esc_attr( $counter_value_suf ); ?></div>
			<?php } else { ?>
				<div class="value"<?php echo( ( $title_style ) ? ' style="' . esc_attr( implode( ' ', $title_style ) ) . '"' : '' ); ?> id="<?php echo esc_attr( $counter_id ); ?>"></div>
			<?php } ?>
			<?php if ( $title ) { ?>
				<div class="title"<?php echo( ( $title_style ) ? ' style="' . esc_attr( implode( ' ', $title_style ) ) . '"' : '' ); ?>><?php echo wp_kses_post( $title ); ?></div>
			<?php } ?>
		</div>
	</div>
	<?php if( $drawing_icon ): ?>
		<style type="text/css" scoped>
			<?php echo "#" . $icon_id; ?>{
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
	<?php endif; ?>
	<script type="text/javascript">
		jQuery(document).ready(function ($) {
			$("#<?php echo esc_js( $icon_div_id ); ?> svg").attr( 'id', '<?php echo esc_js( $icon_id ); ?>' );
			<?php if ( ! wp_is_mobile() ): ?>
				var <?php echo esc_js( $counter_id ); ?> = new countUp("<?php echo esc_js( $counter_id ); ?>", 0, <?php echo esc_js( $counter_value ); ?>, 0, <?php echo esc_js( $duration ); ?>, {
					useEasing: true,
					useGrouping: false,
					prefix : '<?php echo esc_attr( $counter_value_pre ); ?>', 
					suffix : '<?php echo esc_attr( $counter_value_suf ); ?>' 
				});
				var inited = false;
				$("#<?php echo esc_js( $counter_id ); ?>").appear({ force_process: true });

				$("#<?php echo esc_js( $counter_id ); ?>").on('appear', function () {
					if (!inited) {
						<?php echo esc_js( $counter_id ); ?>.start();
						inited = true;
					}
				});
				<?php if( $drawing_icon ): ?>
					new Vivus('<?php echo esc_js( $icon_id ); ?>', {
						type: 'async',
						duration: 150,
						animTimingFunction: Vivus['EASE_OUT']
					});
				<?php endif; ?>
			<?php endif; ?>
		});
	</script>
<?php endif; ?>