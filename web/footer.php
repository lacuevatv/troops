<?php
/*
 * Sitio web: TROOPS
 * @LaCueva.tv
 * Since 1.0
 * FOOTER
 * 
*/
?>


        </div> <!--- //.inner-wrapper -->
    </main><!--- //.main-wrapper -->

<!--- footer ---------------------->
    <footer class="footer-site">
        
    	<section id="socios">
    		<div class="container">
    			<figure>
    			<?php if ( dispositivo () == 'pc' ) : ?>

    				<img class="img-footer" src="<?php echo MAINSURL; ?>/assets/images/socios-pc.png" alt="TROOPS legales">

    			<?php else : ?>

    				<img class="img-footer" src="<?php echo MAINSURL; ?>/assets/images/socios-movil.png" alt="TROOPS legales">

    			<?php endif; ?>
    			</figure>
    		</div>

    		<button class="go-up">
    			<span class="sr-only">Ir arriba</span>
    		</button>
    	</section>

    	<section id="legales">
    		<div class="container">
    			<p>
    				Empresa habilitada para organizar y brindar viajes de egresados
    			</p>

    			<figure>
    				<img class="img-footer" src="<?php echo MAINSURL; ?>/assets/images/habilitaciones.png" alt="TROOPS legales">
    			</figure>

    			<p>
    				<?php echo HABILITACIONES; ?>
    			</p>

    		</div>
    	</section>
        
    </footer>

</div><!--- //.wrapper-site -->
<!--- scripts -->    
<!------- jquery 3.1.1 ------>
    <script src="<?php echo MAINSURL; ?>/assets/js/jquery-3.2.1.min.js"></script>
    <!------- owl ------>
    <script src="<?php echo MAINSURL; ?>/inc/lib/owl/owl.carousel.min.js"></script>
    <!------- GOOGLE MAPS ------>
    <?php if ( $pageActual == 'inicio' || $pageActual == 'las-lenas' || $pageActual == 'cancun' || $pageActual == 'tematicos') {
        echo '<script async defer src="https://maps.googleapis.com/maps/api/js?v=3&key='.APIKEYGOOGLE.'&callback=initMap"></script>';
    } ?>
    <!------- OWN SCRIPT ------>
    <script src="<?php echo MAINSURL; ?>/assets/js/script.js"></script>
</body>
</html>