<!DOCTYPE html>
<html <?php language_attributes(); ?> class="no-js">
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="http://gmpg.org/xfn/11">
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<div id="main">
	<div id="wrapper">
	<header id="header">
		<?php if ( get_theme_mod( 'top_bar', true ) ): ?>
			<div class="top_bar">
				<div class="container">
					<?php
					if ( get_theme_mod( 'wpml_switcher', true ) ) {
						do_action( 'wpml_add_language_selector' );
					}
					$top_bar_info = transcargo_get_top_bar_info();
					?>
					<div class="top_bar_info_wr">
						<?php if ( count( $top_bar_info ) > 1 ): ?>
							<div class="top_bar_info_switcher">
								<div class="active">
									<i class="stm-globe"></i>
									<span><?php echo esc_html( $top_bar_info[1]['office'], true ); ?></span>
								</div>
								<ul>
									<?php foreach ( $top_bar_info as $key => $val ): ?>
										<li>
											<a href="#top_bar_info_<?php echo esc_attr( $key ); ?>"><?php echo esc_html( $val['office'], true ); ?></a>
										</li>
									<?php endforeach; ?>
								</ul>
							</div>
						<?php endif; ?>
						<?php if ( $top_bar_info ): ?>
							<?php foreach ( $top_bar_info as $key => $val ): ?>
								<ul class="top_bar_info" id="top_bar_info_<?php echo esc_attr( $key ); ?>"<?php if ( $key == 1 ) { echo ' style="display: block;"'; } ?>>
									<?php if ( !empty( $val['phone'] ) ): ?>
										<li>
											<i class="<?php echo esc_attr( $val['phone_icon'] ); ?>"></i>
											<span><?php echo esc_html( $val['phone'], true ); ?></span>
										</li>
									<?php endif; ?>
									<?php if ( ! empty( $val['email'] ) ): ?>
										<li>
											<a href="mailto:<?php echo antispambot( $val['email'] ); ?>">
												<i class="<?php echo esc_attr( $val['email_icon'] ); ?>"></i>
												<span><?php echo antispambot( $val['email'] ); ?></span>
											</a>
										</li>
									<?php endif; ?>
									<?php if ( ! empty( $val['hours'] ) ): ?>
										<li>
											<i class="<?php echo esc_attr( $val['hours_icon'] ); ?>"></i>
											<span><?php echo esc_html( $val['hours'], true ); ?></span>
										</li>
									<?php endif; ?>
								</ul>
							<?php endforeach; ?>
						<?php endif; ?>
					</div>
				</div>
			</div>
		<?php endif; ?>
		<div class="top_nav_wr">
			<div class="top_nav_affix">
				<div class="container">
					<div class="top_nav">
						<div id="menu_toggle">
							<button></button>
						</div>
						<div class="media">
							<div class="media-left media-middle">
								<div class="logo">
									<?php echo transcargo_get_logo(); ?>
								</div>
								<div class="mobile_logo">
									<?php echo transcargo_get_logo(true); ?>
								</div>
							</div>
							<div class="media-body media-middle">
								<div class="top_nav_menu_wr">
									<?php
									wp_nav_menu( array(
											'theme_location' => 'transcargo-primary',
											'container'      => false,
											'depth'          => 3,
											'fallback_cb'    => false,
											'menu_class'     => 'top_nav_menu'
										)
									);
									?>
								</div>
							</div>
							<?php if( get_theme_mod( 'header_search', true ) ): ?>
								<div class="media-right media-middle">
									<div class="top_search">
										<div class="search_button"><i class="stm-tracking"></i></div>
										<div class="top_search_form">
											<p><?php echo esc_html( get_theme_mod( 'header_search_text', esc_html__( 'For more detailed tracking and status information, sign in or contact your local BestLogistic representative for access.', 'transcargo' ) ) )?></p>
											<form>
												<input type="text" placeholder="<?php esc_html_e( 'Enter Reference number', 'transcargo' ); ?>" value="" name="track_number" />
												<button type="submit"><i class="stm-arrow-next"></i></button>
											</form>
										</div>
									</div>
								</div>
							<?php endif; ?>
						</div>
						<div class="top_mobile_menu_wr">
							<?php
							wp_nav_menu( array(
									'theme_location' => 'transcargo-primary',
									'container'      => false,
									'depth'          => 3,
									'fallback_cb'    => false,
									'menu_class'     => 'top_mobile_menu'
								)
							);
							?>
							<?php if( get_theme_mod( 'header_search', true ) ): ?>
								<div class="mobile_search_form">
									<p><?php echo esc_html( get_theme_mod( 'header_search_text', esc_html__( 'For more detailed tracking and status information, sign in or contact your local BestLogistic representative for access.', 'transcargo' ) ) )?></p>
									<form>
										<div class="search_button"><i class="stm-tracking"></i></div>
										<input type="text" placeholder="<?php esc_attr_e( 'Enter Reference number', 'transcargo' ); ?>" value="" name="track_number" />
										<button type="submit"><i class="stm-arrow-next"></i></button>
									</form>
								</div>							
							<?php endif; ?>
						</div>
					</div>
				</div>
			</div>
		</div>
		<?php get_template_part( 'partials/title_box' ); ?>
	</header>
	<div id="content">