<!-- GALERÍA DE IMAGENES -->
<div class="galeria-inner-wrapper">
    <div class="main-picture-wrapper">
        <figure class="main-picture">
            <img src="<?php echo UPLOADSURL . '/' . $data[0]; ?>">
            <!--<figcaption>
                <span>
                    Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut minim veniam.
                </span>
            </figcaption>-->
        </figure>
    </div>
    <div class="owl-carousel owl-theme">
    	<?php 

    	for ($i=0; $i < count($data); $i++) { ?>
    		<div class="item">
    	        <img src="<?php echo UPLOADSURL . '/' . $data[$i]; ?>" alt="Troops Viajes" class="toggle-picture">
    	    </div>
    	<?php }//for ?>
    </div>
</div>