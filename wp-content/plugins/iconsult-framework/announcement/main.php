<?php
class iconsult__aAnnouncements
{
	public $announcement = array();

	function __construct()
	{
		add_action('wp_dashboard_setup', array($this, 'iconsult__dashboard_changelog'));
	}

	function iconsult__dashboard_changelog() {
		add_meta_box('iconsult__dashboard_announcement', 'WpSmartApps News', array($this, 'iconsult__dashboard_announcement_screen'), 'dashboard', 'side', 'high');
    }

	function iconsult__dashboard_announcement_screen()
	{
		$stm_theme = wp_get_theme()->get('Name');
		?>
        <script type="text/javascript">
            var stm_theme = <?php echo json_encode($stm_theme); ?>;
        </script>
        <div id="theme-dashboard-announcement"> 
            <div v-for="announcement in announcements">  
                <div v-html="announcement.content"></div>
            </div>
        </div>
	<?php }
}

new iconsult__aAnnouncements();

add_action('admin_enqueue_scripts', 'iconsult__admin_announcment_scripts');
function iconsult__admin_announcment_scripts($hook)
{
	if ($hook == 'index.php') {
		$theme_info = time();
		wp_enqueue_script('vue.js', plugin_dir_url( __FILE__ ) . 'assets/vue.min.js', null, $theme_info, true);
		wp_enqueue_script('vue-resource.js', plugin_dir_url( __FILE__ ) . 'assets/vue-resource.js', array('vue.js'), $theme_info, true);
		wp_enqueue_script('vue-main.js', plugin_dir_url( __FILE__ ) . 'assets/main.js', array('vue.js'), $theme_info, true);
	}
}