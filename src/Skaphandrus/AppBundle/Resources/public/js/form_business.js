$(document).ready(function(){
 
  
    var lat = 0;
    var lng = 0;
    var zoom = 3;
    var coordenada = $('#skaphandrus_appbundle_skbusiness_address_coordinate').val();
    
    if(coordenada != 0){
        var coords = coordenada.split(",");
        lat = coords[0];
        lng = coords[1];
        
        if($('#skaphandrus_appbundle_skbusiness_address_zoom').val()!=0 && $('#skaphandrus_appbundle_skbusiness_address_zoom').val()!="" ){
            zoom = $('#skaphandrus_appbundle_skbusiness_address_zoom').val();
        }
    
    }else{
        lat = 35.460669951495305;
        lng = -32.87109375;
    }

  
    map = new GMaps({
        div: '#map',
        zoom: parseInt(zoom),
        lat: lat,
        lng: lng
    });
    
    
    map.addMarker({
        lat: lat,
        lng: lng
    });
    
    GMaps.on('click', map.map, function(event) {
        var lat = event.latLng.lat();
        var lng = event.latLng.lng();

        map.markers[0].setPosition(new google.maps.LatLng(lat, lng));
        
        $('#skaphandrus_appbundle_skbusiness_address_coordinate').val(lat+','+lng);
        $('#skaphandrus_appbundle_skbusiness_address_zoom').val(map.getZoom());
        
    });

//    $('#skaphandrus_appbundle_skspot_location').bind('input', function() {
//        GMaps.geocode({
//            address: $('#skaphandrus_appbundle_skspot_location').val(),
//            callback: function(results, status) {
//                if (status == 'OK') {
//                    var latlng = results[0].geometry.location;
//                    map.setCenter(latlng.lat(), latlng.lng());
//                }
//            }
//        });
//  
//    });
  

});