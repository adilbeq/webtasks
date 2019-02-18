<?php

if ( ! function_exists( 'transcargo_excerpt_more' ) ) {
	function transcargo_excerpt_more( $more ) {
		return '...';
	}
}

add_filter( 'excerpt_more', 'transcargo_excerpt_more' );

function transcargo_excerpt_length( $length ) {
	return 33;
}
add_filter( 'excerpt_length', 'transcargo_excerpt_length' );

if ( ! function_exists( 'transcargo_custom_mime' ) ) {
	function transcargo_custom_mime( $mimes ) {
		$mimes['svg'] = 'image/svg+xml';
		$mimes['ico'] = 'image/icon';

		return $mimes;
	}
}

add_filter( 'upload_mimes', 'transcargo_custom_mime' );

if ( ! function_exists( 'transcargo_get_logo' ) ) {
	function transcargo_get_logo( $mobile = false) {
		if( $mobile ){
			$logo = get_theme_mod( 'mobile_logo', get_template_directory_uri() . '/assets/images/logos/logo-site_style_blue.svg' );
			if ( $logo ) {
				return '<a href="' . esc_url( home_url( '/' ) ) . '"><img src="' . esc_url( $logo ) . '" alt="' . esc_attr( get_bloginfo( 'name' ) ) . '" /></a>';
			}else{
				return '<a class="logo_text" href="' . esc_url( home_url( '/' ) ) . '">' . esc_html( get_bloginfo( 'name' ) ) . '</a>';
			}
		}else{
			$logo = get_theme_mod( 'logo', get_template_directory_uri() . '/assets/images/logos/logo-site_style_blue-white.svg' );
			if ( $logo ) {
				return '<a href="' . esc_url( home_url( '/' ) ) . '"><img src="' . esc_url( $logo ) . '" alt="' . esc_attr( get_bloginfo( 'name' ) ) . '" /></a>';
			}else{
				return '<a class="logo_text" href="' . esc_url( home_url( '/' ) ) . '">' . esc_html( get_bloginfo( 'name' ) ) . '</a>';
			}
		}
	}
}

if ( ! function_exists( 'transcargo_get_top_bar_info' ) ) {
	function transcargo_get_top_bar_info() {
		$top_bar_info = array();
		for ( $i = 1; $i <= 10; $i ++ ) {
			$top_bar_info_office = get_theme_mod( 'top_bar_info_' . $i . '_office' );
			if ( ! empty( $top_bar_info_office ) ) {
				$top_bar_info[ $i ]['office'] = $top_bar_info_office;
			}
			$top_bar_info_phone = get_theme_mod( 'top_bar_info_' . $i . '_phone' );
			if ( ! empty( $top_bar_info_phone ) && ! empty( $top_bar_info_office ) ) {
				$top_bar_info[ $i ]['phone'] = $top_bar_info_phone;
			}
			$top_bar_info_phone_icon = get_theme_mod( 'top_bar_info_' . $i . '_phone_icon', 'stm-iphone' );
			if ( ! empty( $top_bar_info_phone ) && ! empty( $top_bar_info_phone_icon ) && ! empty( $top_bar_info_office ) ) {
				$top_bar_info[ $i ]['phone_icon'] = $top_bar_info_phone_icon;
			}
			$top_bar_info_email = get_theme_mod( 'top_bar_info_' . $i . '_email' );
			if ( ! empty( $top_bar_info_email ) && ! empty( $top_bar_info_office ) ) {
				$top_bar_info[ $i ]['email'] = $top_bar_info_email;
			}
			$top_bar_info_email_icon = get_theme_mod( 'top_bar_info_' . $i . '_email_icon', 'stm-email' );
			if ( ! empty( $top_bar_info_email ) && ! empty( $top_bar_info_email_icon ) && ! empty( $top_bar_info_office ) ) {
				$top_bar_info[ $i ]['email_icon'] = $top_bar_info_email_icon;
			}
			$top_bar_info_hours = get_theme_mod( 'top_bar_info_' . $i . '_hours' );
			if ( ! empty( $top_bar_info_hours ) && ! empty( $top_bar_info_office ) ) {
				$top_bar_info[ $i ]['hours'] = $top_bar_info_hours;
			}
			$top_bar_info_hours_icon = get_theme_mod( 'top_bar_info_' . $i . '_hours_icon', 'stm-clock' );
			if ( ! empty( $top_bar_info_hours ) && ! empty( $top_bar_info_hours_icon ) && ! empty( $top_bar_info_office ) ) {
				$top_bar_info[ $i ]['hours_icon'] = $top_bar_info_hours_icon;
			}
		}

		return $top_bar_info;
	}
}

