/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


$(document).ready(function () {
    $('#skaphandrus_appbundle_skphoto_model').autocompleter({url_list: '/photo_model_ajax_search', url_get: '/photo_model_ajax_get/'});
});