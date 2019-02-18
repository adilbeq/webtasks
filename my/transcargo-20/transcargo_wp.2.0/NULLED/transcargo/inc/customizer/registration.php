<?php

$socials = array(
	'facebook'      => esc_html__( 'Facebook', 'transcargo' ),
	'twitter'       => esc_html__( 'Twitter', 'transcargo' ),
	'instagram'     => esc_html__( 'Instagram', 'transcargo' ),
	'google-plus'   => esc_html__( 'Google+', 'transcargo' ),
	'vimeo'         => esc_html__( 'Vimeo', 'transcargo' ),
	'linkedin'      => esc_html__( 'Linkedin', 'transcargo' ),
	'behance'       => esc_html__( 'Behance', 'transcargo' ),
	'dribbble'      => esc_html__( 'Dribbble', 'transcargo' ),
	'flickr'        => esc_html__( 'Flickr', 'transcargo' ),
	'github'        => esc_html__( 'Git', 'transcargo' ),
	'pinterest'     => esc_html__( 'Pinterest', 'transcargo' ),
	'yahoo'         => esc_html__( 'Yahoo', 'transcargo' ),
	'delicious'     => esc_html__( 'Delicious', 'transcargo' ),
	'dropbox'       => esc_html__( 'Dropbox', 'transcargo' ),
	'reddit'        => esc_html__( 'Reddit', 'transcargo' ),
	'soundcloud'    => esc_html__( 'Soundcloud', 'transcargo' ),
	'google'        => esc_html__( 'Google', 'transcargo' ),
	'skype'         => esc_html__( 'Skype', 'transcargo' ),
	'youtube'       => esc_html__( 'Youtube', 'transcargo' ),
	'tumblr'        => esc_html__( 'Tumblr', 'transcargo' ),
	'whatsapp'      => esc_html__( 'Whatsapp', 'transcargo' ),
	'odnoklassniki' => esc_html__( 'Odnoklassniki', 'transcargo' ),
	'vk'            => esc_html__( 'Vk', 'transcargo' ),
);

TRANSCARGO_Customizer::setPanels( array(
	'site_settings' => array(
		'title'    => esc_html__( 'Site Settings', 'transcargo' ),
		'priority' => 10
	),
	'header'        => array(
		'title'    => esc_html__( 'Header', 'transcargo' ),
		'priority' => 20
	),
	'footer'        => array(
		'title'    => esc_html__( 'Footer', 'transcargo' ),
		'priority' => 50
	),
	'post_types'    => array(
		'title'    => esc_html__( 'Post Types', 'transcargo' ),
		'priority' => 60
	),
	'typography'    => array(
		'title'    => esc_html__( 'Typography', 'transcargo' ),
		'priority' => 70
	),
) );

TRANSCARGO_Customizer::setSection( 'title_tagline', array(
	'title'    => esc_html__( 'Logo &amp; Title', 'transcargo' ),
	'panel'    => 'site_settings',
	'priority' => 10,
	'fields'   => array(
		'title_tag_separator_1' => array(
			'type' => 'transcargo-separator'
		),
		'logo'                  => array(
			'label' => esc_html__( 'Logo', 'transcargo' ),
			'type'  => 'image'
		),
		'logo_width'         => array(
				'label'  => esc_html__( 'Width', 'transcargo' ),
				'type'   => 'transcargo-attr',
				'mode'   => 'width',
				'units'  => 'px',
				'output' => '.top_nav_wr .top_nav .logo a img'
		),
		'logo_height'        => array(
				'label'  => esc_html__( 'Height', 'transcargo' ),
				'type'   => 'transcargo-attr',
				'mode'   => 'height',
				'units'  => 'px',
				'output' => '.top_nav_wr .top_nav .logo a img'
		),
		'logo_margin_top'    => array(
				'label'  => esc_html__( 'Margin Top', 'transcargo' ),
				'type'   => 'transcargo-attr',
				'mode'   => 'margin-top',
				'units'  => 'px',
				'output' => '.top_nav_wr .top_nav .logo a'
		),
		'logo_margin_bottom' => array(
				'label'  => esc_html__( 'Margin Bottom', 'transcargo' ),
				'type'   => 'transcargo-attr',
				'mode'   => 'margin-bottom',
				'units'  => 'px',
				'output' => '.top_nav_wr .top_nav .logo a'
		),
		'mobile_logo'    => array(
			'label' => esc_html__( 'Mobile Logo', 'transcargo' ),
			'type'  => 'image'
		),
		'title_tag_separator_2' => array(
			'type' => 'transcargo-separator'
		)
	)
) );