if ( ! function_exists( 'transcargo_get_footer_socials' ) ) {
	function transcargo_get_footer_socials() {
		$socials_array = array();

		$footer_socials_enable = get_theme_mod( 'footer_socials_enable' );
		$footer_socials_enable = explode( ',', $footer_socials_enable );

		$socials        = get_theme_mod( 'socials' );
		$socials_values = array();
		if ( ! empty( $socials ) ) {
			parse_str( $socials, $socials_values );
		}

		if ( $footer_socials_enable ) {
			foreach ( $footer_socials_enable as $social ) {
				if ( ! empty( $socials_values[ $social ] ) ) {
					$socials_array[ $social ] = $socials_values[ $social ];
				}
			}
		}

		return $socials_array;
	}
}

if ( ! function_exists( 'transcargo_page_title' ) ) {
	function transcargo_page_title( $display = true, $single_posts = '', $vacancies_posts = '' ) {
		global $wp_locale;

		$m        = get_query_var( 'm' );
		$year     = get_query_var( 'year' );
		$monthnum = get_query_var( 'monthnum' );
		$day      = get_query_var( 'day' );
		$search   = get_query_var( 's' );
		$title    = '';


		// If there is a post
		if ( is_single() || ( is_home() && ! is_front_page() ) || ( is_page() && ! is_front_page() ) || is_front_page() ) {
			$title = single_post_title( '', false );
		}

		if( $single_posts && is_single() ){
			$title = $single_posts;
		}

		if( is_home() ) {
			if ( ! get_option( 'page_for_posts' ) ) {
				$title = $single_posts;
			}
		}

		if( $vacancies_posts && is_singular( 'stm_careers' ) ){
			$title = $vacancies_posts;
		}

		if( is_singular( 'stm_service' ) ){
			$title = single_post_title( '', false );
		}

		// If there's a post type archive
		if ( is_post_type_archive() ) {
			$post_type = get_query_var( 'post_type' );
			if ( is_array( $post_type ) ) {
				$post_type = reset( $post_type );
			}
			$post_type_object = get_post_type_object( $post_type );
			if ( ! $post_type_object->has_archive ) {
				$title = post_type_archive_title( '', false );
			}
		}

		// If there's a category or tag
		if ( is_category() || is_tag() ) {
			$title = single_term_title( '', false );
		}

		// If there's a taxonomy
		if ( is_tax() ) {
			$term = get_queried_object();
			if ( $term ) {
				$tax   = get_taxonomy( $term->taxonomy );
				$title = single_term_title( $tax->labels->name, false );
			}
		}

		// If there's an author
		if ( is_author() && ! is_post_type_archive() ) {
			$author = get_queried_object();
			if ( $author ) {
				$title = $author->display_name;
			}
		}

		// Post type archives with has_archive should override terms.
		if ( is_post_type_archive() && $post_type_object->has_archive ) {
			$title = post_type_archive_title( '', false );
		}

		// If there's a month
		if ( is_archive() && ! empty( $m ) ) {
			$my_year  = substr( $m, 0, 4 );
			$my_month = $wp_locale->get_month( substr( $m, 4, 2 ) );
			$my_day   = intval( substr( $m, 6, 2 ) );
			$title    = $my_year . ( $my_month ? $my_month : '' ) . ( $my_day ? $my_day : '' );
		}

		// If there's a year
		if ( is_archive() && ! empty( $year ) ) {
			$title = $year;
			if ( ! empty( $monthnum ) ) {
				$title .= ' ' . $wp_locale->get_month( $monthnum );
			}
			if ( ! empty( $day ) ) {
				$title .= ' ' . zeroise( $day, 2 );
			}
		}

		// If it's a search
		if ( is_search() ) {
			/* translators: 1: separator, 2: search phrase */
			$title = esc_html__( 'Search Results', 'transcargo' );
		}

		// If it's a 404 page
		if ( is_404() ) {
			$title = esc_html__( 'Page not found', 'transcargo' );
		}

		if ( $display ) {
			echo esc_html( $title );
		} else {
			return esc_html( $title );
		}
	}
}

