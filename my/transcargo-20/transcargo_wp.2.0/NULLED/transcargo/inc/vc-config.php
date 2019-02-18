<?php

if ( function_exists( 'vc_set_default_editor_post_types' ) ) {
	vc_set_default_editor_post_types( array( 'page', 'post', 'stm_service', 'stm_vc_sidebar', 'stm_careers' ) );
}

add_action( 'vc_before_init', 'transcargo_vc_set_as_theme' );

if ( ! function_exists( 'transcargo_vc_set_as_theme' ) ) {
	function transcargo_vc_set_as_theme() {
		vc_set_as_theme( true );
	}
}

if ( ! function_exists( 'transcargo_wpb_widget_title' ) ) {
	function transcargo_wpb_widget_title( $output, $params ) {
		if ( '' === $params['title'] ) {
			return '';
		}

		$extraclass = ( isset( $params['extraclass'] ) ) ? ' ' . $params['extraclass'] : '';
		$output     = '<h4 class="wpb_heading' . esc_attr( $extraclass ) . '">' . esc_html( $params['title'] ) . '</h4>';

		return $output;
	}
}

add_filter( 'wpb_widget_title', 'transcargo_wpb_widget_title', 10, 2 );

if ( ! function_exists( 'transcargo_vc_google_fonts' ) ) {
	function transcargo_vc_google_fonts( $fonts ) {
		$fonts[] = (object) array(
				'font_family' => 'Titillium Web',
				'font_styles' => '200,200italic,300,300italic,regular,italic,600,600italic,700,700italic,900',
				'font_types'  => '200 light regular:200:normal,200 light italic:200:italic,300 light regular:300:normal,300 light italic:300:italic,400 regular:400:normal,400 italic:400:italic,500 bold regular:500:normal,500 bold italic:500:italic,600 bold regular:600:normal,600 bold italic:600:italic,700 bold regular:700:normal,700 bold italic:700:italic,800 bold regular:800:normal,800 bold italic:800:italic,900 bold regular:900:normal'
		);
		return $fonts;
	}
}

add_filter( 'vc_google_fonts_get_fonts_filter', 'transcargo_vc_google_fonts', 10, 1 );

add_action( 'admin_init', 'transcargo_update_existing_shortcodes' );

if ( ! function_exists( 'transcargo_update_existing_shortcodes' ) ) {
	function transcargo_update_existing_shortcodes() {
		if ( function_exists( 'vc_map_update' ) ) {
			vc_add_params( 'vc_btn', array(
				array(
					'type'               => 'dropdown',
					'heading'            => esc_html__( 'Color', 'transcargo' ),
					'param_name'         => 'color',
					'description'        => esc_html__( 'Select button color.', 'transcargo' ),
					'param_holder_class' => 'vc_colored-dropdown vc_btn3-colored-dropdown',
					'value'              => array(
						                        esc_html__( 'Theme Style 1', 'transcargo' )     => 'theme_style_1',
						                        esc_html__( 'Theme Style 2', 'transcargo' )     => 'theme_style_2',
						                        esc_html__( 'Theme Style 3', 'transcargo' )     => 'theme_style_3',
						                        esc_html__( 'Classic Grey', 'transcargo' )      => 'default',
						                        esc_html__( 'Classic Blue', 'transcargo' )      => 'primary',
						                        esc_html__( 'Classic Turquoise', 'transcargo' ) => 'info',
						                        esc_html__( 'Classic Green', 'transcargo' )     => 'success',
						                        esc_html__( 'Classic Orange', 'transcargo' )    => 'warning',
						                        esc_html__( 'Classic Red', 'transcargo' )       => 'danger',
						                        esc_html__( 'Classic Black', 'transcargo' )     => 'inverse',
					                        ) + getVcShared( 'colors-dashed' ),
					'std'                => 'grey',
					'dependency'         => array(
						'element'            => 'style',
						'value_not_equal_to' => array( 'custom', 'outline-custom' ),
					),
				)
			) );
			vc_add_params( 'vc_tta_accordion', array(
				array(
					'type'               => 'dropdown',
					'param_name'         => 'color',
					'value'              => array(
						                        esc_html__( 'Theme Style', 'transcargo' ) => 'theme_style',
					                        ) + getVcShared( 'colors-dashed' ),
					'std'                => 'grey',
					'heading'            => esc_html__( 'Color', 'transcargo' ),
					'description'        => esc_html__( 'Select accordion color.', 'transcargo' ),
					'param_holder_class' => 'vc_colored-dropdown',
				),
			) );
			vc_add_params( 'vc_video', array(
					array(
							'type'       => 'textfield',
							'param_name' => 'height',
							'heading'    => esc_html__( 'Height (px)', 'transcargo' )
					),
			) );
			vc_add_params( 'vc_progress_bar', array(
				array(
					'type'        => 'param_group',
					'heading'     => esc_html__( 'Values', 'transcargo' ),
					'param_name'  => 'values',
					'description' => esc_html__( 'Enter values for graph - value, title and color.', 'transcargo' ),
					'value'       => urlencode( json_encode( array(
						array(
							'label' => esc_html__( 'Development', 'transcargo' ),
							'value' => '90',
						),
						array(
							'label' => esc_html__( 'Design', 'transcargo' ),
							'value' => '80',
						),
						array(
							'label' => esc_html__( 'Marketing', 'transcargo' ),
							'value' => '70',
						),
					) ) ),
					'params'      => array(
						array(
							'type'        => 'textfield',
							'heading'     => esc_html__( 'Label', 'transcargo' ),
							'param_name'  => 'label',
							'description' => esc_html__( 'Enter text used as title of bar.', 'transcargo' ),
							'admin_label' => true,
						),
						array(
							'type'        => 'textfield',
							'heading'     => esc_html__( 'Value', 'transcargo' ),
							'param_name'  => 'value',
							'description' => esc_html__( 'Enter value of bar.', 'transcargo' ),
							'admin_label' => true,
						),
						array(
							'type'               => 'dropdown',
							'heading'            => esc_html__( 'Color', 'transcargo' ),
							'param_name'         => 'color',
							'value'              => array(
							                        esc_html__( 'Theme Style', 'transcargo' )        => 'theme_style',
							                        esc_html__( 'Classic Grey', 'transcargo' )      => 'bar_grey',
							                        esc_html__( 'Classic Blue', 'transcargo' )      => 'bar_blue',
							                        esc_html__( 'Classic Turquoise', 'transcargo' ) => 'bar_turquoise',
							                        esc_html__( 'Classic Green', 'transcargo' )     => 'bar_green',
							                        esc_html__( 'Classic Orange', 'transcargo' )    => 'bar_orange',
							                        esc_html__( 'Classic Red', 'transcargo' )       => 'bar_red',
							                        esc_html__( 'Classic Black', 'transcargo' )     => 'bar_black',
							                        ) + getVcShared( 'colors-dashed' ) + array(
													esc_html__( 'Custom Color', 'transcargo' ) => 'custom',
							                        ),
							'description'        => esc_html__( 'Select single bar background color.', 'transcargo' ),
							'admin_label'        => true,
							'param_holder_class' => 'vc_colored-dropdown',
						),
						array(
							'type'        => 'colorpicker',
							'heading'     => esc_html__( 'Custom color', 'transcargo' ),
							'param_name'  => 'customcolor',
							'description' => esc_html__( 'Select custom single bar background color.', 'transcargo' ),
							'dependency'  => array(
								'element' => 'color',
								'value'   => array( 'custom' ),
							),
						),
						array(
							'type'        => 'colorpicker',
							'heading'     => esc_html__( 'Custom text color', 'transcargo' ),
							'param_name'  => 'customtxtcolor',
							'description' => esc_html__( 'Select custom single bar text color.', 'transcargo' ),
							'dependency'  => array(
								'element' => 'color',
								'value'   => array( 'custom' ),
							),
						),
					),
				),
				array(
					'type'               => 'dropdown',
					'heading'            => esc_html__( 'Color', 'transcargo' ),
					'param_name'         => 'bgcolor',
					'value'              => array(
					                        esc_html__( 'Theme Style', 'transcargo' )        => 'theme_style',
					                        esc_html__( 'Classic Grey', 'transcargo' )      => 'bar_grey',
					                        esc_html__( 'Classic Blue', 'transcargo' )      => 'bar_blue',
					                        esc_html__( 'Classic Turquoise', 'transcargo' ) => 'bar_turquoise',
					                        esc_html__( 'Classic Green', 'transcargo' )     => 'bar_green',
					                        esc_html__( 'Classic Orange', 'transcargo' )    => 'bar_orange',
					                        esc_html__( 'Classic Red', 'transcargo' )       => 'bar_red',
					                        esc_html__( 'Classic Black', 'transcargo' )     => 'bar_black',
					                        ) + getVcShared( 'colors-dashed' ) + array(
											esc_html__( 'Custom Color', 'transcargo' ) => 'custom',
					                        ),
					'description'        => esc_html__( 'Select bar background color.', 'transcargo' ),
					'admin_label'        => true,
					'param_holder_class' => 'vc_colored-dropdown',
				),
				array(
					'type'               => 'dropdown',
					'heading'            => esc_html__( 'Color', 'transcargo' ),
					'param_name'         => 'color',
					'value'              => array(
							                        esc_html__( 'Theme Style', 'transcargo' )        => 'theme_style',
							                        esc_html__( 'Classic Grey', 'transcargo' )      => 'bar_grey',
							                        esc_html__( 'Classic Blue', 'transcargo' )      => 'bar_blue',
							                        esc_html__( 'Classic Turquoise', 'transcargo' ) => 'bar_turquoise',
							                        esc_html__( 'Classic Green', 'transcargo' )     => 'bar_green',
							                        esc_html__( 'Classic Orange', 'transcargo' )    => 'bar_orange',
							                        esc_html__( 'Classic Red', 'transcargo' )       => 'bar_red',
							                        esc_html__( 'Classic Black', 'transcargo' )     => 'bar_black',
					                        ) + getVcShared( 'colors-dashed' ) + array(
									esc_html__( 'Custom Color', 'transcargo' ) => 'custom',
					                        ),
					'description'        => esc_html__( 'Select single bar background color.', 'transcargo' ),
					'admin_label'        => true,
					'param_holder_class' => 'vc_colored-dropdown',
				),
			) );
		}
	}
}


