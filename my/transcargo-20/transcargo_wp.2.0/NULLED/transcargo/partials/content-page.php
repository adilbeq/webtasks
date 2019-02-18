<?php $vc_status = get_post_meta( get_the_ID(), '_wpb_vc_js_status', true ); ?>
<?php transcargo_breadcrumbs(); ?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<div class="container">

		<?php if ( $vc_status != 'false' && $vc_status == true ): ?>
			<?php the_content(); ?>
		<?php else: ?>
			<div class="wpb_text_column">
				<?php the_content(); ?>
			</div>
		<?php endif; ?>
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
		<?php if ( comments_open() || get_comments_number() ) : ?>
			<div class="stm_post_comments">
				<?php comments_template(); ?>
			</div>
		<?php endif; ?>
	</div>
	<!--.container-->

</article> <!-- #post-## -->