if ( ! function_exists( 'transcargo_get_structure' ) ) {
	function transcargo_get_structure( $sidebar_id, $sidebar_type, $sidebar_position, $layout = false ) {

		$output                   = array();
		$output['content_before'] = $output['content_after'] = $output['sidebar_before'] = $output['sidebar_after'] = '';
		$output['class']          = 'blog_list';

		if ( $layout == 'grid' ) {
			$output['class'] = 'blog_grid';
		}
		if ( ! empty( $_GET['layout'] ) && $_GET['layout'] == 'grid' ) {
			$output['class'] = 'blog_grid';
		}

		if ( $sidebar_type == 'vc' ) {
			if ( $sidebar_id ) {
				$sidebar = get_post( $sidebar_id );
			}
		} else {
			if ( $sidebar_id ) {
				$sidebar = true;
			}
		}

		if ( isset( $sidebar ) ) {
			$output['class'] .= ' with_sidebar';
		}

		if ( $sidebar_position == 'right' && isset( $sidebar ) ) {
			$output['content_before'] .= '<div class="row">';
			$output['content_before'] .= '<div class="col-lg-9 col-md-9 col-sm-12 col-xs-12">';

			$output['content_after'] .= '</div>'; // col
			$output['sidebar_before'] .= '<div class="col-lg-3 col-md-3 hidden-sm hidden-xs">';
			// .sidebar-area
			$output['sidebar_after'] .= '</div>'; // col
			$output['sidebar_after'] .= '</div>'; // row
		}

		if ( $sidebar_position == 'left' && isset( $sidebar ) ) {
			$output['content_before'] .= '<div class="row">';
			$output['content_before'] .= '<div class="col-lg-9 col-lg-push-3 col-md-9 col-md-push-3 col-sm-12 col-xs-12">';

			$output['content_after'] .= '</div>'; // col
			$output['sidebar_before'] .= '<div class="col-lg-3 col-lg-pull-9 col-md-3 col-md-pull-9 hidden-sm hidden-xs">';
			// .sidebar-area
			$output['sidebar_after'] .= '</div>'; // col
			$output['sidebar_after'] .= '</div>'; // row
		}

		return $output;
	}
}

if ( ! function_exists( 'transcargo_get_post_categories' ) ) {
	function transcargo_get_post_categories( $postID ) {
		$output = '';
		if ( $categories = wp_get_post_categories( $postID ) ) {
			$output .= '<ul class="post_categories">';
			foreach ( $categories as $category ) {
				$cat = get_category( $category );
				$output .= '<li>';
				$output .= '<a href="' . esc_url( get_category_link( $category ) ) . '">' . esc_html( $cat->name ) . '</a>';
				$output .= '</li>';
			}
			$output .= '</ul>';
		}

		return $output;
	}
}

