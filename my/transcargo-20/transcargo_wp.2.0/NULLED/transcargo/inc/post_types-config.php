<?php

$transcargoPostTypesOptions = array(
		'stm_service'     => array(
				'title'        => get_theme_mod( 'post_type_services_title', esc_html__( 'Service', 'transcargo' ) ),
				'plural_title' => get_theme_mod( 'post_type_services_plural', esc_html__( 'Services', 'transcargo' ) ),
				'all_items'    => get_theme_mod( 'post_type_services_all_items', esc_html__( 'All Services', 'transcargo' ) ),
				'rewrite'      => get_theme_mod( 'post_type_services_rewrite', 'services' ),
				'icon'         => get_theme_mod( 'post_type_services_icon', 'dashicons-clipboard' ),
				'supports'     => array( 'title', 'thumbnail', 'editor', 'excerpt' )
		),
		'stm_testimonial' => array(
				'title'               => get_theme_mod( 'post_type_testimonials_title', esc_html__( 'Testimonial', 'transcargo' ) ),
				'plural_title'        => get_theme_mod( 'post_type_testimonials_plural', esc_html__( 'Testimonials', 'transcargo' ) ),
				'all_items'           => get_theme_mod( 'post_type_testimonials_all_items', esc_html__( 'All Testimonials', 'transcargo' ) ),
				'rewrite'             => get_theme_mod( 'post_type_testimonials_rewrite', 'testimonials' ),
				'icon'                => get_theme_mod( 'post_type_services_icon', 'dashicons-testimonial' ),
				'supports'            => array( 'title', 'excerpt', 'thumbnail' ),
				'exclude_from_search' => true,
				'publicly_queryable'  => false
		),
		'stm_vc_sidebar'  => array(
				'title'               => esc_html__( 'VC Sidebar', 'transcargo' ),
				'plural_title'        => esc_html__( 'VC Sidebars', 'transcargo' ),
				'all_items'           => esc_html__( 'All Sidebars', 'transcargo' ),
				'rewrite'             => 'vc_sidebar',
				'icon'                => 'dashicons-schedule',
				'supports'            => array( 'title', 'editor' ),
				'exclude_from_search' => true,
				'publicly_queryable'  => false
		),
		'stm_careers'     => array(
				'title'        => get_theme_mod( 'post_type_careers_title', esc_html__( 'Vacancy', 'transcargo' ) ),
				'plural_title' => get_theme_mod( 'post_type_careers_plural', esc_html__( 'Vacancies', 'transcargo' ) ),
				'all_items'    => get_theme_mod( 'post_type_careers_all_items', esc_html__( 'All Vacancies', 'transcargo' ) ),
				'rewrite'      => get_theme_mod( 'post_type_careers_rewrite', 'careers_archive' ),
				'icon'         => get_theme_mod( 'post_type_careers_icon', 'dashicons-id' ),
				'supports'     => array( 'title', 'editor' )
		),
		'stm_staff'       => array(
				'title'               => get_theme_mod( 'post_type_staff_title', esc_html__( 'Staff', 'transcargo' ) ),
				'plural_title'        => get_theme_mod( 'post_type_staff_plural', esc_html__( 'Staff', 'transcargo' ) ),
				'all_items'           => get_theme_mod( 'post_type_staff_all_items', esc_html__( 'All Staff', 'transcargo' ) ),
				'rewrite'             => get_theme_mod( 'post_type_staff_rewrite', 'staff' ),
				'icon'                => get_theme_mod( 'post_type_careers_icon', 'dashicons-groups' ),
				'supports'            => array( 'title', 'thumbnail' ),
				'exclude_from_search' => true,
				'publicly_queryable'  => false
		),
		'stm_gallery'     => array(
				'title'               => esc_html__( 'Image', 'transcargo' ),
				'plural_title'        => esc_html__( 'All Gallery', 'transcargo' ),
				'all_items'           => esc_html__( 'All Gallery', 'transcargo' ),
				'rewrite'             => 'stm_gallery',
				'icon'                => 'dashicons-images-alt2',
				'supports'            => array( 'title', 'thumbnail' ),
				'exclude_from_search' => true,
				'publicly_queryable'  => false
		),
);

