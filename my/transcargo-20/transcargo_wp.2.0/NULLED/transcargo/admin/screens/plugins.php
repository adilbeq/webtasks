<?php

// Do not allow directly accessing this file.
if ( ! defined( 'ABSPATH' ) ) {
	exit( 'Direct script access denied.' );
} ?>
<div class="wrap about-wrap stm-admin-wrap  stm-admin-plugins-screen">
	<?php stm_get_admin_tabs('plugins'); ?>

	<?php
	$tgm_page_plugins = new TGM_Plugin_Activation();

	$tgm_page_plugins->install_plugins_page();

	?>
</div>