TRANSCARGO_Customizer::setSection( 'envato_api_settings', array(
	'title'    => esc_html__( 'One Click update', 'transcargo' ),
	'panel'    => 'site_settings',
	'priority' => 250,
	'fields'   => array(
		'envato_username' => array(
			'label' => esc_html__( 'Envato Username', 'transcargo' ),
			'type'  => 'text',
			'default' => ''
		),
		'envato_api' => array(
			'label' => esc_html__( 'Envato API Key', 'transcargo' ),
			'type'  => 'text',
			'default' => ''
		),
	)
) );
TRANSCARGO_Customizer::setSection( 'envato_api_settings', array(
	'title'    => esc_html__( 'One Click update', 'transcargo' ),
	'panel'    => 'site_settings',
	'priority' => 250,
	'fields'   => array(
		'envato_username' => array(
			'label' => esc_html__( 'Envato Username', 'transcargo' ),
			'type'  => 'text',
			'default' => '',
			'description' => esc_html__( 'Enter here your ThemeForest (or Envato) username account (i.e. Stylemixthemes).', 'transcargo' )
		),
		'envato_api' => array(
			'label' => esc_html__( 'Envato API Key', 'transcargo' ),
			'type'  => 'text',
			'default' => '',
			'description' => esc_html__( 'Enter here the secret api key you have created on ThemeForest. You can create a new one in the Settings > API Keys section of your profile.', 'transcargo' )
		),
	)
) );
TRANSCARGO_Customizer::setSection( 'google_api_settings', array(
	'title'    => esc_html__( 'Google Api Settings', 'transcargo' ),
	'panel'    => 'site_settings',
	'priority' => 300,
	'fields'   => array(
		'google_api_key' => array(
			'label' => esc_html__( 'Google API Key', 'transcargo' ),
			'type'  => 'text',
			'description' => esc_html__( 'Enter here the secret api key you have created on Google APIs. You can enable MAP API in Google APIs > Google Maps APIs > Google Maps JavaScript API.', 'transcargo' )
		),
	)
) );
TRANSCARGO_Customizer::setSection( 'static_front_page', array(
	'title' => esc_html__( 'Static Front Page', 'transcargo' ),
	'panel' => 'site_settings'
) );

TRANSCARGO_Customizer::setSection( 'static_front_page', array(
	'title' => esc_html__( 'Static Front Page', 'transcargo' ),
	'panel' => 'site_settings'
) );

