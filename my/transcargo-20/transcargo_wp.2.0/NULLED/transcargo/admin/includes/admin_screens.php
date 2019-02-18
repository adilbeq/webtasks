<?php
//Register scripts and styles for admin pages
function stm_startup_styles()
{
    wp_enqueue_style('stm-startup_css', get_template_directory_uri() . '/assets/admin/css/style.css', null, 1.0, 'all');
}

add_action('admin_enqueue_scripts', 'stm_startup_styles');

//Register Startup page in admin menu
function stm_register_startup_screen()
{
    $theme = stm_get_theme_info();
    $theme_name = $theme['name'];
    $theme_name_sanitized = 'stm-admin';

    // Work around for theme check.
    $stm_admin_menu_page_creation_method = 'add_menu_page';
    $stm_admin_submenu_page_creation_method = 'add_submenu_page';

	if ( !defined('ENVATO_HOSTED_SITE') ) {
		/*Item Registration*/
		$stm_admin_menu_page_creation_method(
			$theme_name,
			$theme_name,
			'manage_options',
			$theme_name_sanitized,
			'stm_theme_admin_page_functions',
			get_template_directory_uri() . '/assets/admin/images/icon.png',
			'2.1111111111'
		);

		/*Support page*/
		$stm_admin_submenu_page_creation_method(
			$theme_name_sanitized,
			esc_html__('Support', 'transcargo'),
			esc_html__('Support', 'transcargo'),
			'manage_options',
			$theme_name_sanitized . '-support',
			'stm_theme_admin_support_page'
		);
		
		/*System status*/
		$stm_admin_submenu_page_creation_method(
			$theme_name_sanitized,
			esc_html__('System status', 'transcargo'),
			esc_html__('System status', 'transcargo'),
			'manage_options',
			$theme_name_sanitized . '-system-status',
			'stm_theme_admin_system_status_page'
		);

		/*Demo Import*/
		$stm_admin_submenu_page_creation_method(
			$theme_name_sanitized,
			esc_html__('Demo import', 'transcargo'),
			esc_html__('Demo import', 'transcargo'),
			'manage_options',
			$theme_name_sanitized . '-demos',
			'stm_theme_admin_install_demo_page'
		);
	} else {
		/*Demo import*/
		$stm_admin_menu_page_creation_method(
			$theme_name,
			$theme_name,
			'manage_options',
			$theme_name_sanitized,
			'stm_theme_admin_install_demo_page',
			get_template_directory_uri() . '/assets/admin/images/icon.png',
			'2.1111111111'
		);
	}

	/*Plugins*/
	$stm_admin_submenu_page_creation_method(
		$theme_name_sanitized,
		esc_html__('Plugins', 'transcargo'),
		esc_html__('Plugins', 'transcargo'),
		'manage_options',
		$theme_name_sanitized . '-plugins',
		'stm_theme_admin_plugins_page'
	);

}

add_action('admin_menu', 'stm_register_startup_screen');

function stm_startup_templates($path)
{
    $path = 'admin/screens/' . $path . '.php';

    $located = locate_template($path);

    if ($located) {
        load_template($located);
    }
}

//Startup screen menu page welcome
function stm_theme_admin_page_functions()
{
    stm_startup_templates('startup');
}

/*Support Screen*/
function stm_theme_admin_support_page()
{
    stm_startup_templates('support');
}

/*Install Plugins*/
function stm_theme_admin_plugins_page()
{
    stm_startup_templates('plugins');
}

/*Install Demo*/
function stm_theme_admin_install_demo_page()
{
    stm_startup_templates('install_demo');
}

/*System status*/
function stm_theme_admin_system_status_page()
{
    stm_startup_templates('system_status');
}

