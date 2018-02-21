<?php 
	$categoria = $data['post_url'];
	$template = $data['post_categoria'];//menos18 o mas18
	$paquetes = getPostsExtended( 'paquete', $categoria );

?>
<section class="lugar-section">
	<div class="paquetes-wrapper">
		<div class="container">
			
			<!--<img src="<?php echo MAINSURL; ?>/assets/images/temp/bariloche-fotos.jpg" class="image-responsive">-->
			<ul class="paquetes">
		<?php 
			for ($i=0; $i < count($paquetes); $i++) { ?>
				<li>
					<article class="paquete paquete-menos18">
						<img src="<?php echo UPLOADSURL . '/' . $paquetes[$i]['post_imagen']; ?>">		
					</article>
				</li>
				
		<?php }
			?>
			</ul>

		</div>
	</div>
</section>