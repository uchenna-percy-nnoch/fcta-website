<?php
//Register Startup page in admin menu
function iconsult__admin_startup_screen() {
	$theme = iconsult__admin_get_theme_info();
	$theme_name = $theme['name'];
		/*Item Registration*/
		add_menu_page( $theme_name, $theme_name, 'manage_options', 'iconsult-admin' , 'iconsult__admin_page', plugin_dir_url( __FILE__ ) . 'favicon.png',
			'2' );
		/*Support page*/
		add_submenu_page('iconsult-admin', esc_html__('Support', 'iconsult-framework'), esc_html__('Support', 'iconsult-framework'), 'manage_options', 'iconsult-admin-support', 'iconsult__admin_support_page' );
		
		/*Plugins*/
		add_submenu_page( 'iconsult-admin', esc_html__('Plugins', 'iconsult-framework'), esc_html__('Plugins', 'iconsult-framework'), 'manage_options', 'iconsult-admin-plugins', 'iconsult__admin_plugins_page' );

		/*Demo Import*/
		add_submenu_page( 'iconsult-admin', esc_html__('Demo import', 'iconsult-framework'), esc_html__('Demo import', 'iconsult-framework'), 'manage_options', 'iconsult-demo-import', 'iconsult__admin_demo_install_page' );

		/*System status*/
		add_submenu_page( 'iconsult-admin', esc_html__('System status', 'iconsult-framework'), esc_html__('System status', 'iconsult-framework'), 'manage_options', 'iconsult-admin-system-status', 'iconsult__admin_status_page' );

}
add_action( 'admin_menu', 'iconsult__admin_startup_screen' );


function iconsult__admin_page_templates($path) {
	$path = ICONSULTSUPPORT_PLUGIN_DIR.'/admin/screens/' . $path . '.php';
	if($path)  require_once $path;
}

//Startup screen menu page welcome
function iconsult__admin_page() {
	iconsult__admin_page_templates('startup');
}

/*Support Screen*/
function iconsult__admin_support_page() {
	iconsult__admin_page_templates('support');
}

/*Install Plugins*/
function iconsult__admin_plugins_page() {
	iconsult__admin_page_templates('plugins');
}

/*Install Demo*/
function iconsult__admin_demo_install_page() {
	iconsult__admin_page_templates('install_demo');
}

/*System status*/
function iconsult__admin_status_page() {
	iconsult__admin_page_templates('system_status');
}