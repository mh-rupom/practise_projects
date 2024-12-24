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
function custom_cart_content() {
    if (function_exists('WC')) {
        ob_start();
        if (WC()->cart->is_empty()) {
            echo '<div id="custom_cart_panel">
                    <h3>Your Cart</h3>
                    <p>Your cart is currently empty.</p>
                </div>';
        } else {
            ?>
            <div id="custom_cart_icon">
                <img src="<?php echo plugin_dir_url( __FILE__ ) . 'assets/images/reshot-icon-shopping-cart-8DYPSUXJBK.svg'; ?>" alt="" />
            </div>
            <div id="custom_cart_panel">
                <span class="close_panel"><img src="<?php echo plugin_dir_url( __FILE__ ) . 'assets/images/close.png'; ?>" alt="" /></span>
                <h3>Your Cart</h3>
                <ul class="cart_items">
                    <?php
                    foreach (WC()->cart->get_cart() as $cart_item_key => $cart_item) {
                        $product = $cart_item['data']; 
                        $product_name = $product->get_name();
                        $product_quantity = $cart_item['quantity'];
                        $product_price = wc_price($product->get_price());
                        $product_permalink = $product->get_permalink();
                        $product_thumbnail = $product->get_image('thumbnail');
                        ?>
                        <li>
                            <div class="cart_item_thumbnail">
                                <a href="<?php echo esc_url($product_permalink); ?>">
                                    <?php echo $product_thumbnail; ?>
                                </a>
                            </div>
                            <div class="cart_item_details">
                                <a href="<?php echo esc_url($product_permalink); ?>" class="cart_item_name">
                                    <?php echo esc_html($product_name); ?>
                                </a>
                                <div class="">
                                    <span class="">Quantity: <?php echo esc_html($product_quantity); ?></span>
                                    <span class="">Price: <?php echo $product_price; ?></span>
                                </div>
                            </div>
                        </li>
                        <?php
                    }
                    ?>
                </ul>
                <div class="cart_total">
                    <strong>Total:</strong> <?php echo WC()->cart->get_cart_total(); ?>
                </div>
                <div class="cart_actions">
                    <a href="<?php echo wc_get_cart_url(); ?>" class="view_cart">View Cart</a>
                    <a href="<?php echo wc_get_checkout_url(); ?>" class="checkout">Checkout</a>
                </div>
            </div>
            <?php
        }
        return ob_get_clean();
    }
}
add_shortcode('cart_content', 'custom_cart_content');

function cs_script_callback(){
    $version = CS_DEBUG ? time() : CS_VERSION ;
    wp_enqueue_style( 'cs_custom_css', CS_URL.'assets/css/style.css' , false ,$version);
    wp_enqueue_script('jquery');
    wp_enqueue_script( 'custom_main_js', CS_URL. 'assets/js/main.js', array('jquery'), $version, true);
    $active_menu_color = get_option('active_menu_color');
    $active_menu_background = get_option('active_menu_background');
    $scrollbar_thumb_color = get_option('scrollbar_thumb_color');
    $menu_css = [
        'active_menu_color' => $active_menu_color,
        'active_menu_background' => $active_menu_background,
        'scrollbar_thumb_color' => $scrollbar_thumb_color,
    ];
    wp_localize_script( 'custom_main_js', 'localize_data', array(
        'ajax_url' => admin_url('admin-ajax.php'),
        'menu_css' => $menu_css,
        'nonce'    => wp_create_nonce('my_nonce'), 
    ));
    
}
add_action('wp_enqueue_scripts','cs_script_callback');