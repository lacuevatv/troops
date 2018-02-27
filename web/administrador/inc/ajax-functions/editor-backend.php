<?php
/*
 * editor
 * Since 3.0
 * Maneja el backend del editor de noticias, ya sea para una nueva noticia o editar alguna
*/
session_start();
require_once('../functions.php');

if ( isAjax() ) {

	//se toman los datos para variables
	$connection              = connectDB();
	$tabla                   = 'posts';
	$user                    = $_SESSION['user_id'];
	$postID                  = isset( $_POST['post_ID'] ) ? $_POST['post_ID'] : '';
	$newPost                 = isset( $_POST['new_post'] ) ? $_POST['new_post'] : '';
	$postTitulo              = isset( $_POST['post_title'] ) ? $_POST['post_title'] : '';
	$postCategoria           = isset( $_POST['post_categoria'] ) ? $_POST['post_categoria'] : 'categoria1';
	$postUrl                 = isset( $_POST['post_url'] ) ? $_POST['post_url'] : 'none';
	$postStatus              = isset( $_POST['post_status'] ) ? $_POST['post_status'] : 'none';
	$postDate                = isset( $_POST['post_date'] ) ? $_POST['post_date'] : 'none';
	$postResumen             = isset( $_POST['post_resumen'] ) ? $_POST['post_resumen'] : '';
	$postContenido           = isset( $_POST['post_contenido'] ) ? $_POST['post_contenido'] : 'none';
	$postImagen              = isset( $_POST['post_imagen'] ) ? $_POST['post_imagen'] : '';
	$postVideo               = isset( $_POST['post_video'] ) ? $_POST['post_video'] : '';
	$postGaleria             = isset( $_POST['post_galeria'] ) ? $_POST['post_galeria'] : '0';//si es true hay que pasarlo a 1 para que se guarde correctamente
	$imgGaleria              = isset( $_POST['imgGaleria'] ) ? $_POST['imgGaleria'] : '';
	$archivo                 = isset( $_POST['archivo'] ) ? $_POST['archivo'] : '';
	$map_latitud             = isset( $_POST['map_latitud'] ) ? $_POST['map_latitud'] : '';
	$map_longitud            = isset( $_POST['map_longitud'] ) ? $_POST['map_longitud'] : '';
	$detalles_loc            = isset( $_POST['detalles_loc'] ) ? $_POST['detalles_loc'] : '';
	$detalles_asientos       = isset( $_POST['detalles_asientos'] ) ? $_POST['detalles_asientos'] : '';
	$detalles_precio         = isset( $_POST['detalles_precio'] ) ? $_POST['detalles_precio'] : '';
	$detalles_dias           = isset( $_POST['detalles_dias'] ) ? $_POST['detalles_dias'] : '';
	$detalles_descuento      = isset( $_POST['detalles_descuento'] ) ? $_POST['detalles_descuento'] : '';
	$detalles_ida            = isset( $_POST['detalles_ida'] ) ? $_POST['detalles_ida'] : '';
	$detalles_idafecha       = isset( $_POST['detalles_idafecha'] ) ? $_POST['detalles_idafecha'] : '';
	$detalles_aviondespegue  = isset( $_POST['detalles_aviondespegue'] ) ? $_POST['detalles_aviondespegue'] : '';
	$detalles_avionaterriza  = isset( $_POST['detalles_avionaterriza'] ) ? $_POST['detalles_avionaterriza'] : '';
	$detalles_regreso        = isset( $_POST['detalles_regreso'] ) ? $_POST['detalles_regreso'] : '';
	$detalles_regresofecha   = isset( $_POST['detalles_regresofecha'] ) ? $_POST['detalles_regresofecha'] : '';
	$detalles_aviondespegue2 = isset( $_POST['detalles_aviondespegue2'] ) ? $_POST['detalles_aviondespegue2'] : '';
	$detalles_avionaterriza2 = isset( $_POST['detalles_avionaterriza2'] ) ? $_POST['detalles_avionaterriza2'] : '';

    //saneamiento
	$postResumen             = mysqli_real_escape_string($connection, $postResumen);
	$postContenido           = mysqli_real_escape_string($connection, $postContenido);
	$postTitulo              = mysqli_real_escape_string($connection, $postTitulo);
	$postResumen             = filter_var($postResumen,FILTER_SANITIZE_STRING);
	$postTitulo              = filter_var($postTitulo,FILTER_SANITIZE_STRING);
	$map_latitud             = filter_var($map_latitud,FILTER_SANITIZE_STRING);
	$map_longitud            = filter_var($map_longitud,FILTER_SANITIZE_STRING);
	$detalles_loc            = filter_var($detalles_loc,FILTER_SANITIZE_STRING);
	$detalles_asientos       = filter_var($detalles_asientos,FILTER_SANITIZE_STRING);
	$detalles_precio         = filter_var($detalles_precio,FILTER_SANITIZE_STRING);
	$detalles_dias           = filter_var($detalles_dias,FILTER_SANITIZE_STRING);
	$detalles_descuento      = filter_var($detalles_descuento,FILTER_SANITIZE_STRING);
	$detalles_ida            = filter_var($detalles_ida,FILTER_SANITIZE_STRING);
	$detalles_idafecha       = filter_var($detalles_idafecha,FILTER_SANITIZE_STRING);
	$detalles_aviondespegue  = filter_var($detalles_aviondespegue,FILTER_SANITIZE_STRING);
	$detalles_avionaterriza  = filter_var($detalles_avionaterriza,FILTER_SANITIZE_STRING);
	$detalles_regreso        = filter_var($detalles_regreso,FILTER_SANITIZE_STRING);
	$detalles_regresofecha   = filter_var($detalles_regresofecha,FILTER_SANITIZE_STRING);
	$detalles_aviondespegue2 = filter_var($detalles_aviondespegue2,FILTER_SANITIZE_STRING);
	$detalles_avionaterriza2 = filter_var($detalles_avionaterriza2,FILTER_SANITIZE_STRING);

	$mapaDatos = array( $map_latitud, $map_longitud );
	$mapaDatos = serialize($mapaDatos);

	$detallesData = array( $detalles_loc,$detalles_asientos,$detalles_precio,$detalles_dias,$detalles_descuento,$detalles_ida,$detalles_idafecha,$detalles_aviondespegue,$detalles_avionaterriza,$detalles_regreso,$detalles_regresofecha,$detalles_aviondespegue2,
	$detalles_avionaterriza2 );
	$detallesData = serialize($detallesData);

	//si hay una galería hay que armar un array con las imagenes y luego serializarlas
	if ( $postGaleria == 'true' ) {
		//en la base de datos se escribe como 1 y 0 así que traduzco a 1 y 0 para que se guarde correctamente
		$postGaleria = '1';
	}	else {
		//en la base de datos se escribe como 1 y 0 así que traduzco a 1 y 0 para que se guarde correctamente
		$postGaleria = '0';
	}
	if ( $imgGaleria != '' ) {
		$imagenesGaleria = explode(',', $imgGaleria );
		
		for ($i=0; $i < count($imagenesGaleria)-1; $i++) { 
			$imagenesGaleria[$i] = trim($imagenesGaleria[$i]);
		}
		
		$imagenesGaleria = serialize($imagenesGaleria);
	} else {
		$imagenesGaleria = '';
	}
	

/*
* GUARDAR POST
*/

	//es nuevo post
	if ($newPost == 'true') {
		//primero hay que ver si el url no está tomado y si está tomado enviar un mensaje
		$query  = "SELECT * FROM " .$tabla. " WHERE post_url='".$postUrl."' ";
		$result = mysqli_query($connection, $query);
		if ( $result->num_rows != 0 ) {
			echo 'error-url';
			exit;
		}

		$query = "INSERT INTO $tabla (post_autor,post_fecha,post_titulo,post_url,post_contenido,post_resumen,post_imagen,post_file,post_video,post_galeria,post_imagenesGal,post_detalle,post_mapa,post_categoria,post_type,post_status) VALUES ('$user', '$postDate', '$postTitulo', '$postUrl', '$postContenido', '$postResumen', '$postImagen', '$archivo', '$postVideo', '$postGaleria', '$imagenesGaleria', '$detallesData', '$mapaDatos', '$postCategoria', 'paquete', '$postStatus')";

		$nuevoPost = mysqli_query($connection, $query); 
		$postID = mysqli_insert_id($connection);

		echo 'saved';

	} //es viejo post
		else {

		$query = "UPDATE ".$tabla." SET post_autor='".$user."',post_fecha='".$postDate."', post_titulo='".$postTitulo."',post_url='".$postUrl."',post_contenido='".$postContenido."',post_resumen='".$postResumen."',post_imagen='".$postImagen."',post_file='".$archivo."',post_video='".$postVideo."',post_galeria='".$postGaleria."',post_imagenesGal='".$imagenesGaleria."', post_detalle='".$detallesData."', post_mapa='".$mapaDatos."', post_categoria='".$postCategoria."',post_status='".$postStatus."' WHERE post_ID='".$postID."' LIMIT 1";

		$updatePost = mysqli_query($connection, $query); 
		
		echo 'updated';
		
	}

//cierre base de datos
mysqli_close($connection);


} //if not ajax
else {
	exit;
}

