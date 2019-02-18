<?php get_header(); ?>
<?php
$sidebar_type = get_theme_mod( 'blog_sidebar_type', 'wp' );
if ( $sidebar_type == 'wp' ) {
	$sidebar_id = get_theme_mod( 'blog_wp_sidebar', 'transcargo-right-sidebar' );
} else {
	$sidebar_id = get_theme_mod( 'blog_vc_sidebar' );
}
if ( ! empty( $_GET['sidebar_id'] ) ) {
	$sidebar_id =  $_GET['sidebar_id'];
}
$structure = transcargo_get_structure( $sidebar_id, $sidebar_type, get_theme_mod( 'blog_sidebar_position', 'right' ), get_theme_mod( 'blog_layout' ) ); ?>
<?php transcargo_breadcrumbs(); ?>
	<div class="container">
		<?php echo $structure['content_before']; ?>
			<?php if( is_search() ): ?>
				<h2><?php esc_html_e( 'Need a new search?', 'transcargo' ); ?></h2>
				<p><?php esc_html_e( 'If you didn\'t find what you were looking for, try a new search!', 'transcargo' ); ?></p>
				<?php get_search_form(); ?>
			<?php endif; ?>
			<div class="<?php echo esc_attr( $structure['class'] ); ?>">
				<?php
				if ( have_posts() ) :
					while ( have_posts() ) : the_post();

						if ( transcargo_blog_layout() == 'grid' ) {
							get_template_part( 'partials/loop', 'grid' );
						}else{
							get_template_part( 'partials/loop', 'list' );
						}

					endwhile;
				else:
					get_template_part( 'partials/content', 'none' );
				endif;
				?>
			</div>
			<?php
			echo paginate_links( array(
				'type'      => 'list',
				'prev_text' => '<i class="stm-arrow-prev"></i>' . esc_html__( 'Prev', 'transcargo' ),
				'next_text' => esc_html__( 'Next', 'transcargo' ) . '<i class="stm-arrow-next"></i>',
			) );
			?>
		<?php echo $structure['content_after']; ?>
		<?php echo $structure['sidebar_before']; ?>
			<?php
			if ( $sidebar_id ) {
				if ( $sidebar_type == 'wp' ) {
					$sidebar = true;
				} else {
					if ( function_exists('icl_object_id') ) {
						$sidebar = get_post(icl_object_id($sidebar_id, 'stm_vc_sidebar', false));
					}else{
						$sidebar = get_post( $sidebar_id );
					}
				}
			}
			if ( isset( $sidebar ) ) {
				if ( $sidebar_type == 'vc' ) { ?>
					<div class="sidebar-area stm_sidebar">
						<style type="text/css" scoped>
							<?php echo get_post_meta( $sidebar_id, '_wpb_shortcodes_custom_css', true ); ?>
						</style>
						<?php echo apply_filters( 'the_content', $sidebar->post_content ); ?>
					</div>
				<?php } else { ?>
					<div class="sidebar-area default_widgets">
						<?php dynamic_sidebar( $sidebar_id ); ?>
					</div>
				<?php }
			}
			?>
		<?php echo $structure['sidebar_after']; ?>
	</div>
<?php get_footer(); ?>