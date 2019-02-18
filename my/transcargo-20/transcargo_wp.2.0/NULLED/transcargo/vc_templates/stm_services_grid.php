<?php
$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );

$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, vc_shortcode_custom_css_class( $css, ' ' ) );

$css_class .= ' cols_' . $posts_per_row;

$services = new WP_Query( array(
	'post_type'      => 'stm_service',
	'posts_per_page' => $posts_per_page
) );

if( empty( $img_size ) ){
	$img_size = '350x220';
}

?>

<?php if ( $services->have_posts() ): ?>
	<div class="vc_services_grid<?php echo esc_attr( $css_class ); ?>">
		<?php while ( $services->have_posts() ): $services->the_post(); ?>
			<div class="item">
				<div class="item_wr">
					<?php if ( has_post_thumbnail() ): ?>
						<?php
						$post_thumbnail = wpb_getImageBySize( array(
								'attach_id'  => get_post_thumbnail_id(),
								'thumb_size' => $img_size,
						) );
						$post_thumbnail = $post_thumbnail['thumbnail'];
						?>

						<div class="item_thumbnail">
							<a href="<?php the_permalink(); ?>">
								<?php echo $post_thumbnail; ?>
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
<?php endif;
wp_reset_postdata(); ?>