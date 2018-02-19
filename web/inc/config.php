<?php 
/*
 * Sitio web: TROOPS
 * @LaCueva.tv
 * Since 1.0
 * CONFIG
*/
//BD
define('DB_SERVER', 'localhost');
define('DB_USER', 'dbuser');
define('DB_PASS', '123');
define('DB_NAME', 'troops_bd');
//DEFINICIONES HEAD Y SCRIPTS
define ( 'VERSION', '1.0' );
//CARPETAS
define ( 'UPLOADS', dirname( __FILE__ ) . '/../contenido' );
define ( 'TEMPLATEDIR', dirname( __FILE__ ) . '/../templates' );
//urls
define ('CARPETASERVIDOR', '' );//esta variable se define si el sitio no está en el root del dominio y si está en una subcarpeta
define ('MAINSURL', 'http://' . $_SERVER['HTTP_HOST'] . CARPETASERVIDOR );
define ('UPLOADSURL', MAINSURL . '/contenido');
define ('UPLOADSFILE', MAINSURL . '/contenido');
//META TAGS
define('SITETITLE', 'Troops');
define('METADESCRIPTION', '');
define('METAKEYS', '');
define( 'HABILITACIONES', 'Toors Viajes E.V y T. 0.000 Disp. 0.000' );
define('INSTAGRAM', 'viajestroops');
//LINKS:
define( 'LINK_EMAIL', 'info@lacueva.tv' );
define( 'WHATSAPPTEXT', '+54.934.1559.0789');
define( 'WHATSAPP', '54934590789');
define('LINK_FACEBOOK', '#');
define('LINK_INSTAGRAM', 'https://www.instagram.com/' . INSTAGRAM);
define('LINK_TWITTER', '#');
define('LINK_VIMEO', '#');
define('LINK_YOUTUBE', '#');
define('INSTAGRAMWIDGETPC', '<!-- LightWidget WIDGET --><script src="//lightwidget.com/widgets/lightwidget.js"></script><iframe src="//lightwidget.com/widgets/db5d98d1f5445cc4a7b3f4b55be9c4a0.html" scrolling="no" allowtransparency="true" class="lightwidget-widget" style="width: 100%; border: 0; overflow: hidden;"></iframe>');
define('INSTAGRAMWIDGETMOVIL', '<!-- LightWidget WIDGET --><script src="//lightwidget.com/widgets/lightwidget.js"></script><iframe src="//lightwidget.com/widgets/bf96b875186c52ee83bc5ee4034b52a5.html" scrolling="no" allowtransparency="true" class="lightwidget-widget" style="width: 100%; border: 0; overflow: hidden;"></iframe>');
define( 'IFRAMEGOOGLE', 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d6697.920461882658!2d-60.67323982182689!3d-32.92564894746303!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x95b654ae16bc21a1%3A0xadcddd71fe834ae!2sLuis+C%C3%A1ndido+Carballo+194%2C+S2013CTV+Rosario%2C+Santa+Fe!5e0!3m2!1ses!2sar!4v1519052211125');

global $categorias;
$categorias = array(
	array( 'slug' => 'galeria', 'nombre' => 'Galería'),
);

define('POSTPERPAG', '5');//indica al paginador cuantos se muestran por pagina para calcular el offset además de que el loop muestra solo esos
