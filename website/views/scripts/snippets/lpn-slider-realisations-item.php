<?php if (!$this->editmode) { ?>
<textarea>
<?php } ?>
<ul id="slider_realisation">

<?php
$count = $this->select("carouselSlides")->getData();
if(!$count) {
    $count = 1;
}
for($i=0; $i<$count; $i++) {

$urlImage =  'http://'.$_SERVER['HTTP_HOST'].$this->image("cImage_".$i)->getThumbnail("magento_realisation")->getPath();

?>

<li data-zoom="<?= $urlImage ?>">
<div class="nsg_container col-md-16">
<div>
<?php if ($this->editmode) { ?>

<?= $this->image("cImage_".$i,array(
    "thumbnail" => "magento_small",
    "attributes" => array(
        "custom-attr" => "value",
        "data-role" => "image"
    )
)
);

} else { 

    echo '<img src="'.$urlImage.'" title="'.$this->image("cImage_".$i)->getText().'" alt="'.$this->image("cImage_".$i)->getAlt().'" class="norelazy" />';
}
?></div>
<div class="nsg_abs">
<div class="realisationpicto">Nos r&eacute;alisations</div>
<div class="realisationtitle"><?php if($this->editmode) echo "Titre";?><?= $this->input("cTitle_".$i, ["width" => 900]); ?></div>
<div class="realisationcontent"><?php if($this->editmode) echo "Content";?><?= $this->input("cContent_".$i, ["width" => 900]); ?></div>
<div class="jspush">
<?php if ($this->editmode) { ?>
    <?= $this->href("cProduct".$i,array(
    "types"=>array("object"),
    "classes" => array("product"),
    "reload" => true,
 )); 
} else { 
        $product = $this->href("cProduct".$i)->getElement();
        if($product ) {
            $ean =  $product->getEan();

            if(!(strlen($ean)>4))
                $ean =  $product->getCode();
        }
        else {
            $ean = $this->image("cImage_".$i)->getImage()->getMetadata("product");
            $product = Object_Product::getByEan($ean)->objects[0];
            if(!$product) {
                $product = Object_Product::getByCode($ean)->objects[0];
            }
            
        }

        $name="";
        $description="";
        if($product) {
            $name =  $product->getName();

             $description = $product->getShort_description();
            $description = str_replace("\n", "|", $description);
        }
        

        echo '<div class="realisationpush">'.$name.'<br />'.$description .' | EAN : '.$ean.'</div>';
        echo '<div class="realisationlink">{{block type="core/template" template="lpn/lpn_product_link.phtml" name="givemetheprice_'.$ean.'" product_sku="'.$ean.'" class="btnarrow"}}</div>';
        

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
            "store" => [[1,1],[2,2],[3,3],[4,4],[5,5],[6,6],[7,7],[8,8],[9,9]]
        ]); ?>
    </div>
<?php } ?>

<?php if (!$this->editmode) { ?>
</textarea>
<?php } ?>