TRANSCARGO_Customizer::setSection( 'site_settings', array(
	'title'    => esc_html__( 'Style &amp; Settings', 'transcargo' ),
	'panel'    => 'site_settings',
	'fields'   => array(
		'site_style' => array(
				'label'   => esc_html__( 'Style', 'transcargo' ),
				'type'    => 'transcargo-select',
				'choices' => array(
						'site_style_default'   => esc_html__( 'Default', 'transcargo' ),
						'site_style_green'     => esc_html__( 'Green', 'transcargo' ),
						'site_style_orange'    => esc_html__( 'Orange', 'transcargo' ),
						'site_style_purple'    => esc_html__( 'Purple', 'transcargo' ),
						'site_style_red'       => esc_html__( 'Red', 'transcargo' ),
						'site_style_turquoise' => esc_html__( 'Turquoise', 'transcargo' ),
						'site_style_yellow'    => esc_html__( 'Yellow', 'transcargo' ),
						'site_style_custom'    => esc_html__( 'Custom Colors', 'transcargo' ),
				)
		),
		'site_style_base_color' => array(
				'label'   => esc_html__( 'Custom Base Color', 'transcargo' ),
				'type'    => 'color',
				'default' => '#183650'
		),
		'site_style_secondary_color' => array(
				'label'   => esc_html__( 'Custom Secondary Color', 'transcargo' ),
				'type'    => 'color',
				'default' => '#34ccff'
		),
		'frontend_customizer' => array(
				'label'   => esc_html__( 'Frontend Customizer', 'transcargo' ),
				'type'    => 'transcargo-checkbox',
				'default' => false
		),
		'site_boxed' => array(
				'label'   => esc_html__( 'Enable Boxed Layout', 'transcargo' ),
				'type'    => 'transcargo-checkbox',
				'default' => false
		),
		'bg_image' => array(
				'label'   => esc_html__( 'Background Image', 'transcargo' ),
				'type'    => 'transcargo-bg',
				'choices' => array(
						'bg_img_1' => 'prev_img_1',
						'bg_img_2' => 'prev_img_2',
						'bg_img_3' => 'prev_img_3',
						'bg_img_4' => 'prev_img_4',
						'bg_img_5' => 'prev_img_5',
				)
		),
		'custom_bg_image' => array(
				'label' => esc_html__( 'Custom Bg Image', 'transcargo' ),
				'type'  => 'image'
		),
	)
) );

$top_bar_fields['top_bar'] = array(
	'label'   => esc_html__( 'Enable Top Bar', 'transcargo' ),
	'type'    => 'transcargo-checkbox',
	'default' => true
);

$top_bar_fields['wpml_switcher'] = array(
	'label'   => esc_html__( 'Enable WPML Switcher', 'transcargo' ),
	'type'    => 'transcargo-checkbox',
	'default' => true
);

$top_bar_fields['top_bar_separator_1'] = array(
	'type' => 'transcargo-separator'
);

for ( $i = 1; $i <= 10; $i ++ ) {
	$top_bar_fields[ 'top_bar_info_' . $i . '_office' ]     = array(
		'label'       => esc_html__( 'Office ' . $i, 'transcargo' ),
		'type'        => 'transcargo-text',
		'description' => esc_html__( 'for dropdown options', 'transcargo' )
	);
	$top_bar_fields[ 'top_bar_info_' . $i . '_phone' ]      = array(
		'label' => esc_html__( 'Phone number', 'transcargo' ),
		'type'  => 'transcargo-text',
	);
	$top_bar_fields[ 'top_bar_info_' . $i . '_phone_icon' ] = array(
		'label'   => esc_html__( 'Phone Icon', 'transcargo' ),
		'type'    => 'transcargo-picker',
		'default' => 'stm-iphone'
	);
	$top_bar_fields[ 'top_bar_info_' . $i . '_email' ]      = array(
		'label' => esc_html__( 'Email', 'transcargo' ),
		'type'  => 'transcargo-text',
	);
	$top_bar_fields[ 'top_bar_info_' . $i . '_email_icon' ] = array(
		'label'   => esc_html__( 'Email Icon', 'transcargo' ),
		'type'    => 'transcargo-picker',
		'default' => 'stm-email'
	);
	$top_bar_fields[ 'top_bar_info_' . $i . '_hours' ]      = array(
		'label' => esc_html__( 'Working Hours', 'transcargo' ),
		'type'  => 'transcargo-text',
	);
	$top_bar_fields[ 'top_bar_info_' . $i . '_hours_icon' ] = array(
		'label'   => esc_html__( 'Hours Icon', 'transcargo' ),
		'type'    => 'transcargo-picker',
		'default' => 'stm-clock'
	);
	$top_bar_fields[ 'top_bar_info_' . $i . '_separator' ]  = array(
		'type' => 'transcargo-separator'
	);
}

TRANSCARGO_Customizer::setSection( 'top_bar', array(
	'title'  => esc_html__( 'Top Bar', 'transcargo' ),
	'panel'  => 'header',
	'fields' => $top_bar_fields
) );

