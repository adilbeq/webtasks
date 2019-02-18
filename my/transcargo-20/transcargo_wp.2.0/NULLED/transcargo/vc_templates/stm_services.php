<?php
$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );

$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, vc_shortcode_custom_css_class( $css, ' ' ) );

$services = new WP_Query( array(
	'post_type'      => 'stm_service',
	'posts_per_page' => $posts_per_page
) );

wp_enqueue_script( 'owl.carousel' );
wp_enqueue_style( 'transcargo-owl.carousel.css' );

$owl_id     = uniqid( 'owl-' );
$owl_nav_id = uniqid( 'owl-nav-' );

?>

<?php if ( $services->have_posts() ): ?>
	<div class="vc_services<?php echo esc_attr( $css_class ); ?>">
		<div class="row">
			<div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
				<?php echo wpb_js_remove_wpautop( $content, true ); ?>
				<div class="owl-dots" id="<?php echo esc_attr( $owl_nav_id ); ?>"></div>
			</div>
			<div class="col-lg-9 col-md-9 col-sm-12 col-xs-12">
				<div class="vc_services_carousel_wr">
					<div class="vc_services_carousel" id="<?php echo esc_attr( $owl_id ); ?>">
						<?php while ( $services->have_posts() ): $services->the_post(); ?>
							<div class="item">
								<div class="item_wr">
									<?php if ( has_post_thumbnail() ): ?>
										<div class="item_thumbnail">
											<a href="<?php the_permalink(); ?>">
												<?php the_post_thumbnail( 'transcargo-image-255x170-croped' ); ?>
											</a>
										</div>
									<?php endif; ?>
									<div class="content">
										<h6><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h6>
										<?php the_excerpt(); ?>
										<a href="<?php the_permalink(); ?>" class="read_more"><em><?php echo esc_html__( 'read more', 'transcargo' ); ?></em><span>&rarr;</span></a>
									</div>
								</div>
							</div>
						<?php endwhile; ?>
					</div>
				</div>
			</div>
		</div>
		<script type="text/javascript">
			jQuery(document).ready(function ($) {
				$("#<?php echo esc_js( $owl_id ); ?>").owlCarousel({
					dotsContainer: '#<?php echo esc_js( $owl_nav_id ); ?>',
					items: <?php echo esc_js( $items ); ?>,
					<?php if( $autoplay ): ?>
					autoplay: true,
					<?php endif; ?>
					<?php if( $hide_pagination_control ): ?>
					dots: false,
					<?php endif; ?>
					<?php if( $loop ): ?>
					loop: true,
					<?php endif; ?>
					autoplayTimeout: <?php echo esc_js( $timeout ); ?>,
					smartSpeed: <?php echo esc_js( $smart_speed ); ?>,
					responsive: {
						0: {
							items: <?php echo esc_js( $items_mobile ); ?>
						},
						768: {
							items: <?php echo esc_js( $items_tablet ); ?>
						},
						980: {
							items: <?php echo esc_js( $items_small_desktop ); ?>
						},
						1199:{
							items: <?php echo esc_js( $items ); ?>
						}
					}
				});
			});
		</script>
	</div>
<?php endif;
wp_reset_postdata(); ?>