foreach ( $transcargoPostTypesOptions as $post_type => $data ) {
	$args = array();

	if ( ! empty( $data['plural_title'] ) ) {
		$args['pluralTitle'] = $data['plural_title'];
	}
	if ( ! empty( $data['all_items'] ) ) {
		$args['all_items'] = $data['all_items'];
	}
	if ( ! empty( $data['icon'] ) ) {
		$args['menu_icon'] = $data['icon'];
	}
	if ( ! empty( $data['rewrite'] ) ) {
		$args['rewrite'] = array( 'slug' => $data['rewrite'] );
	}
	if ( ! empty( $data['supports'] ) ) {
		$args['supports'] = $data['supports'];
	}
	if ( ! empty( $data['exclude_from_search'] ) ) {
		$args['exclude_from_search'] = $data['exclude_from_search'];
	}
	if ( ! empty( $data['publicly_queryable'] ) ) {
		$args['publicly_queryable'] = $data['publicly_queryable'];
	}
	if ( ! empty( $data['show_in_menu'] ) ) {
		$args['show_in_menu'] = $data['show_in_menu'];
	}
	STM_PostType::registerPostType( $post_type, esc_html( $data['title'] ), $args );
}

STM_PostType::addTaxonomy( 'stm_testimonials_category', esc_html__( 'Categories', 'transcargo' ), 'stm_testimonial' );
STM_PostType::addTaxonomy( 'stm_gallery_category', esc_html__( 'Categories', 'transcargo' ), 'stm_gallery' );

