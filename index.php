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
    wp_enqueue_script('jquery');
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
    echo '<div class="content_sidebar sticky">';
    for($i = 0; $i < $h2_count; $i++ ) {
        $h2 = $h2s->item($i);
        $attributes = $h2->attributes;
        $h2_id = $attributes->getNamedItem('id') ?: "";
        ?> 
        <div class="item_subitem">
        <?php
        if( isset($h2_id->value) ) {
            echo '<p class="item_h2 sidebar_item" data-id="'.$h2_id->value.'">'.$h2->nodeValue.'</p>';
        }
        ?> 
        </div>
        <?php
    }
    ?>
    <?php
    echo '</div>';
    ?>
    <div class="items_sub_menu">
        <?php
        for($j = 0; $j < $h3_count; $j++ ) {
            $h3 = $h3s->item($j);
            $attributes = $h3->attributes;
            $h3_id = $attributes->getNamedItem('id') ?: "";
            if( isset($h3_id->value) ) {
                echo '<p class="item_h3 h3_css sidebar_item" data-id="'.$h3_id->value.'">'.$h3->nodeValue.'</p>';
            }
        }
        ?>
    </div>
    <?php
    echo '</div>';
    ob_start();
    return ob_get_clean();
}
add_shortcode( 'cs_sidebar', 'cs_content_custom_shortcode' );

// php dom
function custom_dom_shortcode($atts, $content = null) {
    $doc = new DOMDocument();
    $figureElement = $doc->createElement("figure");
    $sectionElement1 = $doc->createElement("section");
    $sectionElement2 = $doc->createElement("section");
    $sectionElement3 = $doc->createElement("section");
    $figureElement->appendChild($sectionElement1);
    $figureElement->appendChild($sectionElement2);
    $figureElement->appendChild($sectionElement3);
    $doc->appendChild($figureElement);
    // create attribute 
    // $figure_attribute = $figureElement->createAttribute('class');
    // $figure_attribute->value = 'dom_figure';
    // set text node
    $figureElement->setAttribute('class', 'dom_figure');
    $textNode1 = $doc->createTextNode("This is some content inside the section1.");
    $sectionElement1->appendChild($textNode1);
    $textNode2 = $doc->createTextNode("This is some content inside the section2.");
    $sectionElement2->appendChild($textNode2);
    $textNode3 = $doc->createTextNode("This is some content inside the section3.");
    $sectionElement3->appendChild($textNode3);
    $content_text = $doc->getElementsByTagName('section');
    foreach ($content_text as $c_text) {
        echo $c_text->nodeValue, PHP_EOL;
    }
    $sectionElement2->setAttribute('id','section2');
    // $section2_value = $doc->getElementById('section2')->tagName;
    $section2 = $doc->getElementById('section2');
    if($section2){
        echo $section2->nodeValue . PHP_EOL;
    }
    // $sectionElement2->removeAttribute('id');
    return $doc->saveHTML();
}
add_shortcode('custom_dom', 'custom_dom_shortcode');

