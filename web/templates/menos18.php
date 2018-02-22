<?php 
	$categoria = $data['post_url'];
	$template = $data['post_categoria'];//menos18 o mas18
	$paquetes = getPostsExtended( 'paquete', $categoria );

?>
<section class="lugar-section">
	<div class="paquetes-wrapper">
		<div class="background-more-info"></div>
		<div class="container">

			<ul class="paquetes-menos18">
				<span class="deco-paquetes-top-right"></span>
		<?php 
			for ($i=0; $i < count($paquetes); $i++) { ?>
				<li>
					<article id="<?php echo $paquetes[$i]['post_url']; ?>" class="paquete-menos18">
						<figure class="paquete-imagen">
							<img src="<?php echo UPLOADSURL . '/' . $paquetes[$i]['post_imagen']; ?>">	
						</figure>
						<div class="paquete-hover">

							<div class="paquete-resumen">
								<p>
									<?php echo $paquetes[$i]['post_resumen']; ?>
								</p>
							</div>

							<ul class="paquete-botones">
								<li>
									<a href="<?php echo UPLOADSFILE . '/' . $paquetes[$i]['post_file']; ?>" title="Descargar detalles" target="_blank" class="paquete-btn-pdf">
										<span class="icon-paquete-boton icon-paquete-boton-pdf"></span>
										<span class="texto-paquete-btn">
											Descargar PDF
										</span>
									</a>
								</li>

								<li>
									<button class="paquete-btn-info">
										<span class="icon-paquete-boton icon-paquete-boton-info"></span>
										<span class="texto-paquete-btn">
											Más info
										</span>
									</button>
								</li>

								<li>
									<button class="paquete-btn-galeria">
										<span class="icon-paquete-boton icon-paquete-boton-galeria"></span>
										<span class="texto-paquete-btn">
											Ver galería
										</span>
									</button>
								</li>
							</ul>

						</div>
						
						<div class="paquete-info">
							<h1>
								<?php echo $paquetes[$i]['post_titulo']; ?>
							</h1>
							<div>
								<?php echo $paquetes[$i]['post_contenido']; ?>
							</div>
						</div>

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
