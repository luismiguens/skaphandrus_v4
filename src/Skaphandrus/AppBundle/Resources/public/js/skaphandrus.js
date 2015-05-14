/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


$(document).ready(function () {


    if ($('.dataTables-example').length) {
        $('.dataTables-example').dataTable({
            responsive: true,
            "dom": 'T<"clear">lfrtip'
        });
    }


    $('#skaphandrus_appbundle_skphoto_model').autocompleter({url_list: '/app_dev.php/en/ajax_search_photo_machine_model/', url_get: '/app_dev.php/en/ajax_get_photo_machine_model/'});
    $('#skaphandrus_appbundle_skphoto_species').autocompleter({url_list: '/app_dev.php/en/ajax_search_species/', url_get: '/app_dev.php/en/ajax_get_species/'});
    $('#skaphandrus_appbundle_skphoto_spot').autocompleter({url_list: '/app_dev.php/en/ajax_search_spot/', url_get: '/app_dev.php/en/ajax_get_spot/'});
    

    
});