TRANSCARGO_Customizer::setSection( 'header_appearance', array(
	'title'  => esc_html__( 'Header Appearance', 'transcargo' ),
	'panel'  => 'header',
	'fields' => array(
		'header_search'      => array(
			'label'   => esc_html__( 'Enable Header Search', 'transcargo' ),
			'type'    => 'transcargo-checkbox',
			'default' => true
		),
		'header_search_text' => array(
			'label'   => esc_html__( 'Search Text', 'transcargo' ),
			'type'    => 'transcargo-text',
			'default' => esc_html__( 'For more detailed tracking and status information, sign in or contact your local BestLogistic representative for access.', 'transcargo' )
		),
		'header_style' => array(
				'label'   => esc_html__( 'Header Style', 'transcargo' ),
				'type'    => 'transcargo-select',
				'default' => 'header_style_4',
				'choices' => array(
						'header_style_1'     => esc_html__( 'Style 1', 'transcargo' ),
						'header_style_2'     => esc_html__( 'Style 2', 'transcargo' ),
						'header_style_3'     => esc_html__( 'Style 3', 'transcargo' ),
						'header_style_4'     => esc_html__( 'Style 4', 'transcargo' ),
				)
		),
		'sticky_menu' => array(
				'label'   => esc_html__( 'Sticky Menu', 'transcargo' ),
				'type'    => 'transcargo-checkbox',
				'default' => false
		),
	)
) );

TRANSCARGO_Customizer::setSection( 'footer_layout', array(
	'title'  => esc_html__( 'Layout', 'transcargo' ),
	'panel'  => 'footer',
	'fields' => array(
		'footer_logo'          => array(
			'label' => esc_html__( 'Logo', 'transcargo' ),
			'type'  => 'image'
		),
		'footer_logo_width'    => array(
			'label'  => esc_html__( 'Width', 'transcargo' ),
			'type'   => 'transcargo-attr',
			'mode'   => 'width',
			'units'  => 'px',
			'output' => '#footer .widgets_row .footer_logo a img'
		),
		'footer_logo_height'   => array(
			'label'  => esc_html__( 'Height', 'transcargo' ),
			'type'   => 'transcargo-attr',
			'mode'   => 'height',
			'units'  => 'px',
			'output' => '#footer .widgets_row .footer_logo a img'
		),
		'footer_break_1'       => array(
			'type' => 'transcargo-separator',
		),
		'footer_sidebar_count' => array(
			'label'   => esc_html__( 'Additional Widget Areas', 'transcargo' ),
			'type'    => 'transcargo-select',
			'default' => 3,
			'choices' => array(
				1 => 1,
				2 => 2,
				3 => 3,
				4 => 4
			)
		),
		'footer_break_2'       => array(
			'type' => 'transcargo-separator',
		),
		'footer_text'          => array(
			'label'   => esc_html__( 'Footer Text', 'transcargo' ),
			'type'    => 'transcargo-code',
			'default' => esc_html__( 'Everyday is a new day for us and we work really hard to satisfy our customer everywhere.', 'transcargo' )
		),
		'footer_copyright'     => array(
			'label'       => esc_html__( 'Copyright', 'transcargo' ),
			'placeholder' => esc_html__( 'Copyright &copy; 2012-2015 Logistics Theme by <a href="http://stylemixthemes.com/" target="_blank">Stylemix Themes</a>. All rights reserved', 'transcargo' ),
			'default'     => esc_html__( 'Copyright &copy; 2012-2015 Logistics Theme by <a href="http://stylemixthemes.com/" target="_blank">Stylemix Themes</a>. All rights reserved', 'transcargo' ),
			'type'        => 'transcargo-text'
		),
	)
) );

TRANSCARGO_Customizer::setSection( 'footer_socials', array(
	'title'  => esc_html__( 'Footer Socials', 'transcargo' ),
	'panel'  => 'footer',
	'fields' => array(
		'footer_socials_enable' => array(
			'type'    => 'transcargo-multiple-checkbox',
			'choices' => $socials
		)
	)
) );

