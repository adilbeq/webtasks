<?php if ( get_the_author_meta( 'description' ) ): ?>
	<div class="about_author">
		<div class="author_image">
			<?php echo get_avatar( get_the_author_meta( 'email' ), 174 ); ?>
		</div>
		<div class="author_info">
			<div class="author_name">
				<span><?php esc_html_e( 'Author', 'transcargo' ); ?></span>
				<strong><?php the_author(); ?></strong>
			</div>
			<div class="author_content"><?php echo esc_html( get_the_author_meta( 'description' ) ); ?></div>
		</div>
	</div>
<?php endif; ?>