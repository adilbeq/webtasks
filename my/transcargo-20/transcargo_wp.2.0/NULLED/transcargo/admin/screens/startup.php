<?php

// Do not allow directly accessing this file.
if (!defined('ABSPATH')) {
    exit('Direct script access denied.');
}

$theme = stm_get_theme_info();
$theme_name = $theme['name'];

$token = stm_get_token();
$check_token = stm_check_token();

$message = '';

if ($check_token) {
    $icon = 'dashicons dashicons-yes';
} else {
    $icon = 'dashicons dashicons-no';

    $message = esc_html__('Please make sure you have purchased this theme with the account you registered current token', 'motors');
}

if (empty($token)) {
    $icon = 'dashicons dashicons-post-status';
    $message = '';
}

$envato_market = Envato_Market::instance();
$envato_market->items()->set_themes(true);
$themes = $envato_market->items()->themes('purchased');
?>

<div class="wrap about-wrap stm-admin-wrap stm-admin-start-screen">

    <?php stm_get_admin_tabs(); ?>

    <?php if (!$check_token) { ?>
		<div class="stm-notice">
			<p class="about-description">
				<?php printf(esc_html__('Thank you for choosing %s! Please register it to enable the %1$s demos and theme auto updates. The instructions below must be followed exactly.', 'motors'), $theme_name); ?>
			</p>
		</div>
	<?php }?>

    <div class="two-col panel">
        <?php
        if (!empty($themes) and !empty($token)) {
            envato_market_themes_column('active');
        }
        ?>
    </div>

    <form id="stm_item_registration" method="post" action="">
        <?php settings_fields('stm_registration'); ?>
        <div class="stm_item_registration_input">
            <span class="<?php echo $icon; ?>"></span>
            <input type="text" name="stm_registration[token]" value="<?php echo esc_attr($token); ?>"/>
        </div>
        <?php submit_button(esc_attr__('Submit', 'motors'), array('primary', 'large', 'stm-admin-button', 'stm-admin-large-button')); ?>
    </form>

    <?php if (!empty($message)): ?>
        <div class="stm-admin-message"><?php echo $message; ?></div>
    <?php endif; ?>

    <?php if (!$check_token) { ?>
		<h3><?php _e('Instructions For Generating A Token', 'motors'); ?></h3>
		<ol>
			<li><?php printf(__('Click on this <a href="%s" target="_blank">Generate A Personal Token</a> link. <strong>IMPORTANT:</strong> You must be logged into the same Themeforest account that purchased %s. If you are logged in already, look in the top menu bar to ensure it is the right account. If you are not logged in, you will be directed to login then directed back to the Create A Token Page.', 'motors'), 'https://build.envato.com/create-token/?purchase:download=t&purchase:verify=t&purchase:list=t', $theme_name); ?></li>
			<li><?php _e('Enter a name for your token, then check the boxes for <strong>View Your Envato Account Username, Download Your Purchased Items, Verify Purchases You\'ve Made</strong> and <strong>List Purchases You\'ve Made</strong> from the permissions needed section. Check the box to agree to the terms and conditions, then click the <strong>Create Token button</strong>', 'motors'); ?></li>
			<li><?php _e('A new page will load with a token number in a box. Copy the token number then come back to this registration page and paste it into the field below and click the <strong>Submit</strong> button.', 'motors'); ?></li>
			<li><?php _e('You will see a green check mark for success, or a failure message if something went wrong. If it failed, please make sure you followed the steps above correctly.', 'motors'); ?></li>
		</ol>
	<?php }?>

</div>