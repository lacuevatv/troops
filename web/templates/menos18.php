<?php 
	$categoria = $data['post_url'];
	$template = $data['post_categoria'];//menos18 o mas18
	$paquetes = getPostsExtended( 'paquete', $categoria );

?>
<section class="lugar-section">
	<div class="paquetes-wrapper">
		<div class="container">
			
			<!--<img src="<?php echo MAINSURL; ?>/assets/images/temp/bariloche-fotos.jpg" class="image-responsive">-->
			<ul class="paquetes">
		<?php 
			for ($i=0; $i < count($paquetes); $i++) { ?>
				<li class="paquetes-item">
					<article id="<?php echo $paquetes[$i]['post_url']; ?>" class="paquete paquete-menos18">

						<img src="<?php echo UPLOADSURL . '/' . $paquetes[$i]['post_imagen']; ?>" class="paquete-imagen">	

						<div class="paquete-info">
							<h1>
								<?php echo $paquetes[$i]['post_titulo']; ?>
							</h1>
							<div>
								<?php echo $paquetes[$i]['post_contenido']; ?>
							</div>
						</div>

						<div class="paquete-resumen">
							<p>
								<?php echo $paquetes[$i]['post_resumen']; ?>
							</p>
						</div>

						<ul class="paquete-botones">
							<li>
								<a href="<?php echo UPLOADSFILE . '/' . $paquetes[$i]['post_file']; ?>" title="Descargar detalles" target="_blank">
									Descargar PDF
								</a>
							</li>

							<li>
								<button class="paquete-btn-info">
									Más info
								</button>
							</li>

							<li>
								<button class="paquete-btn-galeria">
									Ver galería
								</button>
							</li>
						</ul>
						

					<?php if ($paquetes[$i]['post_imagenesGal'] != '') : ?>
						<ul class="paquete-lista-imagenes">
					<?php 
						$imagenes = unserialize($paquetes[$i]['post_imagenesGal']);
						for ($a=0; $a < count($imagenes); $a++) {
							echo '<li>'.$imagenes[$a].'</li>';
						}
					?>
						</ul>
					<?php endif; ?>

					</article>
				</li>
				
		<?php }
			?>
			</ul>

		</div>
	</div>
</section>
