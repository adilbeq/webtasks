<?php

// Do not allow directly accessing this file.
if ( ! defined( 'ABSPATH' ) ) {
	exit( 'Direct script access denied.' );
}

$theme = stm_get_theme_info();
$theme_name = $theme['name'];
?>
<div class="wrap about-wrap stm-admin-wrap  stm-admin-support-screen">
	<?php stm_get_admin_tabs('support'); ?>
	<div class="stm-admin-important-notice">

		<p class="about-description"><?php printf(__( '%s comes with 6 months of free support for every license you purchase. Support can be extended through subscriptions via ThemeForest.', 'motors' ), $theme_name); ?></p>
		<p><a href="<?php echo stm_theme_support_url() . 'support/'; ?>" class="button button-large button-primary stm-admin-button stm-admin-large-button" target="_blank" rel="noopener noreferrer"><?php esc_attr_e( 'Create A Support Account', 'motors' ); ?></a></p>
	</div>

	<div class="stm-admin-row">
		<div class="stm-admin-two-third">

			<div class="stm-admin-row">

				<div class="stm-admin-one-half">
					<div class="stm-admin-one-half-inner">
						<h3>
							<span>
								<img src="<?php echo stm_get_admin_images_url('ticket.svg'); ?>" />
							</span>
							<?php _e( 'Ticket System', 'motors' ); ?>
						</h3>
						<p>
							<?php _e( 'We offer excellent support through our advanced ticket system. Make sure to register your purchase first to access our support services and other resources.', 'motors' ); ?>
						</p>
						<a href="<?php echo stm_theme_support_url() . 'support/'; ?>" target="_blank">
							<?php esc_html_e( 'Submit a ticket', 'motors' ); ?>
						</a>
					</div>
				</div>

				<div class="stm-admin-one-half">
					<div class="stm-admin-one-half-inner">
						<h3>
							<span>
								<img src="<?php echo stm_get_admin_images_url('docs.svg'); ?>" />
							</span>
							<?php _e( 'Documentation', 'motors' ); ?>
						</h3>
						<p>
							<?php printf(__( 'Our online documentaiton is a useful resource for learning the every aspect and features of %s.', 'motors' ), $theme_name); ?>
						</p>
						<a href="<?php echo stm_theme_support_url() . 'manuals/transcargo/'; ?>" target="_blank">
							<?php esc_html_e( 'Learn more', 'motors' ); ?>
						</a>
					</div>
				</div>
			</div>

			<div class="stm-admin-row">

				<div class="stm-admin-one-half">
					<div class="stm-admin-one-half-inner">
						<h3>
							<span>
								<img src="<?php echo stm_get_admin_images_url('tutorials.svg'); ?>" />
							</span>
							<?php _e( 'Video Tutorials', 'motors' ); ?>
						</h3>
						<p>
							<?php printf(__( 'We recommend you to watch video tutorials before you start the theme customization. Our video tutorials can teach you the different aspects of using %s.', 'motors' ), $theme_name); ?>
						</p>
						<a href="https://www.youtube.com/watch?v=GyxC5D8nyvU&feature=youtu.be" target="_blank">
							<?php esc_html_e( 'Watch Videos', 'motors' ); ?>
						</a>
					</div>
				</div>

				<div class="stm-admin-one-half">
					<div class="stm-admin-one-half-inner">
						<h3>
							<span>
								<img src="<?php echo stm_get_admin_images_url('forum.svg'); ?>" />
							</span>
							<?php _e( 'Community Forum', 'motors' ); ?>
						</h3>
						<p>
							<?php printf(__( 'Our forum is the best place for user to user interactions. Ask another %s user or share your experience with the community to help others.', 'motors' ), $theme_name); ?>
						</p>
						<a href="<?php echo stm_theme_support_url() . 'forums/'; ?>" target="_blank">
							<?php esc_html_e( 'Visit Our Forum', 'motors' ); ?>
						</a>
					</div>
				</div>

			</div>

		</div>

		<div class="stm-admin-one-third">
			<a href="https://stylemix.net/?utm_source=dashboard&utm_medium=banner&utm_campaign=motorswp" target="_blank">
				<img src="<?php echo stm_get_admin_images_url('banner-1.png'); ?>" />
			</a>
		</div>
	</div>

</div>