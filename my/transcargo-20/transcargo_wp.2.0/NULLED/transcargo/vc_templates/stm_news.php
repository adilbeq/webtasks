<?php
$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );

$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, vc_shortcode_custom_css_class( $css, ' ' ) );

if ( empty( $loop ) ) {
	return;
}

$query = false;

list( $loop_args, $query ) = vc_build_loop_query( $loop, get_the_ID() );

if ( ! $query ) {
	return;
}

$link = vc_build_link( $link );

wp_enqueue_script( 'owl.carousel' );
wp_enqueue_style( 'transcargo-owl.carousel.css' );

$owl_id     = uniqid( 'owl-' );
$owl_nav_id = uniqid( 'owl-nav-' );

?>

<?php if ( $query->have_posts() ): ?>
	<div class="vc_news<?php echo esc_attr( $css_class ); ?>">
		<ul class="news_list" id="<?php echo esc_attr( $owl_id ); ?>">
			<?php while( $query->have_posts() ): $query->the_post(); ?>
				<li>
					<?php if( has_post_thumbnail() ): ?>
						<div class="news_thumbnail">
							<a href="<?php the_permalink(); ?>">
								<?php the_post_thumbnail( 'transcargo-image-270x330-croped' ); ?>
							</a>
							<div class="date">
								<div class="day"><?php echo get_the_date( 'j' ); ?></div>
								<div class="month"><?php echo get_the_date( 'M' ); ?></div>
							</div>
						</div>
					<?php endif; ?>
					<div class="news_content">
						<h4><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>
						<p><?php echo esc_html( get_the_excerpt() ); ?></p>
						<a href="<?php the_permalink(); ?>" class="read_more"><em><?php echo esc_html__( 'learn more', 'transcargo' ); ?></em><span>&rarr;</span></a>
					</div>
				</li>
			<?php endwhile; ?>
		</ul>
		<div class="vc_news_footer">
			<div class="owl-dots" id="<?php echo esc_attr( $owl_nav_id ); ?>"></div>
			<?php if ( ! empty( $link['url'] ) && ! empty( $link['title'] ) ): ?>
				<?php
				if ( ! $link['target'] ) {
					$link['target'] = '_self';
				}
				?>
				<a class="button size-sm icon_right" href="<?php echo esc_url( $link['url'] ) ?>" target="<?php echo esc_attr( $link['target'] ); ?>">
					<?php echo esc_html( $link['title'] ); ?>
					<i class="stm-arrow-next"></i>
				</a>
			<?php endif; ?>
		</div>
		<script type="text/javascript">
			jQuery(document).ready(function ($) {
				$("#<?php echo esc_js( $owl_id ); ?>").owlCarousel({
					dotsContainer: '#<?php echo esc_js( $owl_nav_id ); ?>',
					items: 1,
					margin: 20,
					autoplay: true,
					autoplayTimeout: 5000,
					smartSpeed: 250
				});
			});
		</script>
	</div>
<?php endif;
wp_reset_postdata(); ?>