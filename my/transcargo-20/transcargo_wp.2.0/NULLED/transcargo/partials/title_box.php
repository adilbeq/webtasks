
<?php if( ! get_post_meta( get_the_ID(), 'transparent_header', true ) || is_search() ): ?>
	<div class="page_title">
		<div class="container">
			<h1><?php transcargo_page_title( true, esc_html__( 'News', 'transcargo' ), esc_html__( 'Careers', 'transcargo' ) ); ?></h1>
		</div>
	</div>
<?php endif; ?>