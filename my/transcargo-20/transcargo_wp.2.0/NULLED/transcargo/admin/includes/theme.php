<?php


/*Redirect to theme Welcome screen*/
global $pagenow;

if ( is_admin() && 'themes.php' == $pagenow && isset( $_GET['activated'] ) && !defined('ENVATO_HOSTED_SITE') ) {
	wp_redirect(admin_url("admin.php?page=stm-admin"));
}

/*Theme info*/
function stm_get_theme_info() {
	$theme = wp_get_theme();
	$theme_name = $theme->get('Name');
	$theme_v = $theme->get('Version');

	$theme_info = array(
		'name' => $theme_name,
		'slug' => sanitize_file_name(strtolower($theme_name)),
		'v'    => $theme_v,
	);

	return $theme_info;
}

function stm_beautify_theme_response($theme) {
	return array(
		'id' => $theme['id'],
		'name' => ( ! empty( $theme['wordpress_theme_metadata']['theme_name'] ) ? $theme['wordpress_theme_metadata']['theme_name'] : '' ),
		'author' => ( ! empty( $theme['wordpress_theme_metadata']['author_name'] ) ? $theme['wordpress_theme_metadata']['author_name'] : '' ),
		'version' => ( ! empty( $theme['wordpress_theme_metadata']['version'] ) ? $theme['wordpress_theme_metadata']['version'] : '' ),
		'url' => ( ! empty( $theme['url'] ) ? $theme['url'] : '' ),
		'author_url' => ( ! empty( $theme['author_url'] ) ? $theme['author_url'] : '' ),
		'thumbnail_url' => ( ! empty( $theme['thumbnail_url'] ) ? $theme['thumbnail_url'] : '' ),
		'rating' => ( ! empty( $theme['rating'] ) ? $theme['rating'] : '' ),
	);
}

function stm_get_token() {
	return 'nulled';
	$token = get_option('envato_market', array());
	$return_token = '';
	if(!empty($token['token'])) {
		$return_token = $token['token'];
	}

	return $return_token;
}
	

function stm_check_token($args = array()) {
	return true;
	/*If envato hosted*/
	if ( defined('ENVATO_HOSTED_SITE') ) return true;

	$has_token = get_site_transient('stm_theme_token_added');

	$purchased = false;

    $has_token = false;

	if(false === $has_token) {
		$defaults = array(
			'headers'   => array(
				'Authorization' => 'Bearer ' . stm_get_token(),
				'User-Agent'    => 'WordPress - Motors',
			),
			'filter_by' => 'wordpress-themes',
			'timeout'   => 20,
		);
		$args     = wp_parse_args( $args, $defaults );

		$url = 'https://api.envato.com/v3/market/buyer/list-purchases?filter_by=wordpress-themes';

		$response = wp_remote_get( esc_url_raw( $url ), $args );

		// Check the response code.
		$response_code = wp_remote_retrieve_response_code( $response );

		if ( $response_code == '200' ) {
			$return = json_decode( wp_remote_retrieve_body( $response ), true );
			foreach ( $return['results'] as $theme ) {
				$theme_info = stm_beautify_theme_response( $theme['item'] );

				if ( $theme_info['name'] == STM_ITEM_NAME ) {
					$purchased = true;
					set_site_transient('stm_theme_token_added', 'token_set');
				}
			}

			if(!$purchased) {
				$purchased = false;
				delete_site_transient('stm_theme_token_added');
			}
		}
	} else {
		$purchased = true;
	}

	return $purchased;
}

function stm_set_token() {
	if(isset($_POST['stm_registration'])) {
		if(isset($_POST['stm_registration']['token'])) {
			delete_site_transient('stm_theme_token_added');

			$token = array();
			$token['token'] = sanitize_text_field($_POST['stm_registration']['token']);

			update_option('envato_market', $token);

			$envato_market = Envato_Market::instance();
			$envato_market->items()->set_themes(true);
		}
	}
}

add_action('init', 'stm_set_token');

function stm_convert_memory($size) {
	$l   = substr( $size, -1 );
	$ret = substr( $size, 0, -1 );
	switch ( strtoupper( $l ) ) {
		case 'P':
			$ret *= 1024;
		case 'T':
			$ret *= 1024;
		case 'G':
			$ret *= 1024;
		case 'M':
			$ret *= 1024;
		case 'K':
			$ret *= 1024;
	}
	return $ret;
}

function stm_theme_support_url() {
	return 'https://stylemixthemes.com/';
}

function stm_get_plugin_tgm_link($plugin_path, $plugin_name) {
	$installed_plugins = get_plugins();
	$plugins           = TGM_Plugin_Activation::$instance->plugins;

	$plugin = array();
	if(!empty($plugins) and !empty($plugins[$plugin_name])) {
		$plugin = $plugins[$plugin_name];
	}


	$url = '';
	$install = false;

	if(empty($installed_plugins[$plugin_path])) {
		$url = esc_url( wp_nonce_url(
			add_query_arg(
				array(
					'page'          => urlencode( TGM_Plugin_Activation::$instance->menu ),
					'plugin'        => urlencode( $plugin['slug'] ),
					'plugin_name'   => urlencode( $plugin['name'] ),
					'tgmpa-install' => 'install-plugin',
					'return_url'    => 'stm-admin-demos',
				),
				TGM_Plugin_Activation::$instance->get_tgmpa_url()
			),
			'tgmpa-install',
			'tgmpa-nonce'
		) );
		$install = true;
	} else {
		$url = esc_url( wp_nonce_url(
			add_query_arg(
				array(
					'page'          => urlencode( TGM_Plugin_Activation::$instance->menu ),
					'plugin'        => urlencode( $plugin['slug'] ),
					'plugin_name'   => urlencode( $plugin['name'] ),
					'tgmpa-install' => 'activate-plugin',
					'return_url'    => 'stm-admin-demos',
				),
				TGM_Plugin_Activation::$instance->get_tgmpa_url()
			),
			'tgmpa-install',
			'tgmpa-nonce'
		) );
	}

	if($install) {
		$plugin['plugin_url_activate'] = '<a class="button button-primary" href="' .esc_url( $url ) . '">' . esc_html__('Install', 'motors') . '</a>';
	} else {
		$plugin['plugin_url_activate'] = '<a class="button button-primary" href="' .esc_url( $url ) . '">' . esc_html__('Activate', 'motors') . '</a>';
	}

	return $plugin;
}

function stm_get_admin_images_url($image) {
	return esc_url(get_template_directory_uri() . '/assets/admin/images/' . $image);
}