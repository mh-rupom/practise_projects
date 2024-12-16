(function($) {
    $(document).on('click', '.item_h2', function() {
        $('.item_h3').each(function() {
            $(this).closest('p').hide();
        });
        $(this).closest('div').find('.h3_css').remove();
        let data_id = $(this).data('id');
        let h2_div = $(this).closest('div');
        window.location.href = '#' + data_id;
        $('.items_sub_menu p').hide();
        $('.item_h3').each(function() {
            let h3_data_id = $(this).data('id');
            if (h3_data_id.includes(data_id)) {
                let target_p = $(this).closest('p');
                target_p.show(); 
                let cloning = target_p.clone();
                cloning.addClass('h3_css');
                h2_div.append(cloning); 
                target_p.hide(); 
            }
        });
    });
    $(document).on('click', '.item_h3', function() {
        let data_id = $(this).data('id');
        window.location.href = '#' + data_id;
    });
    $('.sidebar_item:first').css('background', '#ffecd1');
    $('.entry-content').scroll(function () {
        let content_top = $(this).offset().top; 
        $('.item_h2_or_h3').each(function () {
            let item_top = $(this).offset().top; 
            if (item_top - content_top <= 10 && item_top - content_top >= 0) {
                let a_item_id = $(this).attr("id");
                $('.sidebar_item').css('background', '');
                $(`.sidebar_item[data-id="${a_item_id}"]`).css('background', '#ffecd1');
            }else{
                // $('.sidebar_item').css('background', '');
            }
        });
        $('.content_sidebar ').css({'position':'sticky','top': '10px' })
    });

    // $(document).ready(function () {
    //     let sidebar = $('.sticky'); 
    //     let offset = sidebar.offset().top; 
    //     $(window).on('scroll', function () {
    //         let scrollTop = $(window).scrollTop();
    //         if (scrollTop > offset ) {
    //             sidebar.css({
    //                 position: 'fixed', 
    //             });
    //         } else {
    //             sidebar.css({
    //                 position: 'relative',
    //                 top: 'auto'
    //             });
    //         }
    //     });
    // });
    // $(document).ready(function () {
    //     $('.entry-content').animate({
    //         scrollTop: 200
    //     }, 500); 
    // });

    // $('.entry-content').scroll(function () {
    //     let content_top = $(this).scrollTop(); 
    //     let content_offset = $(this).offset().top;

    //     $('.item_h2_or_h3').each(function () {
    //         let item_top = $(this).offset().top - content_offset + content_top;
    //         let a_item_id = $(this).attr("id");
    //         if (item_top - content_top <= 10 && item_top - content_top >= 0) {
    //             $('.sidebar_item').css('background', ''); 
    //             $(`.sidebar_item[data-id="${a_item_id}"]`).css('background', '#ffecd1'); 
    //         }
    //     });
    // });
    $(document).on('click','.sidebar_item',function(){
        $('.sidebar_item').css('background', '');
        $(this).css('background','#ffecd1');
    })
})(jQuery);






// (function($) {
//     $(document).on('click', '.item_h2', function() {
//         $('.item_h3').each(function() {
//             $(this).closest('p').hide();
//         })
//         $(this).closest('div').find('.h3_css').closest('p').remove();
//         let data_id = $(this).data('id'); 
//         // let currentHash = window.location.href.split('#')[1];
//         // let idsArray = currentHash ? currentHash.split(',') : []; 
//         // if (idsArray.length > 0) {
//         //     window.location.href = '#' + idsArray[0];
//         // }
//         let h2_div = $(this).closest('div');
//         $('.items_sub_menu p').hide();
//         idsArray.push(data_id);
//         idsArray.forEach(function(id) {
//             $('.item_h3').each(function() {
//                 let h3_data_id = $(this).data('id');
//                 if (h3_data_id.includes(id)) {
//                     let target_p = $(this).closest('p');
//                     target_p.show();
//                     let cloning = target_p.clone();
//                     cloning.addClass('h3_css');
//                     h2_div.append(cloning);
//                     target_p.hide();
//                 }
//             });
//         });
//     });

//     $(document).on('click', '.item_h3', function() {
//         let data_id = $(this).data('id');
//         window.location.href = '#' + data_id;
//     });
// })(jQuery);
