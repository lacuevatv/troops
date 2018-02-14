<?php 
/*
 * Sitio web: TROOPS
 * @LaCueva.tv
 * Since 1.0
 * FUNCTIONS
 * 
*/

require_once 'config.php';
require_once 'functions.php';
require_once 'lib/mobile-detect/Mobile_Detect.php';

//chequea si es peticion de ajax y ejecuta la funcion
if( isAjax() ) {
	$function = isset($_POST['function']) ? $_POST['function'] : '';

	switch ( $function ) {
		case 'funcion1':
			
			echo 'funcion1';

		break;

	}

	
//sino es peticion ajax se cancela
} else{
    throw new Exception("Error Processing Request", 1);   
}