<?php
if (isset($_POST['custom_css_save'])) {
    $sidebar_text_color = sanitize_hex_color($_POST['sidebar_text_color']);
    $sidebar_bg_color = sanitize_hex_color($_POST['sidebar_background_color']);
    // $content_title_color = sanitize_hex_color($_POST['content_title_color']);
    // $content_text_color = sanitize_hex_color($_POST['content_color']);
    // $content_bg_color = sanitize_hex_color($_POST['content_background']);
    $active_menu_color = sanitize_hex_color($_POST['active_menu_color']);
    $active_menu_background = sanitize_hex_color($_POST['active_menu_background']);
    $scrollbar_thumb_color = sanitize_hex_color($_POST['scrollbar_thumb_color']);
    
    update_option('custom_sidebar_text_color', $sidebar_text_color);
    update_option('custom_sidebar_bg_color', $sidebar_bg_color);
    update_option('active_menu_color', $active_menu_color);
    update_option('active_menu_background', $active_menu_background);
    update_option('scrollbar_thumb_color', $scrollbar_thumb_color);
    // update_option('custom_content_title_color', $content_title_color);
    // update_option('custom_content_text_color', $content_text_color);
    // update_option('custom_content_bg_color', $content_bg_color);
    echo '<div class="success" style="border: 1px solid gray; border-left: 8px solid blue; padding:12px; border-radius: 2px">Settings saved!</div>';
}
$saved_sidebar_color = get_option('custom_sidebar_text_color'); 
$saved_sidebar_background = get_option('custom_sidebar_bg_color'); 
$saved_menu_color = get_option('active_menu_color'); 
$saved_menu_background = get_option('active_menu_background'); 
$saved_scrollbar_thumb_color = get_option('scrollbar_thumb_color'); 
// $saved_content_title_color = get_option('custom_content_title_color'); 
// $saved_content_color = get_option('custom_content_text_color'); 
// $saved_content_background = get_option('custom_content_bg_color'); 
?>
<div class="wrap">
    <form method="post">
        <!-- <table class="form-table">
            <h1>Content style</h1>
            <tr>
                <th><label for="">Title Color</label></th>
                <td>
                    <input type="color" name="content_title_color" id="content_title_color" value="<?php echo esc_attr($saved_content_title_color); ?>">
                </td>
            </tr>
            <tr>
                <th><label for="">Content Color</label></th>
                <td>
                    <input type="color" name="content_color" id="content_color" value="<?php echo esc_attr($saved_content_color); ?>">
                </td>
            </tr>
            <tr>
                <th><label for="">Content Background</label></th>
                <td>
                    <input type="color" name="content_background" id="content_background" value="<?php echo esc_attr($saved_content_background); ?>">
                </td>
            </tr>
        </table> -->
        <table class="form-table">
            <h1>Sidebar style</h1>
            <tr>
                <th><label for="sidebar_text_color">Color</label></th>
                <td>
                    <input type="color" id="sidebar_text_color" name="sidebar_text_color" value="<?php echo esc_attr($saved_sidebar_color); ?>">
                </td>
            </tr>
            <tr>
                <th><label for="background_color">Background Color</label></th>
                <td>
                    <input type="color" id="sidebar_background_color" name="sidebar_background_color" value="<?php echo esc_attr($saved_sidebar_background); ?>" data-default-color="#ffffff">
                </td>
            </tr>
            <tr>
                <th><label for="">Active Menu color</label></th>
                <td>
                    <input type="color" name="active_menu_color" id="active_menu_color" value="<?php echo esc_attr($saved_menu_color); ?>">
                </td>
            </tr>
            <tr>
                <th><label for="">Active Menu Background</label></th>
                <td>
                    <input type="color" name="active_menu_background" id="active_menu_background" value="<?php echo esc_attr($saved_menu_background); ?>">
                </td>
            </tr>
            <tr>
                <th><label for="">Scrollbar Thumb Color</label></th>
                <td>
                    <input type="color" name="scrollbar_thumb_color" id="scrollbar_thumb_color" value="<?php echo esc_attr($saved_scrollbar_thumb_color); ?>">
                </td>
            </tr>
        </table>

        <input type="submit" value="Save" name="custom_css_save" id="save_setting" class="button button-primary">
    </form>
</div>

<?php