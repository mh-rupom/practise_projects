(function($) {
    let menu_css = localize_data.menu_css;
    let active_menu_color = menu_css.active_menu_color;
    let active_menu_background = menu_css.active_menu_background;
    let scrollbar_thumb_color = menu_css.scrollbar_thumb_color;
    let style_scrollbar = `
        .cs_sidebar::-webkit-scrollbar {
            width: 4px;
        }
        .cs_sidebar::-webkit-scrollbar-thumb {
            background: ${scrollbar_thumb_color}; 
            border-radius: 8px; 
        }
        .cs_sidebar::-webkit-scrollbar-track {
            border-radius: 4px;
        }
    `;
    $('head').append(`<style>${style_scrollbar}</style>`);
    // $(document).ready(function() {
    //     let item_h2 = $('.item_h2');
    //     $('.item_h2').each(function(){
    //         let h2_div = $(this).closest('div');
    //         let data_id = $(this).data('id');
    //         if (data_id) {
    //             $('.item_h3').each(function() {
    //                 let h3_data_id = $(this).data('id');
    //                 if (h3_data_id.includes(data_id)) {
    //                     let target_p = $(this).closest('p');
    //                     target_p.show();
    //                     var cloning = target_p.clone();
    //                     cloning.addClass('h3_css');
    //                     h2_div.append(cloning);
    //                     target_p.hide();
    //                 }
    //             });
    //         }
    //     })
        
    // });
    $(document).on('click', '.item_h2', function(event) {
        event.preventDefault();
        let data_id = $(this).data('id');
        window.history.pushState(null, null, `#${data_id}`);
        let target_element = $('#'+data_id);
        if (target_element.length) {
            let target_offset = target_element.offset().top; 
            $('html, body').animate({ scrollTop: target_offset - 35 }, 800, function () {
                console.log('Animation completed'); 
            });
        }
    });
    $(document).on('click', '.item_h3', function (event) {
        event.preventDefault();
        let data_id = $(this).data('id'); 
        window.history.pushState(null, null, `#${data_id}`);
        let target_element = $('#' + data_id);
        if (target_element.length) {
            let target_offset = target_element.offset().top; 
            $('html, body').animate({ scrollTop: target_offset - 35 }, 800, function () {
                console.log('Animation completed'); 
            });
        }
    });
    console.log(active_menu_background);
    
    $('.sidebar_item:first').css({'background': active_menu_background,'color': active_menu_color});
    $(window).scroll(function () {
        $('.item_h2_or_h3').each(function () {
            let item_top = $(this).offset().top; 
            let scroll_position = $(window).scrollTop(); 
            if (item_top - scroll_position <= 40 && item_top - scroll_position >= 0) {
                let a_item_id = $(this).attr("id");
                $('.sidebar_item').css('background', '');
                $('.sidebar_item').css('color', '');
                $(`.sidebar_item[data-id="${a_item_id}"]`).css({
                    'background': active_menu_background,
                    'color': active_menu_color,
                });
            }
        });
       
    });
    
    $(document).on('click','.cs_cart_div',function(){
        // alert('cart')
    })
    let cart_icon = $('#custom_cart_icon');
    let cart_panel = $('#custom_cart_panel');
    let close_panel = cart_panel.find('.close_panel');
    cart_icon.on('click', function () {
        cart_panel.toggleClass('show');
    });
    close_panel.on('click', function () {
        cart_panel.removeClass('show');
    });
    
})(jQuery);
