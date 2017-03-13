<?php 
	if ($this->editmode) { 
		echo "<h2>Content Headline (include/content-headlines)</h2>";
	}

?>
<?php
    // automatically use the headline as title
	/* HEADLINE comme block automatique en haut de page */


    $this->headTitle($this->input("headline")->getData());
?><section class="area-lpn-image-header2">
<div id="category_header" class="row content_header_container" <?php if ($this->editmode): echo 'style="height:500px'; endif; ?>>
	<div class="nsg_container">
		<div class="fullimg">
		 <?php 
		 if ($this->editmode) { 
		 	echo "Image:";
		 	echo $this->image("image");
		 	echo "FIN Image<br />";

		} else { 
				if($this->image("image")->getThumbnail("magento_header"))
					$urlImage =  $this->image("image")->getThumbnail("magento_header")->getPath();
				else
				  $urlImage =""; 
			    echo '<img src="'.$urlImage.'" title="'.$this->image("image")->getText().'" alt="'.$this->image("image")->getAlt().'" class="norelazy__" />';
		}

?>
		</div>
		<div class="nsg_abs">			
			<h1 class="catTitle"><?= $this->input("headline"); ?></h1>
			<div class="catLine">&nbsp;</div>
			<div class="catDesc"> <?= $this->wysiwyg("description", ["width" => 800]); ?></div>						
			<div class="catScrollDown"><a title="scroll down" href="#"><span class="hidden">scroll down</span></a></div>
		</div>
	</div>
</div>
</section>