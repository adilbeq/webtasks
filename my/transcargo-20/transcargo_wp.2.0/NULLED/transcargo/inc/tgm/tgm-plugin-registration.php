<?php

require_once TRANSCARGO_INC_PATH . '/tgm/class-tgm-plugin-activation.php';

add_action( 'tgmpa_register', 'transcargo_require_plugins' );

function transcargo_require_plugins() {
	$plugins_path = TRANSCARGO_INC_PATH . '/tgm/plugins';
	$plugins      = array(
		array(
			'name'             => 'STM Post Type',
			'slug'             => 'stm-post-type',
			'source'           => $plugins_path . '/stm-post-type.zip',
			'required'         => true,
			'force_activation' => true,
			'version'          => '1.0'
		),
		array(
				'name'             => 'STM Importer',
				'slug'             => 'stm-importer',
				'source'           => $plugins_path . '/stm-importer.zip',
				'required'         => true,
				'force_activation' => true,
				'version'          => '3.0'
		),
		array(
			'name'             => 'Custom Icons by Stylemixthemes',
			'slug'             => 'custom-icons-by-stylemixthemes',
			'source'           => $plugins_path . '/custom-icons-by-stylemixthemes.zip',
			'required'         => true,
			'force_activation' => true,
			'version'          => '2.1'
		),
		array(
			'name'         => 'WPBakery Visual Composer',
			'slug'         => 'js_composer',
			'source'       => $plugins_path . '/js_composer.zip',
			'required'     => true,
			'external_url' => 'http://vc.wpbakery.com',
			'version'      => '5.4.7'
		),
		array(
			'name'         => 'Revolution Slider',
			'slug'         => 'revslider',
			'source'       => $plugins_path . '/revslider.zip',
			'required'     => false,
			'external_url' => 'http://www.themepunch.com/revolution/',
			'version'      => '5.4.7.3'
		),
		'stm-gdpr-compliance' => array(
			'name'         => 'GDPR Compliance & Cookie Consent',
			'slug'         => 'stm-gdpr-compliance',
			'source'       => $plugins_path . '/stm-gdpr-compliance.zip',
			'required'     => false,
			'external_url' => 'https://stylemixthemes.com',
			'version'      => '1.0'
		),
		array(
			'name'     => 'Breadcrumb NavXT',
			'slug'     => 'breadcrumb-navxt',
			'required' => true
		),
		array(
			'name'     => 'Contact Form 7',
			'slug'     => 'contact-form-7',
			'required' => true
		),
		array(
			'name'     => 'TinyMCE Advanced',
			'slug'     => 'tinymce-advanced',
			'required' => false
		),
		array(
			'name'     => 'MailChimp for WordPress Lite',
			'slug'     => 'mailchimp-for-wp',
			'required' => false
		),
		array(
			'name'     => 'Recent Tweets Widget',
			'slug'     => 'recent-tweets-widget',
			'required' => false
		)
	);

	tgmpa( $plugins, array( 'is_automatic' => true ) );

}