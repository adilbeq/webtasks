<div class="post_details_wr">
	<div class="post_date">
		<div class="day"><?php echo get_the_date( 'j' ); ?></div>
		<div class="month"><?php echo get_the_date( 'M' ); ?></div>
	</div>
	<div class="post_details">
		<?php if ( ! get_post_meta( get_the_ID(), 'disable_author_info', true ) ) { ?>
			<div class="posted_by">
				<?php esc_html_e( 'Posted by', 'transcargo' ); ?> <?php the_author_link(); ?>
			</div>
		<?php }	?>
		<?php if ( ! get_post_meta( get_the_ID(), 'disable_cats', true ) ) { ?>
			<div class="categories">
				<span><?php esc_html_e( 'Category:', 'transcargo' ); ?></span>
				<?php echo transcargo_get_post_categories( get_the_ID() ); ?>
			</div>
		<?php }	?>
		<div class="comments">
			<a href="<?php comments_link(); ?>"><?php comments_number(); ?></a>
		</div>
	</div>
</div>