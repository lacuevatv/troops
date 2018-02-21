<?php 
/*
 * Sitio web: TROOPS
 * @LaCueva.tv
 * Since 1.0
 * FUNCTIONS
 * 
*/

require_once 'config.php';
require_once 'lib/mobile-detect/Mobile_Detect.php';

//busca el template $name = nombre del archivo sin extensión
function getTemplate ( $name, $data = array() ) {
	$namePage = TEMPLATEDIR . '/'. $name. '.php';

	if (is_file($namePage)) {
		include $namePage;
	}
}


//detecta el dispositivo
function dispositivo () {
	$dispositivo = 'pc';
	$detect = new Mobile_Detect;

	if ( $detect->isMobile() ) {
		$dispositivo = 'movil';
	}
		
	// Any tablet device.
	if( $detect->isTablet() ){
		$dispositivo = 'tablet';
	}

	return $dispositivo;

}

//esta función limpia el url si el sitio no está instalado en la rais del servidor para que funcionen los permalinks sin problemas
function cleanUri() {
	$uri = $_SERVER["REQUEST_URI"];
	$uri = str_replace(CARPETASERVIDOR, '', $uri);
	return $uri;	
}

/*
* FUNCIÓN DE PERMALINKS
 * Define la page actual y redirecciona segun url, devuelve el slug o template part.
 * a) En el caso de que sean paginas, busca el template en la carpeta templates y listo.
 * b) En el caso de que sea noticia, categoria o curso, busca el template adecuado (cursos = curso.php / o en en el archivo index elige la primera opcion (la segunda es de paginas).
 * Pero ademas, e importante, busca en la base de datos mediante el slug. Si es noticia hace un loop de la categoria elegida o de todas las noticias y si es noticia single busca la noticia específica.
 *
*/
function pageActual ( $uri ) {
	$slug = 'inicio'; //slug por defecto
	/*if ( $_SERVER["PHP_SELF"] == '/index.php' ) {
	 
	} else {
		//echo $_SERVER["PHP_SELF"];
		//echo $_SERVER["REQUEST_URI"];
	}*/
	//borramos la barra / luego del dominio:
	$url = $uri;
	$parseUrl = explode('/', $url);
	$RequestURI = $parseUrl[1];
	
	//busca el simbolo ? en la url
	$permalink = strpos($RequestURI, '?');
	$permalink2 = strpos($RequestURI, '&');
	
	//si en el url no aparece ni ? ni & es porque es un link bonito
	if ( $permalink === false && $permalink2 === false ) {
		
		//si no está vacío, hay que procesar cual es
		if ( $url != '/' ) {

			$slug = $RequestURI;		
			
		}

	} 
	//en cambio, si aparece el ? o el & el url funciona con ids, ejecuta la segunda opcion
	else {
		//BUSCAR PAGE EN EL URL, por defecto sería home
		$slug = isset($_REQUEST['page'])?$_REQUEST['page']:'inicio';
		$noticia = isset($_REQUEST['noticia'])?$_REQUEST['noticia']:'none';
		$cat = isset($_REQUEST['cat'])?$_REQUEST['cat']:'none';

		if ( $noticia != 'none' ) {
			$slug = $noticia;
		}

		if ( $cat != 'none' ) {
			$slug = $cat;
		}
	}

	return $slug;

}//pageActual()

//esta funcion devuelve el nombre de la categoria o nada sino lo es 
function ver_categoria ( $uri ) {
	global $categorias;
	//ver si figura la variable cat en el url, en ese caso es categoria
	$cat = isset($_REQUEST['cat']) ? $_REQUEST['cat'] : 'none';

	$parseUrl = explode('/', $uri);
	$RequestURI = $parseUrl[1];

	for ($i=0; $i < count($categorias); $i++) { 
		if ( $categorias[$i]['slug'] == $RequestURI ) {
		$cat = $RequestURI;
		break;
		}
	}

	return $cat;

}

//esta funcion devuelve el nombre true si es categoria y false si no lo es
function es_categoria ( $uri ) {
	global $categorias;
	//ver si figura la variable cat en el url, en ese caso es categoria
	$cat = isset($_REQUEST['cat'])?$_REQUEST['cat']:'none';
	if ( $cat != 'none' ) {
		return true;
	} 
	//si el url es bonito hay que parsearlo para buscar las categorias
	$parseUrl = explode('/', $uri);

	if ( count( $parseUrl ) >= 3 && $parseUrl[2] != '' ){
		//si el index 2 figura en el url significa que es single
		return false;
	} else {
		$RequestURI = $parseUrl[1];

		for ($i=0; $i < count($categorias); $i++) { 
			if ( $categorias[$i]['slug'] == $RequestURI ) {
			return true;
			break;
			}
		}
		//sino encuentra la categoria en el url, entonces no lo es
		return false;
	}	
}

