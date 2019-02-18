<?php
if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}

/**
 * Shortcode attributes
 * @var $atts
 * @var $title
 * @var $link
 * @var $el_class
 * @var $css
 * @var $height
 * Shortcode class
 * @var $this WPBakeryShortCode_VC_Video
 */
$title = $link = $el_class = $css = $height = '';

extract( shortcode_atts( array(
		'title' => '',
		'link' => '',
		'el_class' => '',
		'css' => '',
		'height' => '',
), $atts ) );

if ( '' === $link ) {
	return null;
}
$el_class = $this->getExtraClass( $el_class );
$id = uniqid( 'video_id_' );
$video_w = ( isset( $content_width ) ) ? $content_width : 500;
$video_h = $video_w / 1.61; //1.61 golden ratio
/** @var WP_Embed $wp_embed */
global $wp_embed;
$embed = '';
if ( is_object( $wp_embed ) ) {
	$embed = $wp_embed->run_shortcode( '[embed width="' . $video_w . '"' . $video_h . ']' . $link . '[/embed]' );
}
$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, 'wpb_video_widget wpb_content_element' . $el_class . $el_class . vc_shortcode_custom_css_class( $css, ' ' ), $this->settings['base'], $atts );
$css_class .= ' ' . $id;

$output = '<div class="' . esc_attr( $css_class ) . '">
		<div class="wpb_wrapper">
				' . wpb_widget_title( array( 'title' => $title, 'extraclass' => 'wpb_video_heading' ) ) . '
				<div class="wpb_video_wrapper">' . $embed . '</div>
			</div>';
		if( $height ){
			$output .= '
				<style scoped type="text/css">
					.wpb_video_widget.'.esc_attr($id).' .wpb_wrapper iframe{
						height: ' . intval( $height ) . 'px;
					}
				</style>
			';
		}
	$output .= '</div>';

echo $output;
