<div id="frontend_customizer">
	<div class="customizer_wrapper">
		<h3><?php esc_html_e( 'Color Skin', 'transcargo' ); ?></h3>
		<div class="customizer_element">
			<div class="customizer_colors" id="skin_color">
				<span id="site_style_default"></span>
				<span id="site_style_green"></span>
				<span id="site_style_orange"></span>
				<span id="site_style_purple"></span>
				<span id="site_style_red"></span>
				<span id="site_style_turquoise"></span>
				<span id="site_style_yellow"></span>
			</div>
		</div>

		<h3><?php esc_html_e('Header Style', 'transcargo'); ?></h3>
		<div class="customizer_element">
			<select name="header_style">
				<option value="header_style_4"><?php esc_html_e( 'Style 1', 'transcargo' ); ?></option>
				<option value="header_style_2"><?php esc_html_e( 'Style 2', 'transcargo' ); ?></option>
				<option value="header_style_3"><?php esc_html_e( 'Style 3', 'transcargo' ); ?></option>
				<option value="header_style_1"><?php esc_html_e( 'Style 4', 'transcargo' ); ?></option>
			</select>
		</div>

		<h3><?php esc_html_e('Nav Mode', 'transcargo'); ?></h3>
		<div class="customizer_element">
			<div class="stm_switcher" id="navigation_type">
				<div class="switcher_label disable"><?php esc_html_e('Static', 'transcargo'); ?></div>
				<div class="switcher_nav"></div>
				<div class="switcher_label enable"><?php esc_html_e('Sticky', 'transcargo'); ?></div>
			</div>
		</div>

		<h3><?php esc_html_e('Layout', 'transcargo'); ?></h3>
		<div class="customizer_element">
			<div class="stm_switcher" id="site_layout">
				<div class="switcher_label disable"><?php esc_html_e('Wide', 'transcargo'); ?></div>
				<div class="switcher_nav"></div>
				<div class="switcher_label enable"><?php esc_html_e('Boxed', 'transcargo'); ?></div>
			</div>
		</div>

		<div class="customizer_bg_image" style="display: none;">
			<h3><?php esc_html_e('Background Image', 'transcargo'); ?></h3>
			<div class="customizer_element">
				<div class="customizer_colors" id="bg_images">
					<span class="image_type active" data-image="<?php echo get_template_directory_uri(); ?>/assets/images/bg/img_1.jpg" style="background-image: url('<?php echo get_template_directory_uri(); ?>/assets/images/bg/prev_img_1.png'); "></span>
					<span class="image_type" data-image="<?php echo get_template_directory_uri(); ?>/assets/images/bg/img_2.jpg" style="background-image: url('<?php echo get_template_directory_uri(); ?>/assets/images/bg/prev_img_2.png'); "></span>
					<br/>
					<span data-image="<?php echo get_template_directory_uri(); ?>/assets/images/bg/img_3.jpg" style="background-image: url('<?php echo get_template_directory_uri(); ?>/assets/images/bg/prev_img_3.png'); "></span>
					<span data-image="<?php echo get_template_directory_uri(); ?>/assets/images/bg/img_4.jpg" style="background-image: url('<?php echo get_template_directory_uri(); ?>/assets/images/bg/prev_img_4.png'); "></span>
					<span data-image="<?php echo get_template_directory_uri(); ?>/assets/images/bg/img_5.jpg" style="background-image: url('<?php echo get_template_directory_uri(); ?>/assets/images/bg/prev_img_5.png'); "></span>
				</div>
			</div>
		</div>
	</div>
	<div id="frontend_customizer_button"><i class="fa fa-cog"></i></div>
</div>

