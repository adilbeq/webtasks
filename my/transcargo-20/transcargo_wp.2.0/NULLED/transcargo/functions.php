<?php

    if(is_admin()) {
        require_once(get_template_directory() . '/admin/admin.php');
		require_once(get_template_directory() . '/inc/announcement/main.php');
    }
	
$theme_info = wp_get_theme();
define( 'TRANSCARGO_THEME_VERSION', ( WP_DEBUG ) ? time() : $theme_info->get( 'Version' ) );
define( 'TRANSCARGO_INC_PATH', get_template_directory() . '/inc' );
define( 'TRANSCARGO_CUSTOMIZER_PATH', get_template_directory() . '/inc/customizer' );
define( 'TRANSCARGO_CUSTOMIZER_URI', get_template_directory_uri() . '/inc/customizer' );

// Disable WMPL CSS
define( 'ICL_DONT_LOAD_LANGUAGE_SELECTOR_CSS', true );

if ( ! isset( $content_width ) ) {
	$content_width = 1080;
}

/*
 * Load Customizer Support
 */
require_once TRANSCARGO_CUSTOMIZER_PATH . '/customizer.class.php';

/*
 *  Load Custom Functions
 */
require_once TRANSCARGO_INC_PATH . '/extras.php';

/*
 *  Load TGM
 */
require_once TRANSCARGO_INC_PATH . '/tgm/tgm-plugin-registration.php';

/*
 *  Load Vusial Composer Settings
 */
require_once TRANSCARGO_INC_PATH . '/vc-config.php';

/*
 *  Load Post Types & Metaboxes
 */
if ( class_exists( 'STM_PostType' ) ) {
	require_once TRANSCARGO_INC_PATH . '/post_types-config.php';
}

/*
 *  Load Theme Widgets
 */
require_once TRANSCARGO_INC_PATH . '/widgets/widget_contacts.php';
require_once TRANSCARGO_INC_PATH . '/widgets/posts.php';

/*
 *  TRANSCARGO Theme Setup
 */
if ( ! function_exists( 'transcargo_theme_setup' ) ) {
	function transcargo_theme_setup() {

		// Add support for HTML5
		add_theme_support( 'html5', array(
			'comment-list',
			'comment-form',
			'search-form',
			'gallery',
			'caption'
		) );

		// Add support for Title Tags
		add_theme_support( 'title-tag' );

		// Automatic Feed Links
		add_theme_support( 'automatic-feed-links' );

		// Add support for featured images
		add_theme_support( 'post-thumbnails' );

		// Set Large Image Sizes
		add_image_size( 'transcargo-image-255x170-croped', 255, 170, true );
		add_image_size( 'transcargo-image-270x330-croped', 270, 330, true );
		add_image_size( 'transcargo_image-600x377-croped', 600, 377, true );
		add_image_size( 'transcargo_image-350x230-croped', 350, 230, true );
		add_image_size( 'transcargo_image-130x130-croped', 130, 130, true );
		add_image_size( 'transcargo_image-40x40-croped', 40, 40, true );
		add_image_size( 'transcargo_image-1600x1024', 1600, 1024, true );

		// Add text domain
		load_theme_textdomain( 'transcargo', get_template_directory() . '/languages' );

		// Register nav menus
		register_nav_menus( array(
			'transcargo-primary' => esc_html__( 'Header Menu', 'transcargo' ),
			'transcargo-footer'  => esc_html__( 'Footer Menu', 'transcargo' ),
		) );

	}
}
add_action( 'after_setup_theme', 'transcargo_theme_setup', 10 );

/*
 *  Register Default Sidebars
 */
if ( ! function_exists( 'transcargo_register_default_sidebars' ) ) {
	function transcargo_register_default_sidebars() {

		register_sidebar( array(
			'id'            => 'transcargo-right-sidebar',
			'name'          => esc_html__( 'Right Sidebar', 'transcargo' ),
			'before_widget' => '<aside id="%1$s" class="widget %2$s">',
			'after_widget'  => '</aside>',
			'before_title'  => '<h4 class="widget_title">',
			'after_title'   => '</h4>',
		) );

		register_sidebar( array(
			'id'            => 'transcargo-left-sidebar',
			'name'          => esc_html__( 'Left Sidebar', 'transcargo' ),
			'before_widget' => '<aside id="%1$s" class="widget %2$s">',
			'after_widget'  => '</aside>',
			'before_title'  => '<h4 class="widget_title">',
			'after_title'   => '</h4>',
		) );


		// Register Footer Sidebars

		for ( $footer = 1; $footer < 5; $footer ++ ) {
			register_sidebar( array(
				'id'            => 'transcargo-footer-' . $footer,
				'name'          => esc_html__( 'Footer ', 'transcargo' ) . $footer,
				'before_widget' => '<section id="%1$s" class="widget %2$s">',
				'after_widget'  => '</section>',
				'before_title'  => '<h6 class="widget_title">',
				'after_title'   => '</h6>',
			) );
		}
	}
}
add_action( 'widgets_init', 'transcargo_register_default_sidebars', 50 );

