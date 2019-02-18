<?php
if ( ! class_exists( 'TRANSCARGO_Customizer_Heading_Control' ) ) {

	class TRANSCARGO_Customizer_Heading_Control extends WP_Customize_Control {

		public $type = 'transcargo-heading';

		public function render_content() { ?>

			<div id="stm-customize-control-<?php echo esc_attr( $this->id ); ?>" class="stm-customize-control stm-customize-control-<?php echo esc_attr( str_replace( 'transcargo-', '', $this->type ) ); ?>">

				<span class="customize-control-title">
					<?php echo esc_html( $this->label ); ?>
				</span>

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