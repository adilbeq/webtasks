<?php

$title = $number = $show_date = $el_class = '';
$output = '';
$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );

$el_class = $this->getExtraClass( $el_class );

$output = '<div class="vc_wp_posts wpb_content_element' . esc_attr( $el_class ) . '">';
$type = 'TRANSCARGO_Widget_Recent_Posts';
$args = array(
	'before_widget' => '<aside class="widget stm_widget_recent_entries">',
	'after_widget'  => '</aside>',
	'before_title'  => '<h4 class="widget_title">',
	'after_title'   => '</h4>'
);
global $wp_widget_factory;
// to avoid unwanted warnings let's check before using widget
if ( is_object( $wp_widget_factory ) && isset( $wp_widget_factory->widgets, $wp_widget_factory->widgets[ $type ] ) ) {
	ob_start();
	the_widget( $type, $atts, $args );
	$output .= ob_get_clean();

	$output .= '</div>';

	echo $output;
} else {
	echo $this->debugComment( 'Widget ' . esc_attr( $type ) . 'Not found in : vc_wp_posts' );
}
