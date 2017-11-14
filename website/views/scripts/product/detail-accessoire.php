<?php 



$product = $this->product;

?>
<div class="ft-content">

	<!-- First col -->
	<div class="ft-col-1">

		<div class="row">

			<div class="col-xs-12">
				<h2 style=""><?php echo $product->getMage_short_name(3000); ?></h2>
				 <?php
				$subtitle = strlen($product->getSku())>0?"EAN : ".$product->getSku():"";
				
				if (strlen($subtitle)>0) {
					echo $subtitle = '<p>'.$subtitle.'</p>';
				}
				?>

			
		<!--<h3><?php echo nl2br($this->product->getShort_description_title()); ?></h3>-->
		<p><?php echo nl2br($this->product->getShort_description()); ?></p>
        	<p><?php echo nl2br($this->product->getMage_sub_description()); ?></p>
        	<p><?php echo nl2br($this->product->getDescription()); ?></p>
			</div>
		
		</div>



		




	</div>
	<!-- First col / -->


	<!-- Second col -->
	<div class="ft-col-2">

	<?php
			if(is_array($logoAssets) && count($logoAssets)>0) { ?>
				<?php
				foreach ($logoAssets as  $asset) {
					//echo '<div class="col-xs-2__">';
			    	echo  $asset->getThumbnail("magento_logo")->getHTML(array("class"=>'ft-logo')); 
			    	//echo '</div>';
			    }
			    ?>
				 
			  <?php 
			}

			?>

	<?php echo  $image = $this->product->getImage_1()->getThumbnail("galleryLightbox")->getHTML(["class"=>"img-responsive"]); ?>
	<!-- Second col / -->
	</div>


<!-- FIN MAIN LAYOUT / -->
</div>



