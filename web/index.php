<?php
/*
 * Sitio web: TROOPS
 * @LaCueva.tv
 * Since 1.0
 *
 * TRES TEMPLATES: 1. home 2. -18 3. +18
*/
require_once 'inc/functions.php';

/*
 * $pageActual sirve para ver en que pagina estamos y ayuda a marcar el menú
*/
global $pageActual;
global $headerTitulo;
global $imagenHeader;
$data = null;
$pageActual = pageActual( cleanUri() );

/*
 * titulo header e imagen por defecto 
*/
$headerTitulo = 'Are you ready?';
$imagenHeader = MAINSURL . '/assets/images/header-portada-pc.png';
if ( dispositivo() != 'pc' ) {
    $imagenHeader = MAINSURL . '/assets/images/header-portada-movil.png';
}


if ( $pageActual != 'inicio' ) {
	$data = getPostExtended( $pageActual, 'lugar' );
}

if ($data != null ) {
	$headerTitulo = $data['post_titulo'];
    $imagenHeader = UPLOADSURL . '/' . $data['post_imagen'];
	if ( dispositivo() != 'pc' ) {
        $imagenHeader = UPLOADSURL . '/' . $data['post_imagen'];
    }
}

include 'header.php';

switch ($pageActual) {
	case 'bariloche':
	case 'porto-seguro':
	case 'jurere':
		
		if ( $data != null ) {
			getTemplate( 'menos18', $data );
		} else {
			getTemplate( '404' );
		}

		getTemplate( 'formularios', 'menos18' );

		break;

	case 'las-lenas':
	case 'cancun':
	case 'tematicos':
		if ( $data != null ) {
			getTemplate( 'mas18', $data );
		} else {
			getTemplate( '404' );
		}

		getTemplate( 'formularios', 'mas18' );

		break;
	
	default:
		getTemplate( 'inicio' );
		break;
}

include 'footer.php';