<script type="text/javascript">
	jQuery(document).ready(function ($) {
		"use strict";

		$("#frontend_customizer_button").on('click', function () {
			if ($("#frontend_customizer").hasClass('open')) {
				$("#frontend_customizer").removeClass('open');
				$(this).find('.fa').removeClass('fa-spin');
			} else {
				$("#frontend_customizer").addClass('open');
				$(this).find('.fa').addClass('fa-spin');
			}
		});

		$('#main').on('click', function (kik) {
			if (!$(kik.target).is('#frontend_customizer, #frontend_customizer *') && $('#frontend_customizer').is(':visible')) {
				$("#frontend_customizer").removeClass('open');
				$(this).find('.fa').removeClass('fa-spin');
			}
		});

		$("#skin_color span").on('click', function () {
			var style_id = $(this).attr('id');
			$("#skin_color .active").removeClass("active");
			$(this).addClass("active");
			$("#custom_style").remove();
			$.removeCookie( 'site_style', {path: '/'} );
			if( style_id != 'site_style_default' ){
				$("#custom_style").remove();
				$("head").append('<link rel="stylesheet" id="custom_style" href="<?php echo esc_url( get_template_directory_uri() ); ?>/assets/css/'+style_id+'.css" type="text/css" media="all">');
				if( $.cookie('header_style') == 'header_style_1' || $.cookie('header_style') == 'header_style_3' ){
					$(".top_nav_wr .top_nav .logo a img").attr( 'src', '<?php echo esc_url( get_template_directory_uri() ); ?>/assets/images/logos/logo-'+style_id+'.svg' );
				}else{
					$(".top_nav_wr .top_nav .logo a img").attr( 'src', '<?php echo esc_url( get_template_directory_uri() ); ?>/assets/images/logos/logo-'+style_id+'-white.svg' );
				}
				$("#footer .widgets_row .footer_logo a img").attr( 'src', '<?php echo esc_url( get_template_directory_uri() ); ?>/assets/images/logos/logo-footer-'+style_id+'.svg' );
				$.cookie('site_style', style_id, {expires: 7, path: '/'});
			}else{
				if( $.cookie('header_style') == 'header_style_1' || $.cookie('header_style') == 'header_style_3' ){
					$(".top_nav_wr .top_nav .logo a img").attr( 'src', '<?php echo esc_url( get_template_directory_uri() ); ?>/assets/images/logos/logo-site_style_blue.svg' );
				}else{
					$(".top_nav_wr .top_nav .logo a img").attr( 'src', '<?php echo esc_url( get_template_directory_uri() ); ?>/assets/images/logos/logo-site_style_blue-white.svg' );
				}
				$("#footer .widgets_row .footer_logo a img").attr( 'src', '<?php echo esc_url( get_template_directory_uri() ); ?>/assets/images/logos/logo-footer-site_style_blue.svg' );
				$.cookie('site_style', style_id, {expires: 7, path: '/'});
			}
		});

		if ( $.cookie('site_style') ) {
			$("#skin_color #" + $.cookie('site_style')).addClass("active");
			if( $.cookie('site_style') != 'site_style_default' ){
				$(".top_nav_wr .top_nav .logo a img").attr( 'src', '<?php echo esc_url( get_template_directory_uri() ); ?>/assets/images/logos/logo-'+$.cookie('site_style')+'-white.svg' );
				$("#footer .widgets_row .footer_logo a img").attr( 'src', '<?php echo esc_url( get_template_directory_uri() ); ?>/assets/images/logos/logo-footer-'+$.cookie('site_style')+'.svg' );
			}else{
				$(".top_nav_wr .top_nav .logo a img").attr( 'src', '<?php echo esc_url( get_template_directory_uri() ); ?>/assets/images/logos/logo-site_style_blue.svg' );
				$("#footer .widgets_row .footer_logo a img").attr( 'src', '<?php echo esc_url( get_template_directory_uri() ); ?>/assets/images/logos/logo-footer-site_style_blue.svg' );
			}
			if( $.cookie('site_style') != 'site_style_default' ){
				$("head").append('<link rel="stylesheet" id="custom_style" href="<?php echo esc_url( get_template_directory_uri() ); ?>/assets/css/'+$.cookie('site_style')+'.css" type="text/css" media="all">');
			}
			$("#skin_color #" + $.cookie('site_style') ).addClass("active");
		}else{
			$("#skin_color #site_style_default").addClass("active");
		}


		if ($.cookie('navigation_type') && $.cookie('navigation_type') == 'sticky_header') {
			$("body").addClass('sticky_header');
		}else{
			$("body").removeClass('sticky_header');
		}

		$("#navigation_type").on("click", function () {
			if ($(this).hasClass('active')) {
				$(this).removeClass('active');
				$("body").removeClass('sticky_header');
				$.cookie('navigation_type', 'static_header', {expires: 7, path: '/'});
			} else {
				$(this).addClass('active');
				$("body").addClass('sticky_header');
				$.cookie('navigation_type', 'sticky_header', {expires: 7, path: '/'});
			}
		});

		if($("body").hasClass("sticky_header")){
			$("#navigation_type").addClass("active");
		}

		if( $.cookie('site_layout') && $.cookie('site_layout') == 'boxed' ){
			$("#site_layout").addClass('active');
			$("body").addClass('boxed_layout');
			$(".customizer_bg_image").slideDown();
			$('body').removeClass('boxed_bg_image_default boxed_bg_image_pattern');
			if( $("#bg_images span.active").hasClass('image_type') ){
				$('body').addClass('boxed_bg_image_default');
			}else{
				$('body').addClass('boxed_bg_image_pattern');
			}
			$('body').css({'background-image' : 'url(' + $("#bg_images span.active").attr('data-image') + ')'});
			if (window.location.href == '<?php echo esc_url( get_the_permalink( 2 ) ); ?>') {
				window.location.href = '<?php echo esc_url( get_the_permalink( 1063 ) ); ?>';
			}
		}

		$("#site_layout").on("click", function () {
			if ($(this).hasClass('active')) {
				$(this).removeClass('active');
				$("body").removeClass('boxed_layout');
				$.removeCookie( 'site_layout', {path: '/'} );
				$(".customizer_bg_image").slideUp();
				if (window.location.href == '<?php echo esc_url( get_the_permalink( 1063 ) ); ?>') {
					window.location.href = '<?php echo esc_url( get_the_permalink( 2 ) ); ?>';
				}
			} else {
				$(this).addClass('active');
				$("body").addClass('boxed_layout');
				$.cookie('site_layout', 'boxed', {expires: 7, path: '/'});
				$(".customizer_bg_image").slideDown();
				$('body').removeClass('boxed_bg_image_default boxed_bg_image_pattern');
				if( $("#bg_images span.active").hasClass('image_type') ){
					$('body').addClass('boxed_bg_image_default');
				}else{
					$('body').addClass('boxed_bg_image_pattern');
				}
				$('body').css({'background-image': 'url(' + $("#bg_images span.active").attr('data-image') + ')'});

				if (window.location.href == '<?php echo esc_url( get_the_permalink( 2 ) ); ?>') {
					window.location.href = '<?php echo esc_url( get_the_permalink( 1063 ) ); ?>';
				}
			}
		});

		$("#bg_images span").on('click', function () {
			$("#bg_images .active").removeClass("active");
			$(this).addClass("active");
			$('body').removeClass('boxed_bg_image_default boxed_bg_image_pattern');
			if( $(this).hasClass('image_type') ){
				$('body').addClass('boxed_bg_image_default');
			}else{
				$('body').addClass('boxed_bg_image_pattern');
			}
			$('body').css({'background-image' : 'url(' + $(this).attr('data-image') + ')'});
		});

		$("select[name='header_style']").on("change", function () {
			$("body").removeClass("header_style_1 header_style_2 header_style_3 header_style_4");
			$("body").addClass($(this).val());
			$.cookie('header_style', $(this).val(), {expires: 7, path: '/'});
			if ($(this).val() == 'header_style_3' || $(this).val() == 'header_style_1') {
				if( $.cookie('site_style') != 'site_style_default' ){
					$(".top_nav_wr .top_nav .logo a img").attr( 'src', '<?php echo esc_url( get_template_directory_uri() ); ?>/assets/images/logos/logo-'+$.cookie('site_style')+'.svg' );
					$("#footer .widgets_row .footer_logo a img").attr( 'src', '<?php echo esc_url( get_template_directory_uri() ); ?>/assets/images/logos/logo-footer-'+$.cookie('site_style')+'.svg' );
				}else{
					$(".top_nav_wr .top_nav .logo a img").attr( 'src', '<?php echo esc_url( get_template_directory_uri() ); ?>/assets/images/logos/logo-site_style_blue.svg' );
					$("#footer .widgets_row .footer_logo a img").attr( 'src', '<?php echo esc_url( get_template_directory_uri() ); ?>/assets/images/logos/logo-footer-site_style_blue.svg' );
				}
			}else{
				if( $.cookie('site_style') != 'site_style_default' ){
					$(".top_nav_wr .top_nav .logo a img").attr( 'src', '<?php echo esc_url( get_template_directory_uri() ); ?>/assets/images/logos/logo-'+$.cookie('site_style')+'-white.svg' );
					$("#footer .widgets_row .footer_logo a img").attr( 'src', '<?php echo esc_url( get_template_directory_uri() ); ?>/assets/images/logos/logo-footer-'+$.cookie('site_style')+'.svg' );
				}else{
					$(".top_nav_wr .top_nav .logo a img").attr( 'src', '<?php echo esc_url( get_template_directory_uri() ); ?>/assets/images/logos/logo-site_style_blue-white.svg' );
					$("#footer .widgets_row .footer_logo a img").attr( 'src', '<?php echo esc_url( get_template_directory_uri() ); ?>/assets/images/logos/logo-footer-site_style_blue.svg' );
				}
			}
		});

		if ($.cookie('header_style')) {
			$("body").removeClass("header_style_1 header_style_2 header_style_3 header_style_4");
			$("body").addClass($.cookie('header_style'));
			$("select[name='header_style'] option[value='"+$.cookie('header_style')+"']").attr("selected", "selected");
			if ($.cookie('header_style') == 'header_style_3' || $.cookie('header_style') == 'header_style_1') {
				if( $.cookie('site_style') && $.cookie('site_style') != 'site_style_default' ){
					$(".top_nav_wr .top_nav .logo a img").attr( 'src', '<?php echo esc_url( get_template_directory_uri() ); ?>/assets/images/logos/logo-'+$.cookie('site_style')+'.svg' );
					$("#footer .widgets_row .footer_logo a img").attr( 'src', '<?php echo esc_url( get_template_directory_uri() ); ?>/assets/images/logos/logo-footer-'+$.cookie('site_style')+'.svg' );
				}else{
					$(".top_nav_wr .top_nav .logo a img").attr( 'src', '<?php echo esc_url( get_template_directory_uri() ); ?>/assets/images/logos/logo-site_style_blue.svg' );
					$("#footer .widgets_row .footer_logo a img").attr( 'src', '<?php echo esc_url( get_template_directory_uri() ); ?>/assets/images/logos/logo-footer-site_style_blue.svg' );
				}
			}else{
				if( $.cookie('site_style') && $.cookie('site_style') != 'site_style_default' ){
					$(".top_nav_wr .top_nav .logo a img").attr( 'src', '<?php echo esc_url( get_template_directory_uri() ); ?>/assets/images/logos/logo-'+$.cookie('site_style')+'-white.svg' );
					$("#footer .widgets_row .footer_logo a img").attr( 'src', '<?php echo esc_url( get_template_directory_uri() ); ?>/assets/images/logos/logo-footer-'+$.cookie('site_style')+'.svg' );
				}else{
					$(".top_nav_wr .top_nav .logo a img").attr( 'src', '<?php echo esc_url( get_template_directory_uri() ); ?>/assets/images/logos/logo-site_style_blue-white.svg' );
					$("#footer .widgets_row .footer_logo a img").attr( 'src', '<?php echo esc_url( get_template_directory_uri() ); ?>/assets/images/logos/logo-footer-site_style_blue.svg' );
				}
			}
		}else{
			$("select[name='header_style'] option[value='header_style_4']").attr("selected", "selected");
		}

	});

</script>