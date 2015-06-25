/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


$(document).ready(function () {


    if ($('#datatable-list').length) {
        $('#datatable-list').DataTable({
            responsive: true
        });
    }

    // Formulário SkPhoto
    if ($('#skaphandrus_appbundle_skphoto_model').length) {
        $('#skaphandrus_appbundle_skphoto_model').autocompleter({url_list: '/app_dev.php/en/ajax_search_photo_machine_model/', url_get: '/app_dev.php/en/ajax_get_photo_machine_model/'});
    }

    if ($('#skaphandrus_appbundle_skphoto_species').length) {
        $('#skaphandrus_appbundle_skphoto_species').autocompleter({url_list: '/app_dev.php/en/ajax_search_species/', url_get: '/app_dev.php/en/ajax_get_species/'});
    }

    if ($('#skaphandrus_appbundle_skphoto_spot').length) {
        $('#skaphandrus_appbundle_skphoto_spot').autocompleter({url_list: '/app_dev.php/en/ajax_search_spot/', url_get: '/app_dev.php/en/ajax_get_spot/'});
    }

    // Formulário Identification Group
    if ($('#skaphandrus_appbundle_skidentificationgroup_genus').length) {
        $('#skaphandrus_appbundle_skidentificationgroup_genus').autocompleter({url_list: '/app_dev.php/en/ajax_search_genus/', url_get: '/app_dev.php/en/ajax_get_genus/'});
    }

    if ($('#skaphandrus_appbundle_skidentificationgroup_family').length) {
        $('#skaphandrus_appbundle_skidentificationgroup_family').autocompleter({url_list: '/app_dev.php/en/ajax_search_family/', url_get: '/app_dev.php/en/ajax_get_family/'});
    }

    if ($('#skaphandrus_appbundle_skidentificationgroup_order').length) {
        $('#skaphandrus_appbundle_skidentificationgroup_order').autocompleter({url_list: '/app_dev.php/en/ajax_search_order/', url_get: '/app_dev.php/en/ajax_get_order/'});
    }

    if ($('#skaphandrus_appbundle_skidentificationgroup_class').length) {
        $('#skaphandrus_appbundle_skidentificationgroup_class').autocompleter({url_list: '/app_dev.php/en/ajax_search_class/', url_get: '/app_dev.php/en/ajax_get_class/'});
    }

    if ($('#skaphandrus_appbundle_skidentificationgroup_phylum').length) {
        $('#skaphandrus_appbundle_skidentificationgroup_phylum').autocompleter({url_list: '/app_dev.php/en/ajax_search_phylum/', url_get: '/app_dev.php/en/ajax_get_phylum/'});
    }

    // Filtro Identification Species Index
    $('#form_module_filter_form_id').change(function () {
        // var id = $(this).val(); // get selected value
        // if (id) { // require a URL
        //     window.location = '/identification_species_admin/' + id; // redirect
        // }
        // return false;
        $(this).parent('form').submit();
    });


    // Formulário skPerson
    if ($('#skaphandrus_appbundle_skperson_skaphandrusId').length) {
        $('#skaphandrus_appbundle_skperson_skaphandrusId').autocompleter({url_list: '/app_dev.php/en/ajax_search_fosUser/', url_get: '/app_dev.php/en/ajax_get_fosUser/'});
    }

    // Formulário SkSpot
    if ($('#skaphandrus_appbundle_skspot_location').length) {
        $('#skaphandrus_appbundle_skspot_location').autocompleter({url_list: '/app_dev.php/en/ajax_search_location/', url_get: '/app_dev.php/en/ajax_get_location/'});
    }




});