/*
ESTA FUNCIÓN TOMA LA VARIANTE DE ALGUNAS PAGINAS POR EJEMPLO NOTICIAS, EL SLUG ES UNA CATEGORIA O EL URL DE UNA NOTICIA
@return: string
*/
function getPageVar ( $uri ) {
	$slug = '';

	//si es categoria, entonces no hay nada que decir
	if ( es_categoria( $uri ) ){
		return;
	} 
	
	//si figura variable noticia en el url, entonces es facil:
	$noticia = isset($_REQUEST['noticia'])?$_REQUEST['noticia']:'none';
	if ( $noticia != 'none' ) {
		$slug = $noticia;
		return $slug;
	} 

	//si no hay variables hay que parsear el url para buscar informacion
	$parseUrl = explode('/', $uri);
	
	//si por el contrario hay un indice 2 y este no es la "/" entonces hay info que rescatar
	if ( isset($parseUrl[2]) && $parseUrl[2] != '' ) {
		$slug = $parseUrl[2];
	} else {
		//y por ultimo la info a mostrar también puede estar en el indice 1 si este no es categoria
		$slug = $parseUrl[1];
	}

	return $slug;

}
//esta función toma el nombre de la categoría para mostrarlo en el front en caso de que sea distinto el nombre del slug
function getNameCategoria( $categoria ) {
	global $categorias;
	for ($i=0; $i < count($categorias) ; $i++) { 
		if ($categorias[$i]['slug'] == $categoria ) {
			return $categorias[$i]['nombre'];
			break;
		}
	}
}

//acorta el texto
function acortaTexto( $texto, $cantPalabras = 50, $final = null ) {
	if ( null === $final ) {
	$final = '&hellip;';
	}	
	$textoOriginal = $texto;
	
	//quitar html
	$texto = preg_replace( '@<(script|style)[^>]*?>.*?</\\1>@si', '', $texto );
	$texto = strip_tags($texto);
	
	//reducir texto y agregar el final
	 $words_array = preg_split( "/[\n\r\t ]+/", $texto, $cantPalabras + 1, PREG_SPLIT_NO_EMPTY );
	$sep = ' ';
	
	//devolver texto reducido
	if ( count( $words_array ) > $cantPalabras ) {
		array_pop( $words_array );
		$texto = implode( $sep, $words_array );
		$texto = $texto . $final;
	} else {
		$texto = implode( $sep, $words_array );
	}
	return $texto;
}

//devuelve el título de la página para <head><title>
function SeoTitlePage ( $page ) {
    $tituloBase   = SITETITLE;

    //titulo cuando no es home ni noticias
    if ( $page != 'inicio' && $page != 'noticias' ) {
        //si la página no es home hay que separar la url que está unido por "-" para armar un nuevo título
        $pageActualTitle = explode('-', $page);
        $pageSEOTitle = ' |';
        for ($i=0; $i < count($pageActualTitle); $i++) { 
            $pageSEOTitle .= ' ';
            $pageSEOTitle .= ucfirst($pageActualTitle[$i]);
        }

        $tituloBase .= $pageSEOTitle;
    }

    return $tituloBase;
} //SeoTitlePage()


//define el metadescription en la etiqueta Head para SEO
function metaDescriptionText ( $pageActual, $noticia, $curso, $categoriaNoticias ) {
	$metaDescription = METADESCRIPTION;
	

	if ( $noticia != 'none') {
		global $dataNoticia;
		$base = ' | Asociación de trabajadores de la Sanidad Argentina, Buenos Aires.';
		$metaDescription = $dataNoticia['resumen'] . $base;
	}

	if ( $categoriaNoticias != 'none') {
		$metaDescription = 'Últimas noticias ' .$categoriaNoticias. '. Asociación de trabajadores de la Sanidad Argentina, Buenos Aires.';
	}

	return $metaDescription;

}//metaDescriptionText()

/**
 * Checks if a request is a AJAX request
 * @return bool
 */
function isAjax() {
    return (isset($_SERVER['HTTP_X_REQUESTED_WITH']) && $_SERVER['HTTP_X_REQUESTED_WITH']  == 'XMLHttpRequest');
}


/*
 *
 * FUNCIONES CON BASE DE DATOS
 *
*/

