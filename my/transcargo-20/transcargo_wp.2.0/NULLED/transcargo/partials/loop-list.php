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
			<?php if( transcargo_get_post_categories( get_the_ID() ) ): ?>
				<div class="categories">
					<span><?php esc_html_e( 'Category:', 'transcargo' ); ?></span>
					<?php echo transcargo_get_post_categories( get_the_ID() ); ?>
				</div>
			<?php endif; ?>
			<div class="post_excerpt">
				<?php the_excerpt(); ?>
			</div>
		</div>
	</div>
</article> <!-- #post-## -->