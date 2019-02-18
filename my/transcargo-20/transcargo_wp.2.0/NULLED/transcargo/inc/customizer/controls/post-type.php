<?php
if ( ! class_exists( 'TRANSCARGO_Customizer_Post_Type_Control' ) ) {

	class TRANSCARGO_Customizer_Post_Type_Control extends WP_Customize_Control {

		public $type = 'transcargo-post-type';
		public $post_type = '';

		public function render_content() {

			if ( empty( $this->post_type ) ) {
				$this->post_type = 'post';
			}

			$post_types[] = esc_html__( '--- Default ---', 'transcargo' );
			if ( $this->post_type != 'sidebar' ) {
				$query = get_posts( array( 'post_type' => $this->post_type, 'posts_per_page' => - 1 ) );
				if ( $query ) {
					foreach ( $query as $post ) {
						$post_types[ $post->ID ] = get_the_title( $post->ID );
					}
				}
			} else {
				foreach ( $GLOBALS['wp_registered_sidebars'] as $sidebar ) {
					$post_types[ $sidebar['id'] ] = $sidebar['name'];
				}
			}

			$input_args = array(
				'type'    => 'select',
				'label'   => $this->label,
				'name'    => '',
				'id'      => $this->id,
				'value'   => $this->value(),
				'link'    => $this->get_link(),
				'options' => $post_types
			);

			?>

			<div id="stm-customize-control-<?php echo esc_attr( $this->id ); ?>" class="stm-customize-control stm-customize-control-<?php echo esc_attr( str_replace( 'transcargo-', '', $this->type ) ); ?>">

				<span class="customize-control-title">
					<?php echo esc_html( $this->label ); ?>
				</span>

				<div class="stm-form-item">
					<div class="stm-post-type-wrapper stm-form-item">
						<?php transcargo_input( $input_args ); ?>
					</div>
				</div>

				<?php if ( '' != $this->description ) : ?>
					<div class="description customize-control-description">
						<?php echo esc_html( $this->description ); ?>
					</div>
				<?php endif; ?>

			</div>
			<?php
		}
	}
}