<?php
/*
 * Sitio web: TROOPS
 * @LaCueva.tv
 * Since 1.0
 * HEADER
*/
global $pageActual;



?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<title><?php echo SITETITLE; ?></title>

<!--favicon-->
    <link rel="apple-touch-icon" sizes="180x180" href="<?php echo MAINSURL; ?>/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="<?php echo MAINSURL; ?>/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="<?php echo MAINSURL; ?>/favicon-16x16.png">
    <link rel="manifest" href="<?php echo MAINSURL; ?>/site.webmanifest">
    <link rel="mask-icon" href="<?php echo MAINSURL; ?>/safari-pinned-tab.svg" color="#5bbad5">
    <meta name="msapplication-TileColor" content="#da532c">
    <meta name="theme-color" content="#ffffff">

<!-- SEO SECCTION -->
    <meta name="keywords" content="<?php echo METAKEYS; ?>">
    <meta name="description" content="<?php echo METADESCRIPTION; ?>">
    <link rel="canonical" href="<?php echo MAINSURL; ?>" />
    <meta property="og:locale" content="es_ES" />
    <meta property="og:type" content="website" />
    <meta property="og:title" content="<?php echo SITETITLE; ?>" />
    <meta property="og:description" content="" />
    <meta property="og:url" content="<?php echo MAINSURL; ?>" />
    <meta property="og:site_name" content="<?php echo SITETITLE; ?>" />
    <meta property="og:image" content="" />
    <meta name="twitter:card" content="summary" />
    <meta name="twitter:description" content="<?php echo METADESCRIPTION; ?>" />
    <meta name="twitter:title" content="<?php echo SITETITLE; ?>" />
    <meta name="twitter:image" content="" />
<!-- // SEO SECCTION -->

<!-- OWL -->
    <link href="<?php echo MAINSURL; ?>/assets/css/owl.carousel.min.css" rel="stylesheet">
<!-- Custom CSS -->
    <link href="<?php echo MAINSURL; ?>/assets/css/style.css?<?php echo VERSION; ?>" rel="stylesheet">

<!--- modernizr -->
    <script src="<?php echo MAINSURL; ?>/assets/js/modernizr-custom.js"></script>

