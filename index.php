<?php
/**
 * Plugin Name: Sidebar content  
 * Description: hello
 * Version: 1.0
 * Author: Rupom
 * Text Domain: 
 * 
 */
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}
define('CS_DEBUG',true);
define('CS_VERSION', '1.0.0');
define('CS_PATH', plugin_dir_path(__FILE__));
define('CS_URL',plugin_dir_url(__FILE__));
// include (CS_PATH.'/includes/include.php');

// admin menu
function custom_admin_css_menu() {
    add_menu_page(
        'Site CSS Settings',      
        'Site style',             
        'manage_options',           
        'site-css-settings',      
        'site_css_settings_page', 
        'dashicons-admin-customizer',
        100                         
    );
}
add_action('admin_menu', 'custom_admin_css_menu');
// Display the settings page
function site_css_settings_page() {
    include(CS_PATH.'/templates/admin-menu-temp.php');
}
// Register sidebar shortcode.
function cs_content_custom_shortcode( $atts ) {
    include(CS_PATH.'/templates/shortcode-sidebar.php');
}
add_shortcode( 'cs_sidebar', 'cs_content_custom_shortcode' );

// content style
// function custom_dynamic_content_styles() {
//     $saved_content_title_color = get_option('custom_content_title_color');
//     $saved_content_color = get_option('custom_content_text_color', '#000000');
//     $saved_content_background = get_option('custom_content_bg_color', '#ffffff');
// 
// }
// add_action('wp_head', 'custom_dynamic_content_styles');

function cs_script_callback(){
    $version = CS_DEBUG ? time() : CS_VERSION ;
    wp_enqueue_style( 'cs_custom_css', CS_URL.'assets/css/style.css' , false ,$version);
    wp_enqueue_script('jquery');
    wp_enqueue_script( 'custom_main_js', CS_URL. 'assets/js/main.js', array('jquery'), $version, true);
    $active_menu_color = get_option('active_menu_color');
    $active_menu_background = get_option('active_menu_background');
    $menu_css = [
        'active_menu_color' => $active_menu_color,
        'active_menu_background' => $active_menu_background,
    ];
    wp_localize_script( 'custom_main_js', 'localize_data', array(
        'ajax_url' => admin_url('admin-ajax.php'),
        'menu_css' => $menu_css,
        'nonce'    => wp_create_nonce('my_nonce'), 
    ));
    
}
add_action('wp_enqueue_scripts','cs_script_callback');