if ( function_exists( 'vc_map' ) ) {
	add_action( 'init', 'vc_transcargo_elements' );
}

if ( ! function_exists( 'vc_transcargo_elements' ) ) {
	function vc_transcargo_elements() {

		if ( class_exists( 'RevSlider' ) ) {

			$slider     = new RevSlider();
			$arrSliders = $slider->getArrSliders();

			$revsliders = array();
			if ( $arrSliders ) {
				foreach ( $arrSliders as $slider ) {
					$revsliders[ $slider->getTitle() ] = $slider->getID();
				}
			} else {
				$revsliders[ esc_html__( 'No sliders found', 'transcargo' ) ] = 0;
			}

			vc_map( array(
					'name'     => esc_html__( 'Revolution Slider Navigation', 'transcargo' ),
					'base'     => 'stm_rev_slider_nav',
					'icon'     => 'icon-wpb-revslider',
					'category' => esc_html__( 'STM', 'transcargo' ),
					'params'   => array(
							array(
									'type'        => 'dropdown',
									'heading'     => esc_html__( 'Revolution Slider', 'transcargo' ),
									'param_name'  => 'slider_id',
									'admin_label' => true,
									'value'       => $revsliders,
									'description' => esc_html__( 'Select your Revolution Slider.', 'transcargo' ),
							),
							array(
									'type'       => 'iconpicker',
									'heading'    => esc_html__( 'Icon', 'transcargo' ),
									'param_name' => 'icon'
							),
							array(
									'type'       => 'textfield',
									'heading'    => esc_html__( 'Icon Height (px)', 'transcargo' ),
									'param_name' => 'icon_height'
							),
							array(
									'type'        => 'textfield',
									'heading'     => esc_html__( 'Title', 'transcargo' ),
									'param_name'  => 'title',
									'admin_label' => true
							),
							array(
									'type'       => 'textfield',
									'heading'    => esc_html__( 'Go To Slide (int)', 'transcargo' ),
									'param_name' => 'slide_number'
							),
					)
			) );
		}

		$testimonial_categories_array = get_terms( 'stm_testimonials_category' );
		$testimonial_categories       = array(
				esc_html__( 'All', 'transcargo' ) => 'all'
		);
		if ( $testimonial_categories_array && ! is_wp_error( $testimonial_categories_array ) ) {
			foreach ( $testimonial_categories_array as $cat ) {
				$testimonial_categories[ $cat->name ] = $cat->slug;
			}
		}

		vc_map( array(
				'name'     => esc_html__( 'Services Carousel', 'transcargo' ),
				'base'     => 'stm_services',
				'icon'     => 'stm_services',
				'category' => esc_html__( 'STM', 'transcargo' ),
				'params'   => array(
						array(
								'type'       => 'textarea_html',
								'heading'    => esc_html__( 'Text', 'transcargo' ),
								'param_name' => 'content'
						),
						array(
								'type'       => 'textfield',
								'heading'    => esc_html__( 'Number Posts', 'transcargo' ),
								'param_name' => 'posts_per_page',
								'value'      => 12
						),
						array(
								'type'        => 'checkbox',
								'heading'     => esc_html__( 'Slider autoplay', 'transcargo' ),
								'param_name'  => 'autoplay',
								'description' => esc_html__( 'Enable autoplay mode.', 'transcargo' ),
								'value'       => array(
										esc_html__( 'Yes', 'transcargo' ) => 'yes'
								),
								'group'       => esc_html__( 'Carousel', 'transcargo' )
						),
						array(
								'type'        => 'textfield',
								'heading'     => esc_html__( 'Autoplay Timeout', 'transcargo' ),
								'param_name'  => 'timeout',
								'value'       => '5000',
								'description' => esc_html__( 'Autoplay interval timeout (in ms).', 'transcargo' ),
								'dependency'  => array(
										'element' => 'autoplay',
										'value'   => array( 'yes' ),
								),
								'group'       => esc_html__( 'Carousel', 'transcargo' ),
						),
						array(
								'type'        => 'checkbox',
								'heading'     => esc_html__( 'Hide pagination control', 'transcargo' ),
								'param_name'  => 'hide_pagination_control',
								'description' => esc_html__( 'If checked, pagination controls will be hidden.', 'transcargo' ),
								'value'       => array(
										esc_html__( 'Yes', 'transcargo' ) => 'yes'
								),
								'group'       => esc_html__( 'Carousel', 'transcargo' ),
						),
						array(
								'type'        => 'checkbox',
								'heading'     => esc_html__( 'Slider loop', 'transcargo' ),
								'param_name'  => 'loop',
								'description' => esc_html__( 'Enable slider loop mode.', 'transcargo' ),
								'value'       => array(
										esc_html__( 'Yes', 'transcargo' ) => 'yes'
								),
								'group'       => esc_html__( 'Carousel', 'transcargo' ),
						),
						array(
								'type'       => 'textfield',
								'heading'    => esc_html__( 'Smart Speed', 'transcargo' ),
								'param_name' => 'smart_speed',
								'value'      => '250',
								'group'      => esc_html__( 'Carousel', 'transcargo' ),
						),
						array(
								'type'        => 'textfield',
								'heading'     => esc_html__( 'Items', 'transcargo' ),
								'param_name'  => 'items',
								'value'       => '3',
								'description' => esc_html__( 'The number of items you want to see on the screen.', 'transcargo' ),
								'group'       => esc_html__( 'Carousel', 'transcargo' ),
						),
						array(
								'type'        => 'textfield',
								'heading'     => esc_html__( 'Items (Small Desktop)', 'transcargo' ),
								'param_name'  => 'items_small_desktop',
								'value'       => '3',
								'description' => esc_html__( 'Number of items the carousel will display. Default: at <980px - 3 items.', 'transcargo' ),
								'group'       => esc_html__( 'Carousel', 'transcargo' ),
						),
						array(
								'type'        => 'textfield',
								'heading'     => esc_html__( 'Items (Tablet)', 'transcargo' ),
								'param_name'  => 'items_tablet',
								'value'       => '2',
								'description' => esc_html__( 'Number of items the carousel will display. Default: at <768px - 2 items.', 'transcargo' ),
								'group'       => esc_html__( 'Carousel', 'transcargo' ),
						),
						array(
								'type'        => 'textfield',
								'heading'     => esc_html__( 'Items (Mobile)', 'transcargo' ),
								'param_name'  => 'items_mobile',
								'value'       => '1',
								'description' => esc_html__( 'Number of items the carousel will display. Default: at <479px - 1 item.', 'transcargo' ),
								'group'       => esc_html__( 'Carousel', 'transcargo' ),
						),
						array(
								'type'       => 'css_editor',
								'heading'    => esc_html__( 'Css', 'transcargo' ),
								'param_name' => 'css',
								'group'      => esc_html__( 'Design options', 'transcargo' )
						)
				)
		) );

		vc_map( array(
				'name'     => esc_html__( 'Services Grid', 'transcargo' ),
				'base'     => 'stm_services_grid',
				'icon'     => 'stm_services_grid',
				'category' => esc_html__( 'STM', 'transcargo' ),
				'params'   => array(
						array(
								'type'       => 'textfield',
								'heading'    => esc_html__( 'Number Posts', 'transcargo' ),
								'param_name' => 'posts_per_page',
								'value'      => 12
						),
						array(
								'type'       => 'dropdown',
								'heading'    => esc_html__( 'Posts Per Row', 'transcargo' ),
								'param_name' => 'posts_per_row',
								'value'       => array(
										4 => 4,
										3 => 3,
										2 => 2,
										1 => 1
								),
						),
						array(
								'type'        => 'textfield',
								'heading'     => esc_html__( 'Image size', 'transcargo' ),
								'param_name'  => 'img_size',
								'value'       => '',
								'description' => esc_html__( 'Enter image size. Example: thumbnail, medium, large, full or other sizes defined by current theme. Alternatively enter image size in pixels: 200x100 (Width x Height). Leave empty to use default size.', 'transcargo' ),
						),
						array(
								'type'       => 'css_editor',
								'heading'    => esc_html__( 'Css', 'transcargo' ),
								'param_name' => 'css',
								'group'      => esc_html__( 'Design options', 'transcargo' )
						)
				)
		) );

		vc_map( array(
				'name'     => esc_html__( 'Service Info Block', 'transcargo' ),
				'base'     => 'stm_service_info',
				'icon'     => 'stm_service_info',
				'category' => esc_html__( 'STM', 'transcargo' ),
				'params'   => array(
						array(
								'type'       => 'textfield',
								'heading'    => esc_html__( 'Title', 'transcargo' ),
								'param_name' => 'title',
								'admin_label' => true,
						),
						array(
								'type'       => 'textarea_html',
								'heading'    => esc_html__( 'Content', 'transcargo' ),
								'param_name' => 'content'
						),
						array(
								'type'       => 'attach_image',
								'heading'    => esc_html__( 'Image', 'transcargo' ),
								'param_name' => 'image'
						),
						array(
								'type'        => 'textfield',
								'heading'     => esc_html__( 'Image size', 'transcargo' ),
								'param_name'  => 'img_size',
								'value'       => '',
								'description' => esc_html__( 'Enter image size. Example: thumbnail, medium, large, full or other sizes defined by current theme. Alternatively enter image size in pixels: 200x100 (Width x Height). Leave empty to use default size.', 'transcargo' ),
						),
						array(
								'type'       => 'css_editor',
								'heading'    => esc_html__( 'Css', 'transcargo' ),
								'param_name' => 'css',
								'group'      => esc_html__( 'Design options', 'transcargo' )
						)
				)
		) );

		vc_map( array(
				'name'     => esc_html__( 'Counter', 'transcargo' ),
				'base'     => 'stm_counter',
				'icon'     => 'stm_counter',
				'category' => esc_html__( 'STM', 'transcargo' ),
				'params'   => array(
						array(
								'type'        => 'textarea',
								'heading'     => esc_html__( 'Title', 'transcargo' ),
								'admin_label' => true,
								'param_name'  => 'title'
						),
						array(
								'type'       => 'colorpicker',
								'heading'    => esc_html__( 'Font Color', 'transcargo' ),
								'param_name' => 'font_color'
						),
						array(
								'type'       => 'textfield',
								'heading'    => esc_html__( 'Counter Value', 'transcargo' ),
								'param_name' => 'counter_value',
								'value'      => '300'
						),
						array(
							'type' 				=> 'textfield',
							'heading' 			=> __( 'Counter Value Prefix', 'bestbuild' ),
							'param_name' 		=> 'counter_value_pre',
							'value'				=> ''
						),
						array(
							'type' 				=> 'textfield',
							'heading' 			=> __( 'Counter Value Suffix', 'bestbuild' ),
							'param_name' 		=> 'counter_value_suf',
							'value'				=> ''
						),
						array(
								'type'       => 'textfield',
								'heading'    => esc_html__( 'Duration', 'transcargo' ),
								'param_name' => 'duration',
								'value'      => '2.5'
						),
						array(
								'type'        => 'checkbox',
								'heading'     => esc_html__( 'Drawing Icon', 'transcargo' ),
								'param_name'  => 'drawing',
								'value'       => array(
										esc_html__( 'Yes', 'transcargo' ) => 'yes'
								)
						),
						array(
								'type'        => 'textfield',
								'heading'     => esc_html__( 'Extra class name', 'transcargo' ),
								'param_name'  => 'el_class',
								'description' => esc_html__( 'Style particular content element differently - add a class name and refer to it in custom CSS.', 'transcargo' )
						),
						array(
								'type'       => 'iconpicker',
								'heading'    => esc_html__( 'Icon', 'transcargo' ),
								'param_name' => 'icon',
								'group'      => esc_html__( 'Icon', 'transcargo' ),
								'dependency'  => array(
										'element' => 'drawing',
										'is_empty' => true
								),
						),
						array(
								'type'       => 'iconpicker',
								'heading'    => esc_html__( 'Icon', 'transcargo' ),
								'param_name' => 'drawing_icon',
								'group'      => esc_html__( 'Icon', 'transcargo' ),
								'dependency'  => array(
										'element' => 'drawing',
										'value' => array( 'yes' )
								),
								'settings' => array(
										'type' => 'drawing_icons'
								),
						),
						array(
								'type'       => 'colorpicker',
								'heading'    => esc_html__( 'Icon Color', 'transcargo' ),
								'param_name' => 'icon_color',
								'group'      => esc_html__( 'Icon', 'transcargo' )
						),
						array(
								'type'       => 'textfield',
								'heading'    => esc_html__( 'Icon Wrapper Width (px)', 'transcargo' ),
								'param_name' => 'icon_width',
								'value'      => '90',
								'group'      => esc_html__( 'Icon', 'transcargo' )
						),
						array(
								'type'       => 'textfield',
								'heading'    => esc_html__( 'Icon Width (px)', 'transcargo' ),
								'param_name' => 'icon_width_svg',
								'value'      => '67',
								'group'      => esc_html__( 'Icon', 'transcargo' ),
								'dependency'  => array(
										'element' => 'drawing',
										'value' => array( 'yes' )
								),
						),
						array(
								'type'       => 'textfield',
								'heading'    => esc_html__( 'Icon Height (px)', 'transcargo' ),
								'param_name' => 'icon_size',
								'value'      => '66',
								'group'      => esc_html__( 'Icon', 'transcargo' ),
						),
						array(
								'type'       => 'css_editor',
								'heading'    => esc_html__( 'Css', 'transcargo' ),
								'param_name' => 'css',
								'group'      => esc_html__( 'Design options', 'transcargo' )
						)
				)
		) );

		vc_map( array(
				'name'     => esc_html__( 'Testimonials', 'transcargo' ),
				'base'     => 'stm_testimonials',
				'icon'     => 'stm_testimonials',
				'category' => esc_html__( 'STM', 'transcargo' ),
				'params'   => array(
						array(
								'type'       => 'textfield',
								'heading'    => esc_html__( 'Number Testimonials', 'transcargo' ),
								'param_name' => 'posts_per_page',
								'value'      => 4
						),
						array(
								'type'        => 'dropdown',
								'heading'     => esc_html__( 'Style', 'transcargo' ),
								'param_name'  => 'style',
								'value'       => array(
										esc_html__( 'Style 1', 'transcargo' ) => 'style_1',
										esc_html__( 'Style 2', 'transcargo' ) => 'style_2'
								)
						),
						array(
								'type'       => 'dropdown',
								'heading'    => esc_html__( 'Category', 'transcargo' ),
								'param_name' => 'category',
								'value'      => $testimonial_categories
						),
						array(
								'type'        => 'checkbox',
								'heading'     => esc_html__( 'Slider autoplay', 'transcargo' ),
								'param_name'  => 'autoplay',
								'description' => esc_html__( 'Enable autoplay mode.', 'transcargo' ),
								'value'       => array(
										esc_html__( 'Yes', 'transcargo' ) => 'yes'
								),
								'group'       => esc_html__( 'Carousel', 'transcargo' )
						),
						array(
								'type'        => 'textfield',
								'heading'     => esc_html__( 'Autoplay Timeout', 'transcargo' ),
								'param_name'  => 'timeout',
								'value'       => '5000',
								'description' => esc_html__( 'Autoplay interval timeout (in ms).', 'transcargo' ),
								'dependency'  => array(
										'element' => 'autoplay',
										'value'   => array( 'yes' ),
								),
								'group'       => esc_html__( 'Carousel', 'transcargo' ),
						),
						array(
								'type'        => 'checkbox',
								'heading'     => esc_html__( 'Hide pagination control', 'transcargo' ),
								'param_name'  => 'hide_pagination_control',
								'description' => esc_html__( 'If checked, pagination controls will be hidden.', 'transcargo' ),
								'value'       => array(
										esc_html__( 'Yes', 'transcargo' ) => 'yes'
								),
								'group'       => esc_html__( 'Carousel', 'transcargo' ),
						),
						array(
								'type'        => 'checkbox',
								'heading'     => esc_html__( 'Slider loop', 'transcargo' ),
								'param_name'  => 'loop',
								'description' => esc_html__( 'Enable slider loop mode.', 'transcargo' ),
								'value'       => array(
										esc_html__( 'Yes', 'transcargo' ) => 'yes'
								),
								'group'       => esc_html__( 'Carousel', 'transcargo' ),
						),
						array(
								'type'       => 'textfield',
								'heading'    => esc_html__( 'Smart Speed', 'transcargo' ),
								'param_name' => 'smart_speed',
								'value'      => '250',
								'group'      => esc_html__( 'Carousel', 'transcargo' ),
						),
						array(
								'type'        => 'textfield',
								'heading'     => esc_html__( 'Items', 'transcargo' ),
								'param_name'  => 'items',
								'value'       => '1',
								'description' => esc_html__( 'The number of items you want to see on the screen.', 'transcargo' ),
								'group'       => esc_html__( 'Carousel', 'transcargo' ),
						),
						array(
								'type'        => 'textfield',
								'heading'     => esc_html__( 'Items (Small Desktop)', 'transcargo' ),
								'param_name'  => 'items_small_desktop',
								'value'       => '1',
								'description' => esc_html__( 'Number of items the carousel will display. Default: at <980px - 3 items.', 'transcargo' ),
								'group'       => esc_html__( 'Carousel', 'transcargo' ),
						),
						array(
								'type'        => 'textfield',
								'heading'     => esc_html__( 'Items (Tablet)', 'transcargo' ),
								'param_name'  => 'items_tablet',
								'value'       => '1',
								'description' => esc_html__( 'Number of items the carousel will display. Default: at <768px - 2 items.', 'transcargo' ),
								'group'       => esc_html__( 'Carousel', 'transcargo' ),
						),
						array(
								'type'        => 'textfield',
								'heading'     => esc_html__( 'Items (Mobile)', 'transcargo' ),
								'param_name'  => 'items_mobile',
								'value'       => '1',
								'description' => esc_html__( 'Number of items the carousel will display. Default: at <479px - 1 item.', 'transcargo' ),
								'group'       => esc_html__( 'Carousel', 'transcargo' ),
						),
						array(
								'type'       => 'css_editor',
								'heading'    => esc_html__( 'Css', 'transcargo' ),
								'param_name' => 'css',
								'group'      => esc_html__( 'Design options', 'transcargo' )
						)
				)
		) );

		vc_map( array(
				'name'     => esc_html__( 'News', 'transcargo' ),
				'base'     => 'stm_news',
				'icon'     => 'stm_news',
				'category' => esc_html__( 'STM', 'transcargo' ),
				'params'   => array(
						array(
								'type'        => 'textfield',
								'heading'     => esc_html__( 'Title', 'transcargo' ),
								'param_name'  => 'title',
								'admin_label' => true
						),
						array(
								'type'       => 'loop',
								'heading'    => esc_html__( 'Query', 'transcargo' ),
								'param_name' => 'loop',
								'value'      => 'size:2|post_type:post',
								'settings'   => array(
										'size' => array( 'hidden' => false, 'value' => 2 )
								),
						),
						array(
								'type'       => 'vc_link',
								'heading'    => esc_html__( 'Link', 'transcargo' ),
								'param_name' => 'link'
						),
						array(
								'type'       => 'css_editor',
								'heading'    => esc_html__( 'Css', 'transcargo' ),
								'param_name' => 'css',
								'group'      => esc_html__( 'Design options', 'transcargo' )
						)
				)
		) );

		vc_map( array(
				'name'     => esc_html__( 'Icon', 'transcargo' ),
				'base'     => 'stm_icon',
				'icon'     => 'stm_icon',
				'category' => esc_html__( 'STM', 'transcargo' ),
				'params'   => array(
						array(
								'type'        => 'checkbox',
								'heading'     => esc_html__( 'Drawing Icon', 'transcargo' ),
								'param_name'  => 'drawing',
								'value'       => array(
										esc_html__( 'Yes', 'transcargo' ) => 'yes'
								),
								'group'      => esc_html__( 'Icon', 'transcargo' ),
						),
						array(
								'type'       => 'dropdown',
								'heading'    => esc_html__( 'Icon Position', 'transcargo' ),
								'param_name' => 'icon_position',
								'value'      => array(
										esc_html__( 'Top', 'transcargo' )   => 'icon_position_top',
										esc_html__( 'Left', 'transcargo' )   => 'icon_position_left',
								),
								'group'      => esc_html__( 'Icon', 'transcargo' ),
						),
						array(
								'type'       => 'iconpicker',
								'heading'    => esc_html__( 'Icon', 'transcargo' ),
								'param_name' => 'icon',
								'group'      => esc_html__( 'Icon', 'transcargo' ),
								'dependency'  => array(
										'element' => 'drawing',
										'is_empty' => true
								),
						),
						array(
								'type'       => 'iconpicker',
								'heading'    => esc_html__( 'Icon', 'transcargo' ),
								'param_name' => 'drawing_icon',
								'group'      => esc_html__( 'Icon', 'transcargo' ),
								'dependency'  => array(
										'element' => 'drawing',
										'value' => array( 'yes' )
								),
								'settings' => array(
										'type' => 'drawing_icons'
								),
						),
						array(
								'type'       => 'textfield',
								'heading'    => esc_html__( 'Icon Width (px)', 'transcargo' ),
								'param_name' => 'icon_width_svg',
								'value'      => '67',
								'group'      => esc_html__( 'Icon', 'transcargo' ),
								'dependency'  => array(
										'element' => 'drawing',
										'value' => array( 'yes' )
								),
						),
						array(
								'type'       => 'textfield',
								'heading'    => esc_html__( 'Icon Height (px)', 'transcargo' ),
								'param_name' => 'icon_size',
								'value'      => 71,
								'group'      => esc_html__( 'Icon', 'transcargo' )
						),
						array(
								'type'       => 'textfield',
								'heading'    => esc_html__( 'Icon Wrapper Height (px)', 'transcargo' ),
								'param_name' => 'icon_height',
								'value'      => 72,
								'group'      => esc_html__( 'Icon', 'transcargo' ),
								'dependency' => array(
										'element' => 'icon_position',
										'value'   => array( 'icon_position_top' )
								),
						),
						array(
								'type'       => 'textfield',
								'heading'    => esc_html__( 'Icon Wrapper Width (px)', 'transcargo' ),
								'param_name' => 'icon_width',
								'value'      => 95,
								'group'      => esc_html__( 'Icon', 'transcargo' ),
								'dependency' => array(
										'element' => 'icon_position',
										'value'   => array( 'icon_position_left' )
								),
						),
						array(
								'type'        => 'textarea',
								'heading'     => esc_html__( 'Title', 'transcargo' ),
								'param_name'  => 'title',
								'admin_label' => true,
								'group'      => esc_html__( 'Title/Text', 'transcargo' )
						),
						array(
								'type'       => 'textarea',
								'heading'    => esc_html__( 'Text', 'transcargo' ),
								'param_name' => 'text',
								'group'      => esc_html__( 'Title/Text', 'transcargo' )
						),
						array(
								'type'       => 'textfield',
								'heading'    => esc_html__( 'Title Font Size (px)', 'transcargo' ),
								'param_name' => 'title_font_size',
								'value'      => 14,
								'group'      => esc_html__( 'Title/Text', 'transcargo' )
						),
						array(
								'type'       => 'textfield',
								'heading'    => esc_html__( 'Title Font Weight', 'transcargo' ),
								'param_name' => 'title_font_weight',
								'value'      => 500,
								'group'      => esc_html__( 'Title/Text', 'transcargo' )
						),
						array(
								'type'       => 'dropdown',
								'heading'    => esc_html__( 'Align', 'transcargo' ),
								'param_name' => 'align',
								'value'      => array(
										esc_html__( 'Left', 'transcargo' )   => 'left',
										esc_html__( 'Center', 'transcargo' ) => 'center',
										esc_html__( 'Right', 'transcargo' )  => 'right'
								)
						),
						array(
								'type'       => 'vc_link',
								'heading'    => esc_html__( 'Link', 'transcargo' ),
								'param_name' => 'link'
						),
						array(
								'type'       => 'colorpicker',
								'heading'    => esc_html__( 'Icon Color', 'transcargo' ),
								'param_name' => 'icon_color',
								'group'      => esc_html__( 'Icon', 'transcargo' )
						),
						array(
								'type'       => 'colorpicker',
								'heading'    => esc_html__( 'Title Color', 'transcargo' ),
								'param_name' => 'title_color',
								'group'      => esc_html__( 'Title/Text', 'transcargo' )
						),
						array(
								'type'       => 'colorpicker',
								'heading'    => esc_html__( 'Text Color', 'transcargo' ),
								'param_name' => 'text_color',
								'group'      => esc_html__( 'Title/Text', 'transcargo' )
						),
						array(
								'type'       => 'css_editor',
								'heading'    => esc_html__( 'Css', 'transcargo' ),
								'param_name' => 'css',
								'group'      => esc_html__( 'Design options', 'transcargo' )
						)
				)
		) );

		vc_map( array(
				'name'     => esc_html__( 'Image Carousel', 'transcargo' ),
				'base'     => 'stm_image_carousel',
				'icon'     => 'stm_image_carousel',
				'category' => esc_html__( 'STM', 'transcargo' ),
				'params'   => array(
						array(
								'type'       => 'attach_images',
								'heading'    => esc_html__( 'Images', 'transcargo' ),
								'param_name' => 'images'
						),
						array(
								'type'       => 'checkbox',
								'heading'    => esc_html__( 'Enable Grayscale', 'transcargo' ),
								'param_name' => 'grayscale',
								'value'      => array(
										esc_html__( 'Yes', 'transcargo' ) => 'yes'
								)
						),
						array(
								'type'        => 'textfield',
								'heading'     => esc_html__( 'Image size', 'transcargo' ),
								'param_name'  => 'img_size',
								'value'       => 'thumbnail',
								'description' => esc_html__( 'Enter image size. Example: thumbnail, medium, large, full or other sizes defined by current theme. Alternatively enter image size in pixels: 200x100 (Width x Height). Leave empty to use default size.', 'transcargo' ),
						),
						array(
								'type'        => 'checkbox',
								'heading'     => esc_html__( 'Slider autoplay', 'transcargo' ),
								'param_name'  => 'autoplay',
								'description' => esc_html__( 'Enable autoplay mode.', 'transcargo' ),
								'value'       => array(
										esc_html__( 'Yes', 'transcargo' ) => 'yes'
								),
								'group'       => esc_html__( 'Carousel', 'transcargo' )
						),
						array(
								'type'        => 'textfield',
								'heading'     => esc_html__( 'Autoplay Timeout', 'transcargo' ),
								'param_name'  => 'timeout',
								'value'       => '5000',
								'description' => esc_html__( 'Autoplay interval timeout (in ms).', 'transcargo' ),
								'dependency'  => array(
										'element' => 'autoplay',
										'value'   => array( 'yes' ),
								),
								'group'       => esc_html__( 'Carousel', 'transcargo' ),
						),
						array(
								'type'        => 'checkbox',
								'heading'     => esc_html__( 'Slider loop', 'transcargo' ),
								'param_name'  => 'loop',
								'description' => esc_html__( 'Enable slider loop mode.', 'transcargo' ),
								'value'       => array(
										esc_html__( 'Yes', 'transcargo' ) => 'yes'
								),
								'group'       => esc_html__( 'Carousel', 'transcargo' ),
						),
						array(
								'type'       => 'textfield',
								'heading'    => esc_html__( 'Smart Speed', 'transcargo' ),
								'param_name' => 'smart_speed',
								'value'      => '250',
								'group'      => esc_html__( 'Carousel', 'transcargo' ),
						),
						array(
								'type'        => 'textfield',
								'heading'     => esc_html__( 'Items', 'transcargo' ),
								'param_name'  => 'items',
								'value'       => '6',
								'description' => esc_html__( 'The number of items you want to see on the screen.', 'transcargo' ),
								'group'       => esc_html__( 'Carousel', 'transcargo' ),
						),
						array(
								'type'        => 'textfield',
								'heading'     => esc_html__( 'Items (Small Desktop)', 'transcargo' ),
								'param_name'  => 'items_small_desktop',
								'value'       => '5',
								'description' => esc_html__( 'Number of items the carousel will display. Default: at <980px - 3 items.', 'transcargo' ),
								'group'       => esc_html__( 'Carousel', 'transcargo' ),
						),
						array(
								'type'        => 'textfield',
								'heading'     => esc_html__( 'Items (Tablet)', 'transcargo' ),
								'param_name'  => 'items_tablet',
								'value'       => '4',
								'description' => esc_html__( 'Number of items the carousel will display. Default: at <768px - 2 items.', 'transcargo' ),
								'group'       => esc_html__( 'Carousel', 'transcargo' ),
						),
						array(
								'type'        => 'textfield',
								'heading'     => esc_html__( 'Items (Mobile)', 'transcargo' ),
								'param_name'  => 'items_mobile',
								'value'       => '1',
								'description' => esc_html__( 'Number of items the carousel will display. Default: at <479px - 1 item.', 'transcargo' ),
								'group'       => esc_html__( 'Carousel', 'transcargo' ),
						),
						array(
								'type'       => 'css_editor',
								'heading'    => esc_html__( 'Css', 'transcargo' ),
								'param_name' => 'css',
								'group'      => esc_html__( 'Design options', 'transcargo' )
						)
				)
		) );

		vc_map( array(
				'name'     => esc_html__( 'Image Gallery', 'transcargo' ),
				'base'     => 'stm_image_gallery',
				'icon'     => 'stm_image_gallery',
				'category' => esc_html__( 'STM', 'transcargo' ),
				'params'   => array(
						array(
								'type'       => 'attach_images',
								'heading'    => esc_html__( 'Images', 'transcargo' ),
								'param_name' => 'images'
						),
						array(
								'type'        => 'checkbox',
								'heading'     => esc_html__( 'Show Image Title', 'transcargo' ),
								'param_name'  => 'image_title',
								'value'       => array(
										esc_html__( 'Yes', 'transcargo' ) => 'yes'
								)
						),
						array(
								'type'       => 'textfield',
								'heading'    => esc_html__( 'Gallery Width (in px.)', 'transcargo' ),
								'param_name' => 'gallery_width',
								'value'      => '635'
						),
						array(
								'type'        => 'textfield',
								'heading'     => esc_html__( 'Image size', 'transcargo' ),
								'param_name'  => 'img_size',
								'value'       => '635x360',
								'description' => esc_html__( 'Enter image size. Example: thumbnail, medium, large, full or other sizes defined by current theme. Alternatively enter image size in pixels: 200x100 (Width x Height). Leave empty to use default size.', 'transcargo' ),
						),
						array(
								'type'        => 'checkbox',
								'heading'     => esc_html__( 'Slider autoplay', 'transcargo' ),
								'param_name'  => 'autoplay',
								'description' => esc_html__( 'Enable autoplay mode.', 'transcargo' ),
								'value'       => array(
										esc_html__( 'Yes', 'transcargo' ) => 'yes'
								),
								'group'       => esc_html__( 'Carousel', 'transcargo' )
						),
						array(
								'type'        => 'textfield',
								'heading'     => esc_html__( 'Autoplay Timeout', 'transcargo' ),
								'param_name'  => 'timeout',
								'value'       => '5000',
								'description' => esc_html__( 'Autoplay interval timeout (in ms).', 'transcargo' ),
								'dependency'  => array(
										'element' => 'autoplay',
										'value'   => array( 'yes' ),
								),
								'group'       => esc_html__( 'Carousel', 'transcargo' ),
						),
						array(
								'type'        => 'checkbox',
								'heading'     => esc_html__( 'Slider loop', 'transcargo' ),
								'param_name'  => 'loop',
								'description' => esc_html__( 'Enable slider loop mode.', 'transcargo' ),
								'value'       => array(
										esc_html__( 'Yes', 'transcargo' ) => 'yes'
								),
								'group'       => esc_html__( 'Carousel', 'transcargo' ),
						),
						array(
								'type'       => 'textfield',
								'heading'    => esc_html__( 'Smart Speed', 'transcargo' ),
								'param_name' => 'smart_speed',
								'value'      => '250',
								'group'      => esc_html__( 'Carousel', 'transcargo' ),
						),
						array(
								'type'        => 'checkbox',
								'heading'     => esc_html__( 'Vertical Navigation', 'transcargo' ),
								'param_name'  => 'vertical_navigation',
								'value'       => array(
										esc_html__( 'Yes', 'transcargo' ) => 'yes'
								),
								'group'       => esc_html__( 'Carousel', 'transcargo' )
						),
						array(
								'type'       => 'css_editor',
								'heading'    => esc_html__( 'Css', 'transcargo' ),
								'param_name' => 'css',
								'group'      => esc_html__( 'Design options', 'transcargo' )
						)
				)
		) );

		vc_map( array(
				'name'                    => esc_html__( 'Google Map', 'transcargo' ),
				'base'                    => 'stm_gmap',
				'icon'                    => 'stm_gmap',
				'as_parent'               => array( 'only' => 'stm_gmap_address' ),
				'show_settings_on_create' => true,
				'js_view'                 => 'VcColumnView',
				'category'                => esc_html__( 'STM', 'transcargo' ),
				'params'                  => array(
						array(
								'type'        => 'textfield',
								'heading'     => esc_html__( 'Map Height', 'transcargo' ),
								'param_name'  => 'map_height',
								'value'       => '688px',
								'description' => esc_html__( 'Enter map height in px', 'transcargo' )
						),
						array(
								'type'       => 'textfield',
								'heading'    => esc_html__( 'Map Zoom', 'transcargo' ),
								'param_name' => 'map_zoom',
								'value'      => 18
						),
						array(
								'type'       => 'attach_image',
								'heading'    => esc_html__( 'Marker Image', 'transcargo' ),
								'param_name' => 'marker'
						),
						array(
								'type'       => 'checkbox',
								'param_name' => 'disable_mouse_whell',
								'value'      => array(
										esc_html__( 'Disable map zoom on mouse wheel scroll', 'transcargo' ) => 'disable'
								)
						),
						array(
								'type'        => 'textfield',
								'heading'     => esc_html__( 'Extra class name', 'transcargo' ),
								'param_name'  => 'el_class',
								'description' => esc_html__( 'Style particular content element differently - add a class name and refer to it in custom CSS.', 'transcargo' )
						),
						array(
								'type'       => 'css_editor',
								'heading'    => esc_html__( 'Css', 'transcargo' ),
								'param_name' => 'css',
								'group'      => esc_html__( 'Design options', 'transcargo' )
						)
				)
		) );

		vc_map( array(
				'name'     => esc_html__( 'Address', 'transcargo' ),
				'base'     => 'stm_gmap_address',
				'icon'     => 'stm_gmap_address',
				'as_child' => array( 'only' => 'stm_gmap' ),
				'category' => esc_html__( 'STM', 'transcargo' ),
				'params'   => array(
						array(
								'type'        => 'textfield',
								'heading'     => esc_html__( 'Title', 'transcargo' ),
								'admin_label' => true,
								'param_name'  => 'title'
						),
						array(
								'type'       => 'textarea',
								'heading'    => esc_html__( 'Address', 'transcargo' ),
								'param_name' => 'address'
						),
						array(
								'type'       => 'textfield',
								'heading'    => esc_html__( 'Phone', 'transcargo' ),
								'param_name' => 'phone'
						),
						array(
								'type'       => 'textfield',
								'heading'    => esc_html__( 'Email', 'transcargo' ),
								'param_name' => 'email'
						),
						array(
								'type'        => 'textfield',
								'heading'     => esc_html__( 'Latitude', 'transcargo' ),
								'param_name'  => 'lat',
								'description' => wp_kses( __( '<a href="http://www.latlong.net/convert-address-to-lat-long.html">Here is a tool</a> where you can find Latitude & Longitude of your location', 'transcargo' ), array( 'a' => array( 'href' => array() ) ) )
						),
						array(
								'type'        => 'textfield',
								'heading'     => esc_html__( 'Longitude', 'transcargo' ),
								'param_name'  => 'lng',
								'description' => wp_kses( __( '<a href="http://www.latlong.net/convert-address-to-lat-long.html">Here is a tool</a> where you can find Latitude & Longitude of your location', 'transcargo' ), array( 'a' => array( 'href' => array() ) ) )
						),
				)
		) );

		vc_map( array(
				'name'        => esc_html__( 'STM Recent Posts', 'transcargo' ),
				'base'        => 'stm_recent_posts_widget',
				'icon'        => 'icon-wpb-wp',
				'category'    => esc_html__( 'STM Widgets', 'transcargo' ),
				'description' => esc_html__( 'The most recent posts on your site', 'transcargo' ),
				'params'      => array(
						array(
								'type'        => 'textfield',
								'heading'     => esc_html__( 'Widget title', 'transcargo' ),
								'param_name'  => 'title',
								'description' => esc_html__( 'What text use as a widget title. Leave blank to use default widget title.', 'transcargo' ),
								'value'       => esc_html__( 'Recent Posts', 'transcargo' ),
						),
						array(
								'type'        => 'textfield',
								'heading'     => esc_html__( 'Number of posts', 'transcargo' ),
								'description' => esc_html__( 'Enter number of posts to display.', 'transcargo' ),
								'param_name'  => 'number',
								'value'       => 5,
								'admin_label' => true,
						),
						array(
								'type'        => 'checkbox',
								'heading'     => esc_html__( 'Display post date?', 'transcargo' ),
								'param_name'  => 'show_date',
								'value'       => array( esc_html__( 'Yes', 'transcargo' ) => true ),
								'description' => esc_html__( 'If checked, date will be displayed.', 'transcargo' ),
						),
						array(
								'type'        => 'textfield',
								'heading'     => esc_html__( 'Extra class name', 'transcargo' ),
								'param_name'  => 'el_class',
								'description' => esc_html__( 'Style particular content element differently - add a class name and refer to it in custom CSS.', 'transcargo' ),
						),
				),
		) );

		$stm_sidebars_array = get_posts( array( 'post_type' => 'stm_vc_sidebar', 'posts_per_page' => - 1 ) );
		$stm_sidebars       = array( esc_html__( 'Select', 'transcargo' ) => 0 );
		if ( $stm_sidebars_array ) {
			foreach ( $stm_sidebars_array as $val ) {
				$stm_sidebars[ get_the_title( $val ) ] = $val->ID;
			}
		}

		vc_map( array(
				'name'     => esc_html__( 'STM Sidebar', 'transcargo' ),
				'base'     => 'stm_sidebar',
				'category' => esc_html__( 'STM', 'transcargo' ),
				'params'   => array(
						array(
								'type'       => 'dropdown',
								'heading'    => esc_html__( 'Sidebar', 'transcargo' ),
								'param_name' => 'sidebar',
								'value'      => $stm_sidebars
						),
						array(
								'type'       => 'css_editor',
								'heading'    => esc_html__( 'Css', 'transcargo' ),
								'param_name' => 'css',
								'group'      => esc_html__( 'Design options', 'transcargo' )
						)
				)
		) );

		vc_map( array(
				'name'     => esc_html__( 'Details', 'transcargo' ),
				'base'     => 'stm_post_details',
				'category' => esc_html__( 'STM Post Partials', 'transcargo' ),
				'params'   => array(
						array(
								'type'       => 'css_editor',
								'heading'    => esc_html__( 'Css', 'transcargo' ),
								'param_name' => 'css'
						)
				)
		) );

		vc_map( array(
				'name'     => esc_html__( 'Bottom Info', 'transcargo' ),
				'base'     => 'stm_post_bottom',
				'category' => esc_html__( 'STM Post Partials', 'transcargo' ),
				'params'   => array(
						array(
								'type'       => 'css_editor',
								'heading'    => esc_html__( 'Css', 'transcargo' ),
								'param_name' => 'css'
						)
				)
		) );

		vc_map( array(
				'name'     => esc_html__( 'About Author', 'transcargo' ),
				'base'     => 'stm_post_about_author',
				'category' => esc_html__( 'STM Post Partials', 'transcargo' ),
				'params'   => array(
						array(
								'type'       => 'css_editor',
								'heading'    => esc_html__( 'Css', 'transcargo' ),
								'param_name' => 'css',
						)
				)
		) );

		vc_map( array(
				'name'     => esc_html__( 'Comments', 'transcargo' ),
				'base'     => 'stm_post_comments',
				'category' => esc_html__( 'STM Post Partials', 'transcargo' ),
				'params'   => array(
						array(
								'type'       => 'css_editor',
								'heading'    => esc_html__( 'Css', 'transcargo' ),
								'param_name' => 'css',
						)
				)
		) );

		vc_map( array(
				'name'     => esc_html__( 'Pricing Table', 'transcargo' ),
				'base'     => 'stm_pricing_table',
				'category' => esc_html__( 'STM', 'transcargo' ),
				'params'   => array(
						array(
								'type'        => 'textfield',
								'heading'     => esc_html__( 'Title', 'transcargo' ),
								'param_name'  => 'title',
								'admin_label' => true,
						),
						array(
								'type'       => 'checkbox',
								'heading'    => esc_html__( 'Sticker', 'transcargo' ),
								'param_name' => 'sticker',
								'value'      => array(
										esc_html__( 'Yes', 'transcargo' ) => 'yes'
								)
						),
						array(
								'type'       => 'textfield',
								'heading'    => esc_html__( 'Sticker Title', 'transcargo' ),
								'param_name' => 'sticker_title',
								'value'      => esc_html__( 'Recomended!', 'transcargo' ),
								'dependency' => array(
										'element' => 'sticker',
										'value'   => array( 'yes' ),
								),
						),
						array(
								'type'       => 'textfield',
								'heading'    => esc_html__( 'Price', 'transcargo' ),
								'param_name' => 'price',
								'value'      => '19.99'
						),
						array(
								'type'       => 'textfield',
								'heading'    => esc_html__( 'Prefix', 'transcargo' ),
								'param_name' => 'prefix',
								'value'      => '$'
						),
						array(
								'type'       => 'textfield',
								'heading'    => esc_html__( 'Suffix', 'transcargo' ),
								'param_name' => 'suffix',
								'value'      => esc_html__( 'per month', 'transcargo' )
						),
						array(
								'type'       => 'textarea_html',
								'heading'    => esc_html__( 'Content', 'transcargo' ),
								'param_name' => 'content'
						),
						array(
								'type'       => 'vc_link',
								'heading'    => esc_html__( 'Link', 'transcargo' ),
								'param_name' => 'link'
						),
						array(
								'type'       => 'css_editor',
								'heading'    => esc_html__( 'Css', 'transcargo' ),
								'param_name' => 'css',
								'group'      => esc_html__( 'Design options', 'transcargo' )
						)
				)
		) );

		vc_map( array(
				'name'     => esc_html__( 'Circle Progress', 'transcargo' ),
				'base'     => 'stm_circle_progress',
				'category' => esc_html__( 'STM', 'transcargo' ),
				'params'   => array(
						array(
								'type'        => 'textfield',
								'heading'     => esc_html__( 'Title', 'transcargo' ),
								'param_name'  => 'title',
								'value'       => esc_html__( 'WordPress', 'transcargo' ),
								'admin_label' => true,
						),
						array(
								'type'       => 'textfield',
								'heading'    => esc_html__( 'Value (in %)', 'transcargo' ),
								'param_name' => 'value',
								'value'      => '50'
						),
						array(
								'type'       => 'textfield',
								'heading'    => esc_html__( 'Circle Width / Height (in px)', 'transcargo' ),
								'param_name' => 'size',
								'value'      => '125'
						),
						array(
								'type'       => 'colorpicker',
								'heading'    => esc_html__( 'Fill Color', 'transcargo' ),
								'param_name' => 'fill_color'
						),
						array(
								'type'       => 'css_editor',
								'heading'    => esc_html__( 'Css', 'transcargo' ),
								'param_name' => 'css',
								'group'      => esc_html__( 'Design options', 'transcargo' )
						)
				)
		) );

		vc_map( array(
				'name'     => esc_html__( 'Vacancy Bottom', 'transcargo' ),
				'base'     => 'stm_vacancy_bottom',
				'category' => esc_html__( 'STM Vacancy Partials', 'transcargo' ),
				'params'   => array(
						array(
								'type'       => 'css_editor',
								'heading'    => esc_html__( 'Css', 'transcargo' ),
								'param_name' => 'css'
						)
				)
		) );

		vc_map( array(
				'name'     => esc_html__( 'About Vacancy', 'transcargo' ),
				'base'     => 'stm_about_vacancy',
				'category' => esc_html__( 'STM Vacancy Partials', 'transcargo' ),
				'params'   => array(
						array(
								'type'       => 'css_editor',
								'heading'    => esc_html__( 'Css', 'transcargo' ),
								'param_name' => 'css',
						)
				)
		) );

		vc_map( array(
				'name'     => esc_html__( 'Vacancies', 'transcargo' ),
				'base'     => 'stm_vacancies',
				'category' => esc_html__( 'STM', 'transcargo' ),
				'params'   => array(
						array(
								'type'       => 'css_editor',
								'heading'    => esc_html__( 'Css', 'transcargo' ),
								'param_name' => 'css'
						)
				)
		) );

		vc_map( array(
				'name'     => esc_html__( 'Staff List', 'transcargo' ),
				'base'     => 'stm_staff_list',
				'icon'     => 'stm_staff_list',
				'category' => esc_html__( 'STM', 'transcargo' ),
				'params'   => array(
						array(
								'type'       => 'dropdown',
								'heading'    => esc_html__( 'Style', 'transcargo' ),
								'param_name' => 'style',
								'value'      => array(
										esc_html__( 'List', 'transcargo' ) => 'list',
										esc_html__( 'Grid', 'transcargo' ) => 'grid'
								)
						),
						array(
								'type'       => 'dropdown',
								'heading'    => esc_html__( 'Staff Per Row', 'transcargo' ),
								'param_name' => 'per_row',
								'value'      => array(
										2 => 2,
										3 => 3,
								),
								'dependency' => array(
										'element' => 'style',
										'value'   => array( 'grid' )
								)
						),
						array(
								'type'       => 'textfield',
								'heading'    => esc_html__( 'Count', 'transcargo' ),
								'param_name' => 'count',
								'value'      => 6
						),
						array(
								'type'       => 'css_editor',
								'heading'    => esc_html__( 'Css', 'transcargo' ),
								'param_name' => 'css',
								'group'      => esc_html__( 'Design options', 'transcargo' )
						)
				)
		) );

		vc_map( array(
				'name'     => esc_html__( 'Gallery', 'transcargo' ),
				'base'     => 'stm_gallery',
				'category' => esc_html__( 'STM', 'transcargo' ),
				'params'   => array(
						array(
								'type'       => 'dropdown',
								'heading'    => esc_html__( 'Style', 'transcargo' ),
								'param_name' => 'style',
								'value'      => array(
										esc_html__( 'Grid', 'transcargo' )    => 'grid',
										esc_html__( 'Masonry', 'transcargo' ) => 'masonry'
								)
						),
						array(
								'type'       => 'dropdown',
								'heading'    => esc_html__( 'Cols', 'transcargo' ),
								'param_name' => 'cols',
								'value'      => array(
										4 => 4,
										3 => 3,
										2 => 2,
										1 => 1,
								)
						),
						array(
								'type'       => 'css_editor',
								'heading'    => esc_html__( 'Css', 'transcargo' ),
								'param_name' => 'css',
								'group'      => esc_html__( 'Design options', 'transcargo' )
						)
				)
		) );

		vc_map( array(
				'name'     => esc_html__( 'Video Popup', 'transcargo' ),
				'base'     => 'stm_video_popup',
				'category' => esc_html__( 'STM', 'transcargo' ),
				'params'   => array(
						array(
								'type'       => 'attach_image',
								'heading'    => esc_html__( 'Preview', 'transcargo' ),
								'param_name' => 'image'
						),
						array(
								'type'        => 'textfield',
								'heading'     => esc_html__( 'Preview size', 'transcargo' ),
								'param_name'  => 'img_size',
								'value'       => '',
								'description' => esc_html__( 'Enter image size. Example: thumbnail, medium, large, full or other sizes defined by current theme. Alternatively enter image size in pixels: 200x100 (Width x Height). Leave empty to use default size.', 'transcargo' ),
						),
						array(
								'type'       => 'textfield',
								'heading'    => esc_html__( 'Video URL', 'transcargo' ),
								'param_name' => 'video'
						),
						array(
								'type'       => 'css_editor',
								'heading'    => esc_html__( 'Css', 'transcargo' ),
								'param_name' => 'css',
								'group'      => esc_html__( 'Design options', 'transcargo' )
						)
				)
		) );

	}
}

