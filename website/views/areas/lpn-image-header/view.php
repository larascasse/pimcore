<section class="area-lpn-image-header">
<div class="row" id="category_header">
	<div class="nsg_container">
		<div class="fullimg">
		 <?= $this->image("image", [
            "thumbnail" => "magento_realisation"
        ]); ?>
		</div>
		<div class="nsg_abs">			
			<h1 class="catTitle"> <?= $this->wysiwyg("title", ["width" => 400]); ?></h1>
			<div class="catLine">&nbsp;</div>
			<div class="catDesc"> <?= $this->wysiwyg("description", ["width" => 400]); ?></div>						
			<div class="catScrollDown"><a title="scroll down" href="#"><span class="hidden">scroll down</span></a></div>
		</div>
	</div>
</div>
</section>