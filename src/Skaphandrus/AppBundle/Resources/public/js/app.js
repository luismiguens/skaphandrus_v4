/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


$(document).ready(function () {

    $('[data-toggle="tooltip"]').tooltip();

    if ($('#datatable-list').length) {
        $('#datatable-list').DataTable({
            responsive: true
        });
    }

    // Formulário SkPhoto
    if ($('#skaphandrus_appbundle_skphoto_model').length) {
        $('#skaphandrus_appbundle_skphoto_model').autocompleter({url_list: '/en/ajax_search_photo_machine_model/', url_get: '/en/ajax_get_photo_machine_model/'});
    }

    if ($('#skaphandrus_appbundle_skphoto_species').length) {
        $('#skaphandrus_appbundle_skphoto_species').autocompleter({url_list: '/en/ajax_search_species/', url_get: '/en/ajax_get_species/'});
    }

    if ($('#skaphandrus_appbundle_skphoto_spot').length) {
        $('#skaphandrus_appbundle_skphoto_spot').autocompleter({url_list: '/en/ajax_search_spot/', url_get: '/en/ajax_get_spot/'});
    }

    // Formulário Identification Group
    if ($('#skaphandrus_appbundle_skidentificationgroup_genus').length) {
        $('#skaphandrus_appbundle_skidentificationgroup_genus').autocompleter({url_list: '/en/ajax_search_genus/', url_get: '/en/ajax_get_genus/'});
    }

    if ($('#skaphandrus_appbundle_skidentificationgroup_family').length) {
        $('#skaphandrus_appbundle_skidentificationgroup_family').autocompleter({url_list: '/en/ajax_search_family/', url_get: '/en/ajax_get_family/'});
    }

    if ($('#skaphandrus_appbundle_skidentificationgroup_order').length) {
        $('#skaphandrus_appbundle_skidentificationgroup_order').autocompleter({url_list: '/en/ajax_search_order/', url_get: '/en/ajax_get_order/'});
    }

    if ($('#skaphandrus_appbundle_skidentificationgroup_class').length) {
        $('#skaphandrus_appbundle_skidentificationgroup_class').autocompleter({url_list: '/en/ajax_search_class/', url_get: '/en/ajax_get_class/'});
    }

    if ($('#skaphandrus_appbundle_skidentificationgroup_phylum').length) {
        $('#skaphandrus_appbundle_skidentificationgroup_phylum').autocompleter({url_list: '/en/ajax_search_phylum/', url_get: '/en/ajax_get_phylum/'});
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
        $('#skaphandrus_appbundle_skperson_skaphandrusId').autocompleter({url_list: '/en/ajax_search_fosUser/', url_get: '/en/ajax_get_fosUser/'});
    }


    // Formulário FOSMessage new message
    if ($('#message_recipient').length) {
        $('#message_recipient').autocompleter({url_list: '/en/ajax_search_fosUser/', url_get: '/en/ajax_get_fosUser/'});
    }

    // Formulário SkSpot
    if ($('#skaphandrus_appbundle_skspot_location').length) {
        $('#skaphandrus_appbundle_skspot_location').autocompleter({url_list: '/en/ajax_search_location/', url_get: '/en/ajax_get_location/'});
    }

    // Formulário photo validation
    if ($('#skaphandrus_appbundle_skphotovalidation_species').length) {
        $('#skaphandrus_appbundle_skphotovalidation_species').autocompleter({url_list: '/en/ajax_search_species/', url_get: '/en/ajax_get_species/', appendTo: '#validationForm'});
    }
    if ($('#skaphandrus_appbundle_skphotosugestion_species').length) {
        $('#skaphandrus_appbundle_skphotosugestion_species').autocompleter({url_list: '/en/ajax_search_species/', url_get: '/en/ajax_get_species/', appendTo: '#validationForm'});
    }

    // Formulário SkPhotoContestJudge
    if ($('#skaphandrus_appbundle_skphotocontestjudge_fosUser').length) {
        $('#skaphandrus_appbundle_skphotocontestjudge_fosUser').autocompleter({url_list: '/en/ajax_search_fosUser/', url_get: '/en/ajax_get_fosUser/'});
    }

    // Formulário skPhotoContestAward
    if ($('#skaphandrus_appbundle_skphotocontestaward_winnerFosUser').length) {
        $('#skaphandrus_appbundle_skphotocontestaward_winnerFosUser').autocompleter({url_list: '/en/ajax_search_fosUser/', url_get: '/en/ajax_get_fosUser/'});
    }

    // Formulário SkBusiness
    if ($('#skaphandrus_appbundle_skbusiness_address_location').length) {
        $('#skaphandrus_appbundle_skbusiness_address_location').autocompleter({url_list: '/en/ajax_search_location/', url_get: '/en/ajax_get_location/'});
    }

    // Formulário SkProfile
    if ($('#skaphandrus_appbundle_fosuser_address_location').length) {
        $('#skaphandrus_appbundle_fosuser_address_location').autocompleter({url_list: '/en/ajax_search_location/', url_get: '/en/ajax_get_location/'});
    }

    // Formulário SkBusinessDiveSpot
    if ($('#skaphandrus_appbundle_skbusiness_spotAutocomplete').length) {
        $('#skaphandrus_appbundle_skbusiness_spotAutocomplete').autocompleterMultiple({form_name: 'skaphandrus_appbundle_skbusiness', field_name: 'spotChoices', url_list: '/en/ajax_search_spot/', url_get: '/en/ajax_get_spot/'});
    }

    // Formulário SkBusinessSettingsAdmins
    if ($('#skaphandrus_appbundle_skbusiness_adminAutocomplete').length) {
        $('#skaphandrus_appbundle_skbusiness_adminAutocomplete').autocompleterMultiple({form_name: 'skaphandrus_appbundle_skbusiness', field_name: 'adminChoices', url_list: '/en/ajax_search_fosUser/', url_get: '/en/ajax_get_fosUser/'});
//        $('#skaphandrus_appbundle_skbusiness_adminAutocomplete').attr("Add the users who works and manage your page.");
    }

    // Formulário SkBooking
    if ($('#skaphandrus_appbundle_skbooking_business').length) {
        $('#skaphandrus_appbundle_skbooking_business').autocompleter({url_list: '/en/ajax_search_business/', url_get: '/en/ajax_get_business/'});
    }

    // Formulário SkBooking
    if ($('#skaphandrus_appbundle_skphoto_business').length) {
        $('#skaphandrus_appbundle_skphoto_business').autocompleter({url_list: '/en/ajax_search_business/', url_get: '/en/ajax_get_business/'});
    }

});
