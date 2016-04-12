var map;
$(document).ready(function () {

    sliders('.slider_thumbs');
    slider_concurso('.lista_slides_concurso');
    slider_similar('.slider_similar');

    //maps code
    var selector = "map-canvas";
    if ($("#" + selector).length) {
        initialize(selector);
        $.get("map.json", function (dados) {
            $.each(dados.pontos, function (index, dado) {
                codeAddress(dado);
            });
        });
    }
    //end maps code 

//    //listner for spot list view more
//    $("#show_more_spots").click(function () {
//        loader('append', '');
//        $.get('view_more_spots.php', function (data) {
//            killLoader();
//            $('#spots_list').append(data);
//            $('#spots_list .slider_thumbs').slick('unslick');
//            sliders('#spots_list .slider_thumbs');
//
//        });
//    });
//    //listener form species list view more 
//    $("#show_more_species").click(function () {
//        loader('append', '');
//        $.get('view_more_spots.php', function (data) {
//            killLoader();
//            $('#species_list').append(data);
//            sliders('#species_list .slider_thumbs');
//        })
//    });
//
//    //listener form photographers list view more 
//    $("#show_more_photographers").click(function () {
//        loader('append', '');
//        $.get('photographers_scroller.php', function (data) {
//            killLoader();
//            $('#photographers_list').append(data);
//            sliders('#photographers_list .slider_thumbs');
//        })
//    });

    //deal with slider in hidden tabs
    $('#tabs_marine_animals a[data-toggle="tab"]').on('shown.bs.tab', function (e) {
        var id = $(e.target).attr('href');
        $(id + ' .slider_thumbs').slick('unslick');
        sliders(id + ' .slider_thumbs');
    });

    slide_people('.slider_people');

    $('.grid').masonry({
        // set itemSelector so .grid-sizer is not used in layout
        itemSelector: '.grid-item',
        // use element for option
        columnWidth: '.grid-sizer',
        percentPosition: true
    });

//    sliders('.slider_similar');
    sidebar_slide('.latest_model_carrossel');
    sidebar_contest('.side_contest_slider');
    $(".right-sidebar-toggle").click(function () {
        $("body").toggleClass("mini-navbar");
        SmoothlyMenu();
    });
    fechar_ibox_home();
});

/**
 * Inicialize a google maps canvas on #map-canvas
 * @returns {undefined}
 */
function initialize(selector) {
    var mapOptions = {
        center: new google.maps.LatLng(37.738786, -25.664942),
        zoom: 8,
        mapTypeId: google.maps.MapTypeId.ROADMAP,
        styles: [{"featureType": "water", "stylers": [{"saturation": 43}, {"lightness": -11}, {"hue": "#0088ff"}]}, {"featureType": "road", "elementType": "geometry.fill", "stylers": [{"hue": "#ff0000"}, {"saturation": -100}, {"lightness": 99}]}, {"featureType": "road", "elementType": "geometry.stroke", "stylers": [{"color": "#808080"}, {"lightness": 54}]}, {"featureType": "landscape.man_made", "elementType": "geometry.fill", "stylers": [{"color": "#ece2d9"}]}, {"featureType": "poi.park", "elementType": "geometry.fill", "stylers": [{"color": "#ccdca1"}]}, {"featureType": "road", "elementType": "labels.text.fill", "stylers": [{"color": "#767676"}]}, {"featureType": "road", "elementType": "labels.text.stroke", "stylers": [{"color": "#ffffff"}]}, {"featureType": "poi", "stylers": [{"visibility": "off"}]}, {"featureType": "landscape.natural", "elementType": "geometry.fill", "stylers": [{"visibility": "on"}, {"color": "#b8cb93"}]}, {"featureType": "poi.park", "stylers": [{"visibility": "on"}]}, {"featureType": "poi.sports_complex", "stylers": [{"visibility": "on"}]}, {"featureType": "poi.medical", "stylers": [{"visibility": "on"}]}, {"featureType": "poi.business", "stylers": [{"visibility": "simplified"}]}]
    };
    map = new google.maps.Map(document.getElementById(selector),
            mapOptions);
}
/**
 * Inicialize home ibox closed 
 */
function fechar_ibox_home() {
    var ibox = $("#home_box").closest('div.ibox');
    var button = $("#home_box").find('i');
    var content = ibox.find('div.ibox-content');
    content.slideToggle(200);
    button.toggleClass('fa-chevron-up').toggleClass('fa-chevron-down');
    ibox.toggleClass('').toggleClass('border-bottom');
    setTimeout(function () {
        ibox.resize();
        ibox.find('[id^=map-]').resize();
    }, 50);
}
/**
 * add markers to a global map varibale with info window 
 * @param {type} dados
 * @returns {undefined}
 */
