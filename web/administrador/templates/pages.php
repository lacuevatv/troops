<?php
/*
 * Noticias recientes
 * Lista las noticias publicadas y con links para verlas, editarlas o publicarlas
 * Since 3.0
 * 
*/
global $userStatus;
if ($userStatus != '1' ) {
    echo 'No tiene permisos para ver esta sección';
    
    exit;
}
load_module( 'noticias' );
?>
<!---------- noticias ---------------->
<div class="contenido-modulo">
    <h1 class="titulo-modulo">
        Paginas
    </h1>
    <div class="container">
        
        <div class="row">
            <div class="col">
                <ul class="loop-noticias-backend-small">
                    
                <?php 

                $pages = getPages();
                
                for ($i=0; $i < count($pages); $i++) { 
                      $page = $pages[$i]; ?>

                    <li>
                        <article>
                            <h1>
                                <?php echo $page['post_titulo']; ?>
                            </h1>

                            <div class="contenido-resumen">
                                <?php if ( $page['post_imagen'] != '' ) : ?>
                                <img src="<?php echo UPLOADSURLIMAGES . '/' . $page['post_imagen']; ?>">
                                <?php else : ?>
                                    
                                    <img src="<?php echo MAINURL; ?>/assets/images/header-portada-pc.png">

                                <?php endif; ?>
                            </div>
                            <div class="wrapper-button">
                                <a href="index.php?admin=editar-page&slug=<?php echo $page['post_url']; ?>" class="btn btn-primary btn-sm">
                                    Editar
                                </a>
                            </div>
                        </article>
                    </li>

            <?php }//for
            ?>
                    
                </ul>
            </div><!-- // col -->
        </div><!-- // row -->
        
        
    </div><!-- // container gral modulo -->
</div><!-- // container -->
<!-- botones del modulo -->
<footer class="footer-modulo container">
    <a type="button" href="index.php" class="btn">Volver al inicio</a>
</footer>

<!---------- fin noticias ---------------->