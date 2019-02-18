<div class="post_bottom media">
	<?php
	if ( ! get_post_meta( get_the_ID(), 'disable_tags', true ) ) {
		the_tags( '<div class="tags media-body">', ' ', '</div>' );
	}
	?>
	<?php
	if ( function_exists( 'ADDTOANY_SHARE_SAVE_KIT' ) && !get_post_meta( get_the_ID(), 'sharing_disabled', true ) ) { ?>
		<div class="share_buttons media-right">
			<?php
			$addtoany_options = get_option( 'addtoany_options' );
			if ( isset( $addtoany_options['header'] ) && '' != $addtoany_options['header'] ) { ?>
				<div class="addtoany_header"><?php echo stripslashes( esc_html( $addtoany_options['header'] ) ); ?></div>
			<?php }
			ADDTOANY_SHARE_SAVE_KIT( array( "use_current_page" => true ) ); ?>
		</div>
	<?php } ?>
</div>