if ( ! function_exists( 'transcargo_blog_layout' ) ) {
	function transcargo_blog_layout() {
		$blog_layout = get_theme_mod( 'blog_layout', 'list' );
		if ( isset( $_REQUEST['layout'] ) && $_REQUEST['layout'] == 'grid' ) {
			$blog_layout = 'grid';
		}

		return $blog_layout;
	}
}

if ( ! function_exists( 'transcargo_comment' ) ) {
	function transcargo_comment( $comment, $args, $depth ) {
		$GLOBALS['comment'] = $comment;
		extract( $args, EXTR_SKIP );

		if ( 'div' == $args['style'] ) {
			$tag       = 'div';
			$add_below = 'comment';
		} else {
			$tag       = 'li';
			$add_below = 'div-comment';
		}
		?>
		<<?php echo esc_attr( $tag ); ?> <?php comment_class( empty( $args['has_children'] ) ? '' : 'parent' ); ?> id="comment-<?php comment_ID(); ?>">

		<?php if ( 'div' != $args['style'] ) : ?>
			<div id="div-comment-<?php comment_ID(); ?>" class="comment-body">
		<?php endif; ?>

		<div class="comment-author vcard">
			<?php if ( $args['avatar_size'] != 0 ) {
				echo get_avatar( $comment, $args['avatar_size'] );
			} ?>
		</div>

		<div class="comment-body">
			<?php if ( $comment->comment_approved == '0' ) : ?>
				<em class="comment-awaiting-moderation"><?php esc_html_e( 'Your comment is awaiting moderation.', 'transcargo' ); ?></em>
				<br/>
			<?php endif; ?>

			<div class="comment-meta commentmetadata">
				<?php printf( wp_kses( __( '<cite class="fn">%s</cite>', 'transcargo' ), array( 'cite' => array( 'class' => array() ) ) ), get_comment_author_link() ); ?>
				<span class="comment-date"><?php printf( esc_html__( '%1$s at %2$s', 'transcargo' ), get_comment_date(), get_comment_time() ); ?></span>
				<?php comment_reply_link( array_merge( $args, array(
					'add_below' => $add_below,
					'depth'     => $depth,
					'max_depth' => $args['max_depth']
				) ) ); ?>
				<?php edit_comment_link( esc_html__( 'Edit', 'transcargo' ) ); ?>
			</div>

			<?php comment_text(); ?>
		</div>

		<?php if ( 'div' != $args['style'] ) : ?>
			</div>
		<?php endif; ?>
		<?php
	}
}

add_filter( 'comment_form_default_fields', 'transcargo_comment_form_fields' );

if ( ! function_exists( 'transcargo_comment_form_fields' ) ) {
	function transcargo_comment_form_fields( $fields ) {
		$commenter = wp_get_current_commenter();
		$req       = get_option( 'require_name_email' );
		$aria_req  = ( $req ? " aria-required='true'" : '' );
		$html5     = current_theme_supports( 'html5', 'comment-form' ) ? 1 : 0;

		$fields    = array(
			'author' => '<div class="row"><div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
						<div class="form-group comment-form-author">
		            	<input placeholder="' . esc_attr__( 'Name', 'transcargo' ) . ( $req ? ' *' : '' ) . '" class="form-control" id="author" name="author" type="text" value="' . esc_attr( $commenter['comment_author'] ) . '" size="30"' . $aria_req . ' />
	                </div>',
			'email'  => '<div class="form-group comment-form-email">
						<input placeholder="' . esc_attr__( 'E-mail', 'transcargo' ) . ( $req ? ' *' : '' ) . '" class="form-control" id="email" name="email" ' . ( $html5 ? 'type="email"' : 'type="text"' ) . ' value="' . esc_attr( $commenter['comment_author_email'] ) . '" size="30"' . $aria_req . ' />
					</div>',
			'url'    => '<div class="form-group comment-form-url">
						<input placeholder="' . esc_attr__( 'Website', 'transcargo' ) . '" class="form-control" id="url" name="url" type="text" value="' . esc_attr( $commenter['comment_author_url'] ) . '" size="30" />
					</div></div>'
		);

		return $fields;
	}
}