function connectDB () {
	global $connection;
  $connection = mysqli_connect(DB_SERVER, DB_USER, DB_PASS, DB_NAME);
  // Test if connection succeeded
  if( mysqli_connect_errno() ) {
    die("Database connection failed: " . mysqli_connect_error() . 
         " (" . mysqli_connect_errno() . ")"
    );
  }

  if (!mysqli_set_charset($connection, "utf8")) {
    printf("Error cargando el conjunto de caracteres utf8: %s\n", mysqli_error($connection));
    exit();
	} else {
		mysqli_character_set_name($connection);
	}
  return $connection;
}

//cierre base de datos
function closeDataBase( $connection ){
	if ( isset($connection) ) {
    	mysqli_close( $connection );
    }
}

/*
 * POSTS LOOPS
*/

//busca datos para loop de noticias por categoria y los devuelve en una variables:
function getPosts( $categoria = 'none', $number = -1, $exclude = 'none', $status = 'publicado', $offset = 0 ) {
	$connection = connectDB();
	$fecha_actual = date("Y-m-d");
	$tabla = 'posts';

	if ( $offset != '0' ) {
		$number = $offset.','.$number;
	}

	$query  = "SELECT * FROM " .$tabla;
	$query .= " WHERE post_status='";
	$query .= $status . "'";
	if ( $categoria != 'none' ) {
		$query .= " AND post_categoria = '".$categoria."'";
	}
	if ( $exclude != 'none' ) {
		$query .= " AND post_url!='".$exclude."'";
	}
	if ( $status == 'publicado' ) {
		$query .= " AND post_fecha <= '".$fecha_actual."'";	
	}
	$query .= " ORDER by post_fecha desc ";
	if ( $number != -1 ) {
		$query .= " LIMIT ".$number." ";
	}
	
	$result = mysqli_query($connection, $query);
	
	closeDataBase( $connection );

	if ( $result->num_rows == 0 ) {
		$loop = '<div>Ninguna noticia ha sido cargada todavía</div>';
	} else {

		while ($row = $result->fetch_array()) {
				$loop[] = $row;
			}

	}
	
	return $loop;
}

//busca datos para loop de noticias por categoria de acuerdo al post type:
function getPostsExtended( $postType, $categoria = 'none', $number = -1, $exclude = 'none', $status = 'publicado', $offset = 0 ) {
	$connection = connectDB();
	$fecha_actual = date("Y-m-d");
	$tabla = 'posts';

	if ( $offset != '0' ) {
		$number = $offset.','.$number;
	}

	$query  = "SELECT * FROM " .$tabla;
	$query .= " WHERE post_status='";
	$query .= $status . "'";
	if ( $categoria != 'none' ) {
		$query .= " AND post_categoria = '".$categoria."'";
	}
	if ( $exclude != 'none' ) {
		$query .= " AND post_url!='".$exclude."'";
	}
	if ( $status == 'publicado' ) {
		$query .= " AND post_fecha <= '".$fecha_actual."'";	
	}
	$query .= " AND post_type = '".$postType."'";	
	$query .= " ORDER by post_fecha desc ";
	if ( $number != -1 ) {
		$query .= " LIMIT ".$number." ";
	}
	
	$result = mysqli_query($connection, $query);
	
	closeDataBase( $connection );

	if ( $result->num_rows == 0 ) {
		$loop = null;
	} else {

		while ($row = $result->fetch_array()) {
				$loop[] = $row;
			}

	}
	
	return $loop;
}

/*
 * SEARCH
*/

//realiza la búsqueda según parametros del buscador
function getSearch( $busqueda, $offset = -1 ) {
	if ($busqueda != '') {
		$busqueda = trim($busqueda);
		$connection = connectDB();
		$tabla = 'posts';

		$query  = "SELECT * FROM ".$tabla." WHERE (post_titulo LIKE '%" .$busqueda. "%') OR (post_contenido LIKE '%" .$busqueda. "%') OR (post_categoria LIKE '%" .$busqueda. "%')";
		if ( $offset != -1 ) {
		$query  .= " LIMIT " .$offset." ";
		}
		
		$result = mysqli_query($connection, $query);

		closeDataBase( $connection );

		if ( $result->num_rows == 0 ) {
			getTemplate( '404' );
			return;
		} else {

			while ($row = $result->fetch_array()) {
					$loop[] = $row;
				}

		}
	
	return $loop;
	}
}


/*
 * PAGINATION
*/

//Crea la paginación y los links de acuerdo a la cantidad de post dividido la cantidad a mostrar por pagina
function getPagination( $categoria, $postPerPage ) {
	$posts = getPosts( $categoria );
	$totalPost = count($posts);
	$cantPages = ceil($totalPost / $postPerPage);//devuelve valor redondeado 

	if ( $cantPages < 2 || $posts == null ) {
		return;
	}

	$data = array(
		'numberPages' => $cantPages,
		'categoria'   => $categoria,
		'postPerPage' => $postPerPage,
	);

	getTemplate( 'pagination' ,$data );

}