function codeAddress(dados) {
    var marker = new google.maps.Marker({
        map: map,
        position: {lat: Number(dados.Lat), lng: Number(dados.Lng)},
        icon: 'pin.png',
        size: (32, 32)
    });

    var infowindow = new google.maps.InfoWindow({
        content: '<a href="' + dados.link + '">' + dados.name + '</a>'
    });
    marker.addListener('click', function () {
        infowindow.open(map, marker);
    });
}

function loader(type, target) {
    loader = '<div class="sk-spinner sk-spinner-wave" id="temp_spinner"><div class="sk-rect1"></div><div class="sk-rect2"></div><div class="sk-rect3"></div><div class="sk-rect4"></div> <div class="sk-rect5"></div></div>';
    switch (type) {
        case 'append' :
            $(target).append(loader);
            break;
        case 'html' :
            $(target).html(loader);
            break;
        default :
            $(target).html(loader);
            break;
    }
}
function killLoader() {
    $("#temp_spinner").remove();
}

function sliders(selector) {
   
    
//if( $( selector ).length){
//    $(selector).slick('unslick');
//}


    $(selector).slick({
        infinite: false,
        slidesToShow: 6,
        slidesToScroll: 4,
        centerMode: false,
        responsive: [
            {
                breakpoint: 1024,
                settings: {
                    slidesToShow: 5,
                    slidesToScroll: 5,
                    infinite: false,
                    dots: true
                }
            },
            {
                breakpoint: 480,
                settings: {
                    slidesToShow: 3,
                    slidesToScroll: 1
                }
            }
        ]
    });

    $(selector).on('afterChange', function (event, slick, currentSlide) {
        if (slick.currentLeft == 0) {
            var link = $(slick.$nextArrow[0].parentElement).attr('data');
            if (typeof link !== 'undefined') {
                $(slick.$nextArrow[0]).removeClass('slick-disabled');
                $(slick.$nextArrow[0]).click(function () {
                    window.location = link;
                });
            }
        }
    });

}

function slider_similar(selector) {

    $(selector).slick({
        infinite: true,
        slidesToShow: 5,
        slidesToScroll: 1,
        autoplay: true,
        autoplaySpeed: 2000,
        responsive: [
            {
                breakpoint: 1024,
                settings: {
                    slidesToShow: 5,
                    slidesToScroll: 5,
                    infinite: true,
                    autoplay: true,
                    autoplaySpeed: 2000,
                    dots: true
                }
            },
            {
                breakpoint: 480,
                settings: {
                    slidesToShow: 3,
                    autoplay: true,
                    autoplaySpeed: 2000,
                    slidesToScroll: 1
                }
            }
        ]
    });

}


function slider_concurso(selector) {
    $(selector).slick({
        infinite: false,
        slidesToShow: 3,
        slidesToScroll: 1,
        centerMode: true,
        centerPadding: '60px',
        autoplay: true,
        autoplayspeed: 1000,
        responsive: [
            {
                breakpoint: 1024,
                settings: {
                    slidesToShow: 3,
                    slidesToScroll: 3,
                    infinite: true,
                    dots: true
                }
            },
            {
                breakpoint: 600,
                settings: {
                    slidesToShow: 2,
                    slidesToScroll: 2
                }
            },
            {
                breakpoint: 480,
                settings: {
                    slidesToShow: 1,
                    slidesToScroll: 1
                }
            }
        ]
    });
    $(selector).slick('slickGoTo', 2);
}

function slide_people(selector) {
    $(selector).slick({
        infinite: true,
        slidesToShow: 11,
        slidesToScroll: 11,
        centerMode: false,
        responsive: [
            {
                breakpoint: 980,
                settings: {
                    slidesToShow: 20,
                    slidesToScroll: 20
                }
            },
            {
                breakpoint: 769,
                settings: {
                    slidesToShow: 15,
                    slidesToScroll: 15
                }
            },
            {
                breakpoint: 361,
                settings: {
                    slidesToShow: 7,
                    slidesToScroll: 7
                }
            }
        ]
    });
}

function sidebar_slide(selector) {
    $(selector).slick({
        infinite: false,
        slidesToShow: 1,
        slidesToScroll: 1,
        centerMode: false
    });
}
function sidebar_contest(selector) {
    $(selector).slick({
        infinite: false,
        slidesToShow: 3,
        slidesToScroll: 1,
        centerMode: false
    });
}