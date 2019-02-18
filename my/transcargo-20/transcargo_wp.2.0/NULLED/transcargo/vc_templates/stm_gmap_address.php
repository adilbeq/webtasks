<?php
$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );

?>

<div class="item" data-lat="<?php echo esc_attr( $lat ); ?>" data-lng="<?php echo esc_attr( $lng ); ?>" data-title="<?php echo esc_attr( $title ); ?>">
	<?php if( ! empty( $title ) ): ?>
		<div class="title"><?php echo esc_html( $title ); ?></div>
	<?php endif; ?>
	<ul>
		<?php if( ! empty( $address ) ): ?>
			<li>
				<div class="icon">
					<i class="stm-location-2"></i>
				</div>
				<div class="text">
					<p><?php echo wp_kses( $address, array( 'br' => array() ) ); ?></p>
				</div>
			</li>
		<?php endif; ?>
		<?php if( ! empty( $phone ) ): ?>
			<li>
				<div class="icon">
					<i class="stm-iphone"></i>
				</div>
				<div class="text">
					<p><?php echo esc_html( $phone ); ?></p>
				</div>
			</li>
		<?php endif; ?>
		<?php if( ! empty( $email ) ): ?>
			<li>
				<div class="icon">
					<i class="stm-email"></i>
				</div>
				<div class="text">
					<a href="mailto:<?php echo antispambot( $email ); ?>"><?php echo antispambot( $email ); ?></a>
				</div>
			</li>
		<?php endif; ?>
	</ul>
</div>