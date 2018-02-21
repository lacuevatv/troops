<div class="inner-container col-flex">
	
	<div class="form-wrapper-tours">
		<h2 class="titulo-formulario-tours">
			<span>Pedí tu reunión Troops acá</span>
		</h2>
		
		<form method="POST" id="contact-form-tour" name="contact-form-tour" class="formulario">

			<div class="form-group">
				<label for="name">Nombre del colegio</label>
				<input type="text" id="name" name="name" placeholder="Nombre del colegio">
			</div>

			<div class="form-group">
				<label for="name">Año de viaje</label>
				<input type="text" id="name" name="name" placeholder="Año de viaje">
			</div>

			<div class="form-group">
				<label for="name">Cantidad de Alumnos</label>
				<input type="text" id="name" name="name" placeholder="Cantidad de Alumnos">
			</div>
			
			<div class="form-group">
				<label for="name">Tu nombre y apellido</label>
				<input type="text" id="name" name="name" placeholder="Tu nombre y apellido">
			</div>

			<div class="form-group">
				<label for="name">Sos alumno/padre/madre/otro</label>
				<input type="text" id="name" name="name" placeholder="Sos alumno/padre/madre/otro">
			</div>

			<div class="form-group">
				<label for="telephone">Teléfono movil</label>
				<input type="number" id="telephone" name="telephone" placeholder="Teléfono movil">	
			</div>

			<div class="form-group">
				<label for="email">Email</label>
				<input type="email" id="email" name="email" required placeholder="E-mail">
			</div>

			<div class="form-group-col-2">
				<span class="url-form">troops.tur.ar</span>
				<input type="submit" value="Enviar" class="btn-form">	
			</div>

		</form>

	</div><!-- //.form-wrapper -->
	
	<div class="image-form">
		
		<?php
		$imagenValijas = MAINSURL . '/assets/images/valijas.png';
		if ( dispositivo() != 'pc' ) {
			$imagenValijas = MAINSURL . '/assets/images/valijas768.png';
		}
		?>

		<img class="image-responsive" src="<?php echo $imagenValijas; ?>">
		<span class="form-deco-bottom"></span>

	</div>

</div>	