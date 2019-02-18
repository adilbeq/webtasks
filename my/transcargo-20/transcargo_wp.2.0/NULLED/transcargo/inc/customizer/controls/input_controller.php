<?php

function transcargo_input( $args = array() ) {

	$defaults = array(
		'type'        => 'text',
		'name'        => '',
		'id'          => '',
		'placeholder' => '',
		'data'        => '',
		'value'       => '',
		'class'       => '',
		'link'        => '',
		'options'     => array()
	);

	$input = wp_parse_args( $args, $defaults );

	$input_props                = array();
	$input_props['id']          = ( $input['id'] != '' ) ? 'id="' . esc_attr( $input['id'] ) . '"' : '';
	$input_props['name']        = ( $input['name'] != '' ) ? 'name="' . esc_attr( $input['name'] ) . '"' : '';
	$input_props['placeholder'] = ( $input['placeholder'] != '' ) ? 'placeholder="' . esc_attr( $input['placeholder'] ) . '"' : '';
	$input_props['class']       = ( $input['class'] != '' ) ? 'class="' . esc_attr( $input['class'] ) . '"' : '';
	$input_props['disabled']    = isset( $input['disabled'] ) ? 'disabled="disabled"' : '';
	$input_props['data']        = $input['link'];
	$input_props['min']         = ( isset( $input['min'] ) ) ? 'min="' . esc_attr( $input['min'] ) . '"' : '';
	$input_props['max']         = ( isset( $input['max'] ) ) ? 'max="' . esc_attr( $input['max'] ) . '"' : '';

	switch ( $input['type'] ) {

		case 'checkbox' : ?>
			<input type="checkbox" <?php echo implode( ' ', $input_props ); ?> <?php checked( $input['value'], true ); ?>/>
			<?php if ( isset( $input['label'] ) ) { ?>
				<label for="<?php echo esc_attr( $input['id'] ); ?>"><?php echo esc_html( $input['label'] ); ?></label>
			<?php } ?>
			<?php break;

		case 'socials' : ?>
			<?php
			$values = array();
			if( ! empty( $input['value'] ) ){
				parse_str($input['value'], $values);
			}
			?>
			<form>
				<ul>
					<?php foreach ( $input['options'] as $value => $label ) { ?>
						<?php
						$input_value = '';
						if ( ! empty( $values[ $value ] ) ) {
							$input_value = $values[ $value ];
						}
						?>
						<li class="customize-control">
							<label class="customize-control-title"><?php echo esc_html( $label ); ?></label>
							<input type="text" value="<?php echo esc_attr( $input_value ); ?>" name="<?php echo esc_attr( $value ); ?>" />
						</li>

					<?php } ?>
				</ul>
			</form>
			<input type="hidden" <?php echo $input_props['data']; ?> value="" />

			<?php break;

		case 'multiple-checkbox' : ?>
			<?php $multi_values = ! is_array( $input['value'] ) ? explode( ',', $input['value'] ) : $input['value']; ?>
			<ul>
				<?php foreach ( $input['options'] as $value => $label ) { ?>

					<li>
						<label>
							<input type="checkbox" value="<?php echo esc_attr( $value ); ?>" <?php checked( in_array( $value, $multi_values ) ); ?> />
							<?php echo esc_html( $label ); ?>
						</label>
					</li>

				<?php } ?>
			</ul>

			<input type="hidden" <?php echo $input_props['data']; ?> value="<?php echo esc_attr( implode( ',', $multi_values ) ); ?>" />

			<?php break;

		case 'select' : ?>
			<select size="1" <?php echo implode( ' ', $input_props ); ?>>
				<?php foreach ( $input['options'] as $value => $label ) { ?>
					<option value="<?php echo esc_attr( $value ); ?>" <?php selected( $input['value'], $value, true ); ?>>
						<?php echo esc_html( $label ); ?>
					</option>
				<?php } ?>
			</select>
			<?php break;

		case 'textarea' : ?>
			<textarea <?php echo implode( ' ', $input_props ); ?> <?php if ( isset( $input['rows'] ) ) { echo 'rows="', esc_attr( $input['rows'] ), '"'; } ?>><?php echo esc_textarea( $input['value'] ); ?></textarea>
			<?php break;

		case 'number' : ?>
			<input type="number" <?php echo implode( ' ', $input_props ); ?> value="<?php echo esc_attr( $input['value'] ); ?>"/>
			<?php break;

		case 'text' : ?>
			<input type="text" <?php echo implode( ' ', $input_props ); ?> value="<?php echo esc_attr( $input['value'] ); ?>"/>
			<?php break;

		default : ?>
			<input type="hidden" <?php echo implode( ' ', $input_props ); ?> value="<?php echo esc_attr( $input['value'] ); ?>"/>
		<?php }

}