if ( ! function_exists( 'transcargo_body_class' ) ) {
	function transcargo_body_class( $classes ) {
		global $post;

		$classes['header_style'] = get_theme_mod( 'header_style', 'header_style_4' );

		if ( $post && ! is_search() ) {
			if( get_post_meta( $post->ID, 'header_style', true ) ){
				$classes['header_style'] = get_post_meta( $post->ID, 'header_style', true );
			}
			if( get_post_meta( $post->ID, 'transparent_header', true ) ){
				$classes[] = 'transparent_header';
			}
		}

		if( get_theme_mod( 'sticky_menu' ) ){
			$classes[] = 'sticky_header';
		}

		if( get_theme_mod( 'site_boxed' ) ){
			$classes[] = 'boxed_layout';
			if( get_theme_mod( 'bg_image' ) ){
				$classes[] = get_theme_mod( 'bg_image' );
			}
		}

		return $classes;
	}
}

add_filter( 'body_class', 'transcargo_body_class' );

if ( ! function_exists( 'transcargo_load_scripts' ) ) {
	function transcargo_load_scripts() {

		$upload_paths = wp_upload_dir();
		$google_api_key = get_theme_mod( 'google_api_key', false );

		// Register Styles
		wp_register_style( 'transcargo-style', get_stylesheet_uri(), array(), TRANSCARGO_THEME_VERSION, 'all' );
		wp_register_style( 'bootstrap', get_template_directory_uri() . '/assets/css/bootstrap.min.css', array(), TRANSCARGO_THEME_VERSION, 'all' );
		wp_register_style( 'transcargo-font-awesome', get_template_directory_uri() . '/assets/css/font-awesome.min.css', array(), TRANSCARGO_THEME_VERSION, 'all' );
		wp_register_style( 'jquery.fonticonpicker', get_template_directory_uri() . '/assets/css/jquery.fonticonpicker.min.css', array(), TRANSCARGO_THEME_VERSION, 'all' );
		wp_register_style( 'jquery.fonticonpicker.bootstrap', get_template_directory_uri() . '/assets/css/jquery.fonticonpicker.bootstrap.min.css', array(), TRANSCARGO_THEME_VERSION, 'all' );
		wp_register_style( 'transcargo-owl.carousel.css', get_template_directory_uri() . '/assets/css/owl.carousel.css', array(), TRANSCARGO_THEME_VERSION, 'all' );
		wp_register_style( 'transcargo-default-font', transcargo_fonts_url(), array(), TRANSCARGO_THEME_VERSION, 'all' );
		wp_register_style( 'transcargo-select2.min.css', get_template_directory_uri() . '/assets/css/select2.min.css', array(), TRANSCARGO_THEME_VERSION, 'all' );
		wp_register_style( 'transcargo-jquery.fancybox.css', get_template_directory_uri() . '/assets/css/jquery.fancybox.css', array(), TRANSCARGO_THEME_VERSION, 'all' );
		wp_register_style( 'transcargo-frontend_customizer', get_template_directory_uri() . '/assets/css/frontend_customizer.css', null, TRANSCARGO_THEME_VERSION, 'all' );
		wp_register_style( 'transcargo-site_style_green', get_template_directory_uri() . '/assets/css/site_style_green.css', null, TRANSCARGO_THEME_VERSION, 'all' );
		wp_register_style( 'transcargo-site_style_orange', get_template_directory_uri() . '/assets/css/site_style_orange.css', null, TRANSCARGO_THEME_VERSION, 'all' );
		wp_register_style( 'transcargo-site_style_purple', get_template_directory_uri() . '/assets/css/site_style_purple.css', null, TRANSCARGO_THEME_VERSION, 'all' );
		wp_register_style( 'transcargo-site_style_red', get_template_directory_uri() . '/assets/css/site_style_red.css', null, TRANSCARGO_THEME_VERSION, 'all' );
		wp_register_style( 'transcargo-site_style_turquoise', get_template_directory_uri() . '/assets/css/site_style_turquoise.css', null, TRANSCARGO_THEME_VERSION, 'all' );
		wp_register_style( 'transcargo-site_style_yellow', get_template_directory_uri() . '/assets/css/site_style_yellow.css', null, TRANSCARGO_THEME_VERSION, 'all' );

		// Register Scripts
		wp_register_script( 'bootstrap', get_template_directory_uri() . '/assets/js/bootstrap.min.js', array( 'jquery' ), TRANSCARGO_THEME_VERSION, true );
		wp_register_script( 'transcargo-custom.js', get_template_directory_uri() . '/assets/js/custom.js', array( 'jquery' ), TRANSCARGO_THEME_VERSION, true );
		wp_register_script( 'jquery.fonticonpicker', get_template_directory_uri() . '/assets/js/jquery.fonticonpicker.min.js', array( 'jquery' ), TRANSCARGO_THEME_VERSION, true );
		wp_register_script( 'owl.carousel', get_template_directory_uri() . '/assets/js/owl.carousel.min.js', array( 'jquery' ), TRANSCARGO_THEME_VERSION, true );
		wp_register_script( 'jquery.appear', get_template_directory_uri() . '/assets/js/jquery.appear.js', array( 'jquery' ), TRANSCARGO_THEME_VERSION, true );
		wp_register_script( 'countUp', get_template_directory_uri() . '/assets/js/countUp.min.js', array( 'jquery' ), TRANSCARGO_THEME_VERSION, true );
		wp_register_script( 'select2', get_template_directory_uri() . '/assets/js/select2.min.js', array( 'jquery' ), TRANSCARGO_THEME_VERSION, true );
		wp_register_script( 'circle-progress', get_template_directory_uri() . '/assets/js/circle-progress.js', array( 'jquery' ), TRANSCARGO_THEME_VERSION, true );
		if( !empty($google_api_key) )
			wp_register_script( 'gmap', 'https://maps.googleapis.com/maps/api/js?key='.$google_api_key.'&v=3.31', array( 'jquery' ), TRANSCARGO_THEME_VERSION, true );
		else
			wp_register_script( 'gmap', 'https://maps.googleapis.com/maps/api/js?&v=3.31', array( 'jquery' ), TRANSCARGO_THEME_VERSION, true );
		wp_register_script( 'jquery.tablesorter', get_template_directory_uri() . '/assets/js/jquery.tablesorter.min.js', array( 'jquery' ), TRANSCARGO_THEME_VERSION, true );
		wp_register_script( 'isotope', get_template_directory_uri() . '/assets/js/isotope.pkgd.min.js', array( 'jquery' ), TRANSCARGO_THEME_VERSION, true );
		wp_register_script( 'imagesloaded', get_template_directory_uri() . '/assets/js/imagesloaded.pkgd.min.js', array( 'jquery' ), TRANSCARGO_THEME_VERSION, true );
		wp_register_script( 'jquery.fancybox', get_template_directory_uri() . '/assets/js/jquery.fancybox.pack.js', array( 'jquery' ), TRANSCARGO_THEME_VERSION, true );
		wp_register_script( 'SmoothScroll', get_template_directory_uri() . '/assets/js/SmoothScroll.js', array( 'jquery' ), TRANSCARGO_THEME_VERSION, true );
		wp_register_script( 'jquery.cookie', get_template_directory_uri() . '/assets/js/jquery.cookie.min.js', array( 'jquery' ), TRANSCARGO_THEME_VERSION, true );
		wp_register_script( 'vivus', get_template_directory_uri() . '/assets/js/vivus.min.js', array( 'jquery' ), TRANSCARGO_THEME_VERSION, true );

		if ( get_theme_mod( 'frontend_customizer' ) ) {
			wp_enqueue_style( 'transcargo-frontend_customizer' );
			wp_enqueue_script( 'jquery.cookie' );
		}

		// Load Styles
		wp_enqueue_style( 'bootstrap' );
		$custom_fonts = get_option( 'stm_fonts' );
		if ( is_array( $custom_fonts ) ) {
			foreach ( $custom_fonts as $font => $info ) {
				if ( strpos( $info['style'], 'http://' ) !== false ) {
					wp_enqueue_style( 'transcargo-' . $font, $info['style'], null, TRANSCARGO_THEME_VERSION, 'all' );
				} else {
					wp_enqueue_style( 'transcargo-' . $font, trailingslashit( $upload_paths['baseurl'] . '/stm_fonts/' ) . $info['style'], null, TRANSCARGO_THEME_VERSION, 'all' );
				}
			}
		}
		wp_enqueue_style( 'transcargo-style' );
		wp_enqueue_style( 'transcargo-font-awesome' );
		wp_enqueue_style( 'transcargo-select2.min.css' );
		wp_enqueue_style( 'transcargo-default-font' );

		if ( get_theme_mod( 'site_style' ) && get_theme_mod( 'site_style' ) != 'site_style_default' && get_theme_mod( 'site_style' ) != 'site_style_custom' ) {
			wp_enqueue_style( 'transcargo-' . get_theme_mod( 'site_style' ) );
		}

		// Load Scripts
		if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
			wp_enqueue_script( 'comment-reply' );
		}

		wp_enqueue_script( 'bootstrap' );
		wp_enqueue_script( 'select2' );
		wp_enqueue_script( 'transcargo-custom.js' );
		wp_enqueue_script( 'SmoothScroll' );
	}
}
add_action( 'wp_enqueue_scripts', 'transcargo_load_scripts' );