TRANSCARGO_Customizer::setSection( 'typography_body', array(
	'title'  => esc_html__( 'Body', 'transcargo' ),
	'panel'  => 'typography',
	'fields' => array(
		'body_font_family' => array(
			'label'   => esc_html__( 'Base Font Family', 'transcargo' ),
			'type'    => 'transcargo-font-family',
			'output'  => 'body, p',
			'default' => 'Open Sans'
		),
		'secondary_font_family' => array(
				'label'   => esc_html__( 'Secondary Font Family', 'transcargo' ),
				'type'    => 'transcargo-font-family',
				'output'  => 'h1, .h1, h2, .h2, h3, .h3, h4, .h4, h5, .h5, h6, .h6',
				'default' => 'Titillium Web'
		),
		'body_font_weight' => array(
			'label'   => esc_html__( 'Font Weight', 'transcargo' ),
			'type'    => 'transcargo-font-weight',
			'output'  => 'body',
			'default' => 400
		),
		'body_font_size'   => array(
			'label'   => esc_html__( 'Font Size', 'transcargo' ),
			'type'    => 'transcargo-attr',
			'mode'    => 'font-size',
			'units'   => 'px',
			'output'  => 'body',
			'default' => 14
		)
	)
) );

TRANSCARGO_Customizer::setSection( 'typography_p', array(
		'title'  => esc_html__( 'Paragraph', 'transcargo' ),
		'panel'  => 'typography',
		'fields' => array(
				'p_font_weight' => array(
						'label'   => esc_html__( 'Font Weight', 'transcargo' ),
						'type'    => 'transcargo-font-weight',
						'output'  => 'p',
						'default' => 400
				),
				'p_font_size'   => array(
						'label'   => esc_html__( 'Font Size', 'transcargo' ),
						'type'    => 'transcargo-attr',
						'mode'    => 'font-size',
						'units'   => 'px',
						'output'  => 'p',
						'default' => 14
				),
				'p_line_height'   => array(
						'label'   => esc_html__( 'Line Height', 'transcargo' ),
						'type'    => 'transcargo-attr',
						'mode'    => 'line-height',
						'units'   => 'px',
						'output'  => 'p',
						'default' => 26
				)
		)
) );

TRANSCARGO_Customizer::setSection( 'typography_h1', array(
	'title'  => esc_html__( 'H1', 'transcargo' ),
	'panel'  => 'typography',
	'fields' => array(
		'h1_font_weight' => array(
			'label'   => esc_html__( 'Font Weight', 'transcargo' ),
			'type'    => 'transcargo-font-weight',
			'output'  => 'h1, .h1',
			'default' => 700
		),
		'h1_font_size'   => array(
			'label'   => esc_html__( 'Font Size', 'transcargo' ),
			'type'    => 'transcargo-attr',
			'mode'    => 'font-size',
			'units'   => 'px',
			'output'  => 'h1, .h1',
			'default' => 42
		),
		'h1_line_height'   => array(
			'label'   => esc_html__( 'Line Height', 'transcargo' ),
			'type'    => 'transcargo-attr',
			'mode'    => 'line-height',
			'units'   => 'px',
			'output'  => 'h1, .h1',
			'default' => 46
		)
	)
) );

TRANSCARGO_Customizer::setSection( 'typography_h2', array(
	'title'  => esc_html__( 'H2', 'transcargo' ),
	'panel'  => 'typography',
	'fields' => array(
		'h2_font_weight' => array(
				'label'   => esc_html__( 'Font Weight', 'transcargo' ),
				'type'    => 'transcargo-font-weight',
				'output'  => 'h2, .h2',
				'default' => 700
		),
		'h2_font_size'   => array(
				'label'   => esc_html__( 'Font Size', 'transcargo' ),
				'type'    => 'transcargo-attr',
				'mode'    => 'font-size',
				'units'   => 'px',
				'output'  => 'h2, .h2',
				'default' => 36
		),
		'h2_line_height'   => array(
				'label'   => esc_html__( 'Line Height', 'transcargo' ),
				'type'    => 'transcargo-attr',
				'mode'    => 'line-height',
				'units'   => 'px',
				'output'  => 'h2, .h2',
				'default' => 42
		)
	)
) );

