<?php
$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );

$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, vc_shortcode_custom_css_class( $css, ' ' ) );

$css_class .= ' cols_' . $cols;

$categories = get_terms( 'stm_gallery_category' );

if ( ! $categories ) {
	return false;
}

wp_enqueue_script( 'isotope' );
wp_enqueue_script( 'imagesloaded' );
wp_enqueue_script( 'jquery.fancybox' );
wp_enqueue_style( 'transcargo-jquery.fancybox.css' );

$gallery_id = uniqid( 'stm_gallery_' );
$fancy_id   = uniqid( 'fancy_' );

?>
<div id="<?php echo esc_attr( $gallery_id ); ?>" class="stm_gallery_wr<?php echo esc_attr( $css_class ); ?>">
	<div class="stm_gallery_nav_wr media container">
		<div class="stm_gallery_nav media-body media-middle">
			<ul>
				<li class="active"><a href="#all"><?php esc_html_e( 'All', 'transcargo' ); ?></a></li>
				<?php foreach ( $categories as $cat ): ?>
					<li><a href="#<?php echo esc_attr( $cat->slug ); ?>"><?php echo esc_attr( $cat->name ); ?></a></li>
				<?php endforeach; ?>
			</ul>
		</div>
		<div class="stm_gallery_nav media-right media-middle">
			<a href="#" class="stm_gallery_switcher">
				<i class="stm-arrow-bottom-left left"></i>
				<i class="stm-arrow-top-right right"></i>
			</a>
		</div>
	</div>
	<div class="stm_gallery container">
		<div class="row">
			<?php
			$gallery = new WP_Query(
				array(
					'post_type'      => 'stm_gallery',
					'posts_per_page' => - 1
				)
			);
			?>
			<?php while ( $gallery->have_posts() ): $gallery->the_post(); ?>
				<?php
				$project_class = '';
				$term_list     = wp_get_post_terms( get_the_ID(), 'stm_gallery_category' );
				if ( $term_list ) {
					foreach ( $term_list as $term ) {
						$project_class .= ' ' . $term->slug;
					}
				}
				?>
				<?php if ( has_post_thumbnail() ): ?>
					<?php
					$post_thumbnail = wpb_getImageBySize( array(
						'attach_id'  => get_post_thumbnail_id(),
						'thumb_size' => '480x320',
					) );
					$post_thumbnail = $post_thumbnail['thumbnail'];
					?>
					<div class="item all<?php echo esc_attr( $project_class ); ?>">
						<a title="<?php the_title(); ?>" rel="<?php echo esc_attr( $fancy_id ); ?>" class="fancybox" href="<?php echo esc_url( wp_get_attachment_url( get_post_thumbnail_id() ) ); ?>">
							<?php
							if ( $style == 'masonry' ) {
								the_post_thumbnail( 'transcargo_image-1600x1024' );
							} else {
								echo $post_thumbnail;
							}
							?>
						</a>
					</div>
				<?php endif; ?>
			<?php endwhile;
			wp_reset_postdata(); ?>
		</div>
	</div>
	<script type="text/javascript">
		jQuery(document).ready(function ($) {
			var $container = $("#<?php echo esc_js( $gallery_id ); ?> .stm_gallery .row");
			$container.isotope({
				itemSelector: '.item',
				transitionDuration: '0.7s'
			});
			$container.imagesLoaded().progress(function () {
				$container.isotope('layout');
			});
			$(".stm_gallery_switcher").on('click', function () {
				$(this).toggleClass('active');
				var $container_wrapper = $('#<?php echo esc_js( $gallery_id ); ?>');
				$container_wrapper.find('.stm_gallery').toggleClass('container');
				$container.isotope('layout');
				return false;
			});
			$('#<?php echo esc_js( $gallery_id ); ?> .stm_gallery_nav ul li a').live('click', function () {
				$(this).closest('ul').find('li.active').removeClass('active');
				$(this).parent().addClass('active');
				var sort = $(this).attr('href');
				sort = sort.substring(1);
				$container.isotope({
					filter: '.' + sort
				});
				return false;
			});
			$(".fancybox").fancybox({
				openEffect: 'elastic',
				closeEffect: 'elastic'
			});
		});
	</script>
</div>