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

echo 'main';

include 'footer.php';