TRANSCARGO_Customizer::setSection( 'typography_h3', array(
		'title'  => esc_html__( 'H3', 'transcargo' ),
		'panel'  => 'typography',
		'fields' => array(
				'h3_font_weight' => array(
						'label'   => esc_html__( 'Font Weight', 'transcargo' ),
						'type'    => 'transcargo-font-weight',
						'output'  => 'h3, .h3',
						'default' => 700
				),
				'h3_font_size'   => array(
						'label'   => esc_html__( 'Font Size', 'transcargo' ),
						'type'    => 'transcargo-attr',
						'mode'    => 'font-size',
						'units'   => 'px',
						'output'  => 'h3, .h3',
						'default' => 30
				),
				'h3_line_height'   => array(
						'label'   => esc_html__( 'Line Height', 'transcargo' ),
						'type'    => 'transcargo-attr',
						'mode'    => 'line-height',
						'units'   => 'px',
						'output'  => 'h3, .h3',
						'default' => 33
				)
		)
) );

TRANSCARGO_Customizer::setSection( 'typography_h4', array(
		'title'  => esc_html__( 'H4', 'transcargo' ),
		'panel'  => 'typography',
		'fields' => array(
				'h4_font_weight' => array(
						'label'   => esc_html__( 'Font Weight', 'transcargo' ),
						'type'    => 'transcargo-font-weight',
						'output'  => 'h4, .h4',
						'default' => 700
				),
				'h4_font_size'   => array(
						'label'   => esc_html__( 'Font Size', 'transcargo' ),
						'type'    => 'transcargo-attr',
						'mode'    => 'font-size',
						'units'   => 'px',
						'output'  => 'h4, .h4',
						'default' => 24
				),
				'h4_line_height'   => array(
						'label'   => esc_html__( 'Line Height', 'transcargo' ),
						'type'    => 'transcargo-attr',
						'mode'    => 'line-height',
						'units'   => 'px',
						'output'  => 'h4, .h4',
						'default' => 26
				)
		)
) );

TRANSCARGO_Customizer::setSection( 'typography_h5', array(
		'title'  => esc_html__( 'H5', 'transcargo' ),
		'panel'  => 'typography',
		'fields' => array(
				'h5_font_weight' => array(
						'label'   => esc_html__( 'Font Weight', 'transcargo' ),
						'type'    => 'transcargo-font-weight',
						'output'  => 'h5, .h5',
						'default' => 700
				),
				'h5_font_size'   => array(
						'label'   => esc_html__( 'Font Size', 'transcargo' ),
						'type'    => 'transcargo-attr',
						'mode'    => 'font-size',
						'units'   => 'px',
						'output'  => 'h5, .h5',
						'default' => 18
				),
				'h5_line_height'   => array(
						'label'   => esc_html__( 'Line Height', 'transcargo' ),
						'type'    => 'transcargo-attr',
						'mode'    => 'line-height',
						'units'   => 'px',
						'output'  => 'h5, .h5',
						'default' => 19
				)
		)
) );

TRANSCARGO_Customizer::setSection( 'typography_h6', array(
		'title'  => esc_html__( 'H6', 'transcargo' ),
		'panel'  => 'typography',
		'fields' => array(
				'h6_font_weight' => array(
						'label'   => esc_html__( 'Font Weight', 'transcargo' ),
						'type'    => 'transcargo-font-weight',
						'output'  => 'h6, .h6',
						'default' => 700
				),
				'h6_font_size'   => array(
						'label'   => esc_html__( 'Font Size', 'transcargo' ),
						'type'    => 'transcargo-attr',
						'mode'    => 'font-size',
						'units'   => 'px',
						'output'  => 'h6, .h6',
						'default' => 14
				),
				'h6_line_height'   => array(
						'label'   => esc_html__( 'Line Height', 'transcargo' ),
						'type'    => 'transcargo-attr',
						'mode'    => 'line-height',
						'units'   => 'px',
						'output'  => 'h6, .h6',
						'default' => 15
				)
		)
) );