</head>
<body>
<div class="wrapper-site" data-page-actual="<?php echo $pageActual; ?>">
<!--- header ---------------------->
    <?php
        openPopUp($pageActual);
    ?>
    <header class="main-header">

        <nav class="main-nav-wrapper">

            <div class="container main-nav-innner-wrapper">

                <a class="brand-name" href="<?php echo MAINSURL; ?>" title="<?php echo SITETITLE; ?>">
                    <img src="<?php echo MAINSURL; ?>/assets/images/logo.gif" alt="<?php echo SITETITLE; ?>">
                </a>

                <button class="toggle">
                    <span class="sr-only">Toggle</span>
                    <span class="tog1"></span>
                    <span class="tog2"></span>
                    <span class="tog3"></span>
                </button>
                
                

                <ul class="social-menu" role="menu">

                <?php if ( dispositivo () == 'pc' ) : ?>
                    <li role="menuitem">
                        <a href="https://api.whatsapp.com/send?phone=<?php echo WHATSAPP; ?>" target="_blank" class="icon-social icon-social-whatsapp">
                            <span class="whatsapp-menu">
                                <?php echo WHATSAPPTEXT; ?>
                            </span>
                        </a>
                    </li>

                <?php endif; ?>

                    <li role="menuitem">
                        <a href="<?php echo LINK_INSTAGRAM; ?>" target="_blank" class="icon-social icon-social-instagram">
                            <span class="sr-only">Instagram</span>
                        </a>
                    </li>
                    <li role="menuitem">
                        <a href="<?php echo LINK_FACEBOOK; ?>" target="_blank" class="icon-social icon-social-facebook">
                            <span class="sr-only">Facebook</span>
                        </a>
                    </li>
                    <li role="menuitem">
                        <a href="<?php echo LINK_VIMEO; ?>" target="_blank" class="icon-social icon-social-vimeo">
                            <span class="sr-only">Vimeo</span>
                        </a>
                    </li>
                    <li role="menuitem">
                        <a href="<?php echo LINK_YOUTUBE; ?>" target="_blank" class="icon-social icon-social-youtube">
                            <span class="sr-only">Youtube</span>
                        </a>
                    </li>
                    <li role="menuitem">
                        <a href="<?php echo LINK_TWITTER; ?>" target="_blank" class="icon-social icon-social-twitter">
                            <span class="sr-only">Titter</span>
                        </a>
                    </li>

                    <?php if ( dispositivo () != 'pc' ) : ?>
                    <li role="menuitem">
                        <a href="https://api.whatsapp.com/send?phone=<?php echo WHATSAPP; ?>" target="_blank" class="icon-social icon-social-whatsapp">
                            <span class="whatsapp-menu">
                                <?php echo WHATSAPPTEXT; ?>
                            </span>
                        </a>
                    </li>

                <?php endif; ?>

                </ul><!-- //.social-menu -->

            </div><!-- //.container -->

            <ul class="top-menu" role="menu">
                    <span class="close-menu"></span>
                    <li role="menuitem">
                        <a href="<?php echo MAINSURL; ?>" title="Inicio">
                            Home
                        </a>
                    </li>
                    <li role="menuitem">
                        <a href="<?php echo MAINSURL; ?>/#nosotros" title="Nosotros" class="scroll-down-link" data-href="nosotros">
                            Nosotros
                        </a>
                    </li>
                    <li role="menuitem">
                        <a href="<?php echo MAINSURL; ?>/#sociales" title="Sociales" class="scroll-down-link" data-href="sociales">
                            Sociales
                        </a>
                    </li>
                    <li role="menuitem">
                        <a href="<?php echo MAINSURL; ?>/#contacto" title="Contacto" class="scroll-down-link" data-href="contacto">
                            Contacto
                        </a>
                    </li>
                    <li role="menuitem">
                        <a href="<?php echo MAINSURL; ?>/#socios" title="Socios" class="scroll-down-link" data-href="socios">
                            Socios
                        </a>
                    </li>

                </ul><!-- //.top-menu -->

        </nav><!-- //.main-nav-wrapper -->

<!-- MAIN CONTENT HEADER -->
        <?php 
        

        if ( dispositivo () == 'pc' ) {
            
            $imagen = 'header-fondo-pc.png';
            $color = '#ffe900';
            if ( $pageActual == 'porto-seguro' || $pageActual == 'tematicos' ) {
                $imagen  = 'fondo-rosa.png';
                $color = '#fc88b7';
            }

            if ( $pageActual == 'cancun' || $pageActual == 'floripa' ) {
                $imagen  = 'fondo-verde.png';
                $color = '#45dacc';
            }

        } else {
            $imagen = 'fondo-menu-movil.png';
            if ( $pageActual == 'porto-seguro' || $pageActual == 'tematicos'  ) {
                $imagen  = 'fondo-rosa-movil.png';
                $color = '#fc88b7';
            }
             if ( $pageActual == 'cancun' || $pageActual == 'floripa' ) {
                $imagen  = 'fondo-verde-movil.png';
                $color = '#45dacc';
            }
        }

        $imagen = MAINSURL . '/assets/images/' . $imagen;
        ?>
        <div class="top-header-content" style="background: <?php echo $color; ?> url(<?php echo $imagen; ?>) center">
            
            <img src="<?php echo $imagenHeader; ?>" alt="troops" class="image-header">
            <h1 class="title-header">
                <?php echo $headerTitulo; ?>
            </h1>
        </div>