//Admin tabs
function stm_get_admin_tabs($screen = 'welcome')
{
    $theme = stm_get_theme_info();
    $theme_name = $theme['name'];
    $theme_name_sanitized = 'stm-admin';
    if (empty($screen)) {
        $screen = $theme_name_sanitized;
    }
    ?>
    <div class="clearfix">
        <div class="stm_theme_info">
            <div class="stm_theme_version"><?php echo substr($theme['v'], 0, 3); ?></div>
        </div>
        <div class="stm-about-text-wrap">
            <h1><?php printf(esc_html__('Welcome to %s', 'transcargo'), $theme_name); ?></h1>
            <div class="stm-about-text about-text">
                <?php printf(esc_html__('%s is now installed and ready to use! Get ready to build something beautiful. Please register your purchase to get automatic theme updates, import %1$s demos and install premium plugins. Read below for additional information. We hope you enjoy it! %s', 'transcargo'), $theme_name, '<a href="//youtube.com/embed/GyxC5D8nyvU?rel=0?KeepThis=true&TB_iframe=true&autoplay=true" target="_blank" class="thickbox">' . esc_attr__('Watch Our Quick Guided Tour!', 'transcargo') . '</a>'); ?>
            </div>
        </div>
    </div>
    <h2 class="nav-tab-wrapper">
		<?php if ( !defined('ENVATO_HOSTED_SITE') ): ?>
			<a href="<?php echo esc_url_raw(admin_url('admin.php?page=' . $theme_name_sanitized)); ?>" class="<?php echo ('welcome' === $screen) ? 'nav-tab-active' : ''; ?> nav-tab"><?php esc_attr_e('Product Registration', 'transcargo'); ?></a>
			<a href="<?php echo esc_url_raw(admin_url('admin.php?page=' . $theme_name_sanitized . '-support')); ?>" class="<?php echo ('support' === $screen) ? 'nav-tab-active' : ''; ?> nav-tab"><?php esc_attr_e('Support', 'transcargo'); ?></a>
			<a href="<?php echo esc_url_raw(admin_url('admin.php?page=' . $theme_name_sanitized . '-plugins')); ?>" class="<?php echo ('plugins' === $screen) ? 'nav-tab-active' : ''; ?> nav-tab"><?php esc_attr_e('Plugins', 'transcargo'); ?></a>
			<a href="<?php echo esc_url_raw(admin_url('admin.php?page=' . $theme_name_sanitized . '-demos')); ?>" class="<?php echo ('demos' === $screen) ? 'nav-tab-active' : ''; ?> nav-tab"><?php esc_attr_e('Install Demo', 'transcargo'); ?></a>
			<a href="<?php echo esc_url_raw(admin_url('customize.php')); ?>" class="nav-tab"><?php esc_attr_e('Theme Options', 'transcargo'); ?></a>
			<a href="<?php echo esc_url_raw(admin_url('admin.php?page=' . $theme_name_sanitized . '-system-status')); ?>" class="<?php echo ('system-status' === $screen) ? 'nav-tab-active' : ''; ?> nav-tab"><?php esc_attr_e('System Status', 'transcargo'); ?></a>
		<?php else: ?>
			<a href="<?php echo ( 'demos' === $screen ) ? '#' : esc_url_raw( admin_url( 'admin.php?page=' . $theme_name_sanitized ) ); ?>" class="<?php echo ( 'demos' === $screen ) ? 'nav-tab-active' : ''; ?> nav-tab"><?php esc_attr_e( 'Install Demo', 'transcargo' ); ?></a>
			<a href="<?php echo ( 'plugins' === $screen ) ? '#' : esc_url_raw( admin_url( 'admin.php?page=' . $theme_name_sanitized . '-plugins' ) ); ?>" class="<?php echo ( 'plugins' === $screen ) ? 'nav-tab-active' : ''; ?> nav-tab"><?php esc_attr_e( 'Plugins', 'transcargo' ); ?></a>
			<a href="<?php echo esc_url_raw(admin_url('customize.php')); ?>" class="nav-tab"><?php esc_attr_e('Theme Options', 'transcargo'); ?></a>
		<?php endif; ?>
	</h2>
    <?php
}