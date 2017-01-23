<?php 
if ($this->editmode) { 
 	echo '<h2>LPN Header Image</h2>';

}
?>
<section class="area-lpn-image-header">
<div id="category_header" class="row content_header_container" <?php if ($this->editmode): echo 'style="height:500px'; endif; ?>>
	<div class="nsg_container">
		<div class="fullimg">
		 <?php 
		 if ($this->editmode) { 
		 	echo "Image:";
		 	echo $this->image("image");
		 	echo "FIN Image<br />";

		} else { 
				if($this->image("image")->getThumbnail("magento_realisation"))
					$urlImage =  $this->image("image")->getThumbnail("magento_realisation")->getPath();
				else
				  $urlImage =""; 
			    echo '<img src="'.$urlImage.'" title="'.$this->image("image")->getText().'" alt="'.$this->image("image")->getAlt().'" class="norelazy" />';
		}

?>
		</div>
		<div class="nsg_abs topgradient">			
			<h1 class="catTitle"> <?= $this->wysiwyg("title", ["width" => 800]); ?></h1>
			<div class="catLine">&nbsp;</div>
			<div class="catDesc"> <?= $this->wysiwyg("description", ["width" => 800]); ?></div>						
			<!--<div class="catScrollDown"><a title="scroll down" href="#"><span class="hidden">scroll down</span></a></div>-->
		</div>
	</div>
</div>
</section>