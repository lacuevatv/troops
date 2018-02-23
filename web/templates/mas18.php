<?php 
	$categoria = $data['post_url'];
	$template = $data['post_categoria'];//menos18 o mas18
	$paquetes = getPostsExtended( 'paquete', $categoria );
?>
<section class="lugar-section">
	<div class="paquetes-wrapper">
		<div class="container">
			<ul class="paquetes-mas18">
		<?php 
			for ($i=0; $i < count($paquetes); $i++) { 
				$detalles = unserialize($paquetes[$i]['post_detalle']);
				$mapa = unserialize($paquetes[$i]['post_mapa']); 
				?>
				
				<li>
					<article id="<?php echo $paquetes[$i]['post_url']; ?>" class="paquete-mas18">
						<header>
							<div class="galeria-wrapper"></div>
						</header>						
						<section>
							
							<div class="galeria-wrapper">
								<span class="deco-paquetes-top-right"></span>
								<img src="<?php echo MAINSURL; ?>/assets/images/temp/reflaslenas.jpg" class="image-responsive">
							</div>

							<div class="detalles-wrapper">
								<div class="detalle1">
									<table>
										<tr>
											<td class="color-destacado">
												Localización:
											</td>
											<td class="info">
												<?php echo $detalles['loc']; ?>
											</td>
										</tr>

										<tr>
											<td class="color-destacado">
												Asientos disponible:
											</td>
											<td class="info">
												<?php echo $detalles['asientos']; ?>
											</td>
										</tr>

										<tr>
											<td class="color-destacado">
												Precio:
											</td>
											<td class="info">
												<?php echo $detalles['precio']; ?>
											</td>
										</tr>

										<tr>
											<td class="color-destacado">
												Días:
											</td>
											<td class="info">
												<?php echo $detalles['dias']; ?>
											</td>
										</tr>

										<tr>
											<td class="color-destacado">
												Descuento:
											</td>
											<td class="info">
												<?php echo $detalles['descuento']; ?>
											</td>
										</tr>
									</table>
								</div>
								<div class="detalle2">
									<div class="detalle-header">
										<div>
											<h1>
												<?php echo $paquetes[$i]['post_titulo']; ?>
											</h1>
											<h5>
												<?php echo $paquetes[$i]['post_resumen']; ?>
											</h5>
										</div>
										<div class="precio-archivo">
											<a href="<?php echo $detalles['avion-aterriza']; ?>" target="_blank">
												Descargar PDF
											</a>
											<h4>
												<?php echo $detalles['precio']; ?>
											</h4>
										</div>
									</div>

									<div class="aereos-wrapper">
										<div class="viaje">
											<p>
												<?php echo $detalles['ida']; ?>
											</p>
											<p>
												<?php echo $detalles['idafecha']; ?>
											</p>
										</div>
										<div class="avion">
											<p class="salida">
												<span class="icon-avion-in"></span>
												SALIDA<br>
												<?php echo $detalles['avion-despegue']; ?>
											</p>
											<div class="separador-vertical"></div>
											<p class="llegada">
												<span class="icon-avion-out"></span>
												LLEGADA<br>
												<?php echo $detalles['avion-aterriza']; ?>
											</p>	
										</div>

										<div class="separador-horizontal"></div>

										<div class="viaje">
											<p>
												<?php echo $detalles['regreso']; ?>
											</p>
											<p>
												<?php echo $detalles['regresofecha']; ?>
											</p>
										</div>

										<div class="avion">
											<p class="salida">
												<span class="icon-avion-in"></span>
												SALIDA<br>
												<?php echo $detalles['avion-despegue2']; ?>
											</p>
											<div class="separador"></div>
											<p class="llegada">
												<span class="icon-avion-out"></span>
												LLEGADA<br>
												<?php echo $detalles['avion-aterriza2']; ?>
											</p>
										</div>
									</div>

								</div>
								
							</div>
							
							<div id="contenedor-mapa"></div>
							

							<div class="info-gral-wrapper">
								<h2 class="section-title">
									Información General
								</h2>

								<h5 class="section-sub-title">
									<span class="deco-line"></span>
									<span>
										<?php echo $detalles['loc']; ?>
									</span>
								</h5>

								<div class="contenido-paquete">

									<?php echo $paquetes[$i]['post_contenido']; ?>

								</div>
							</div>

						</section>

					</article>
					 
					<script>
					function initMap() {
						var latE = <?php echo $mapa[0]; ?>;
						var latS = <?php echo $mapa[1]; ?>;
					    var uluru = {lat: latE, lng: latS};
					    //var uluru = {lat: -32.9230013, lng: -60.6664967};
					    var map = new google.maps.Map(document.getElementById('contenedor-mapa'), {
					      zoom: 16,
					      center: uluru,
					    });
					    var marker = new google.maps.Marker({
					      position: uluru,
					      map: map,
					      icon: baseUrl + '/assets/images/google-marker.png'
					    });
					  }
					</script>

				</li>
				
		<?php }
			?>
			</ul>

		</div>
	</div>
</section>
