<?php
$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );

$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, vc_shortcode_custom_css_class( $css, ' ' ) );
$css_class .= ' ' . $style;
if ( $style == 'grid' ) {
	$css_class .= ' cols_' . $per_row;
}
$testimonials = new WP_Query( array( 'post_type' => 'stm_staff', 'posts_per_page' => $count ) );

?>

<?php if ( $testimonials->have_posts() ) { ?>

	<div class="staff_list<?php echo esc_attr( $css_class ); ?>">
		<ul>
			<?php while ( $testimonials->have_posts() ): $testimonials->the_post(); ?>
				<li>
					<?php
					$department  = get_post_meta( get_the_ID(), 'department', true );
					$phone       = get_post_meta( get_the_ID(), 'phone', true );
					$skype       = get_post_meta( get_the_ID(), 'skype', true );
					$email       = get_post_meta( get_the_ID(), 'email', true );
					$facebook    = get_post_meta( get_the_ID(), 'facebook', true );
					$twitter     = get_post_meta( get_the_ID(), 'twitter', true );
					$google_plus = get_post_meta( get_the_ID(), 'google_plus', true );
					$linkedin    = get_post_meta( get_the_ID(), 'linkedin', true );
					if ( $style == 'list' ):
					?>
						<div class="staff_image">
							<?php the_post_thumbnail( 'transcargo_image-350x230-croped' ); ?>
						</div>
						<div class="staff_info">
							<?php the_title( '<h5>', '</h5>' ); ?>
							<?php if( $department ): ?>
								<div class="staff_department">
									<?php echo esc_html( $department ); ?>
								</div>
							<?php endif; ?>
							<?php if( $phone ): ?>
								<div class="staff_phone">
									<?php echo esc_html( $phone ); ?>
								</div>
							<?php endif; ?>
							<?php if( $email ): ?>
								<div class="staff_email">
									<a href="mailto:<?php echo antispambot( $email ); ?>"><?php echo antispambot( $email ); ?></a>
								</div>
							<?php endif; ?>
							<?php if( $skype ): ?>
								<div class="staff_skype">
									<?php echo esc_html( $skype ); ?>
								</div>
							<?php endif; ?>
							<ul class="staff_socials">
								<?php if( $facebook ): ?>
									<li>
										<a class="social-facebook" href="<?php echo esc_url( $facebook ); ?>"><i class="fa fa-facebook"></i></a>
									</li>
								<?php endif; ?>
								<?php if( $twitter ): ?>
									<li>
										<a class="social-twitter" href="<?php echo esc_url( $twitter ); ?>"><i class="fa fa-twitter"></i></a>
									</li>
								<?php endif; ?>
								<?php if( $google_plus ): ?>
									<li>
										<a class="social-google-plus" href="<?php echo esc_url( $google_plus ); ?>"><i class="stm-google-plus"></i></a>
									</li>
								<?php endif; ?>
								<?php if( $linkedin ): ?>
									<li>
										<a class="social-linkedin" href="<?php echo esc_url( $linkedin ); ?>"><i class="fa fa-linkedin"></i></a>
									</li>
								<?php endif; ?>
							</ul>
						</div>
					<?php else: ?>
						<div class="staff_wr">
							<div class="staff_image">
								<?php the_post_thumbnail( 'transcargo_image-350x230-croped' ); ?>
								<ul class="staff_socials">
									<?php if( $facebook ): ?>
										<li>
											<a class="social-facebook" href="<?php echo esc_url( $facebook ); ?>"><i class="fa fa-facebook"></i></a>
										</li>
									<?php endif; ?>
									<?php if( $twitter ): ?>
										<li>
											<a class="social-twitter" href="<?php echo esc_url( $twitter ); ?>"><i class="fa fa-twitter"></i></a>
										</li>
									<?php endif; ?>
									<?php if( $google_plus ): ?>
										<li>
											<a class="social-google-plus" href="<?php echo esc_url( $google_plus ); ?>"><i class="stm-google-plus"></i></a>
										</li>
									<?php endif; ?>
									<?php if( $linkedin ): ?>
										<li>
											<a class="social-linkedin" href="<?php echo esc_url( $linkedin ); ?>"><i class="fa fa-linkedin"></i></a>
										</li>
									<?php endif; ?>
								</ul>
							</div>
							<div class="staff_info">
								<div class="staff_info_wr">
									<div class="staff_name_position">
										<?php the_title( '<h5>', '</h5>' ); ?>
										<?php if( $department ): ?>
											<div class="staff_department">
												<?php echo esc_html( $department ); ?>
											</div>
										<?php endif; ?>
									</div>
									<div class="staff_phone_email">
										<?php if( $phone ): ?>
											<div class="staff_phone">
												<?php echo esc_html( $phone ); ?>
											</div>
										<?php endif; ?>
										<?php if( $email ): ?>
											<div class="staff_email">
												<a href="mailto:<?php echo antispambot( $email ); ?>"><?php echo antispambot( $email ); ?></a>
											</div>
										<?php endif; ?>
									</div>
								</div>
							</div>
						</div>
					<?php endif; ?>
				</li>
			<?php endwhile;
			wp_reset_postdata(); ?>
		</ul>

	</div>

<?php } ?>