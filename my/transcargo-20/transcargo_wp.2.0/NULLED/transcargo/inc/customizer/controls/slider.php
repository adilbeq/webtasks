<?php
if ( ! class_exists( 'TRANSCARGO_Customizer_Slider_Control' ) ) {

	class TRANSCARGO_Customizer_Slider_Control extends WP_Customize_Control {

		public $type = 'transcargo-slider';
		public $min = '';
		public $max = '';
		public $step = '';

		public function enqueue() {
			wp_enqueue_script( 'jquery-ui-core' );
			wp_enqueue_script( 'jquery-ui-slider' );
		}

		public function render_content() {

			$value = $this->value();

			if ( empty( $value ) ) {
				$this->value = 0;
			}

			$input_args = array(
				'type'  => 'text',
				'label' => $this->label,
				'name'  => '',
				'id'    => 'input_' . $this->id,
				'value' => $this->value(),
				'link'  => $this->get_link()
			);

			?>

			<div id="stm-customize-control-<?php echo esc_attr( $this->id ); ?>" class="stm-customize-control stm-customize-control-<?php echo esc_attr( str_replace( 'transcargo-', '', $this->type ) ); ?>">

				<span class="customize-control-title">
					<?php echo esc_html( $this->label ); ?>
				</span>

				<div class="stm-form-item">
					<div class="stm-slider-wrapper stm-form-item">
						<?php transcargo_input( $input_args ); ?>
						<div id="slider_<?php echo esc_attr( $this->id ); ?>" class="stm-slider"></div>
						<script type="text/javascript">
							jQuery(document).ready(function ($) {
								"use strict";

								$("#slider_<?php echo esc_js( $this->id ); ?>").slider({
									value: <?php echo esc_js( $this->value() ); ?>,
									min: <?php echo esc_js( $this->min ); ?>,
									max: <?php echo esc_js( $this->max ); ?>,
									step: <?php echo esc_js( $this->step ); ?>,
									slide: function (event, ui) {
										$("#input_<?php echo esc_js( $this->id ); ?>").val(ui.value).keyup();
									}
								});
							});
						</script>
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