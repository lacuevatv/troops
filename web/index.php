<?php
/*
 * Sitio web: TROOPS
 * @LaCueva.tv
 * Since 1.0
 *
*/
require_once 'inc/functions.php';

global $pageActual;
$pageActual = pageActual( cleanUri() );

include 'header.php';

?>

<div style="margin: 150px auto;">
	<h1>CONTENIDO PRINCIPAL</h1>
	<h2>titulo2</h2>
	<h3>titulo3</h3>
	<p>
		Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut minim veniam.
	</p>
	<p>
		Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
	</p>
	<a href="#">ver mas</a>
</div>


<?php
include 'footer.php';