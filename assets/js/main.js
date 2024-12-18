(function($) {
    // window.onload = function () {
    //     if (!window.location.hash == '#Item1') {
    //         window.location.hash = '#Item1';
    //     }
    // };
    let menu_css = localize_data.menu_css;
    let active_menu_color = menu_css.active_menu_color;
    let active_menu_background = menu_css.active_menu_background;
    let scrollbar_thumb_color = menu_css.scrollbar_thumb_color;
    // let thumb_color = 'red';
    // let scrollbar_color = 'gray';
    let style_scrollbar = `
        .content_sidebar::-webkit-scrollbar {
            width: 4px;
        }
        .content_sidebar::-webkit-scrollbar-thumb {
            background: ${scrollbar_thumb_color}; 
            border-radius: 8px; 
        }
        .content_sidebar::-webkit-scrollbar-track {
           
            border-radius: 4px;
        }
    `;
    // Append the style to the head
    $('head').append(`<style>${style_scrollbar}</style>`);
    $(document).on('click', '.item_h2', function(event) {
        event.preventDefault();
        $('.item_h3').each(function() {
            $(this).closest('p').hide();
        });
        $(this).closest('div').find('.h3_css').remove();
        let data_id = $(this).data('id');
        let h2_div = $(this).closest('div');
        console.log(data_id);
        // let target_offset = $("#"+data_id);
        let target_offset = $('#'+data_id).offset();
        console.log(target_offset);
        var target_top = target_offset.top;
        console.log(target_top);
        $('.entry-content').animate({scrollTop: target_top}, 800,function(){
            window.location.href = '#'+ data_id
        });
        
        // Smooth scrolling animation
        $('.items_sub_menu p').hide();
        $('.item_h3').each(function() {
            let h3_data_id = $(this).data('id');
            if (h3_data_id.includes(data_id)) {
                let target_p = $(this).closest('p');
                target_p.show(); 
                var cloning = target_p.clone().hide();
                cloning.addClass('h3_css');
                h2_div.append(cloning)
                cloning.slideDown(400)
                target_p.hide(); 
            }
        });
    });
    $(document).on('click', '.item_h3', function() {
        let data_id = $(this).data('id');
        window.location.href = '#' + data_id;
    });
    $('.sidebar_item:first').css('background', active_menu_background);
    $('.entry-content').scroll(function () {
        let content_top = $(this).offset().top; 
        $('.item_h2_or_h3').each(function () {
            let item_top = $(this).offset().top; 
            if (item_top - content_top <= 10 && item_top - content_top >= 0) {
                let a_item_id = $(this).attr("id");
                $('.sidebar_item').css('background', '');
                $('.sidebar_item').css('color', '');
                $(`.sidebar_item[data-id="${a_item_id}"]`).css({
                    'background': active_menu_background ,
                    'color' : active_menu_color 
                });
                $('.content_sidebar::-webkit-scrollbar-thumb').css({
                    'background' : 'red'
                })
            }else{
                // $('.sidebar_item').css('background', '');
            }
        });
    });
    let sidebar = $('.sticky'); 
    $(document).on('click','.item_subitem .sidebar_item', function () {
        sidebar.css({
            position: 'relative', 
            top : '85px'
        });
        $('.sidebar_item').css('background', '');
        $(this).css('background','#ffecd1');
    });
    $(window).on('scroll',function(){
        sidebar.css({
            position: 'relative', 
            top : '85px'
        });
    })
})(jQuery);
