<?php 
/*
 * Sitio web: TROOPS
 * @LaCueva.tv
 * Since 1.0
 * CONFIG
 * Contenido: conneccion
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
define ('UPLOADSFILE', MAINSURL . '/contenido/archivos');
//META TAGS
define('SITETITLE', 'Troops');
define('METADESCRIPTION', '');
define('METAKEYS', '');
//LINKS:
define('LINK_FACEBOOK', '#');
define('LINK_INSTAGRAM', '#');
define('LINK_TWITTER', '#');
define('LINK_FLICKR', '#');
define('LINK_YOUTUBE', '#');

global $categorias;
$categorias = array(
	array( 'slug' => 'galeria', 'nombre' => 'Galería'),
);

define('POSTPERPAG', '5');//indica al paginador cuantos se muestran por pagina para calcular el offset además de que el loop muestra solo esos
