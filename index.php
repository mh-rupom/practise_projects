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
function cs_script_callback(){
    $version = CS_DEBUG ? time() : CS_VERSION ;
    wp_enqueue_style( 'cs_custom_css', CS_URL.'assets/css/style.css' , false ,$version);
    wp_enqueue_script( 'custom_main_js', CS_URL. 'assets/js/main.js', array('jquery'), $version, true);
}
add_action('wp_enqueue_scripts','cs_script_callback');
// Register the shortcode.
function cs_content_custom_shortcode( $atts ) {
    if( !is_singular('page') ) return;
    global $post;
    $content = get_the_content(null, null, $post->ID);
    $dom = new DOMDocument();
    $dom->loadHTML($content);
    $h2s = $dom->getElementsByTagName('h2');
    $h3s = $dom->getElementsByTagName('h3');
    $h2_count = $h2s->length;
    $h3_count = $h3s->length;
    echo '<div class="content_sidebar_wrapper">';
    echo '<div class="content_sidebar">';
    for($i = 0; $i < $h2_count; $i++ ) {
        $h2 = $h2s->item($i);
        $attributes = $h2->attributes;
        $h2_id = $attributes->getNamedItem('id') ?: "";
        ?> 
        <div class="item_subitem">
        <?php
        if( isset($h2_id->value) ) {
            echo '<p class="item_h2" data-id="'.$h2_id->value.'">'.$h2->nodeValue.'</p>';
        }
        ?> 
        </div>
        <?php
    }
    ?>
    <div class="items_sub_menu">
        <?php
        for($j = 0; $j < $h3_count; $j++ ) {
            $h3 = $h3s->item($j);
            $attributes = $h3->attributes;
            $h3_id = $attributes->getNamedItem('id') ?: "";
            if( isset($h3_id->value) ) {
                echo '<p class="item_h3 h3_css" data-id="'.$h3_id->value.'">'.$h3->nodeValue.'</p>';
            }
        }
        ?>
    </div>
    <?php
    echo '<div/>';
    echo '<div/>';
    ob_start();
    return ob_get_clean();
}
add_shortcode( 'cs_content', 'cs_content_custom_shortcode' );