if ( ! function_exists( 'transcargo_load_admin_scripts' ) ) {
	function transcargo_load_admin_scripts() {

		$upload_paths = wp_upload_dir();

		wp_register_style( 'jquery.fonticonpicker', get_template_directory_uri() . '/assets/css/jquery.fonticonpicker.min.css', array(), TRANSCARGO_THEME_VERSION, 'all' );
		wp_register_style( 'jquery.fonticonpicker.bootstrap', get_template_directory_uri() . '/assets/css/jquery.fonticonpicker.bootstrap.min.css', array(), TRANSCARGO_THEME_VERSION, 'all' );
		wp_register_script( 'jquery.fonticonpicker', get_template_directory_uri() . '/assets/js/jquery.fonticonpicker.min.js', array( 'jquery' ), TRANSCARGO_THEME_VERSION, true );

		// Load Admin Styles
		wp_enqueue_style( 'transcargo-admin.css', get_template_directory_uri() . '/assets/css/admin.css', array(), TRANSCARGO_THEME_VERSION, 'all' );
		wp_enqueue_style( 'jquery.fonticonpicker' );
		wp_enqueue_style( 'jquery.fonticonpicker.bootstrap' );

		$custom_fonts = get_option( 'stm_fonts' );
		if ( is_array( $custom_fonts ) ) {
			foreach ( $custom_fonts as $font => $info ) {
				if ( strpos( $info['style'], 'http://' ) !== false ) {
					wp_enqueue_style( 'transcargo-' . $font, $info['style'], null, TRANSCARGO_THEME_VERSION, 'all' );
				} else {
					wp_enqueue_style( 'transcargo-' . $font, trailingslashit( $upload_paths['baseurl'] . '/stm_fonts/' ) . $info['style'], null, TRANSCARGO_THEME_VERSION, 'all' );
				}
			}
		}

		// Load Admin Script
		wp_enqueue_script( 'jquery.fonticonpicker' );

	}
}
add_action( 'admin_enqueue_scripts', 'transcargo_load_admin_scripts' );

function transcargo_fonts_url() {

	$font_families   = array();
	$font_families[] = 'Open Sans:400,300,300italic,400italic,600,600italic,700,700italic,800,800italic&subset=latin,greek,greek-ext,vietnamese,cyrillic-ext,latin-ext,cyrillic';
	$font_families[] = 'Titillium Web:400,200,200italic,300,300italic,400italic,600,600italic,700,700italic,900&subset=latin,greek,greek-ext,vietnamese,cyrillic-ext,latin-ext,cyrillic';

	$query_args = array(
			'family' => urlencode( implode( '|', $font_families ) ),
			'subset' => urlencode( 'latin,latin-ext' ),
	);

	$fonts_url = add_query_arg( $query_args, 'https://fonts.googleapis.com/css' );

	return esc_url_raw( $fonts_url );
}

/*
 *  Load Custom Styles
 */
require_once TRANSCARGO_INC_PATH . '/print_styles.php';