add_filter( 'comment_form_defaults', 'transcargo_comment_form' );

if ( ! function_exists( 'transcargo_comment_form' ) ) {
	function transcargo_comment_form( $args ) {
		if( ! is_user_logged_in() ){
			$args['comment_field'] = '
				<div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
					<div class="form-group comment-form-comment">
						<textarea placeholder="' . esc_attr_x( 'Message', 'noun', 'transcargo' ) . ' *" class="form-control" id="comment" name="comment" aria-required="true"></textarea>
					</div>
					<div class="form-group comment-form-submit text-right">
						<button class="button icon_right">' . esc_html__( 'Post Comment', 'transcargo' ) . '<i class="stm-arrow-next"></i></button>
					</div>
				</div>
			</div>';
		}else{
			$args['comment_field'] = '
				<div class="form-group comment-form-comment">
					<textarea placeholder="' . esc_attr_x( 'Message', 'noun', 'transcargo' ) . ' *" class="form-control" id="comment" name="comment" aria-required="true"></textarea>
				</div>
				<div class="form-group comment-form-submit text-right">
					<button class="button icon_right">' . esc_html__( 'Post Comment', 'transcargo' ) . '<i class="stm-arrow-next"></i></button>
				</div>';
		}

		return $args;
	}
}

function transcargo_move_comment_field_to_bottom( $fields ) {
	$comment_field = $fields['comment'];
	unset( $fields['comment'] );
	$fields['comment'] = $comment_field;
	return $fields;
}

add_filter( 'comment_form_fields', 'transcargo_move_comment_field_to_bottom' );

add_filter( 'wpcf7_ajax_loader', 'transcargo_wpcf7_ajax_loader' );

if ( ! function_exists( 'transcargo_wpcf7_ajax_loader' ) ) {
	function transcargo_wpcf7_ajax_loader() {
		return get_template_directory_uri() . '/assets/images/preloader.gif';
	}
}

if( ! function_exists( 'transcargo_highlight_search_term' ) ) {
	function transcargo_highlight_search_term( $text ) {
		if ( is_search() ) {
			$sr   = get_query_var( 's' );
			if( !empty($sr) ){
				$keys = explode( " ", $sr );
				$text = preg_replace( '/(' . implode( '|', $keys ) . ')/iu', '<mark>' . $sr . '</mark>', $text );
			}
		}
		return $text;
	}
}

add_filter( 'the_excerpt', 'transcargo_highlight_search_term' );
add_filter( 'the_title', 'transcargo_highlight_search_term' );

if( ! function_exists( 'transcargo_sass_config' ) ) {
	function transcargo_sass_config( $defaults ) {
		return array(
			'variables' => array( get_template_directory_uri() . '/assets/scss/site/_base_variables.scss' ),
			'imports'   => array( get_template_directory_uri() . '/style.scss' )
		);
	}
}

add_filter( 'sass_configuration', 'transcargo_sass_config' );

function transcargo_hex2rgba($color, $opacity = false) {

	$default = 'rgb(0,0,0)';

	if(empty($color))
		return $default;

	if ($color[0] == '#' ) {
		$color = substr( $color, 1 );
	}

	if (strlen($color) == 6) {
		$hex = array( $color[0] . $color[1], $color[2] . $color[3], $color[4] . $color[5] );
	} elseif ( strlen( $color ) == 3 ) {
		$hex = array( $color[0] . $color[0], $color[1] . $color[1], $color[2] . $color[2] );
	} else {
		return $default;
	}

	$rgb =  array_map('hexdec', $hex);

	if($opacity){
		if(abs($opacity) > 1)
			$opacity = 1.0;
		$output = 'rgba('.implode(",",$rgb).','.$opacity.')';
	} else {
		$output = 'rgb('.implode(",",$rgb).')';
	}

	return $output;
}