TRANSCARGO_Customizer::setSection( 'archive_pages', array(
	'title'    => esc_html__( 'Archive Pages', 'transcargo' ),
	'priority' => 40,
	'fields'   => array(
		'blog_layout'       => array(
			'type'    => 'radio',
			'label'   => esc_html__( 'Layout', 'transcargo' ),
			'choices' => array(
				'grid' => esc_html__( 'Grid View', 'transcargo' ),
				'list' => esc_html__( 'List View', 'transcargo' )
			),
			'default' => 'list'
		),
		'blog_break_1'      => array(
			'type' => 'transcargo-separator',
		),
		'blog_sidebar_type' => array(
			'type'    => 'radio',
			'label'   => esc_html__( 'Sidebar Type', 'transcargo' ),
			'choices' => array(
				'wp' => esc_html__( 'Wordpress Sidebars', 'transcargo' ),
				'vc' => esc_html__( 'VC Sidebars', 'transcargo' )
			),
			'default' => 'wp'
		),
		'blog_break_2'      => array(
			'type' => 'transcargo-separator',
		),
		'blog_wp_sidebar'   => array(
			'type'      => 'transcargo-post-type',
			'post_type' => 'sidebar',
			'label'     => esc_html__( 'Wordpress Sidebar', 'transcargo' ),
			'default'   => 'transcargo-right-sidebar'
		),
		'blog_vc_sidebar'   => array(
			'type'      => 'transcargo-post-type',
			'post_type' => 'stm_vc_sidebar',
			'label'     => esc_html__( 'VC Sidebar', 'transcargo' )
		),
		'blog_break_3'      => array(
			'type' => 'transcargo-separator',
		),
		'blog_sidebar_position' => array(
			'type'    => 'radio',
			'label'   => esc_html__( 'Sidebar - Position', 'transcargo' ),
			'choices' => array(
				'left'  => esc_html__( 'Left', 'transcargo' ),
				'right' => esc_html__( 'Right', 'transcargo' )
			),
			'default' => 'right'
		),
		'blog_break_4'      => array(
			'type' => 'transcargo-separator',
		),
	)
) );

TRANSCARGO_Customizer::setSection( 'socials', array(
	'title'  => esc_html__( 'Socials', 'transcargo' ),
	'priority' => 70,
	'fields' => array(
		'socials' => array(
			'type'    => 'transcargo-socials',
			'choices' => $socials
		)
	)
) );

TRANSCARGO_Customizer::setSection( 'post_type_service', array(
	'title'  => esc_html__( 'Services', 'transcargo' ),
	'panel'  => 'post_types',
	'fields' => array(
		'post_type_services_title'   => array(
			'label'   => esc_html__( 'Title', 'transcargo' ),
			'type'    => 'transcargo-text',
			'default' => esc_html__( 'Service', 'transcargo' )
		),
		'post_type_services_plural'  => array(
			'label'   => esc_html__( 'Plural Title', 'transcargo' ),
			'type'    => 'transcargo-text',
			'default' => esc_html__( 'Services', 'transcargo' )
		),
		'post_type_services_all_items'  => array(
			'label'   => esc_html__( 'All Items', 'transcargo' ),
			'type'    => 'transcargo-text',
			'default' => esc_html__( 'All Services', 'transcargo' )
		),
		'post_type_services_rewrite' => array(
			'label'   => esc_html__( 'Rewrite (URL text)', 'transcargo' ),
			'type'    => 'transcargo-text',
			'default' => 'service'
		),
		'post_type_services_icon'    => array(
			'label'   => esc_html__( 'Icon', 'transcargo' ),
			'type'    => 'transcargo-text',
			'default' => 'dashicons-clipboard'
		),
	)
) );

