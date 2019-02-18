<?php

class TRANSCARGO_Contacts_Widget extends WP_Widget {

	function __construct() {
		parent::__construct( 'contacts', esc_html__( 'Contacts', 'transcargo' ) );
	}

	public function widget( $args, $instance ) {
		$title = apply_filters( 'widget_title', $instance['title'] );

		echo $args['before_widget'];
		if ( ! empty( $title ) ) {
			echo $args['before_title'] . esc_html( $title ) . $args['after_title'];
		}
		echo '<ul>';
		if ( ! empty( $instance['address'] ) ) {
			echo '<li><div class="icon"><i class="stm-location-2"></i></div><div class="text"><p>' . nl2br( esc_html( $instance['address'] ) ) . '</p></div></li>';
		}

		if ( ! empty( $instance['phone'] ) ) {
			echo '<li><div class="icon"><i class="stm-iphone"></i></div><div class="text"><p>' . nl2br( esc_html( $instance['phone'] ) ) . '</p></div></li>';
		}

		if ( ! empty( $instance['fax'] ) ) {
			echo '<li><div class="icon"><i class="stm-fax"></i></div><div class="text"><p>' . nl2br( esc_html( $instance['fax'] ) ) . '</p></div></li>';
		}

		if ( ! empty( $instance['email'] ) ) {
			echo '<li><div class="icon"><i class="stm-email"></i></div><div class="text"><p><a href="mailto:' . antispambot( $instance['email'] ) . '">' . antispambot( $instance['email'] ) . '</a></p></div></li>';
		}

		if ( ! empty( $instance['hours'] ) ) {
			echo '<li><div class="icon"><i class="stm-clock"></i></div><div class="text"><p>' . nl2br( esc_html( $instance['hours'] ) ) . '</p></div></li>';
		}

		echo '</ul>';


		echo $args['after_widget'];
	}

	public function form( $instance ) {

		$title   = '';
		$address = '';
		$phone   = '';
		$fax   = '';
		$hours     = '';
		$email   = '';

		if ( isset( $instance['title'] ) ) {
			$title = $instance['title'];
		} else {
			$title = esc_html__( 'Contact', 'transcargo' );
		}

		if ( isset( $instance['address'] ) ) {
			$address = $instance['address'];
		}

		if ( isset( $instance['email'] ) ) {
			$email = $instance['email'];
		}

		if ( isset( $instance['phone'] ) ) {
			$phone = $instance['phone'];
		}

		if ( isset( $instance['fax'] ) ) {
			$fax = $instance['fax'];
		}

		if ( isset( $instance['hours'] ) ) {
			$hours = $instance['hours'];
		}

		?>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php esc_html_e( 'Title:', 'transcargo' ); ?></label>
			<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>">
		</p>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'address' ) ); ?>"><?php esc_html_e( 'Address:', 'transcargo' ); ?></label>
			<textarea class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'address' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'address' ) ); ?>"><?php echo esc_textarea( $address ); ?></textarea>
		</p>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'phone' ) ); ?>"><?php esc_html_e( 'Phone:', 'transcargo' ); ?></label>
			<textarea class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'phone' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'phone' ) ); ?>"><?php echo esc_textarea( $phone ); ?></textarea>
		</p>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'fax' ) ); ?>"><?php esc_html_e( 'Fax:', 'transcargo' ); ?></label>
			<textarea class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'fax' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'fax' ) ); ?>"><?php echo esc_textarea( $fax ); ?></textarea>
		</p>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'email' ) ); ?>"><?php esc_html_e( 'E-mail:', 'transcargo' ); ?></label>
			<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'email' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'email' ) ); ?>" value="<?php echo sanitize_email( $email ); ?>">
		</p>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'hours' ) ); ?>"><?php esc_html_e( 'Hours:', 'transcargo' ); ?></label>
			<textarea class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'hours' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'hours' ) ); ?>"><?php echo esc_textarea( $hours ); ?></textarea>
		</p>
		<?php
	}

	public function update( $new_instance, $old_instance ) {
		$instance            = array();
		$instance['title']   = ( ! empty( $new_instance['title'] ) ) ? sanitize_text_field( $new_instance['title'] ) : '';
		$instance['address'] = ( ! empty( $new_instance['address'] ) ) ? implode( "\n", array_map( 'sanitize_text_field', explode( "\n", $new_instance['address'] ) ) ) : '';
		$instance['phone']   = ( ! empty( $new_instance['phone'] ) ) ? implode( "\n", array_map( 'sanitize_text_field', explode( "\n", $new_instance['phone'] ) ) ) : '';
		$instance['fax']   = ( ! empty( $new_instance['fax'] ) ) ? implode( "\n", array_map( 'sanitize_text_field', explode( "\n", $new_instance['fax'] ) ) ) : '';
		$instance['email']   = ( ! empty( $new_instance['email'] ) ) ? sanitize_email( $new_instance['email'] ) : '';
		$instance['hours']     = ( ! empty( $new_instance['hours'] ) ) ? implode( "\n", array_map( 'sanitize_text_field', explode( "\n", $new_instance['hours'] ) ) ) : '';

		return $instance;
	}

}

function register_contacts_widget() {
	register_widget( 'TRANSCARGO_Contacts_Widget' );
}

add_action( 'widgets_init', 'register_contacts_widget' );