<!-- //..MAIN CONTENT HEADER -->

        <nav class="tours-nav animation-element fade-in-scroll">
            <?php 
                $html = '<ul class="tours-nav-menu';
                
                if ( $pageActual == 'bariloche' || $pageActual == 'floripa' || $pageActual == 'porto-seguro' ) {
                    $html .= ' section-active';
                }

                /*if ( $pageActual == 'porto-seguro' || $pageActual == 'tematicos' ) {
                    $html .= ' tours-nav-menu-rosa';
                }*/

                $html .= '" role="menu">';

                echo $html;
            ?>
                <li role="menuitem">
                    <?php if ( $pageActual == 'bariloche' ) {
                        echo '<span class="tour-active-icon"></span>';
                    } ?>
                    <a href="<?php echo MAINSURL; ?>/bariloche" title="Bariloche">
                        Bariloche
                    </a>
                </li>
                <li role="menuitem">
                    <?php if ( $pageActual == 'porto-seguro' ) {
                        echo '<span class="tour-active-icon"></span>';
                    } ?>
                    <a href="<?php echo MAINSURL; ?>/porto-seguro" title="Porto Seguro">
                        Porto Seguro
                    </a>
                </li>
                <li role="menuitem">
                    <?php if ( $pageActual == 'floripa' ) {
                        echo '<span class="tour-active-icon"></span>';
                    } ?>
                    <a href="<?php echo MAINSURL; ?>/floripa" title="Floripa">
                        Floripa
                    </a>
                </li>
                
            </ul>
            
            <!-- ICON RULETA -->
            <div class="tours-nav-icon">
                <?php 
                    /*switch ($pageActual) {
                        case 'bariloche':
                        case 'floripa':
                            echo '<img src="' .MAINSURL . '/assets/images/ruletamenos.png">';
                            break;
                        case 'las-lenas':
                        case 'cancun':
                            echo '<img src="' .MAINSURL . '/assets/images/ruletamas.png">';
                            break;
                        case 'tematicos':
                        case 'porto-seguro':
                            echo '<img src="' .MAINSURL . '/assets/images/ruleta-rosa.png">';
                            break;
                        default:
                            echo '<img src="' .MAINSURL . '/assets/images/ruleta-troops.gif">';
                            break;
                    }*/
                    if ( $pageActual == 'bariloche' || $pageActual == 'porto-seguro' || $pageActual == 'floripa' ) {
                        echo '<img src="' .MAINSURL . '/assets/images/ruletamenos.png">';
                    } elseif ( $pageActual == 'las-lenas' || $pageActual == 'cancun' || $pageActual == 'tematicos' ) {
                        echo '<img src="' .MAINSURL . '/assets/images/ruletamas.png">';
                    } else {
                        echo '<img src="' .MAINSURL . '/assets/images/ruleta-troops.gif">';
                    }
                ?>

            </div>

            <?php 
                $html = '<ul class="tours-nav-menu tours-nav-menu-right';
                if ( $pageActual == 'las-lenas' || $pageActual == 'cancun' || $pageActual == 'tematicos' ) {
                    $html .= ' section-active';
                }

                /*if ( $pageActual == 'porto-seguro' || $pageActual == 'tematicos' ) {
                    $html .= ' tours-nav-menu-rosa';
                }*/

                $html .= '" role="menu">';

                echo $html;
            ?>

                <li role="menuitem">
                    <?php if ( $pageActual == 'las-lenas' ) {
                        echo '<span class="tour-active-icon"></span>';
                    } ?>
                    <a href="<?php echo MAINSURL; ?>/las-lenas" title="Las Leñas">
                        Las Leñas
                    </a>
                </li>
                <li role="menuitem">
                    <?php if ( $pageActual == 'cancun' ) {
                        echo '<span class="tour-active-icon"></span>';
                    } ?>
                    <a href="<?php echo MAINSURL; ?>/cancun" title="Cancún">
                        Cancún
                    </a>
                </li>
                <li role="menuitem">
                    <?php if ( $pageActual == 'tematicos' ) {
                        echo '<span class="tour-active-icon"></span>';
                    } ?>
                    <a href="<?php echo MAINSURL; ?>/tematicos" title="Temáticos">
                        Temáticos
                    </a>
                </li>
                
            </ul> 
        </nav>
        
    </header> <!-- //.main-header -->

    <main role="main" class="main-wrapper">
        <div class="inner-wrapper">