(function($) {
    $(document).on('click', '.item_h2', function() {
        $('.item_h3').each(function() {
            $(this).closest('p').hide();
        })
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
