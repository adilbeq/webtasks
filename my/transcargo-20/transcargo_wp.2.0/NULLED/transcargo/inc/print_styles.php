<?php

if ( ! function_exists( 'transcargo_print_styles' ) ) {
	function transcargo_print_styles() {
		$post_id        = get_the_ID();
		$page_for_posts = get_option( 'page_for_posts' );
		if ( is_home() || is_category() || is_search() || is_tag() || is_tax() || is_404() ) {
			$post_id = $page_for_posts;
		}

		$css = "";

		if( get_theme_mod( 'site_style' ) == 'site_style_custom' ){
			global $wp_filesystem;

			if ( empty( $wp_filesystem ) ) {
				require_once ABSPATH . '/wp-admin/includes/file.php';
				WP_Filesystem();
			}
			$custom_style_css = $wp_filesystem->get_contents( get_template_directory() . '/assets/css/site_style_green.css' );
			$base_color = get_theme_mod( 'site_style_base_color', '#183650' );
			$secondary_color = get_theme_mod( 'site_style_secondary_color', '#34ccff' );
			$custom_style_css = str_replace(
				array(
					'#184c4f',
					'#b6d15c',
					'rgba(24, 76, 79, .35)',
					'rgba(24, 76, 79, .75)',
					'rgba(24, 76, 79, .65)',
					'rgba(24, 76, 79, .9)',
					'rgba(24, 76, 79, .5)',
					'rgba(182, 209, 92, .1)'
				),
				array(
					$base_color,
					$secondary_color,
					transcargo_hex2rgba( $base_color, .35 ),
					transcargo_hex2rgba( $base_color, .75 ),
					transcargo_hex2rgba( $base_color, .9 ),
					transcargo_hex2rgba( $base_color, .5 ),
					transcargo_hex2rgba( $secondary_color, .1 ),
				),
				$custom_style_css
			);
			$css .= $custom_style_css;
		}

		$header_style = array();

		$header_style['color']               = get_post_meta( $post_id, 'header_title_color', true );
		$header_style['background-image']    = wp_get_attachment_image_src( get_post_meta( $post_id, 'header_bg_image', true ), 'full' );
		$header_style['background-position'] = get_post_meta( $post_id, 'header_bg_position', true );
		$header_style['background-size']     = get_post_meta( $post_id, 'header_bg_size', true );
		$header_style['background-repeat']   = get_post_meta( $post_id, 'header_bg_repeat', true );

		if ( $header_style ) {
			$css .= '#header{ ';
			foreach ( $header_style as $key => $val ) {
				if ( $val ) {
					if ( $key != 'background-image' ) {
						$css .= $key . ': ' . esc_attr( $val ) . '; ';
					} else {
						$css .= $key . ': url(' . esc_url( $val[0] ) . '); ';
					}
				}
			}
			$css .= '}';
		}

		if( get_theme_mod( 'site_boxed' ) && get_theme_mod( 'custom_bg_image' ) ){
			$css .= '
				body.boxed_layout{
					background-image: url( ' . esc_url( get_theme_mod( 'custom_bg_image' ) ) . ' );
				}
			';
		}

		$custom_css = get_theme_mod( 'custom_css' );

		if( $custom_css ){
			$css .= preg_replace( '/\s+/', ' ', $custom_css );
		}

		$vc_status = get_post_meta( get_the_ID(), '_wpb_vc_js_status', true );	
		if( is_404() or is_search() or $vc_status == "false" or is_home() ){
			wp_add_inline_style( 'transcargo-style', $css );
		}else{
			wp_add_inline_style( 'js_composer_front', $css );	
		}
	}
}

add_action( 'wp_enqueue_scripts', 'transcargo_print_styles' );