if ( ! function_exists( 'transcargo_post_types_init' ) ) {
	function transcargo_post_types_init() {

		STM_PostType::addMetaBox( 'page_setup', esc_html__( 'Page Setup', 'transcargo' ), array( 'page' ), '', '', '', array(
			'fields' => array(
				'separator_header_options' => array(
					'label' => esc_html__( 'Header Options', 'transcargo' ),
					'type'  => 'separator'
				),
				'header_style'             => array(
					'label'   => esc_html__( 'Header Style', 'transcargo' ),
					'type'    => 'select',
					'options' => array(
						''               => esc_html__( 'Default', 'transcargo' ),
						'header_style_1' => esc_html__( 'Style 1', 'transcargo' ),
						'header_style_2' => esc_html__( 'Style 2', 'transcargo' ),
						'header_style_3' => esc_html__( 'Style 3', 'transcargo' ),
						'header_style_4' => esc_html__( 'Style 4', 'transcargo' ),
					)
				),
				'transparent_header'       => array(
					'label' => esc_html__( 'Transparent Header', 'transcargo' ),
					'type'  => 'checkbox'
				),
				'header_title_color'       => array(
					'label' => esc_html__( 'Title Color', 'transcargo' ),
					'type'  => 'color_picker'
				),
				'header_bg_image'          => array(
					'label' => esc_html__( 'Background Image', 'transcargo' ),
					'type'  => 'image'
				),
				'header_bg_position'       => array(
					'label' => esc_html__( 'Background Position', 'transcargo' ),
					'type'  => 'text'
				),
				'header_bg_size'           => array(
					'label' => esc_html__( 'Background Size', 'transcargo' ),
					'type'  => 'text'
				),
				'header_bg_repeat'         => array(
					'label'   => esc_html__( 'Background Repeat', 'transcargo' ),
					'type'    => 'select',
					'options' => array(
						'repeat'    => esc_html__( 'Repeat', 'transcargo' ),
						'no-repeat' => esc_html__( 'No Repeat', 'transcargo' ),
						'repeat-x'  => esc_html__( 'Repeat-X', 'transcargo' ),
						'repeat-y'  => esc_html__( 'Repeat-Y', 'transcargo' )
					)
				),
				'disable_breadcrumbs'      => array(
					'label' => esc_html__( 'Disable Breadcrumbs', 'transcargo' ),
					'type'  => 'checkbox'
				),
			)
		) );

		STM_PostType::addMetaBox( 'post_setup', esc_html__( 'Post Setup', 'transcargo' ), array( 'post' ), '', '', '', array(
			'fields' => array(
				'separator_header_options'  => array(
					'label' => esc_html__( 'Header Options', 'transcargo' ),
					'type'  => 'separator'
				),
				'header_style'              => array(
					'label'   => esc_html__( 'Header Style', 'transcargo' ),
					'type'    => 'select',
					'options' => array(
						''               => esc_html__( 'Default', 'transcargo' ),
						'header_style_1' => esc_html__( 'Style 1', 'transcargo' ),
						'header_style_2' => esc_html__( 'Style 2', 'transcargo' ),
						'header_style_3' => esc_html__( 'Style 3', 'transcargo' ),
						'header_style_4' => esc_html__( 'Style 4', 'transcargo' ),
					)
				),
				'transparent_header'        => array(
					'label' => esc_html__( 'Transparent Header', 'transcargo' ),
					'type'  => 'checkbox'
				),
				'header_title_color'        => array(
					'label' => esc_html__( 'Title Color', 'transcargo' ),
					'type'  => 'color_picker'
				),
				'header_bg_image'           => array(
					'label' => esc_html__( 'Background Image', 'transcargo' ),
					'type'  => 'image'
				),
				'header_bg_position'        => array(
					'label' => esc_html__( 'Background Position', 'transcargo' ),
					'type'  => 'text'
				),
				'header_bg_size'            => array(
					'label' => esc_html__( 'Background Size', 'transcargo' ),
					'type'  => 'text'
				),
				'header_bg_repeat'          => array(
					'label'   => esc_html__( 'Background Repeat', 'transcargo' ),
					'type'    => 'select',
					'options' => array(
						'repeat'    => esc_html__( 'Repeat', 'transcargo' ),
						'no-repeat' => esc_html__( 'No Repeat', 'transcargo' ),
						'repeat-x'  => esc_html__( 'Repeat-X', 'transcargo' ),
						'repeat-y'  => esc_html__( 'Repeat-Y', 'transcargo' )
					)
				),
				'disable_breadcrumbs'       => array(
					'label' => esc_html__( 'Disable Breadcrumbs', 'transcargo' ),
					'type'  => 'checkbox'
				),
				'separator_content_options' => array(
					'label' => esc_html__( 'Content Options', 'transcargo' ),
					'type'  => 'separator'
				),
				'disable_post_details'      => array(
					'label' => esc_html__( 'Disable Post Details', 'transcargo' ),
					'type'  => 'checkbox'
				),
				'disable_cats'              => array(
					'label' => esc_html__( 'Disable Categories', 'transcargo' ),
					'type'  => 'checkbox'
				),
				'disable_author_info'       => array(
					'label' => esc_html__( 'Disable Author Info', 'transcargo' ),
					'type'  => 'checkbox'
				),
			)
		) );

		STM_PostType::addMetaBox( 'testimonial_info', esc_html__( 'Information', 'transcargo' ), array( 'stm_testimonial' ), '', '', '', array(
				'fields' => array(
						'position' => array(
								'label' => esc_html__( 'Position', 'transcargo' ),
								'type'  => 'text'
						),
						'bg_image' => array(
								'label' => esc_html__( 'Background Image', 'transcargo' ),
								'type'  => 'image'
						),
				)
		) );

		STM_PostType::addMetaBox( 'page_setup', esc_html__( 'Page Setup', 'transcargo' ), array(
			'stm_careers',
			'stm_service'
		), '', '', '', array(
			'fields' => array(
				'separator_header_options' => array(
					'label' => esc_html__( 'Header Options', 'transcargo' ),
					'type'  => 'separator'
				),
				'header_style'             => array(
					'label'   => esc_html__( 'Header Style', 'transcargo' ),
					'type'    => 'select',
					'options' => array(
						''               => esc_html__( 'Default', 'transcargo' ),
						'header_style_1' => esc_html__( 'Style 1', 'transcargo' ),
						'header_style_2' => esc_html__( 'Style 2', 'transcargo' ),
						'header_style_3' => esc_html__( 'Style 3', 'transcargo' ),
						'header_style_4' => esc_html__( 'Style 4', 'transcargo' ),
					)
				),
				'transparent_header'       => array(
					'label' => esc_html__( 'Transparent Header', 'transcargo' ),
					'type'  => 'checkbox'
				),
				'header_title_color'       => array(
					'label' => esc_html__( 'Title Color', 'transcargo' ),
					'type'  => 'color_picker'
				),
				'header_bg_image'          => array(
					'label' => esc_html__( 'Background Image', 'transcargo' ),
					'type'  => 'image'
				),
				'header_bg_position'       => array(
					'label' => esc_html__( 'Background Position', 'transcargo' ),
					'type'  => 'text'
				),
				'header_bg_size'           => array(
					'label' => esc_html__( 'Background Size', 'transcargo' ),
					'type'  => 'text'
				),
				'header_bg_repeat'         => array(
					'label'   => esc_html__( 'Background Repeat', 'transcargo' ),
					'type'    => 'select',
					'options' => array(
						'repeat'    => esc_html__( 'Repeat', 'transcargo' ),
						'no-repeat' => esc_html__( 'No Repeat', 'transcargo' ),
						'repeat-x'  => esc_html__( 'Repeat-X', 'transcargo' ),
						'repeat-y'  => esc_html__( 'Repeat-Y', 'transcargo' )
					)
				),
				'disable_breadcrumbs'      => array(
					'label' => esc_html__( 'Disable Breadcrumbs', 'transcargo' ),
					'type'  => 'checkbox'
				),
			)
		) );

		STM_PostType::addMetaBox( 'careers_information', esc_html__( 'Information', 'transcargo' ), array( 'stm_careers' ), '', '', '', array(
			'fields' => array(
				'department'   => array(
					'label' => esc_html__( 'Department', 'transcargo' ),
					'type'  => 'text'
				),
				'location'     => array(
					'label' => esc_html__( 'Location', 'transcargo' ),
					'type'  => 'text'
				),
				'education'    => array(
					'label' => esc_html__( 'Education', 'transcargo' ),
					'type'  => 'text'
				),
				'compensation' => array(
					'label' => esc_html__( 'Compensation', 'transcargo' ),
					'type'  => 'text'
				),
				'contact_link' => array(
					'label' => esc_html__( 'Contact Us Link', 'transcargo' ),
					'type'  => 'text'
				),
			)
		) );

		STM_PostType::addMetaBox( 'staff_information', esc_html__( 'Information', 'transcargo' ), array( 'stm_staff' ), '', '', '', array(
			'fields' => array(
				'department'  => array(
					'label' => esc_html__( 'Department', 'transcargo' ),
					'type'  => 'text'
				),
				'phone'       => array(
					'label' => esc_html__( 'Phone', 'transcargo' ),
					'type'  => 'text'
				),
				'skype'       => array(
					'label' => esc_html__( 'Skype', 'transcargo' ),
					'type'  => 'text'
				),
				'email'       => array(
					'label' => esc_html__( 'Email', 'transcargo' ),
					'type'  => 'text'
				),
				'facebook'    => array(
					'label' => esc_html__( 'Facebook', 'transcargo' ),
					'type'  => 'text'
				),
				'twitter'     => array(
					'label' => esc_html__( 'Twitter', 'transcargo' ),
					'type'  => 'text'
				),
				'google_plus' => array(
					'label' => esc_html__( 'Google+', 'transcargo' ),
					'type'  => 'text'
				),
				'linkedin'    => array(
					'label' => esc_html__( 'Linkedin', 'transcargo' ),
					'type'  => 'text'
				),
			)
		) );

	}
}

add_action( 'init', 'transcargo_post_types_init' );