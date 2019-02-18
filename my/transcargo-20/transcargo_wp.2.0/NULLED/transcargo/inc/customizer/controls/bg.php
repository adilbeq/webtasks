<?php
if ( ! class_exists( 'TRANSCARGO_Customizer_Bg_Control' ) ) {

	class TRANSCARGO_Customizer_Bg_Control extends WP_Customize_Control {

		public $type = 'transcargo-bg';

		public function render_content() {

			?>

			<div id="stm-customize-control-<?php echo esc_attr( $this->id ); ?>" class="stm-customize-control stm-customize-control-<?php echo esc_attr( str_replace( 'transcargo-', '', $this->type ) ); ?>">

				<span class="customize-control-title">
					<?php echo esc_html( $this->label ); ?>
				</span>

				<div class="stm-form-item">
					<div class="theme_bg">
						<ul>
							<?php foreach ( $this->choices as $itemName => $itemLabel ): ?>
								<li class="<?php echo esc_attr( $itemName ); ?>" <?php if($itemLabel){ ?>style="background-image: url('<?php echo esc_url( get_template_directory_uri() ); ?>/assets/images/bg/<?php echo esc_attr( $itemLabel ); ?>.png')"<?php } ?>>
									<label><input type="radio" <?php $this->link(); ?> name="<?php echo esc_attr( $this->id ); ?>" value="<?php echo esc_attr( $itemName ); ?>" title="<?php echo esc_attr( $itemLabel ); ?>"></label>
								</li>
							<?php endforeach; ?>
						</ul>
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