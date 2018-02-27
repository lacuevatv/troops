<?php
// BASE DE DATOS
define('DB_SERVER', 'localhost');
define('DB_USER', 'dbuser');
define('DB_PASS', '123');
define('DB_NAME', 'troops_bd');
//CARPETAS
define ( 'TEMPLATEDIR', dirname( __FILE__ ) . '/../templates' );
define ( 'MODULOSDIR', dirname( __FILE__ ) . '/modulos' );
define ( 'UPLOADS', dirname( __FILE__ ) . '/../../contenido' );
define ( 'UPLOADSIMAGES', dirname( __FILE__ ) . '/../../contenido' );
define ( 'UPLOADSFILES', dirname( __FILE__ ) . '/../../contenido' );
//URL
define ('CARPETASERVIDOR', '' );//esta variable se define si el sitio no está en el root del dominio y si está en una subcarpeta
define ('MAINURL', 'http://' . $_SERVER['HTTP_HOST'] . CARPETASERVIDOR );
define ('URLADMINISTRADOR', MAINURL . '/administrador' );//esta variable define la carpeta del administrador - también debe cambianser en el .js
define ('UPLOADSURL', MAINURL . '/contenido');//carpeta donde esta el contenido subido por el usuario
define ('UPLOADSURLIMAGES', UPLOADSURL . '');//carpeta  de imagenes (por si tiene distintas carpetas de contenido)
define ('UPLOADSURLFILES', UPLOADSURL . '');//carpeta de archivos (por si tiene distintas carpetas de contenido)

//DEFINICIONES HEAD Y SCRIPTS
define ( 'SITENAME', 'Troops' );
define ( 'DATEPUBLISHED', '2018');
define ('LOGOSITE' , URLADMINISTRADOR . '/assets/images/logo.gif');
define ( 'SITETITLE', 'Nombre - Panel de control' );
define ( 'FAVICONICO', URLADMINISTRADOR . '/favicon.ico' );

//variables tipo de usuario
global $usertype;
$usertype = array(
	array( 'status' => 'a', 'nombre' => 'default'),
	array( 'status' => '0', 'nombre' => 'Administrador'),
	array( 'status' => '1', 'nombre' => 'Editor'),
);
//variables de definicion de administrador
global $categorias;//define las categorias para cargar noticias
$categorias = array(
	array( 'slug' => 'bariloche', 'nombre' => 'Bariloche'),
	array( 'slug' => 'porto-seguro', 'nombre' => 'Porto Seguro'),
	array( 'slug' => 'jurere', 'nombre' => 'Jureré'),
	array( 'slug' => 'las-lenas', 'nombre' => 'Las Leñas'),
	array( 'slug' => 'cancun', 'nombre' => 'Cancún'),
	array( 'slug' => 'tematicos', 'nombre' => 'Temáticos'),
);
