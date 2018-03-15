<?php
/*
 * Editar noticia / Nueva noticia
 * Edita o modifica las noticias
 * Since 3.0
 * 
*/
require_once("inc/functions.php");
load_module( 'noticias' );
//recupera slug a buscar
global $slug;
if ($slug != '') {
	//busca en la base de datos
	searchPost ( $slug );
	//recupera los datos
	global $dataPost;
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
$fecha        = isset($dataPost['fecha']) ? $dataPost['fecha'] : '';
$dia          = isset($dataPost['dia']) ? $dataPost['dia'] : '';
$mes          = isset($dataPost['mes']) ? $dataPost['mes'] : '';
$year         = isset($dataPost['year']) ? $dataPost['year'] : '';
$status       = isset($dataPost['status']) ? $dataPost['status'] : 'new';
$detalles     = isset($dataPost['detalles']) ? unserialize($dataPost['detalles']) : '';
$mapa         = isset($dataPost['mapa']) ? unserialize($dataPost['mapa']) : '';
$archivo      = isset($dataPost['archivo']) ? $dataPost['archivo'] : '';


?>
<!---------- editar noticias ---------------->
<div class="contenido-modulo">
	<h1 class="titulo-modulo">
		<?php if ( $slug == '' ) {
		echo 'Agregar nuevo paquete';
	} else {
		echo 'Editar Paquete';
	} ?>
	</h1>
	<div class="container">
		<form method="POST" id="editar-noticia-formulario" name="editar-noticia-formulario">		
		<input type="hidden" name="post_ID" value="<?php echo $postID; ?>">
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
	<!------ CATEGORIAS DE LA NOTICIA ---------->
				<div class="col-30">
					<div class="form-group">
						<label for="post_categoria">Categoría </label>
						<select name="post_categoria" id="post_categoria">
							<?php 
								global $categorias;

								for ($i=0; $i < count($categorias); $i++) {
									echo '<option value="'.$categorias[$i]['slug'].'"';
									if ( $categorias[$i]['slug'] == $categoria ) {
										echo ' selected="selected"';
									}
									echo '>'.$categorias[$i]['nombre'].'</option>';
								}
							?>
						</select>
					</div>
				</div><!-- // col -->
			</div><!-- // row -->

			
			<div class="row">
				<div class="col-50">
	<!------ PERSONALIZAR URL DE LA NOTICIA ---------->
					<div class="form-group">
						<label for="post_url">Personalizar Url </label>
						<input id="post_url" name="post_url" value="<?php echo $url; ?>">
					</div>
				</div><!-- // col -->
	<!------ PUBLICAR LA NOTICIA ---------->	
				<div class="col-20">
					<div class="form-group">
						
						<?php if ($status != 'publicado') { ?>
							<input type="hidden" id="post_status" name="post_status" value="<?php echo $status; ?>">
							<button type="submit" name="submit_publish" class="btn btn-danger btn-lg btn-submit">Publicar</button>
						<?php } else { ?>
							<input type="hidden" id="post_status" name="post_status" value="<?php echo $status; ?>">
							<!--<p class="plublished">Publicado</p>-->
							<select id="change_status" name="change_status">
								<option value="publicado">PUBLICADO</option>
								<option value="borrador">borrador</option>
							</select>
						<?php } ?>
					</div>
				</div><!-- // col -->
				<div class="col-30">
	<!------ FECHA DE LA NOTICIA ---------->
					<div class="form-group">
						<label for="post_date">Fecha Post</label>
						<input id="post_date" name="post_date" type="date" value="<?php echo $fecha?>">
					</div>
				</div><!-- // col -->
			</div><!-- // row -->

			<div class="row">	
				<div class="col-70">
	<!------ RESUMEN DE LA NOTICIA ---------->
					<div class="form-group">
						<label for="post_resumen" class="larger-label">Resumen</label>
						<textarea id="post_resumen" name="post_resumen"><?php echo $resumen; ?></textarea>
					</div>

				</div><!-- // col -->

				<div class="col-30">
	<!------ IMAGEN DESTACADA DE LA NOTICIA ---------->
					<div id="imagen_destacada_wrapper" class="form-group">
						<label for="post_imagen" class="larger-label">Imagen Destacada</label>
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

	<!------ CONTENIDO DE LA NOTICIA ---------->
				<div class="form-group">
					<label for="post_contenido" class="larger-label">Contenido</label>
					<textarea id="post_contenido" name="post_contenido"><?php echo $contenido; ?></textarea>
				</div>

			<div class="row">	
				<div class="col">

					<div id="accordion">
						<!--<h3>Video destacado</h3>
						<div>
	<!------ VIDEO DESTACADO DE LA NOTICIA -----
							<div class="form-group">
								<label for="post_video">Url del video
								<small>Copiar url de Youtube</small> </label>
								<input id="post_video" name="post_video" value="<?php echo $video; ?>">
							</div>
						</div>-->

					<?php if ( $categoria == 'las-lenas' || $categoria == 'cancun' || $categoria == 'tematicos' ) : ?>
						<h3>Mapa</h3>
						<div>
							<div class="row">
								<div class="col-50">
									<div class="form-group">
										<label for="map_latitud">Map, latitud:</label>
										<input type="text" name="map_latitud" value="<?php echo $mapa[0]; ?>">
									</div>
								</div>
								<div class="col-50">
									<div class="form-group">
										<label for="map_longitud">Map, longitud</label>
										<input type="text" name="map_longitud" value="<?php echo $mapa[1]; ?>">
									</div>
								</div>
							</div>
						</div>

					<?php endif; ?>


					<?php if ( $categoria == 'las-lenas' || $categoria == 'cancun' || $categoria == 'tematicos' ) : ?>
						<h3>Detalles</h3>
						<div>
							<div class="row">
								<div class="col-20">
									<div class="form-group">
										<label for="detalles_loc">Localización</label>
										<input type="text" name="detalles_loc" value="<?php echo $detalles[0]; ?>">
									</div>
								</div>
								<div class="col-20">
									<div class="form-group">
										<label for="detalles_asientos">Asientos disponible</label>
										<input type="text" name="detalles_asientos" value="<?php echo $detalles[1]; ?>">
									</div>
								</div>
								<div class="col-20">
									<div class="form-group">
										<label for="detalles_precio">Precio</label>
										<input type="text" name="detalles_precio" value="<?php echo $detalles[2]; ?>">
									</div>
								</div>
								<div class="col-20">
									<div class="form-group">
										<label for="detalles_dias">Días</label>
										<input type="text" name="detalles_dias" value="<?php echo $detalles[3]; ?>">
									</div>
								</div>
								<div class="col-20">
									<div class="form-group">
										<label for="detalles_descuento">Descuento</label>
										<input type="text" name="detalles_descuento" value="<?php echo $detalles[4]; ?>">
									</div>
								</div>
							</div><!-- //.row-->	
							<div class="row">
								<div class="col-20">
									<div class="form-group">
										<label for="detalles_ida">Ida</label>
										<input type="text" name="detalles_ida" value="<?php echo $detalles[5]; ?>">
									</div>
								</div>
								<div class="col-20">
									<div class="form-group">
										<label for="detalles_idafecha">Ida Fecha</label>
										<input type="text" name="detalles_idafecha" value="<?php echo $detalles[6]; ?>">
									</div>
								</div>
								<div class="col-20">
									<div class="form-group">
										<label for="detalles_aviondespegue">Avión despegue</label>
										<input type="text" name="detalles_aviondespegue" value="<?php echo $detalles[7]; ?>">
									</div>
								</div>
								<div class="col-20">
									<div class="form-group">
										<label for="detalles_avionaterriza">Avión Aterriza</label>
										<input type="text" name="detalles_avionaterriza" value="<?php echo $detalles[8]; ?>">
									</div>
								</div>
							</div><!-- //.row-->	
							<div class="row">
								<div class="col-20">
									<div class="form-group">
										<label for="detalles_regreso">Regreso</label>
										<input type="text" name="detalles_regreso" value="<?php echo $detalles[9]; ?>">
									</div>
								</div>
								<div class="col-20">
									<div class="form-group">
										<label for="detalles_regresofecha">Regreso Fecha</label>
										<input type="text" name="detalles_regresofecha" value="<?php echo $detalles[10]; ?>">
									</div>
								</div>
								<div class="col-20">
									<div class="form-group">
										<label for="detalles_aviondespegue2">Avión despegue</label>
										<input type="text" name="detalles_aviondespegue2" value="<?php echo $detalles[11]; ?>">
									</div>
								</div>
								<div class="col-20">
									<div class="form-group">
										<label for="detalles_avionaterriza2">Avión aterriza</label>
										<input type="text" name="detalles_avionaterriza2" value="<?php echo $detalles[12]; ?>">
									</div>
								</div>
								
							</div><!-- //.row-->	
						</div>
					<?php endif; ?>

						<h3>Galeria de imagenes</h3>
						<div>
	<!------ GALERIA DE IMAGENES DELA  NOTICIA ---------->
							<div class="row">
								<div class="col-50">
									<div class="form-group">
										<label class="larger-label">
											<input type="checkbox" name="post_galeria" value="true"<?php 
											if ( $galeria == 1 ) {
												echo 'checked';
											}
											?>>
											Activar Galería de imagenes
										</label>
									</div>
								</div>
								<div class="col-50">
									<button type="button" id="agregar_imagenes_galeria" class="btn btn-default">
										Agregar imágenes
									</button>
								</div>
								<div class="col">
									<p><small>Se pueden subir muchas imagenes a la vez, el tamaño  ideal es de 1440 x 545</small></p>
								</div>
							</div>
	<!------ IMAGENES DE LA GALERIA DE LA NOTICIA ---------->
							<ul class="galeria-imagenes-wrapper">
							<?php if ( count($imgGaleria) != 0 ) { 
								$item = 1;
								for ($i=0; $i < count($imgGaleria); $i++) { ?>

								<li>
									<input type="hidden" name="imgGaleriaItem" value="<?php echo $imgGaleria[$i]; ?>">
									<figure>
										<img src="<?php echo UPLOADSURLIMAGES . '/' . $imgGaleria[$i]; ?>" class="img-responsive">
										<span class="imgGaleriaItemOrden">
											<?php echo $item; ?>
										</span>
									</figure>
									<button class="btn btn-xs btn-danger imgGaleriaItemDelBTN">Borrar imagen</button>
								</li>

								<?php 
								$item++;
								}//for ?>
							<?php }//if ?>
							</ul>
						</div>
						<!------ ARCHIVO DESCARGAR ---------->
						<h3>Archivo de descarga</h3>
						<div>
							<p>
								Este es el archivo para descargar.
							</p>
							<div class="col">
							<?php if ( $archivo != '' ) : ?>
								<a id="archivo-descarga" href="<?php echo UPLOADSURLFILES . '/' . $archivo; ?>" target="_blank" class="btn" data-href="<?php echo $archivo; ?>">Ver archivo</a>
								<button type="button" class="btn btn-primary btn-cambiar-file">Cambiar archivo</button>
								<button type="button" class="btn btn-danger btn-delete-file">Borrar archivo</button>
							<?php else : ?>
								<button type="button" class="btn btn-primary btn-cambiar-file">Agregar archivo</button>
							<?php endif; ?>

							</div>
						</div>
					</div><!-- //#accordion-->	
				   	
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
    <a type="button" href="index.php?admin=noticias" class="btn">Volver a paquetes</a>
</footer>
	   
	