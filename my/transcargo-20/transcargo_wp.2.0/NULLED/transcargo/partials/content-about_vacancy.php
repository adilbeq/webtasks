<div class="about_vacantion">
	<?php if( $department = get_post_meta( get_the_ID(), 'department', true ) ): ?>
		<div class="info">
			<?php esc_html_e( 'Department:', 'transcargo' ); ?>
			<strong><?php echo esc_html( $department ); ?></strong>
		</div>
	<?php endif; ?>
	<?php if( $location = get_post_meta( get_the_ID(), 'location', true ) ): ?>
		<div class="info">
			<?php esc_html_e( 'Project Location(s):', 'transcargo' ); ?>
			<strong><?php echo esc_html( $location ); ?></strong>
		</div>
	<?php endif; ?>
	<?php if( $education = get_post_meta( get_the_ID(), 'education', true ) ): ?>
		<div class="info">
			<?php esc_html_e( 'Education:', 'transcargo' ); ?>
			<strong><?php echo esc_html( $education ); ?></strong>
		</div>
	<?php endif; ?>
	<?php if( $compensation = get_post_meta( get_the_ID(), 'compensation', true ) ): ?>
		<div class="info">
			<?php esc_html_e( 'Compensation:', 'transcargo' ); ?>
			<strong><?php echo esc_html( $compensation ); ?></strong>
		</div>
	<?php endif; ?>
</div>