if ( class_exists( 'WPBakeryShortCodesContainer' ) ) {
	class WPBakeryShortCode_Stm_Gmap extends WPBakeryShortCodesContainer {
	}
}

if ( class_exists( 'WPBakeryShortCode' ) ) {
	if ( class_exists( 'RevSlider' ) ) {
		class WPBakeryShortCode_Stm_Rev_Slider_Nav extends WPBakeryShortCode {
		}
	}

	class WPBakeryShortCode_Stm_Services extends WPBakeryShortCode {
	}

	class WPBakeryShortCode_Stm_Services_Grid extends WPBakeryShortCode {
	}

	class WPBakeryShortCode_Stm_Service_Info extends WPBakeryShortCode {
	}

	class WPBakeryShortCode_Stm_Counter extends WPBakeryShortCode {
	}

	class WPBakeryShortCode_Stm_Testimonials extends WPBakeryShortCode {
	}

	class WPBakeryShortCode_Stm_News extends WPBakeryShortCode {
	}

	class WPBakeryShortCode_Stm_Icon extends WPBakeryShortCode {
	}

	class WPBakeryShortCode_Stm_Image_Carousel extends WPBakeryShortCode {
	}

	class WPBakeryShortCode_Stm_Gmap_Address extends WPBakeryShortCode {
	}

	class WPBakeryShortCode_Stm_Recent_Posts_Widget extends WPBakeryShortCode {
	}

	class WPBakeryShortCode_Stm_Sidebar extends WPBakeryShortCode {
	}

	class WPBakeryShortCode_Stm_Post_Details extends WPBakeryShortCode {
	}

	class WPBakeryShortCode_Stm_Post_Bottom extends WPBakeryShortCode {
	}

	class WPBakeryShortCode_Stm_Post_About_Author extends WPBakeryShortCode {
	}

	class WPBakeryShortCode_Stm_Post_Comments extends WPBakeryShortCode {
	}

	class WPBakeryShortCode_Stm_Image_Gallery extends WPBakeryShortCode {
	}

	class WPBakeryShortCode_Stm_Pricing_Table extends WPBakeryShortCode {
	}

	class WPBakeryShortCode_Stm_Circle_Progress extends WPBakeryShortCode {
	}

	class WPBakeryShortCode_Stm_Vacancy_Bottom extends WPBakeryShortCode {
	}

	class WPBakeryShortCode_Stm_About_Vacancy extends WPBakeryShortCode {
	}

	class WPBakeryShortCode_Stm_Vacancies extends WPBakeryShortCode {
	}

	class WPBakeryShortCode_Stm_Staff_List extends WPBakeryShortCode {
	}

	class WPBakeryShortCode_Stm_Gallery extends WPBakeryShortCode {
	}

	class WPBakeryShortCode_Stm_Video_Popup extends WPBakeryShortCode {
	}
}

