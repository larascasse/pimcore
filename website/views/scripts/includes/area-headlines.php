<?php 

/* HEADLINE comme block de contenu */
	if ($this->editmode) { 
		echo "<h2>Area Headline (include/areaheadlines)</h2>";
	}

?>

<?php if($this->editmode || !$this->input("headline")->isEmpty()) { ?>

<?php 
	if ($this->editmode) { 
		echo $this->image("image");
	}
}
?>



<section class="area-lpn-image-header">
<div id="category_header" class="row content_header_container" <?php if ($this->editmode): echo 'style="height:500px'; endif; ?>>
	<div class="nsg_container">
		<div class="fullimg">
		 <?php 
		 if (!$this->editmode) { 
		 	
				if($this->image("image")->getThumbnail("magento_header"))
					$urlImage =  'http://'.$_SERVER['HTTP_HOST'].$this->image("image")->getThumbnail("magento_header")->getPath();
				else
				  $urlImage =""; 
			    echo '<img src="'.$urlImage.'" title="'.$this->image("image")->getText().'" alt="'.$this->image("image")->getAlt().'" class="norelazy" />';
		}

?>
		</div>
		<div class="<?php if (!$this->editmode): echo 'nsg_abs'; endif; ?>">			
			<h1 class="catTitle"><?= $this->input("headline"); ?></h1>
			<div class="catLine">&nbsp;</div>
			<div class="catDesc"><?= $this->wysiwyg("lead", ["height" => 100]); ?></div>						
			<div class="catScrollDown"><a title="scroll down" href="#"><span class="hidden">scroll down</span></a></div>
		</div>
	</div>
</div>
</section>