if( ! function_exists( 'transcargo_breadcrumbs' ) ){
	function transcargo_breadcrumbs(){
		if ( function_exists( 'bcn_display' ) && ! get_post_meta( get_the_ID(), 'transparent_header', true ) && ! get_post_meta( get_the_ID(), 'disable_breadcrumbs', true ) ) { ?>
			<div class="breadcrumbs">
				<div class="container">
					<?php bcn_display(); ?>
				</div>
			</div>
		<?php }
	}
}

if( ! function_exists( 'transcargo_importer_done_function' ) ){
	function transcargo_importer_done_function(){

		global $wp_filesystem;

		if ( empty( $wp_filesystem ) ) {
			require_once ABSPATH . '/wp-admin/includes/file.php';
			WP_Filesystem();
		}

		$locations = get_theme_mod( 'nav_menu_locations' );
		$menus     = wp_get_nav_menus();

		if ( ! empty( $menus ) ) {
			foreach ( $menus as $menu ) {
				if ( is_object( $menu ) ) {
					switch ( $menu->name ) {
						case 'Primary Menu':
							$locations['transcargo-primary'] = $menu->term_id;
							break;
						case 'Footer Menu':
							$locations['transcargo-footer'] = $menu->term_id;
							break;
					}
				}
			}
		}

		set_theme_mod( 'nav_menu_locations', $locations );

		update_option( 'show_on_front', 'page' );

		$front_page = get_page_by_title( 'Home' );
		if ( isset( $front_page->ID ) ) {
			update_option( 'page_on_front', $front_page->ID );
		}
		$blog_page = get_page_by_title( 'News' );
		if ( isset( $blog_page->ID ) ) {
			update_option( 'page_for_posts', $blog_page->ID );
		}

		$encode_options = $wp_filesystem->get_contents( get_template_directory() . '/inc/demo/theme_mods.json' );
		$options        = json_decode( $encode_options, true );
		foreach ( $options as $key => $value ) {
			set_theme_mod( $key, $value );
		}

		if ( class_exists( 'RevSlider' ) ) {

			$main_slider = get_template_directory() . '/inc/demo/main_slider.zip';

			if ( file_exists( $main_slider ) ) {
				$slider = new RevSlider();
				$slider->importSliderFromPost( true, true, $main_slider );
			}

			$about_us_slider = get_template_directory() . '/inc/demo/about_us_slider.zip';

			if ( file_exists( $about_us_slider ) ) {
				$slider = new RevSlider();
				$slider->importSliderFromPost( true, true, $about_us_slider );
			}

			$boxed_slider = get_template_directory() . '/inc/demo/boxed-slider.zip';

			if ( file_exists( $boxed_slider ) ) {
				$slider = new RevSlider();
				$slider->importSliderFromPost( true, true, $boxed_slider );
			}
		}
	}
}

add_action( 'stm_importer_done', 'transcargo_importer_done_function' );

// STM Updater
if ( ! function_exists( 'stm_updater' ) ) {
	function stm_updater() {
		
		$envato_username = get_theme_mod('envato_username');
		$envato_api_key = get_theme_mod('envato_api');
		
		if( !empty($envato_username) && !empty($envato_api_key) ){
			$envato_username = trim( $envato_username );
			$envato_api_key  = trim( $envato_api_key );
			if ( ! empty( $envato_username ) && ! empty( $envato_api_key ) ) {
				load_template( get_template_directory() . '/inc/updater/envato-theme-update.php' );
				
				if ( class_exists( 'Envato_Theme_Updater' ) ) {
					Envato_Theme_Updater::init( $envato_username, $envato_api_key, 'StylemixThemes' );
				}
			}
		}
	}
	add_action( 'after_setup_theme', 'stm_updater' );
}