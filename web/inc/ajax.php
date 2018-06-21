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
require("class.phpmailer.php");
require("class.smtp.php");

//chequea si es peticion de ajax y ejecuta la funcion
if( isAjax() ) {
	$function = isset($_POST['function']) ? $_POST['function'] : '';

	switch ( $function ) {
		case 'contact-home':

			// Valores enviados desde el formulario
			if ( !isset($_POST['email']) || !isset($_POST['msj']) ) {
			    die ('Es necesario completar todos los datos del formulario');
			}

			$page = isset($_POST['page']) ? $_POST['page'] : 'inicio';
			$nombre = isset($_POST['name']) ? $_POST['name'] : '';
			$telephone = isset($_POST['telephone']) ? $_POST['telephone'] : '';
			$email = isset($_POST['email']) ? $_POST['email'] : '';
			$msj = isset($_POST['msj']) ? $_POST['msj'] : '';

			$mensaje = 'Nombre: '. $nombre . '<br> Teléfono: '. $telephone . '<br> Email: '. $email . '<br> Mensaje: ' . $msj .'<br>';

			$asunto = 'Contacto desde la página - ' . $page;
			// Email donde se enviaran los datos cargados en el formulario de contacto
			$emailDestino = EMAILFORMULARIO;

			
			enviarFormulario( $emailDestino , $asunto, $mensaje, $nombre, $email);

		break;


		case 'contact-tour-menos':
			// Valores enviados desde el formulario
			if ( !isset($_POST['email']) || !isset($_POST['telephone']) ) {
			    die ('Es necesario completar todos los datos del formulario');
			}

			$page = isset($_POST['page']) ? $_POST['page'] : 'inicio';
			$escuela = isset($_POST['school']) ? $_POST['school'] : 'inicio';
			$tripYear = isset($_POST['trip-year']) ? $_POST['trip-year'] : 'inicio';
			$cantAlumnos = isset($_POST['number-students']) ? $_POST['number-students'] : 'inicio';
			$nombre = isset($_POST['name']) ? $_POST['name'] : '';
			$cargo = isset($_POST['charge']) ? $_POST['charge'] : 'inicio';
			$telephone = isset($_POST['telephone']) ? $_POST['telephone'] : '';
			$email = isset($_POST['email']) ? $_POST['email'] : '';

			$mensaje = 'Colegio: '. $escuela . '<br> Año de viaje: '. $tripYear . '<br> Cant. de Alumnos: '. $cantAlumnos . '<br> Nombre: '. $nombre . '<br> Cargo: ' . $cargo .'<br>Teléfono: ' . $telephone . '<br>Email: '.$email. ' <br>';

			$asunto = 'Contacto desde la página - ' . $page;
			// Email donde se enviaran los datos cargados en el formulario de contacto
			$emailDestino = EMAILFORMULARIO;

			
			enviarFormulario( $emailDestino , $asunto, $mensaje, $nombre, $email);
		break;

		case 'contact-tour-mas':
			// Valores enviados desde el formulario
			if ( !isset($_POST['email']) || !isset($_POST['telephone']) ) {
			    die ('Es necesario completar todos los datos del formulario');
			}

			$page = isset($_POST['page']) ? $_POST['page'] : 'más 18';
			$nombre = isset($_POST['name']) ? $_POST['name'] : '';
			$telephone = isset($_POST['telephone']) ? $_POST['telephone'] : '';
			$email = isset($_POST['email']) ? $_POST['email'] : '';
			$msj = isset($_POST['msj']) ? $_POST['msj'] : '';

			$mensaje = 'Nombre: '. $nombre . '<br> Teléfono: '. $telephone . '<br> Destino: '. $page . '<br> Email: '. $email . '<br> Mensaje: ' . $msj .'<br>';

			$asunto = 'Contacto desde la página - ' . $page;
			// Email donde se enviaran los datos cargados en el formulario de contacto
			$emailDestino = EMAILFORMULARIO;

			
			enviarFormulario( $emailDestino , $asunto, $mensaje, $nombre, $email);
		break;
	}

	
//sino es peticion ajax se cancela
} else{
    throw new Exception("Error Processing Request", 1);   
}

function enviarFormulario( $emailDestino , $asunto, $mensaje, $nombre, $email) {
	// Datos de la cuenta de correo utilizada para enviar vía SMTP
			$smtpHost = 'mail.troops.tur.ar';  // Dominio alternativo brindado en el email de alta 
			$smtpUsuario = 'info@troops.tur.ar';  // Mi cuenta de correo
			$smtpClave = 'Larabianca2014';  // Mi contraseña

			$mail = new PHPMailer();
			$mail->IsSMTP();
			$mail->SMTPAuth = true;
			$mail->Port = 587; 
			$mail->IsHTML(true); 
			$mail->CharSet = 'utf-8';

			$mail->Host = $smtpHost; 
			$mail->Username = $smtpUsuario; 
			$mail->Password = $smtpClave;

			$mail->From = $smtpUsuario; // Email desde donde envío el correo.
			$mail->FromName = $nombre;
			$mail->AddAddress($emailDestino); // Esta es la dirección a donde enviamos los datos del formulario
			$mail->AddReplyTo($email); // Esto es para que al recibir el correo y poner Responder, lo haga a la cuenta del visitante. 
			$mail->Subject = $asunto; // Este es el titulo del email.
			$mensajeHtml = nl2br($mensaje);
			$mail->Body = "{$mensajeHtml} <br><br>Formulario enviado desde la página web Troops.tur.ar<br />"; // Texto del email en formato HTML
			$mail->AltBody = "{$mensaje} \n\n Formulario enviado desde la página web Troops.tur.ar"; // Texto sin formato HTML
			// FIN - VALORES A MODIFICAR //

			$mail->SMTPOptions = array(
			    'ssl' => array(
			        'verify_peer' => false,
			        'verify_peer_name' => false,
			        'allow_self_signed' => true
			    )
			);

			$estadoEnvio = $mail->Send(); 
			if($estadoEnvio){
			    echo "El correo fue enviado correctamente.";
			} else {
			    echo "Ocurrió un error inesperado.";
			}
}