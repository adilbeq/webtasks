<form method="get" class="search-form" action="<?php echo esc_url( home_url( '/' ) ); ?>">
	<input type="search" class="form-control" placeholder="<?php esc_html_e( 'Search...', 'transcargo' ); ?>" value="<?php echo get_search_query(); ?>" name="s"/>
	<button type="submit"><i class="stm-search"></i></button>
</form>