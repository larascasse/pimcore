<ul id="slider_home">

        <?php
        $count = $this->select("carouselSlides")->getData();
        if(!$count) {
            $count = 1;
        }
        for($i=0; $i<$count; $i++) { ?>
            
<li>
<div class="nsg_container"><?= $this->image("cImage_".$i) ?>
<div class="nsg_abs">
<div class="slidetitle"><?php if($this->editmode) echo "Titre";?><?= $this->input("cTitle_".$i, ["width" => 900]); ?></div>
<div class="slidesubtitle"><?php if($this->editmode) echo "Sous titre";?><?= $this->textarea("cSubtitle_".$i, ["width" => 900]); ?></div>
<div class="slidelink"><?php if(!$this->editmode) {
		echo '{{widget type="catalog/category_widget_link" anchor_text="'.$this->input("cTitle_".$i)->getData().'" title="'.$this->input("cTitle_".$i)->getData().'" template="catalog/category/widget/link/link_block.phtml" id_path="category/'.$this->numeric("cCategoryId".$i).'}}';
		}
			else {
				echo "Catégorie:";
		
		echo $this->numeric("cCategoryId".$i,array(
    "width" => 80,
    "minValue" => 1,
    "maxValue" => 2000,
    "decimalPrecision" => 0,
    "reload" => true
));
	}
	 ?>
</div>
</div>
</div>
</li>
<?php } ?>
</ul>
<?php if($this->editmode) { ?>
    <div class="container" style="padding-bottom: 40px">
        Number of Slides: <?= $this->select("carouselSlides", [
            "width" => 60,
            "reload" => true,
            "store" => [[1,1],[2,2],[3,3],[4,4]]
        ]); ?>
    </div>
<?php } ?>