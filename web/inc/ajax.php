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
		case 'paginationLoop':
			
			$page  = isset($_POST['page']) ? $_POST['page'] : 1;
			$postPerPage  = isset($_POST['postPerPage']) ? $_POST['postPerPage'] : '1';
			$categoria = isset($_POST['categoria']) ? $_POST['categoria'] : 'none';

			$offset = ($page-1) * $postPerPage;

			$loop = getPosts( $categoria, $postPerPage, $exclude = 'none', $status = 'publicado', $offset );

			getTemplate( 'posts-loop', $loop );

		break;

		case 'searchLoop':
			
			$page  = isset($_POST['page']) ? $_POST['page'] : 1;
			$postPerPage  = isset($_POST['postPerPage']) ? $_POST['postPerPage'] : '1';
			$busqueda = isset($_POST['busqueda']) ? $_POST['busqueda'] : '';

			$offset = ($page-1) * $postPerPage .',' .$postPerPage;

			$loop = getSearch ($busqueda, $offset );

			getTemplate( 'posts-loop-mini', $loop );

		break;
	}

	
//sino es peticion ajax se cancela
} else{
    throw new Exception("Error Processing Request", 1);   
}