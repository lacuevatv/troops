/**
 * File script.js
 *
 * @required jQuery
 * @ver 1.0
 --------------------------------------------------------------
>>> TABLE OF CONTENTS:
1.0 NAVIGATION / AJAX FORMS
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

//setea la altura del contenedor
function setHeightContentVideo() {
    $('.video-wrapper').height( parseInt($('.image-ref-video').height()) + parseInt($('.image-ref-video').css('top')) );    
}

/*--------------------------------------------------------------
1.0 NAVIGATION / AJAX FORMS
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

    /*
     * MARCADOR MENU
    */
    $('.tours-nav-menu li').hover(
        function() {
            if ( $('.tour-active-icon').length != 0 ) {
                $('.tour-active-icon').clone().addClass('item-tem').prependTo($(this))
            } else {
                $('<span class="tour-active-icon item-tem"></span>').prependTo($(this))
            }
        }, function() {
            $('.item-tem').fadeOut().remove();
        });
    //$('.tour-active-icon').prependTo($($('.tours-nav-menu li')[4]))

    /*
     * SECCION EQUIPOS
    */
    //Si es pc o la pantalla es mayor a 992px entonces toma los contenidos y los copia abajo para poder abrirlos al hacer clic
    
    if (window.innerWidth > 992) {
        $('.nosotros-equipo-content').each( function() {
            $('#contenedor-data-equipo').append(this);
        } );
    }


    //click en los icons de contenido sección nosotros
    $(document).on('click', '.toogle-icons-contenidos', function( e ){
        e.preventDefault();
        //debugger;
        var href = $(this).attr('href');
        var item = $(href);
        var h = item.prop('scrollHeight') + 'px';
        var itemWidth = $(this).width();
        var positionTop = $(this).position().top;
        //var positionLeft = ($(this).offset().left) - itemWidth;
        var positionLeft = ($(this).offset().left)-70;
        var marcador = $('.equipo-item-active');

        if (window.innerWidth > 1500) {
            var positionLeft = ($(this).offset().left)-150;
        }
        if (window.innerWidth > 1800) {
            var positionLeft = ($(this).offset().left)-200;
        }

        //opción pantalla chica se abren todos a la vez
        if ( window.innerWidth < 992 ) {
            
            $('.equipo-item-active')
            if ( item.css('height') == '0px' ) {
                
                item.animate({
                    'height': h,
                }, 1000);
                $('.equipo-item-active').clone().prependTo($(this).closest('article')).fadeIn('slow')
                

            } else {
                item.animate({
                    'height': '0px',
                }, 200);
                $($(this).closest('article')).find('.equipo-item-active').fadeOut('slow').remove();

            }

        } //opción pantalla grande se abre solo uno a la vez
        else {         

            //primero busca si hay alguno abierto y lo cierra
            $('.item-abierto').each(function(){
                $(this).animate({
                    'height': '0px',
                }, 500);
                $(this).removeClass('item-abierto');
            });

            if ( item.css('height') == '0px' ) {
                
                item.animate({
                    'height': h,
                }, 1000);
                //le coloca una clase para indicar q este modulo esta abierto
                item.addClass('item-abierto');
                //coloca el marcador sobre el icono
                $(marcador).animate({
                    'left': positionLeft + 'px',
                }, 500);
            } else {
                item.animate({
                    'height': '0px',
                }, 200);
                //quita la clase que indica q esta abierto
                item.removeClass('item-abierto');
                //mueve el marcador afuera
                $(marcador).animate({
                    'left': '-10000px',
                }, 500);
            }
        }

    });



    /*
     * AJAX FORMS
    */
    console.log('form ready')
    $('#contact-form-home').submit(function( event ){
        event.preventDefault();
    
        console.log('formulario');

        formData = new FormData( this );
        formData.append('function','contact-home');

        $.ajax( {
            type: 'POST',
            url: ajaxFileUrl,
            data: formData,
            processData: false,
            contentType: false,
            cache: false,
            //funcion antes de enviar
            beforeSend: function() {
            },
            success: function ( response ) {
                console.log(response);
                
            },
            error: function ( ) {
                console.log('error');
            },
    });//cierre ajax


    });//.submit




});//.ready()

/*
 * FUNCIONES QUE REQUIEREN QUE TODO ESTE CARGADO
*/


$( window ).on('load', function(){

    console.log('all loaded')

    /*
     * SECCION VIDEO
    */
    //setea la altura del video cuando la ventana se agranda o se achica
    setHeightContentVideo();
    $( window ).resize(function() {
        setHeightContentVideo();
    });

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
2.0 POPUP PROMO
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

