<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<div class="post_wr">
		<?php if ( has_post_thumbnail() ): ?>
			<div class="post_thumbnail">
				<a href="<?php the_permalink(); ?>">
					<?php
					the_post_thumbnail( 'transcargo_image-600x377-croped' );
					?>
				</a>
				<div class="date">
					<div class="day"><?php echo get_the_date( 'j' ); ?></div>
					<div class="month"><?php echo get_the_date( 'M' ); ?></div>
				</div>
			</div>
		<?php endif; ?>
		<div class="content">
			<h5><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h5>
			<div class="post_excerpt">
				<?php the_excerpt(); ?>
			</div>
			<a href="<?php the_permalink(); ?>" class="read_more"><em><?php echo esc_html__( 'read more', 'transcargo' ); ?></em><span>&rarr;</span></a>
		</div>
	</div>
</article> <!-- #post-## -->