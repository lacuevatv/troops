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
PARALLAX / VIDEO INICIO / GRILLA BARILOCHE / MAS INFO
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

/*
ESTA FUNCIÓN LE AGREGA UNA CLASE CSS SI EL NAVEGADOR ES SAFARI
En Safari el clip-path no funciona muy bien a no ser que se le ponga transform: translateZ(0),
pero al ponerlo por defecto en chrome y opera se ve mal
entonces cuando detecta q es safari incluye la clase
*/

function hackClipPath () {
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
    

    if ( safari ) {
        //$('.nosotros-equipo-wrapper').addClass('nosotros-equipo-wrapper-safari');
        $('.nosotros-equipo-wrapper').css({
            'transform': 'translateZ(0)',
            '-webkit-transform': 'translateZ(0)',
            '-moz-transform': 'translateZ(0)',
            '-ms-transform': 'translateZ(0)',
            '-o-transform': 'translateZ(0)',
        });
    }
}





/*--------------------------------------------------------------
1.0 NAVIGATION / AJAX FORMS
--------------------------------------------------------------*/

$(document).ready(function(){

    //si es safari hackea el css para que funcione bien el clip-path
    hackClipPath();

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
    

    var hNosotros = $($('.nosotros-content p')[0]).height()+ 20;
    $('.nosotros-content-wrapper').height(hNosotros);


    //clic en toogle leer mas sección nosotros
    $(document).on('click', '.nosotros-content-toggle', function( e ){
        
        var contenedor = $(this).closest('.nosotros-content-wrapper')
        var texto = $(contenedor).find('.nosotros-content');
        
        var adicional = 30;

        if (window.innerWidth > 960) {
            adicional = 60;
        }
        if (window.innerWidth > 1380) {
            adicional = 100;
        }
        if (window.innerWidth > 1800) {
            adicional = 180;
        }

        if ( contenedor.height() == hNosotros ) {
            
            var h = texto.prop('scrollHeight') + adicional;
            
            contenedor.animate({
                'height': h +'px',
            }, 500);
            $(this).text('Cerrar');
            
        } else {
            contenedor.animate({
                'height': hNosotros + 'px',
            }, 500);
            $(this).text('Leer más');
        }

        
        
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

    //hover en los iconos de contenido
    /*if ( window.innerWidth > 992 ) {
        $('.toogle-icons-contenidos').hover(

            function () {
                
                    var href = $(this).attr('href');
                    var positionLeft = ($(this).offset().left)-70;              
                    
                    var marcador = $('.equipo-item-active').clone().addClass('equipo-item-active-clone');
                    marcador.appendTo('.nosotros-equipo');
                    
                    $(marcador).animate({
                        'left':  positionLeft + 'px',
                    }, 500);
                
            },
            function () {
                
                    var marcador = $('.equipo-item-active-clone');
                    $(marcador).animate({
                        'left':  '-10000px',
                    }, 500);   
                    $(marcador).remove();
                
            },
        );
    }*/




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
                $('.url-form').text('Enviando, espere...');
            },
            success: function ( response ) {
                //console.log(response);
                $('.url-form').text(response);
                $('#contact-form-home')[0].reset();
                
            },
            error: function ( ) {
                console.log('error');
            },
    });//cierre ajax


    });//.submit



    $('#contact-form-tour-menos').submit(function( event ){
        event.preventDefault();
    
        console.log('formulario-tours');

        formData = new FormData( this );
        formData.append('function','contact-tour-menos');

        $.ajax( {
            type: 'POST',
            url: ajaxFileUrl,
            data: formData,
            processData: false,
            contentType: false,
            cache: false,
            //funcion antes de enviar
            beforeSend: function() {
                $('.url-form').text('Enviando, espere...');
            },
            success: function ( response ) {
                console.log(response);
                $('.url-form').text(response);
                $('#contact-form-tour-menos')[0].reset();
                
            },
            error: function ( ) {
                console.log('error');
            },
        });//cierre ajax


    });//.submit

    $('#contact-form-tour-mas').submit(function( event ){
        event.preventDefault();
    
        console.log('formulario-tours-mas');

        formData = new FormData( this );
        formData.append('function','contact-tour-mas');

        $.ajax( {
            type: 'POST',
            url: ajaxFileUrl,
            data: formData,
            processData: false,
            contentType: false,
            cache: false,
            //funcion antes de enviar
            beforeSend: function() {
                $('.url-form').text('Enviando, espere...');
            },
            success: function ( response ) {
                console.log(response);
                $('.url-form').text(response);
                $('#contact-form-tour-mas')[0].reset();
                
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
        var li = $(paquetes).closest('li');

        
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
   

    /*
     * MENOS 18 / MAS 18 GALERIAS E INFO
    */


    //clic en btn más info para abrir el modal de más info
   $(document).on('click', '.paquete-btn-info', function(){
        var contenedor = $('.background-more-info');
        $(contenedor).addClass('open-background');
        contenedor.empty();
        //agrega los controles
        $(contenedor).append($('<div class="controls"><span class="close-control"></span><span class="left-control"></span><span class="right-control"></span></div>'));
        
        //clona la info del paquete y la adjunta al modal para mostrarla
        var info = $($(this).closest('article')).find('.paquete-info').clone();
        $(contenedor).append(info);
        //sube la pantalla para que se vea bien
        $('html, body').stop().animate({
            scrollTop: $(contenedor).offset().top - 130
        }, 'slow');


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

   //boton cerrar, para más info y galeria:
   $(document).on('click', '.close-control', function(){
        var contenedor = $('.background-more-info');
        $(contenedor).removeClass('open-background');
        $(contenedor).find('.paquete-info').remove();
   });

   //clic en boton mostrar galeria, menos 18
   $(document).on('click', '.paquete-btn-galeria', function(){
        var paquete = $(this).closest('article');
        var contenedor = $('.background-more-info');
        contenedor.empty();
        $(contenedor).addClass('open-background');
        //agrega los controles
        $(contenedor).append($('<div class="controls"><span class="close-control"></span><span class="left-control"></span><span class="right-control"></span></div>'));
        //abre los controles, en este caso, solo cerrar
        $('.close-control').fadeIn();
        //$('.left-control').fadeIn();
        //$('.right-control').fadeIn();

        //url basico
        var href = baseUrl + '/contenido/';
        //imagenes de este paquete
        var imagenes = $(paquete).find('.paquete-lista-imagenes li');

        //armamos html para insertar
        var html = '<div class="galeria-wrapper-menos18"><div class="main-picture-wrapper"><figure class="main-picture"><img src=""></figure></div><div class="owl-carousel owl-theme">';
                    
                

        for (var i = 0; i < imagenes.length; i++) {
            html += '<div class="item"><img src="'+ href + $(imagenes[i]).text() + '" alt="Troops Viajes" class="toggle-picture"></div>'
        }
        
        html += '</div></div>';

        contenedor.append($(html));


        
         //ademas hace un scroll hacia arriba para mostrarlo adecuadamene
         if ( window.innerWidth > 992 ) {
            $('html, body').stop().animate({
                scrollTop: $(contenedor).offset().top - 70
            }, 'slow');
         } else {
            $('html, body').stop().animate({
                scrollTop: $(contenedor).offset().top - 130
            }, 'slow');
         }
        

        //inicializa el carousel
        $('.owl-carousel').owlCarousel({
            loop:true,
            margin:10,
            nav:true,
            navText : ['<span class="icon-arrow icon-arrow-left"></span>','<span class="icon-arrow icon-arrow-right"></span>'],
            responsive:{
                0:{
                    items:1
                },
                992:{
                    items:4
                },
                1200:{
                    items:6
                },
                1500:{
                    items:8
                },
            }
        });//owl

        if (window.innerWidth > 992) {
            var MainImage = $('.main-picture-wrapper figure img');
            var wrapper = $('.galeria-wrapper-menos18');
            var wrapperHeightNormal = $(wrapper).height();
            
            //coloca la primera imagen como principal
            $(MainImage).attr('src', href + $(imagenes[0]).text());

            //al hacer clic en la imagen debería mostrar la que se selecciono
            $('.toggle-picture').click(function(){
                
                //busca el src de la imagen
                var href = $(this).attr('src');
                //lo coloca como main image
                $(MainImage).attr('src', href);
            });
        } else {
            //busca la imagen mas alta y ajusta el contenedor
            var hImg = $('.owl-carousel').height();
            
            $('.galeria-wrapper-menos18').animate({
                    'height': hImg + 'px'
                },1000);
        }

    });




    /*
    parallax superior:
    */

    //tomamos las imagenes
    var background = $('.top-header-content');
    var img = $('.image-header');
    var title = $('.title-header');
    
    //guardamos la posicion inicial
    //paralax: funcionar al scroll
    $(window).scroll(function(){

        var barra = ($(window).scrollTop()); 
        
        var nuevoY = barra*0.9;
        var nuevoY2 = barra*0.9;
        //movemos los puntos hacia abajo
        background.css('background-position-y', '-'+nuevoY+'px' );
        img.css('top',nuevoY+'px');

        if ( barra <= 100 && barra >= 0) {
            title.css('top','48%');   
        }

        if ( barra <= 200 && barra >= 100) {
            title.css('top','58%');   
        }
        if ( barra <= 300 && barra >= 200) {
            title.css('top','68%');   
        }
        if ( barra <= 400 && barra >= 300) {
            title.css('top','78%');   
        }
        if ( barra <= 500 && barra >= 400) {
            title.css('top','88%');   
        }
     
    });//fin paralax

    /*
     * ANIMACIONES
    */
    var $animation_elements_2 = $('.animation-element');
    var $window = $(window);

    function check_if_in_view_2() {
      var window_height = $window.height();
      var window_top_position = $window.scrollTop();
      var window_bottom_position = (window_top_position + window_height);

      $.each($animation_elements_2, function() {
        var $element = $(this);
        var element_height = $element.outerHeight();
        var element_top_position = $element.offset().top;
        var element_bottom_position = (element_top_position + element_height);

        //check to see if this current container is within viewport
        if ((element_bottom_position >= window_top_position) &&
            (element_top_position <= window_bottom_position)) {
          $element.addClass('in-view-2');
        } else {
          $element.removeClass('in-view-2');
        }
      });
    }

    $window.on('scroll resize', check_if_in_view_2);
    $window.trigger('scroll');
    




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


//CARGA SLIDER EN MÁS 18
$(window).on('load', function(){
    
    if( pageActual == 'las-lenas' || pageActual == 'cancun' || pageActual == 'tematicos') {
        //inicia el carousel
        $('.owl-carousel').owlCarousel({
            loop:true,
            margin:10,
            nav:true,
            navText : ['<span class="icon-arrow icon-arrow-left"></span>','<span class="icon-arrow icon-arrow-right"></span>'],
            responsive:{
                0:{
                    items:1
                },
                992:{
                    items:3
                },
                1200:{
                    items:5
                },
                1300:{
                    items:6
                },
                1500:{
                    items:8
                }
            }
        });//owl

        if (window.innerWidth > 992) {
            var MainImage = $('.main-picture-wrapper figure img');
            var contenedor = $('.galeria-inner-wrapper');
            var contenedorHeightNormal = $(contenedor).height();
            //ajusta las medidas la inicio
            var hImg = $('.main-picture-wrapper figure img').height();
                $(contenedor).animate({
                    'height': hImg + 'px'
                },1000);

            //al hacer clic en la imagen debería mostrar la que se selecciono
            $('.toggle-picture').click(function(){
                
                //busca el src de la imagen
                var href = $(this).attr('src');
                //lo coloca como main image
                $(MainImage).attr('src', href);
                //ajusta las medidas
                var hImg = $('.main-picture-wrapper figure img').height();
                $(contenedor).animate({
                    'height': hImg + 'px'
                },1000);
                
            });
        } else {
            //busca la imagen mas alta y ajusta el contenedor
            var hImg = $('.owl-carousel').height();
            
            $('.galeria-inner-wrapper').animate({
                    'height': hImg + 'px'
                },1000);
        }

    }

});//on load


