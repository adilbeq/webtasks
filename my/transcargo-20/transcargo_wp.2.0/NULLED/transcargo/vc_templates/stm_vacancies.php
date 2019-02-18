<?php
$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );

$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, vc_shortcode_custom_css_class( $css, ' ' ) );
wp_enqueue_script( 'jquery.tablesorter' );

$id        = rand();
$vacancies = new WP_Query( array( 'post_type' => 'stm_careers', 'posts_per_page' => - 1 ) );
?>

<div class="vacancy_table_wr<?php echo esc_attr( $css_class ); ?>">

	<?php if ( $vacancies->have_posts() ) { ?>

		<table class="vacancy_table" id="vacancy_table_<?php echo esc_attr( $id ) ?>">
			<thead>
			<tr>
				<th><?php esc_html_e( 'Job Posting Title', 'transcargo' ); ?></th>
				<th class="location"><?php esc_html_e( 'Location', 'transcargo' ); ?></th>
				<th><?php esc_html_e( 'Department', 'transcargo' ); ?></th>
				<th><?php esc_html_e( 'Date', 'transcargo' ); ?></th>
			</tr>
			</thead>
			<tbody>

			<?php while ( $vacancies->have_posts() ) {
				$vacancies->the_post(); ?>
				<tr>
					<td><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></td>
					<td class="location"><?php echo esc_html( get_post_meta( get_the_ID(), 'location', true ) ); ?></td>
					<td><?php echo esc_html( get_post_meta( get_the_ID(), 'department', true ) ); ?></td>
					<td><?php echo get_the_date(); ?></td>
				</tr>
			<?php }
			wp_reset_postdata(); ?>

			</tbody>
		</table>

	<?php } ?>

	<script type="text/javascript">
		jQuery(document).ready(function ($) {
			$("#vacancy_table_<?php echo esc_js( $id )?>").tablesorter({
				sortList: [[0, 0]]
			});
		});
	</script>
</div>