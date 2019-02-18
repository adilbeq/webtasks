<?php
if ( ! class_exists( 'TRANSCARGO_Customizer_Code_Control' ) ) {

	class TRANSCARGO_Customizer_Code_Control extends WP_Customize_Control {

		public $type = 'transcargo-code';
		public $placeholder = '';

		public function render_content() {

			$input_args = array(
				'type'        => 'textarea',
				'label'       => $this->label,
				'name'        => '',
				'id'          => $this->id,
				'value'       => $this->value(),
				'link'        => $this->get_link(),
				'placeholder' => $this->placeholder
			);

			?>

			<div id="stm-customize-control-<?php echo esc_attr( $this->id ); ?>" class="stm-customize-control stm-customize-control-<?php echo esc_attr( str_replace( 'transcargo-', '', $this->type ) ); ?>">

				<span class="customize-control-title">
					<?php echo esc_html( $this->label ); ?>
				</span>

				<div class="stm-form-item">
					<div class="stm-code-wrapper stm-form-item">
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