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
    $(document).on('click', '.toggle_menu', function(){
        var menu = $('.main-menu');

        if ( menu.css('height') == '0px' ) {
            menu.css('height', 'auto');
            var h = menu.css('height');
            menu.css('height', '0px');
            menu.animate({
                'height': h,
            }, 2000);
        } else {
            menu.animate({
                'height': '0px',
            }, 500);
        }
    });//.click toggle

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

