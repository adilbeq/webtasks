<?php
if ( ! class_exists( 'TRANSCARGO_Customizer_Checkbox_Control' ) ) {

	class TRANSCARGO_Customizer_Checkbox_Control extends WP_Customize_Control {

		public $type = 'transcargo-checkbox';

		public function render_content() {

			$input_args = array(
				'type'  => 'checkbox',
				'label' => $this->label,
				'name'  => '',
				'id'    => $this->id,
				'value' => $this->value(),
				'link'  => $this->get_link()
			);

			?>

			<div id="stm-customize-control-<?php echo esc_attr( $this->id ); ?>" class="stm-customize-control stm-customize-control-<?php echo esc_attr( str_replace( 'transcargo-', '', $this->type ) ); ?>">

				<div class="stm-form-item">
					<div class="stm-checkbox-wrapper stm-form-item">
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