add_filter( 'vc_iconpicker-type-fontawesome', 'vc_transcargo_icons' );

if ( ! function_exists( 'vc_transcargo_icons' ) ) {
	function vc_transcargo_icons( $fonts ) {

		$custom_fonts  = get_option( 'stm_fonts' );
		foreach ( $custom_fonts as $font => $info ) {
			$icon_set   = array();
			$icons      = array();
			$upload_dir = wp_upload_dir();
			$path       = trailingslashit( $upload_dir['basedir'] );
			$file       = $path . $info['include'] . '/' . $info['config'];
			include( $file );
			if ( ! empty( $icons ) ) {
				$icon_set = array_merge( $icon_set, $icons );
			}
			if ( ! empty( $icon_set ) ) {
				foreach ( $icon_set as $icons ) {
					foreach ( $icons as $icon ) {
						$fonts['Theme Icons'][] = array(
								$font . '-' . $icon['class'] => $icon['class']
						);
					}
				}
			}
		}

		return $fonts;
	}
}

add_filter( 'vc_iconpicker-type-drawing_icons', 'vc_transcargo_drawing_icons' );

if ( ! function_exists( 'vc_transcargo_drawing_icons' ) ) {
	function vc_transcargo_drawing_icons( $fonts ) {

		$fonts[] = array( "stm-projects-done" => 'STM Projects Done' );
		$fonts[] = array( "stm-clients-worldwide" => 'STM Clients Worldwide' );
		$fonts[] = array( "stm-owned-vehicles" => 'STM Owned Vehicles' );
		$fonts[] = array( "stm-people-in-team" => 'STM People In Team' );
		$fonts[] = array( "stm-packaging-and-storage" => 'STM Packaging And Storage' );
		$fonts[] = array( "stm-warehousing-service" => 'STM Warehousing Service' );
		$fonts[] = array( "stm-ground-transport" => 'STM Ground Transport' );
		$fonts[] = array( "stm-logistic-services" => 'STM Logistic Services' );

		return $fonts;
	}
}