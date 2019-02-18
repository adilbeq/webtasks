<?php
if ( ! class_exists( 'TRANSCARGO_Customizer_Attr_Control' ) ) {

	class TRANSCARGO_Customizer_Attr_Control extends WP_Customize_Control {

		public $type = 'transcargo-attr';
		public $mode = '';
		public $units = '';

		public function render_content() {

			$type = 'text';

			if ( $this->mode == 'font-size'
			     || $this->mode == 'width'
			     || $this->mode == 'height'
			     || $this->mode == 'line-height'
			     || $this->mode == 'margin-top'
			     || $this->mode == 'margin-right'
			     || $this->mode == 'margin-bottom'
			     || $this->mode == 'margin-left'
			     || $this->mode == 'padding-top'
			     || $this->mode == 'padding-right'
			     || $this->mode == 'padding-bottom'
			     || $this->mode == 'padding-left'
			) {
				$type = 'number';
			}

			$input_args = array(
				'type'  => $type,
				'label' => $this->label,
				'name'  => '',
				'id'    => $this->id,
				'value' => $this->value(),
				'link'  => $this->get_link()
			);

			?>

			<div id="stm-customize-control-<?php echo esc_attr( $this->id ); ?>" class="stm-customize-control stm-customize-control-<?php echo esc_attr( str_replace( 'transcargo-', '', $this->type ) ); ?>">

				<span class="customize-control-title">
					<?php echo esc_html( $this->label ); ?>
				</span>

				<div class="stm-form-item">
					<div class="stm-attr-wrapper stm-form-item stm_input_group">
						<?php transcargo_input( $input_args ); ?>
						<?php if ( $this->units ): ?>
							<span class="input-addon"><?php echo esc_html( $this->units ); ?></span>
						<?php endif; ?>
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