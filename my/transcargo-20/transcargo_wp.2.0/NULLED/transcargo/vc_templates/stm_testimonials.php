<?php
$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );

$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, vc_shortcode_custom_css_class( $css, ' ' ) );

$css_class .= ' ' . $style;

$args = array(
	'post_type' => 'stm_testimonial',
	'posts_per_page' => $posts_per_page
);

if( $category != 'all' ){
	$args['stm_testimonials_category'] = $category;
}

$testimonials = new WP_Query( $args );

wp_enqueue_script( 'owl.carousel' );
wp_enqueue_style( 'transcargo-owl.carousel.css' );

$owl_wr_id  = uniqid( 'owl_wr_' );
$owl_id     = uniqid( 'owl_' );
$owl_nav_id = uniqid( 'owl-nav-' );

?>

<?php if ( $testimonials->have_posts() ): ?>
	<div class="vc_testimonials<?php echo esc_attr( $css_class ); ?>" id="<?php echo esc_attr( $owl_wr_id ); ?>">
		<?php if( $style == 'style_2' ): ?>
			<div class="container">
		<?php endif; ?>
		<div class="vc_testimonials_carousel_wr">
			<div class="vc_testimonials_carousel" id="<?php echo esc_attr( $owl_id ); ?>">
				<?php while ( $testimonials->have_posts() ): $testimonials->the_post(); ?>
					<div class="item" data-image="<?php echo esc_url( wp_get_attachment_image_url( get_post_meta( get_the_ID(), 'bg_image', true ), true ) ); ?>">
						<?php the_excerpt(); ?>
						<?php if( $style == 'style_2' ): ?>
							<div class="sep"><i class="stm-testimonials-new-2"></i></div>
						<?php endif; ?>
						<?php if( has_post_thumbnail() && $style != 'style_2' ): ?>
							<div class="testimonial_thumbnail">
								<?php the_post_thumbnail( 'transcargo_image-40x40-croped' ); ?>
							</div>
						<?php endif; ?>
						<div class="testimonial_info">
							<h6><?php the_title(); ?></h6>
							<?php if ( $position = get_post_meta( get_the_ID(), 'position', true ) ): ?>
								<div class="position"><?php echo esc_html( $position ); ?></div>
							<?php endif; ?>
						</div>
					</div>
				<?php endwhile; ?>
			</div>
			<div class="owl-dots" id="<?php echo esc_attr( $owl_nav_id ); ?>"></div>
		</div>
		<?php if( $style == 'style_2' ): ?>
			</div>
		<?php endif; ?>
		<script type="text/javascript">
			jQuery(document).ready(function ($) {

				var <?php echo esc_js( $owl_id ); ?> = $("#<?php echo esc_js( $owl_id ); ?>");
				var <?php echo esc_js( $owl_wr_id ); ?> = $("#<?php echo esc_js( $owl_wr_id ); ?>");

				<?php if( $style == 'style_2' ): ?>
					<?php echo esc_js( $owl_id ); ?>.on('initialized.owl.carousel', function () {
						var bg_image = <?php echo esc_js( $owl_id ); ?>.find(".owl-item.active .item").data("image");
						<?php echo esc_js( $owl_wr_id ); ?>.css({'background-image': 'url('+bg_image+')'});
					});
				<?php endif; ?>

				$("#<?php echo esc_js( $owl_id ); ?>").owlCarousel({
					margin: 15,
					dotsContainer: '#<?php echo esc_js( $owl_nav_id ); ?>',
					<?php if( $autoplay ): ?>
					autoplay: true,
					<?php endif; ?>
					<?php if( $hide_pagination_control ): ?>
					dots: false,
					<?php endif; ?>
					dotsEach: true,
					<?php if( $loop ): ?>
					loop: true,
					<?php endif; ?>
					autoHeight:true,
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
						1199: {
							items: <?php echo esc_js( $items ); ?>
						}
					}<?php if( $style == 'style_2' ): ?>,
						onTranslated: function () {
							var bg_image = <?php echo esc_js( $owl_id ); ?>.find(".owl-item.active .item").data("image");
							<?php echo esc_js( $owl_wr_id ); ?>.css({'background-image': 'url('+bg_image+')'});
						}
					<?php endif; ?>
				});

			});
		</script>
	</div>
<?php endif;
wp_reset_postdata(); ?>