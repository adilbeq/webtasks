<?php
if ( post_password_required() ) {
	return;
}
?>

<div id="comments" class="comments-area">

	<?php if ( have_comments() ) : ?>
		<h2 class="comments-title"><?php esc_html_e( 'Comments', 'transcargo' ); ?></h2>

		<ul class="comment-list">
			<?php
				wp_list_comments( array(
					'style'       => 'ul',
					'short_ping'  => true,
					'reply_text'  => esc_html__( 'Reply', 'transcargo' ),
					'avatar_size' => 87,
					'callback'    => 'transcargo_comment'
				) );
			?>
		</ul><!-- .comment-list -->

		<?php
			if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) :
				?>
				<nav class="navigation comment-navigation" role="navigation">
					<h4 class="screen-reader-text"><?php esc_html_e( 'Comment navigation', 'transcargo' ); ?></h4>
					<div class="nav-links">
						<?php
						if ( $prev_link = get_previous_comments_link( esc_html__( 'Older Comments', 'transcargo' ) ) ) :
							printf( '<div class="nav-previous">%s</div>', $prev_link );
						endif;

						if ( $next_link = get_next_comments_link( esc_html__( 'Newer Comments', 'transcargo' ) ) ) :
							printf( '<div class="nav-next">%s</div>', $next_link );
						endif;
						?>
					</div><!-- .nav-links -->
				</nav><!-- .comment-navigation -->
				<?php
			endif;
		?>

	<?php endif; // have_comments() ?>

	<?php if ( ! comments_open() && get_comments_number() && post_type_supports( get_post_type(), 'comments' ) ) : ?>
		<p class="no-comments"><?php esc_html_e( 'Comments are closed.', 'transcargo' ); ?></p>
	<?php endif; ?>

	<?php comment_form( array( 'comment_notes_before' => '', 'comment_notes_after' => '' ) ); ?>

</div><!-- .comments-area -->
