/**
 * File script.js
 *
 * @required jQuery
 * @ver 1.0
 --------------------------------------------------------------
>>> TABLE OF CONTENTS:
1.0 A) ON READY
NAVIGATION / SECCION EQUIPOS (pg inicio) / AJAX FORMS 
B ) ON LOAD (requieren que todo este cargado)
VIDEO INICIO / GRILLA BARILOCHE / MAS INFO
2.0 POP UP PROMO
3.0 OWL SLIDERS
4.0 
--------------------------------------------------------------*/

var baseUrl = 'http://' + window.location.host + '/troops';
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


//detecta el navegador y agrega una clase si es ese navegador
function menos18TemplateHacks() {

    var safari = false;
    var ms_ie = false;
    var ua = window.navigator.userAgent;
    var old_ie = ua.indexOf('MSIE ');
    var new_ie = ua.indexOf('Trident/');
    var edge = ua.indexOf('Edge');

    if ( (old_ie > -1) || (new_ie > -1) || (edge > -1) ) {
        ms_ie = true;
    }

    if ( navigator.vendor.indexOf('Apple') > -1 ) {
        safari = true;
    }

    if (safari || ms_ie) {
            $('.paquetes-menos18').addClass('paquetes-columns');
    }
}

/*--------------------------------------------------------------
1.0 NAVIGATION / AJAX FORMS
--------------------------------------------------------------*/

$(document).ready(function(){

    /*
     * MENU basico
    */
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
                scrollTop: $(url).offset().top - 130
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
    $('.tours-nav-menu li a').hover(

        function() {

            if (window.innerWidth > 992) {
                if ( $('.tour-active-icon').length != 0 ) {
                    $('.tour-active-icon').clone().addClass('item-tem').prependTo($(this).closest('li'))
                } else {
                    $('<span class="tour-active-icon item-tem"></span>').prependTo($(this).closest('li'))
                }
            }
        }, function() {
            $('.item-tem').fadeOut().remove();
        });
    

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
                $('.equipo-item-active').clone().prependTo($(this).closest('article')).fadeIn()
                

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
    
    //formulario inicio
    $('#contact-form-home').submit(function( event ){
        event.preventDefault();
    
        console.log('formulario-inicio');

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



    $('#contact-form-tour').submit(function( event ){
        event.preventDefault();
    
        console.log('formulario-tours');

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

    /*
     * GRILLA MENOS 18
    */
    //función que ajusta y coloca las imagenes en la grilla
    function resizeImageTours() {
        //debugger;
        //contenedor de los paquetes
        var contenedor = $('.paquetes-menos18');
        //busca todos los paquetes (articles)
        var paquetes = $('.paquete-menos18');
        var li = paquetes.closest('li');

        
        //primero redimensiona a todos
        $(li[0]).width('29.3%').height('34.5%');
        $(li[1]).width('29.3%').height('34.5%');
        $(li[2]).width('41.2%').height('34.5%');
        $(li[3]).width('40.4%').height('65.5%');
        $(li[4]).width('34.8%').height('32.7%');
        $(li[5]).width('24.6%').height('32.7%');
        $(li[6]).width('29.6%').height('32.8%');
        $(li[7]).width('29.8%').height('32.8%');
        //además ubica las dos ultimas según posicion
        $(li[6]).css({
            'position': 'absolute',
            'bottom' : '0',
            'right' : '29.9%',
        });
        $(li[7]).css({
            'position': 'absolute',
            'bottom' : '0',
            'right' : '1px'
        });

        var newheight = contenedor.width() * 800/1105;
            
        contenedor.height(newheight);
        
    }//resizeImageTours()


    //iguala la altura de la imagen con el article, para que no quede sin fondo y además coloca el width en auto para que la imagen no se deforme
    function resizeImageToursMovil() {

        var paquetes = $('.paquete-menos18');
        paquetes.each(function(){
            var img = $(this).find('img');
            if (img.height() < $(this).height()) {
                img.height($(this).height());
                img.css('width', 'auto');
            }

        });

    }//resizeImageToursMovil()

    //funciones de hover para que se muestre en celulares
    function hoverPaqueteIn (elem) {
        var item = $(elem).find('.paquete-hover');
        $(item).fadeIn().addClass('hover-animation');
    }

    //funciones de hover
    function hoverPaqueteOut (elem) {
        var item = $(elem).find('.paquete-hover');
        $(item).fadeOut().removeClass('hover-animation');

    }

    //al cargar se arma la grilla
    if (window.innerWidth > 992) {
        
        resizeImageTours();

    } else {
        resizeImageToursMovil();
    }//innerWidth > 992 GRILLA

    //cada vez que la ventana se redimenciona se arma la grilla
    $( window ).resize(function() {
        if (window.innerWidth > 992) {
            resizeImageTours();
        };
    });

    //al hacer hover en un paquete de la grilla
    $('.paquete-menos18').hover(function(){
        hoverPaqueteIn (this);
    }, function(){
        hoverPaqueteOut (this);
    })

    //hover en celulares
    var $animation_elements = $('.paquete-menos18');
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


    if (window.innerWidth < 992) {
        $window.on('scroll resize', check_if_in_view);
        $window.trigger('scroll');
    }
   
    //clic en btn más info para abrir el modal de más info
   $(document).on('click', '.paquete-btn-info', function(){
        var contenedor = $('.background-more-info');
        $(contenedor).addClass('open-background');
        contenedor.empty();
        //agrega los controles
        $(contenedor).append($('<div class="controls"><span class="close-control"></span><span class="left-control"></span><span class="right-control"></span></div>'));

        
        var info = $(this.closest('article')).find('.paquete-info').clone();
        $(contenedor).append(info);



        //abre los controles, en este caso, solo cerrar
        $('.close-control').fadeIn();

        if (window.innerWidth < 992) {
            //si es movil, busca la altura de lo que tiene que buscar y pone esa altura en el contenedor para que no sea tan alto
            var h = $(contenedor).find('.paquete-info').height();
            //a la altura obtenida le suma 150 para padding bottom y 100 para arriba
            contenedor.height(h+150);
            //ademas hace un scroll hacia arriba para mostrarlo adecuadamene
            $('html, body').stop().animate({
                scrollTop: $(contenedor).offset().top - 130
            }, 'slow');
        }
   });

   //cierra más info:
   $(document).on('click', '.close-control', function(){
        var contenedor = $('.background-more-info');
        $(contenedor).removeClass('open-background');
        $(contenedor).find('.paquete-info').remove();
   });


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

