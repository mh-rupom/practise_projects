<?php
$sidebar_text_color = get_option('custom_sidebar_text_color');
$sidebar_bg_color = get_option('custom_sidebar_bg_color');
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
echo '<div class="content_sidebar sticky" style="background: '.$sidebar_bg_color.'"> ';
for($i = 0; $i < $h2_count; $i++ ) {
    $h2 = $h2s->item($i);
    $attributes = $h2->attributes;
    $h2_id = $attributes->getNamedItem('id') ?: "";
    ?> 
    <div class="item_subitem">
    <?php
    if( isset($h2_id->value) ) {
        echo '<p class="item_h2 sidebar_item" data-id="'.$h2_id->value.'" style="color:'.$sidebar_text_color.'">'.$h2->nodeValue.'</p>';
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
            echo '<p class="item_h3 h3_css sidebar_item" data-id="'.$h3_id->value.'" style="color:'.$sidebar_text_color.'">'.$h3->nodeValue.'</p>';
        }
    }
    ?>
</div>
<?php
echo '</div>';
ob_start();
return ob_get_clean();