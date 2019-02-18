<?php
if ( ! class_exists( 'TRANSCARGO_Customizer_Separator_Control' ) ) {

	class TRANSCARGO_Customizer_Separator_Control extends WP_Customize_Control {

		public $type = 'transcargo-separator';

		public function render_content() { ?>

			<div id="stm-customize-control-<?php echo esc_attr( $this->id ); ?>" class="stm-customize-control stm-customize-control-<?php echo esc_attr( str_replace( 'transcargo-', '', $this->type ) ); ?>"></div>
			<?php
		}
	}
}