//Crea la paginación y los links de acuerdo a la cantidad de post dividido la cantidad a mostrar por pagina PARA BUSQUEDA
function getPaginationSearch ( $busqueda, $postPerPage ) {
	$loop = getSearch( $busqueda );
	$totalPost = count($loop);
	$cantPages = ceil($totalPost / $postPerPage);//devuelve valor redondeado 

	if ( $cantPages < 2 || $busqueda == null ) {
		return;
	}

	$data = array(
		'numberPages' => $cantPages,
		'categoria'   => 'buscar',
		'postPerPage' => $postPerPage,
	);
	
	getTemplate( 'pagination', $data );
}

/*
 * POST INDIVIDUALES
*/

//busca el post en general en base a url y recoge los datos para pasar al template
function getPost ( $url ) {
	$connection = connectDB();
	$fecha_actual = date("Y-m-d");
	$tabla = 'posts';

	$query  = "SELECT * FROM " .$tabla. " WHERE post_url='".$url."' LIMIT 1 ";
	$result = mysqli_query($connection, $query);

	closeDataBase( $connection );

	if ( $result->num_rows == 0 ) {
		$singlePost = null;
	} else {

		$singlePost = mysqli_fetch_array($result);

	}

	return $singlePost;

}

//busca el post mediante post type y url recoge los datos para pasar al template
function getPostExtended ( $url, $postType ) {
	$connection = connectDB();
	$fecha_actual = date("Y-m-d");
	$tabla = 'posts';

	$query  = "SELECT * FROM " .$tabla. " WHERE post_url='".$url."' AND post_type='".$postType."' LIMIT 1 ";
	$result = mysqli_query($connection, $query);

	closeDataBase( $connection );

	if ( $result->num_rows == 0 ) {
		$singlePost = null;
	} else {

		$singlePost = mysqli_fetch_array($result);

	}

	return $singlePost;

}

/*
 * SLIDERS
 */

//busca el slider en base de datos de acuerdo a su 'ubicacion' pasada
function getSliders( $slider ) {

	$connection = connectDB();
	$tabla = 'sliders';
	$query  = "SELECT * FROM " .$tabla. " WHERE slider_ubicacion='".$slider."' ORDER by slider_orden asc";
		
	$result = mysqli_query($connection, $query);
	
	if ( $result->num_rows == 0 ) {
		echo '<div></div>';
	} else {

		while ( $row = $result->fetch_array(MYSQLI_ASSOC) ) {
			$dataSlider[] = $row;
		}
		
		//selecciona el template html y le pasa la info
		getTemplate( 'sliders', $dataSlider);

	}//else
	closeDataBase( $connection );
} //getSliders()


/*
 * POPUPS
*/

function openPopUp ( $page ) {
	
	if ( $page == 'inicio' ) {

		$connection = connectDB();
		$tabla = 'options';
		$option_name = 'popupValue';
		$query  = "SELECT * FROM " .$tabla. " WHERE options_name = '{$option_name}' LIMIT 1";
		$result =  mysqli_query($connection, $query);
		
		
		if ($result->num_rows == 0) {
			return;
		}
		
		$data = mysqli_fetch_array($result);
		
		if ($data[2] == '1') {
			getTemplate( 'popup' );
		} else {
			return;
		}
	}
}//funcion openPopUp

function showPopupImg () {
	
	$connection = connectDB();
	$tabla = 'medios';
	$post_type = 'promo';
	$query  = 'SELECT * FROM ' .$tabla. ' WHERE medio_post_type = "'.$post_type.'" order by medio_id desc LIMIT 1';

	$result =  mysqli_query($connection, $query);
	$data = mysqli_fetch_array($result);
	$urlPoup = $data[3];
	
	mysqli_close($connection);
	if ( $urlPoup == NULL ) {
		echo MAINSURL . '/assets/images/popupdefault.png';
	} else {
		echo UPLOADSURL . '/' . $urlPoup;
	}
}

//busca el url si existe
function getUrlPromo() {
	$connection = connectDB();
	$tabla = 'options';
	$option_name = 'urlPopup';

	$query  = "SELECT * FROM " .$tabla. " WHERE options_name = '{$option_name}' LIMIT 1";
	$result =  mysqli_query($connection, $query);
	
	closeDataBase($connection);

	if ($result->num_rows == 0) {
		return '#';
	}
	
	$data = mysqli_fetch_array($result);
	
	if ($data[2] == '') {
		return '#';
	} else {
		return $data[2];
	}

	closeDataBase($connection);
}