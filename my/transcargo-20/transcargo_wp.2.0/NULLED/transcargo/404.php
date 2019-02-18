<?php get_header(); ?>
<?php transcargo_breadcrumbs(); ?>
<div class="page_404">
	<div class="container">
		<div class="image_404"></div>
		<h2><?php echo wp_kses( __( 'Error 404: <br/>Page Not Found', 'transcargo' ), array( 'br' => array() ) ); ?></h2>
		<p><?php esc_html_e( 'The page you were looking for is not here.', 'transcargo' ); ?></p>
		<a class="button icon_right" href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php esc_html_e( 'Home Page', 'transcargo' ); ?><i class="stm-arrow-next"></i></a>
	</div>
</div>
<?php get_footer(); ?>