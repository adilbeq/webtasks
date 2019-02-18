<?php

if ( ! class_exists( 'TRANSCARGO_Customizer' ) ) {
	class TRANSCARGO_Customizer {

		private static $instance;
		public static $customizer;
		public static $panels = array();
		public static $sections = array();
		public static $controls = array();
		public static $enqueue_fonts = array();
		public static $output_css = '';

		public static function get_instance() {
			if ( ! self::$instance ) {
				self::$instance = new self();
				self::$instance->init();
			}

			return self::$instance;
		}

		public static function init() {
			require_once TRANSCARGO_CUSTOMIZER_PATH . '/google-fonts.php';
			require_once TRANSCARGO_CUSTOMIZER_PATH . '/registration.php';

			add_action( 'customize_register', array( get_class(), 'load' ) );
			add_action( 'wp', array( get_class(), 'generate_css' ) );
			add_action( 'wp_head', array( get_class(), 'output_css' ), 150 );
			add_action( 'wp_enqueue_scripts', array( get_class(), 'transcargo_enqueue_custom_fonts' ), 160 );
		}

		public static function load( $wp_customize ) {

			add_action( 'admin_print_styles', array( get_class(), 'admin_scripts' ) );
			add_action( 'customize_controls_print_footer_scripts', array( get_class(), 'admin_enqueue_scripts' ) );
			add_action( 'customize_preview_init', array( get_class(), 'customizer_preview_scripts' ) );

			self::$customizer = $wp_customize;

			self::load_controls();

			if ( self::$panels ) {
				self::register_panels( self::$panels );
			}

			if ( self::$sections ) {
				self::register_sections( self::$sections );
			}
		}

		public static function transcargo_enqueue_custom_fonts() {

			$transcargo_custom_fonts = self::$enqueue_fonts;

			if ( empty( $transcargo_custom_fonts ) ) {
				return;
			}


			$transcargo_custom_fonts = array_unique( $transcargo_custom_fonts );
			$all_fonts        = transcargo_google_fonts_array();
			foreach ( $transcargo_custom_fonts as $font ) {
				$font = trim( $font );
				if ( array_key_exists( $font, $all_fonts ) ) {
					$family[] = urlencode( $font . ':' . join( ',', transcargo_get_google_font_variants( $font, $all_fonts[ $font ]['variants'] ) ) );
				}
			}

			if ( empty( $family ) ) {
				return;
			} else {
				$request = '//fonts.googleapis.com/css?family=' . implode( '|', $family );
			}

			wp_enqueue_style( 'transcargo-google-fonts', $request, array(), TRANSCARGO_THEME_VERSION );
		}

		public static function generate_css() {

			$sections = self::$sections;

			if ( empty( $sections ) ) {
				return;
			}

			$css = '';

			foreach ( $sections as $section => $section_data ) {
				if ( ! empty( $section_data['fields'] ) ) {
					foreach ( $section_data['fields'] as $key => $val ) {
						$theme_mod = get_theme_mod( $key );
						if ( isset( $theme_mod ) && ! empty( $val['output'] ) ) {
							switch ( $val['type'] ) {

								case 'color':
									if( ! empty( $theme_mod ) ){
										foreach ( $val['output'] as $param => $selectors ) {
											$css .= $selectors . '{' . $param . ': ' . $theme_mod . ';}';
										}
									}
									break;

								case 'transcargo-font-family':
									if( ! empty( $theme_mod ) ) {
										self::$enqueue_fonts[] = $theme_mod;
										$css .= $val['output'] . '{font-family:' . $theme_mod . ';}';
									}
									break;

								case 'transcargo-font-weight':
									if( ! empty( $theme_mod ) ) {
										$css .= $val['output'] . '{font-weight:' . str_replace( 'italic', '', $theme_mod ) . ';}';
										if ( strpos( $theme_mod, 'italic' ) ) {
											$css .= $val['output'] . '{font-style:italic;}';
										}
									}
									break;

								case 'transcargo-attr':
									if( $val['mode'] && $theme_mod != '' ){
										$units = '';
										if ( ! empty( $val['units'] ) ) {
											$units = $val['units'];
										}
										$css .= $val['output'] . '{' . $val['mode'] . ':' . $theme_mod . $units . ';}';
									}
									break;
							}
						}
					}
				}
			}

			self::$output_css = $css;

		}


		public static function output_css() {

			if ( self::$output_css ) {
				echo '<style type="text/css" title="dynamic-css" class="options-output">' . self::$output_css . '</style>' . "\n";
			}

		}

		public static function load_controls() {

			require_once TRANSCARGO_CUSTOMIZER_PATH . '/controls/input_controller.php';
			require_once TRANSCARGO_CUSTOMIZER_PATH . '/controls/checkbox.php';
			require_once TRANSCARGO_CUSTOMIZER_PATH . '/controls/multiple-checkbox.php';
			require_once TRANSCARGO_CUSTOMIZER_PATH . '/controls/code.php';
			require_once TRANSCARGO_CUSTOMIZER_PATH . '/controls/heading.php';
			require_once TRANSCARGO_CUSTOMIZER_PATH . '/controls/select.php';
			require_once TRANSCARGO_CUSTOMIZER_PATH . '/controls/post-type.php';
			require_once TRANSCARGO_CUSTOMIZER_PATH . '/controls/separator.php';
			require_once TRANSCARGO_CUSTOMIZER_PATH . '/controls/text.php';
			require_once TRANSCARGO_CUSTOMIZER_PATH . '/controls/font-family.php';
			require_once TRANSCARGO_CUSTOMIZER_PATH . '/controls/attr.php';
			require_once TRANSCARGO_CUSTOMIZER_PATH . '/controls/font-weight.php';
			require_once TRANSCARGO_CUSTOMIZER_PATH . '/controls/icon-picker.php';
			require_once TRANSCARGO_CUSTOMIZER_PATH . '/controls/slider.php';
			require_once TRANSCARGO_CUSTOMIZER_PATH . '/controls/socials.php';
			require_once TRANSCARGO_CUSTOMIZER_PATH . '/controls/bg.php';

		}

		public static function admin_scripts() {
			wp_enqueue_style( 'transcargo-customizer.css', TRANSCARGO_CUSTOMIZER_URI . '/assets/css/customizer.css', array( 'wp-color-picker' ), TRANSCARGO_THEME_VERSION, 'all' );
		}

		public static function customizer_preview_scripts() {
			wp_enqueue_script( 'transcargo-customizer-preview.js', TRANSCARGO_CUSTOMIZER_URI . '/assets/js/customizer-preview.js', array( 'jquery', 'customize-preview' ), TRANSCARGO_THEME_VERSION, true );
		}

		public static function admin_enqueue_scripts() {

			wp_enqueue_script( 'transcargo-customizer.js', TRANSCARGO_CUSTOMIZER_URI . '/assets/js/customizer.js', array( 'customize-controls', 'wp-color-picker' ), TRANSCARGO_THEME_VERSION, true );

			$custom_fonts  = get_option( 'stm_fonts' );
			$fonts = array();
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
							$fonts[] = $font . '-' . $icon['class'];
						}
					}
				}
			}
			wp_localize_script( 'transcargo-customizer.js', 'transcargo_icons_array', $fonts );

		}

		public static function setPanels( $panels ) {
			self::$panels = $panels;
		}

		public static function setSection( $section, $section_data = array() ) {
			self::$sections[ $section ] = $section_data;
		}

		public static function customizer_supports_panels() {
			return ( class_exists( 'WP_Customize_Manager' ) && method_exists( 'WP_Customize_Manager', 'add_panel' ) ) || function_exists( 'wp_validate_boolean' );
		}

		public static function register_panels( $panels = array() ) {

			if ( empty( $panels ) ) {
				return;
			}

			if ( self::customizer_supports_panels() ) {
				foreach ( $panels as $panel => $panel_data ) {
					self::$customizer->add_panel( $panel, $panel_data );
				}
			}

		}

		public static function register_sections( $sections = array() ) {

			if ( empty( $sections ) ) {
				return;
			}

			foreach ( $sections as $section => $section_data ) {
				self::$customizer->add_section( $section, $section_data );

				if ( ! empty( $section_data['fields'] ) ) {
					foreach ( $section_data['fields'] as $field => $field_data ) {
						self::register_control( $field, $field_data, $section );
					}
				}

			}

		}

		public static function register_control( $field, $field_data = array(), $section ) {

			if ( empty( $field ) || ! isset( $field_data ) ) {
				return;
			}

			if ( $section ) {
				$field_data['section'] = $section;
			}

			self::$customizer->add_setting( $field, array(
				'default'           => ( isset( $field_data['default'] ) ? $field_data['default'] : '' ),
				'type'              => 'theme_mod',
				'capability'        => 'manage_options',
				'transport'         => ( isset( $field_data['transport'] ) ? $field_data['transport'] : 'refresh' ),
				'sanitize_callback' => array( get_class(), 'add_sanitize_callback' )
			) );

			switch ( $field_data['type'] ) {

				case 'transcargo-bg':
					self::$customizer->add_control(
						new TRANSCARGO_Customizer_Bg_Control(
							self::$customizer,
							$field,
							$field_data
						)
					);

					break;

				case 'transcargo-attr':
					self::$customizer->add_control(
						new TRANSCARGO_Customizer_Attr_Control(
							self::$customizer,
							$field,
							$field_data
						)
					);

					break;

				case 'transcargo-socials':
					self::$customizer->add_control(
						new TRANSCARGO_Customizer_Socials_Control(
							self::$customizer,
							$field,
							$field_data
						)
					);

					break;

				case 'transcargo-multiple-checkbox':
					self::$customizer->add_control(
						new TRANSCARGO_Customizer_Multiple_Checkbox_Control(
							self::$customizer,
							$field,
							$field_data
						)
					);

					break;

				case 'transcargo-slider':
					self::$customizer->add_control(
						new TRANSCARGO_Customizer_Slider_Control(
							self::$customizer,
							$field,
							$field_data
						)
					);

					break;

				case 'transcargo-picker':
					self::$customizer->add_control(
						new TRANSCARGO_Customizer_Icon_Picker_Control(
							self::$customizer,
							$field,
							$field_data
						)
					);

					break;

				case 'transcargo-font-weight':
					self::$customizer->add_control(
						new TRANSCARGO_Customizer_Font_Weight_Control(
							self::$customizer,
							$field,
							$field_data
						)
					);

					break;

				case 'transcargo-font-family':
					self::$customizer->add_control(
						new TRANSCARGO_Customizer_Font_Family_Control(
							self::$customizer,
							$field,
							$field_data
						)
					);
					break;

				case 'transcargo-post-type':
					self::$customizer->add_control(
						new TRANSCARGO_Customizer_Post_Type_Control(
							self::$customizer,
							$field,
							$field_data
						)
					);

					break;

				case 'color':
					self::$customizer->add_control(
						new WP_Customize_Color_Control(
							self::$customizer,
							$field,
							$field_data
						)
					);

					break;

				case 'transcargo-separator':
					self::$customizer->add_control(
						new TRANSCARGO_Customizer_Separator_Control(
							self::$customizer,
							$field,
							$field_data
						)
					);
					break;

				case 'transcargo-checkbox':
					self::$customizer->add_control(
						new TRANSCARGO_Customizer_Checkbox_Control(
							self::$customizer,
							$field,
							$field_data
						)
					);
					break;

				case 'transcargo-heading':
					self::$customizer->add_control(
						new TRANSCARGO_Customizer_Heading_Control(
							self::$customizer,
							$field,
							$field_data
						)
					);
					break;

				case 'transcargo-code':
					self::$customizer->add_control(
						new TRANSCARGO_Customizer_Code_Control(
							self::$customizer,
							$field,
							$field_data
						)
					);
					break;

				case 'transcargo-select':
					self::$customizer->add_control(
						new TRANSCARGO_Customizer_Select_Control(
							self::$customizer,
							$field,
							$field_data
						)
					);
					break;

				case 'transcargo-text':
					self::$customizer->add_control(
						new TRANSCARGO_Customizer_Text_Control(
							self::$customizer,
							$field,
							$field_data
						)
					);
					break;

				case 'text':
					self::$customizer->add_control(
						new WP_Customize_Control(
							self::$customizer,
							$field,
							$field_data
						)
					);
					break;

				case 'image':
					self::$customizer->add_control(
						new WP_Customize_Image_Control(
							self::$customizer,
							$field,
							$field_data
						)
					);
					break;

				default:
					self::$customizer->add_control(
						$field,
						$field_data
					);
					break;
			}

		}

		public static function add_sanitize_callback( $value ){
			return $value;
		}

	}

	TRANSCARGO_Customizer::get_instance();

}