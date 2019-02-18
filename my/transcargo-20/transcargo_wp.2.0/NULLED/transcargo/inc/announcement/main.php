<?php

class PearlAnnouncements
{
	public $apiurl = 'https://stylemixthemes.scdn2.secure.raxcdn.com/api/announcement.json';
	public $announcement = array();

	function __construct()
	{
		add_action('wp_dashboard_setup', array($this, 'pearl_dashboard_changelog'));
	}

	function pearl_get_announcement() {
		$this->announcement = json_decode(file_get_contents($this->apiurl), true);
    }

	function pearl_dashboard_changelog() {
		add_meta_box('pearl_dashboard_announcement', 'Announcement by StylemixThemes', array($this, 'stm_dashboard_announcement_screen'), 'dashboard', 'side', 'high');
    }

	function stm_dashboard_announcement_screen()
	{
		$stm_theme = wp_get_theme()->get('Name');
		?>
        <script type="text/javascript">
            var stm_theme = <?php echo json_encode($stm_theme); ?>;
        </script>
        <div id="pearl-announcement">
            <div v-for="announcement in announcements">
                <div v-html="announcement.content"></div>
            </div>
        </div>
	<?php }
}

new PearlAnnouncements();


add_action('admin_enqueue_scripts', 'stm_admin_changelog_scripts');

function stm_admin_changelog_scripts($hook)
{
	if ($hook == 'index.php') {
		$theme_info = time();
		$assets = get_template_directory_uri() . '/inc/announcement/assets/';
		wp_enqueue_style('milligram', $assets . 'custom.css', null, $theme_info, 'all');

		wp_enqueue_script('vue.js', $assets . 'vue.min.js', null, $theme_info, true);
		wp_enqueue_script('vue-resource.js', $assets . 'vue-resource.js', array('vue.js'), $theme_info, true);
		wp_enqueue_script('pearl-vue.js', $assets . 'vue.js', array('vue.js'), $theme_info, true);
	}
}