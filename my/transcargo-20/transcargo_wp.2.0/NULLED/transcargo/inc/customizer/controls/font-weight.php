<?php
if ( ! class_exists( 'TRANSCARGO_Customizer_Font_Weight_Control' ) ) {

	class TRANSCARGO_Customizer_Font_Weight_Control extends WP_Customize_Control {

		public $type = 'transcargo-font-weight';

		public function render_content() {


			$weights = array(
				'100'       => esc_html__( 'Ultra Light', 'transcargo' ),
				'100italic' => esc_html__( 'Ultra Light Italic', 'transcargo' ),
				'200'       => esc_html__( 'Light', 'transcargo' ),
				'200italic' => esc_html__( 'Light Italic', 'transcargo' ),
				'300'       => esc_html__( 'Book', 'transcargo' ),
				'300italic' => esc_html__( 'Book Italic', 'transcargo' ),
				'400'       => esc_html__( 'Regular', 'transcargo' ),
				'400italic' => esc_html__( 'Regular Italic', 'transcargo' ),
				'500'       => esc_html__( 'Medium', 'transcargo' ),
				'500italic' => esc_html__( 'Medium Italic', 'transcargo' ),
				'600'       => esc_html__( 'Semi-Bold', 'transcargo' ),
				'600italic' => esc_html__( 'Semi-Bold Italic', 'transcargo' ),
				'700'       => esc_html__( 'Bold', 'transcargo' ),
				'700italic' => esc_html__( 'Bold Italic', 'transcargo' ),
				'800'       => esc_html__( 'Extra Bold', 'transcargo' ),
				'800italic' => esc_html__( 'Extra Bold Italic', 'transcargo' ),
				'900'       => esc_html__( 'Ultra Bold', 'transcargo' ),
				'900italic' => esc_html__( 'Ultra Bold Italic', 'transcargo' )
			);


			$input_args = array(
				'type'    => 'select',
				'label'   => $this->label,
				'name'    => '',
				'id'      => $this->id,
				'value'   => $this->value(),
				'link'    => $this->get_link(),
				'options' => $weights
			);

			?>

			<div id="stm-customize-control-<?php echo esc_attr( $this->id ); ?>" class="stm-customize-control stm-customize-control-<?php echo esc_attr( str_replace( 'transcargo-', '', $this->type ) ); ?>">

				<span class="customize-control-title">
					<?php echo esc_html( $this->label ); ?>
				</span>

				<div class="stm-form-item">
					<div class="stm-font-weight-wrapper">
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