TRANSCARGO_Customizer::setSection( 'post_type_testimonial', array(
	'title'  => esc_html__( 'Testimonials', 'transcargo' ),
	'panel'  => 'post_types',
	'fields' => array(
		'post_type_testimonials_title'   => array(
			'label'   => esc_html__( 'Title', 'transcargo' ),
			'type'    => 'transcargo-text',
			'default' => esc_html__( 'Testimonial', 'transcargo' )
		),
		'post_type_testimonials_plural'  => array(
			'label'   => esc_html__( 'Plural Title', 'transcargo' ),
			'type'    => 'transcargo-text',
			'default' => esc_html__( 'Testimonials', 'transcargo' )
		),
		'post_type_testimonials_all_items'  => array(
			'label'   => esc_html__( 'All Items', 'transcargo' ),
			'type'    => 'transcargo-text',
			'default' => esc_html__( 'All Testimonials', 'transcargo' )
		),
		'post_type_testimonials_rewrite' => array(
			'label'   => esc_html__( 'Rewrite (URL text)', 'transcargo' ),
			'type'    => 'transcargo-text',
			'default' => 'testimonials'
		),
		'post_type_testimonials_icon'    => array(
			'label'   => esc_html__( 'Icon', 'transcargo' ),
			'type'    => 'transcargo-text',
			'default' => 'dashicons-testimonial'
		),
	)
) );

TRANSCARGO_Customizer::setSection( 'post_type_careers', array(
	'title'  => esc_html__( 'Vacancies', 'transcargo' ),
	'panel'  => 'post_types',
	'fields' => array(
		'post_type_careers_title'   => array(
			'label'   => esc_html__( 'Title', 'transcargo' ),
			'type'    => 'transcargo-text',
			'default' => esc_html__( 'Vacancy', 'transcargo' )
		),
		'post_type_careers_plural'  => array(
			'label'   => esc_html__( 'Plural Title', 'transcargo' ),
			'type'    => 'transcargo-text',
			'default' => esc_html__( 'Vacancies', 'transcargo' )
		),
		'post_type_careers_all_items'  => array(
			'label'   => esc_html__( 'All Items', 'transcargo' ),
			'type'    => 'transcargo-text',
			'default' => esc_html__( 'All Vacancies', 'transcargo' )
		),
		'post_type_careers_rewrite' => array(
			'label'   => esc_html__( 'Rewrite (URL text)', 'transcargo' ),
			'type'    => 'transcargo-text',
			'default' => 'careers_archive'
		),
		'post_type_careers_icon'    => array(
			'label'   => esc_html__( 'Icon', 'transcargo' ),
			'type'    => 'transcargo-text',
			'default' => 'dashicons-id'
		),
	)
) );

TRANSCARGO_Customizer::setSection( 'post_type_staff', array(
	'title'  => esc_html__( 'Staff', 'transcargo' ),
	'panel'  => 'post_types',
	'fields' => array(
		'post_type_staff_title'   => array(
			'label'   => esc_html__( 'Title', 'transcargo' ),
			'type'    => 'transcargo-text',
			'default' => esc_html__( 'Staff', 'transcargo' )
		),
		'post_type_staff_plural'  => array(
			'label'   => esc_html__( 'Plural Title', 'transcargo' ),
			'type'    => 'transcargo-text',
			'default' => esc_html__( 'Staff', 'transcargo' )
		),
		'post_type_staff_all_items'  => array(
			'label'   => esc_html__( 'All Items', 'transcargo' ),
			'type'    => 'transcargo-text',
			'default' => esc_html__( 'All Staff', 'transcargo' )
		),
		'post_type_staff_rewrite' => array(
			'label'   => esc_html__( 'Rewrite (URL text)', 'transcargo' ),
			'type'    => 'transcargo-text',
			'default' => 'staff'
		),
		'post_type_staff_icon'    => array(
			'label'   => esc_html__( 'Icon', 'transcargo' ),
			'type'    => 'transcargo-text',
			'default' => 'dashicons-groups'
		),
	)
) );

TRANSCARGO_Customizer::setSection( 'custom_css', array(
	'title'  => esc_html__( 'Custom CSS', 'transcargo' ),
	'priority' => 80,
	'fields' => array(
		'custom_css' => array(
			'label'       => '',
			'type'        => 'transcargo-code',
			'placeholder' => ".classname {\n\tbackground: #000;\n}"
		)
	)
) );