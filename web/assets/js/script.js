/**
 * File script.js
 *
 * @required jQuery
 * @ver 1.0
 --------------------------------------------------------------
>>> TABLE OF CONTENTS:
1.0 NAVIGATION
2.0 POP UP PROMO
3.0 OWL SLIDERS
4.0 
--------------------------------------------------------------*/

var baseUrl = 'http://' + window.location.host;
var ajaxFileUrl = baseUrl + '/inc/ajax.php';
var pageActual = $('.wrapper-site').attr('data-page-actual');


//se pasa con numeral #page
function scrollToID ( id ) {
    $('html, body').stop().animate({
        scrollTop: $(id).offset().top -90
    }, 'slow');
}

/*--------------------------------------------------------------
1.0 NAVIGATION
--------------------------------------------------------------*/

$(document).ready(function(){
    console.log('all ready')

    //scroll top
    $('.go-up').click(function(){
        $("html, body").animate({
            scrollTop: 0
        }, "slow");
    });
    $('.brand-name').click(function( e ){
        if ( pageActual == 'inicio' ) {
            e.preventDefault();
            $("html, body").animate({
                scrollTop: 0
            }, "slow");
        }
    });
    $('.go-up-link').click(function( e ){
        if ( pageActual == 'inicio' ) {
            e.preventDefault();
            $("html, body").animate({
                scrollTop: 0
            }, "slow");
        }
    });

    //toggle
    $(document).on('click', '.toggle', function(){
        var menu = $('.top-menu');

        if ( menu.css('height') == '0px' ) {
            
            var h = menu.prop('scrollHeight');
            
            menu.animate({
                'height': h,
            }, 2000);
        } else {
            menu.animate({
                'height': '0px',
            }, 500);
        }
    });//.click toggle

    //close menu
    $(document).on('click', '.close-menu', function(){
        var menu = $('.top-menu');

        menu.animate({
            'height': '0px',
        }, 500);
    });//.click toggle


    //links scroll
    /*scroll down on link animation*/
    $('.scroll-down-link').on('click', function ( event ) {
        if ( pageActual == 'inicio' ) {
            event.preventDefault();
            var url = '#' + $(this).attr('data-href');
            
            $('html, body').stop().animate({
                scrollTop: $(url).offset().top - 90
            }, 'slow');
        }

        if (window.innerWidth < 992) {
            $('.top-menu').animate({
                'height': '0px',
            }, 500);
        }
    });

});//.ready()

/*--------------------------------------------------------------
3.0 POPUP PROMO
--------------------------------------------------------------*/

$(window).on('load', function(){

    var popup = $( '.popup' );
    var popupIMG = $( '.popup img' );
    var tiempo = 7000;
    if ( popup.length != 0 ) {
        var closeX = $( '.close-popup' );
        var closeBTN = $( '.cerrar-popup' );
        
        function openPop () {
            popup.addClass('popup-active');
            popupIMG.fadeIn();
        }
        
        setTimeout( openPop, tiempo);
        
        function closePopup() {
            popup.removeClass('popup-active');
            popupIMG.fadeOut(tiempo);
        }

        closeX.click(closePopup);
        closeBTN.click(closePopup);

    }
});


$( window ).on('load', function(){

    console.log('all loaded')

    /*var $animation_elements = $('.animation-element');
    var $window = $(window);

    function check_if_in_view() {
      var window_height = $window.height();
      var window_top_position = $window.scrollTop();
      var window_bottom_position = (window_top_position + window_height);

      $.each($animation_elements, function() {
        var $element = $(this);
        var element_height = $element.outerHeight();
        var element_top_position = $element.offset().top;
        var element_bottom_position = (element_top_position + element_height);

        //check to see if this current container is within viewport
        if ((element_bottom_position >= window_top_position) &&
            (element_top_position <= window_bottom_position)) {
          $element.addClass('in-view');
        } else {
          $element.removeClass('in-view');
        }
      });
    }

    $window.on('scroll resize', check_if_in_view);
    $window.trigger('scroll');*/
    
});//ON LOAD

/*--------------------------------------------------------------
3.0 OWL SLIDERS
--------------------------------------------------------------*/

/*$(window).on('load', function(){
    
    $('#header-slider').owlCarousel({
        loop:true,
        margin:50,
        nav:true,
        navText : ['<span class="icon-arrow icon-arrow-left"></span>','<span class="icon-arrow icon-arrow-right"></span>'],
        dots:true,
        responsive:{
            0:{
                items:1
            },
        },
    });



});//on load
*/

