<!-- contacto -->
<section id="contacto" class="contact-section contact-section-tours">
	<span class="form-deco-top"></span>

	<div class="inner-container col-flex">
		
		<?php if ( $data == 'menos18' ) : ?>

		<div class="form-wrapper-tours animation-element slide-up">
			<h2 class="titulo-formulario-tours">
				<span>Pedí tu reunión Troops acá</span>
			</h2>
			
			<form method="POST" id="contact-form-tour-menos" name="contact-form-tourmenos" class="formulario">
				<input type="hidden" name="page" value="<?php global $pageActual; echo $pageActual; ?>">

				<div class="form-group">
					<label for="school">Nombre del colegio</label>
					<input type="text" id="school" name="school" placeholder="Nombre del colegio">
				</div>

				<div class="form-group">
					<label for="trip-year">Año de viaje</label>
					<input type="number" id="trip-year" name="trip-year" placeholder="Año de viaje">
				</div>

				<div class="form-group">
					<label for="number-students">Cantidad de Alumnos</label>
					<input type="number" id="number-students" name="number-students" placeholder="Cantidad de Alumnos">
				</div>
				
				<div class="form-group">
					<label for="name">Tu nombre y apellido</label>
					<input type="text" id="name" name="name" placeholder="Tu nombre y apellido">
				</div>

				<div class="form-group">
					<label for="charge">Sos alumno/padre/madre/otro</label>
					<input type="text" id="charge" name="charge" placeholder="Sos alumno/padre/madre/otro">
				</div>

				<div class="form-group">
					<label for="telephone">Teléfono movil</label>
					<input type="number" id="telephone" name="telephone" placeholder="Teléfono movil" required>	
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
		
		<?php else :
		global $pageActual;
		function renamePageActual ($slug) {
			switch ($slug) {
				case 'las-lenas':
					echo 'Las Leñas';
					break;
				
				case 'cancun':
					echo 'Cancún';
					break;
				case 'tematicos':
					return 'Temáticos';
					break;
			}
		}
		?>

		<div class="form-wrapper-tours animation-element slide-up">
			<h2 class="titulo-formulario-tours">
				<span>Pedí tu reunión Troops acá</span>
			</h2>
			
			<form method="POST" id="contact-form-tour-mas" name="contact-form-tourmas" class="formulario">
				<input type="hidden" name="page" value="<?php echo renamePageActual($pageActual); ?>">
				
				<div class="form-group">
					<label for="name">Nombre y apellido</label>
					<input type="text" id="name" name="name" placeholder="Tu nombre y apellido">
				</div>

				<div class="form-group">
					<label for="telephone">Teléfono</label>
					<input type="number" id="telephone" name="telephone" placeholder="Teléfono movil" required>	
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

		<?php endif; ?>

		<div class="image-form animation-element slide-up">
			
			<?php
			

			global $pageActual;
			switch ($pageActual) {
				case 'floripa':
				case 'cancun':
				case 'porto-seguro':
					$imagenValijas = MAINSURL . '/assets/images/valijas-porto-seguro.png';
					if ( dispositivo() != 'pc' ) {
						$imagenValijas = MAINSURL . '/assets/images/valijas-porto-seguro768.png';
					}
					break;
				
				default:
					$imagenValijas = MAINSURL . '/assets/images/valijas.png';
					if ( dispositivo() != 'pc' ) {
						$imagenValijas = MAINSURL . '/assets/images/valijas768.png';
					}
					break;
			}
			
			
			?>

			<img class="image-responsive" src="<?php echo $imagenValijas; ?>">
			<span class="form-deco-bottom"></span>

		</div>

	</div>	
</section><!-- //#contacto -->