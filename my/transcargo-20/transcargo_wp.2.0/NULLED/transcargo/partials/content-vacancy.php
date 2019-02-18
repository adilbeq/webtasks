<?php $vc_status = get_post_meta( get_the_ID(), '_wpb_vc_js_status', true ); ?>
<?php transcargo_breadcrumbs(); ?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<div class="container">

		<?php if ( $vc_status != 'false' && $vc_status == true ): ?>
			<?php the_content(); ?>
		<?php else: ?>
			<?php
			$sidebar_type = get_theme_mod( 'blog_sidebar_type', 'wp' );
			if ( $sidebar_type == 'wp' ) {
				$sidebar_id = get_theme_mod( 'blog_wp_sidebar' );
			} else {
				$sidebar_id = get_theme_mod( 'blog_vc_sidebar' );
			}
			if ( ! empty( $_GET['sidebar_id'] ) ) {
				$sidebar_id =  $_GET['sidebar_id'];
			}
			$structure = transcargo_get_structure( $sidebar_id, $sidebar_type, get_theme_mod( 'blog_sidebar_position', 'right' ), get_theme_mod( 'blog_layout' ) ); ?>
			<?php echo $structure['content_before']; ?>
				<?php get_template_part( 'partials/content', 'about_vacancy' ) ?>
				<div class="wpb_text_column">
					<?php the_content(); ?>
				</div>
				<?php get_template_part( 'partials/content', 'vacancy_bottom' ); ?>
				<?php
				wp_link_pages( array(
					'before'      => '<div class="page-links"><span class="page-links-title">' . esc_html__( 'Pages:', 'transcargo' ) . '</span>',
					'after'       => '</div>',
					'link_before' => '<span>',
					'link_after'  => '</span>',
					'pagelink'    => '<span class="screen-reader-text">' . esc_html__( 'Page', 'transcargo' ) . ' </span>%',
					'separator'   => '<span class="screen-reader-text">, </span>',
				) );
				?>
			<?php echo $structure['content_after']; ?>
			<?php echo $structure['sidebar_before']; ?>
				<?php
				if ( $sidebar_id ) {
					if ( $sidebar_type == 'wp' ) {
						$sidebar = true;
					} else {
						$sidebar = get_post( $sidebar_id );
					}
				}
				if ( isset( $sidebar ) ) {
					if ( $sidebar_type == 'vc' ) { ?>
						<style type="text/css" scoped>
							<?php echo get_post_meta( $sidebar_id, '_wpb_shortcodes_custom_css', true ); ?>
						</style>
						<div class="sidebar-area stm_sidebar">
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
		<?php endif; ?>

	</div>
	<!--.container-->

</article> <!-- #post-## -->