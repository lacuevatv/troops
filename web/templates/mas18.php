<?php 
	$categoria = $data['post_url'];
	$template = $data['post_categoria'];//menos18 o mas18
	$paquetes = getPostsExtended( 'paquete', $categoria );
	
?>
<section class="lugar-section">
	<div class="paquetes-wrapper">
		<div class="container">
			<ul class="paquetes">
		<?php 
			for ($i=0; $i < count($paquetes); $i++) { ?>
				<li>
					<article>
						<h1>
							<?php echo $paquetes[$i]['post_titulo']; ?>
						</h1>
					</article>
				</li>
				
		<?php }
			?>
			</ul>

		</div>
	</div>
</section>