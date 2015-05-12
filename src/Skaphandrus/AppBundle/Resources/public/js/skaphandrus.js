/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


$(document).ready(function () {
    
    $('.dataTables-example').dataTable({
                responsive: true,
                "dom": 'T<"clear">lfrtip'
            });
    
    
    $('#skaphandrus_appbundle_skphoto_model').autocompleter({url_list: '/app_dev.php/en/ajax_search_photo_machine_model/', url_get: '/ajax_search_photo_machine_model_get/'});
    $('#skaphandrus_appbundle_skphoto_species').autocompleter({url_list: '/app_dev.php/en/ajax_search_species/', url_get: '/ajax_search_species_get/'});
    $('#skaphandrus_appbundle_skphoto_spot').autocompleter({url_list: '/app_dev.php/en/ajax_search_spot/', url_get: '/ajax_search_spot_get/'});
});