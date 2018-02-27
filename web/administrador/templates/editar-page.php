<?php
/*
 * Editar noticia / Nueva noticia
 * Edita o modifica las noticias
 * Since 3.0
 * 
*/
global $userStatus;
if ($userStatus != '0' && $userStatus != '1' ) {
	echo 'No tiene permisos para ver esta sección';
  	
  	exit;
}
require_once("inc/functions.php");
load_module( 'noticias' );
//recupera slug a buscar
global $slug;
if ($slug != '') {
	//busca en la base de datos
	$dataPost = searchPost ( $slug );
	
}

$postID       = isset($dataPost['post_id']) ? $dataPost['post_id'] : '';
$titulo       = isset($dataPost['titulo']) ? $dataPost['titulo'] : '';
$url          = isset($dataPost['url']) ? $dataPost['url'] : '';
$imgDestacada = isset($dataPost['imgDestacada']) ? $dataPost['imgDestacada'] : '';
$resumen      = isset($dataPost['resumen']) ? $dataPost['resumen']:'';
$contenido    = isset($dataPost['contenido']) ? $dataPost['contenido'] : '';
$video        =  isset($dataPost['video']) ? $dataPost['video'] : '';
$categoria    = isset($dataPost['categoria']) ? $dataPost['categoria'] : '';
$galeria      = isset($dataPost['galeria']) ? $dataPost['galeria'] : '';
$imgGaleria   = isset($dataPost['imgGaleria']) ? $dataPost['imgGaleria'] : array();
$linkExterno  = isset($dataPost['linkExterno']) ? $dataPost['linkExterno'] : '';
$fechaAgenda  = isset($dataPost['fechaAgenda']) ? $dataPost['fechaAgenda'] : '';
$fecha        = isset($dataPost['fecha']) ? $dataPost['fecha'] : '';
$dia          = isset($dataPost['dia']) ? $dataPost['dia'] : '';
$mes          = isset($dataPost['mes']) ? $dataPost['mes'] : '';
$year         = isset($dataPost['year']) ? $dataPost['year'] : '';
$status       = isset($dataPost['status']) ? $dataPost['status'] : 'new';


?>
<!---------- editar noticias ---------------->
<div class="contenido-modulo">
	<h1 class="titulo-modulo">
		<?php if ( $slug == '' ) {
			echo 'Agregar nuevo';
		} else {
			echo 'Editor';
		} ?>
	</h1>
	<div class="container">
		<form method="POST" id="editar-noticia-formulario" name="editar-noticia-formulario">		
		<input type="hidden" name="post_ID" value="<?php echo $postID; ?>">
		<input type="hidden" name="post_type" value="page">
			<div class="error-msj-wrapper">
				<ul class="error-msj-list">
					
				</ul>
			</div>
			
			<div class="row">
				<div class="col-70">
	<!------ TITULO DE LA NOTICIA ---------->
					<div class="form-group">
						<label for="post_title" class="larger-label">Título </label>
						<input id="post_title" name="post_title" class="larger-input" value="<?php echo $titulo; ?>">
						<?php if ( $titulo == '' ) { ?>
						<input type="hidden" name="new_post" value="true">
						<?php } else { ?>
						<input type="hidden" name="new_post" value="false">
						<?php } ?>
					</div>	
				</div><!-- // col -->
				<div class="col-30">
	<!------ PERSONALIZAR URL DE LA NOTICIA ---------->
					<div class="form-group">
						<label for="post_url">Personalizar Url </label>
						<input id="post_url" name="post_url" value="<?php echo $url; ?>">
					</div>
					<!------ FECHA DE LA NOTICIA ---------->
					<div class="form-group input-hidden-especial">
						<label for="post_date">Fecha Post</label>
						<input id="post_date" name="post_date" type="date" value="<?php echo $fecha?>">
					</div>
				</div>
			</div><!-- // row -->

			
			<div class="row">
				<div class="col-70">
	

					<div class="form-group">
						<label for="post_resumen" class="larger-label">Resumen</label>
						<textarea name="post_resumen"><?php echo $resumen; ?></textarea>
					</div>
				</div><!-- // col -->
	<!------ PUBLICAR LA NOTICIA ---------->	
				<div class="col-30">
					<div class="form-group">
						
						<?php if ($status != 'publicado') { ?>
							<input type="hidden" id="post_status" name="post_status" value="<?php echo $status; ?>">
							<button type="submit" name="submit_publish" class="btn btn-danger btn-lg btn-submit">Publicar</button>
						<?php } else { ?>
							<input type="hidden" id="post_status" name="post_status" value="<?php echo $status; ?>">
							<!--<p class="plublished">Publicado</p>-->
							<label for="change_status">Estado</label>
							<select id="change_status" name="change_status">
								<option value="publicado">PUBLICADO</option>
								<option value="borrador">borrador</option>
							</select>
						<?php } ?>
					</div>
				</div><!-- // col -->
				
			</div><!-- // row -->

			<div class="row">	
				<div class="col-70">
	<!------ RESUMEN DE LA NOTICIA ---------->
					<div class="form-group">
						<label for="post_contenido" class="larger-label">Contenido</label>
						<textarea class="page-contenido" name="post_contenido"><?php echo $contenido; ?></textarea>
					</div>	
	<!------ NUMERO TELEFONO ---------->
					

				</div><!-- // col -->

				<div class="col-30">
	<!------ IMAGEN DESTACADA DE LA NOTICIA ---------->
					<div id="imagen_destacada_wrapper" class="form-group">
						<label for="post_imagen" class="larger-label">Imagen Destacada </label>
						<input type="hidden" id="post_imagen" name="post_imagen" value="<?php echo $imgDestacada; ?>">
						<?php 
							if ( $imgDestacada == '' ) { ?>
								<div class="upload-post_imagen_btn_wrapper">
									<button type="button" id="upload-post_imagen_btn" class="btn btn-primary">Subir imagen</button>
									<p><small>La imagen debería ser por lo menos de 1440 px por 545px</small></p>
								</div>
						<?php } else { ?>
							<img src="<?php echo UPLOADSURLIMAGES .'/'. $imgDestacada; ?>" class="img-responsive post_imagen">
								<div class="del-post_imagen_wrapper"><button type="button" id="del-post_imagen" class="btn btn-danger">Borrar imagen</button></div>
						<?php } ?>
						
					</div>


				</div><!-- // col -->
				
			</div><!-- // row -->

	

			<div class="row">	
				<div class="col-70">
					
					
			   	</div><!-- // col -->
			   	
			</div><!-- // row -->
			<hr>
		   	<div class="row">	
				<div class="col">
				   	<div class="form-group save-button-right">
				   		<button type="submit" name="submit_save" class="btn btn-primary btn-submit">Guardar Cambios</button>
				   	</div>
				</div><!-- // col -->
			</div><!-- // row -->  
		</form>	
	</div><!-- // container gral modulo -->
</div>
<div id="dialog">
	
</div>
<!-- botones del modulo -->
<footer class="footer-modulo container">
    <a type="button" href="index.php" class="btn">Volver al inicio</a>
    <a type="button" href="index.php?admin=pages" class="btn">Volver a pages</a>
</footer>
	  