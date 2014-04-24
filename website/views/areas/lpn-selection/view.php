
<?php if (!$this->editmode) { ?>
<textarea>
<?php } ?>
<?php while($this->block("block")->loop()) {
    $ean="";
    $name="";
    if ($this->editmode) { 
        echo $this->href("product".$i,array(
            "types"=>array("object"),
            "classes" => array("product"),
            "reload" => true,
        )); 

    } 
    
            $product = $this->href("product")->getElement();
            if($product ) {
                $ean =  $product->getEan();

                if(!(strlen($ean)>4))
                    $ean =  $product->getCode();
            }
            else  if($this->image("image")->getImage()) {
                $ean = $this->image("image")->getImage()->getMetadata("product");
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
      

      $position = $this->select("postition")->getData();
            if(!$position) {
                $position = "right";
            }

    ?>
    <div class="row featurette">

        


        <div class="col-sm-8 col-sm-<?= ($position == "right") ? "push-" : ""; ?>8">
            <div class="nsg_container">
                <div class="fullimg"><?php 

                if($this->editmode) { ?>
                    <div class="editmode-label">
                        <label>Orientation:</label>
                        <?= $this->select("postition", ["store" => [["left","left"],["right","right"]]]); ?>
                    </div>

                <?php } ?>

              <?php if ($this->editmode) { ?>

<?= $this->image("image",array(
    "thumbnail" => "magento_selection",
    
)
);

} else { 
    $urlImage =  'http://'.$_SERVER['HTTP_HOST'].$this->image("image")->getThumbnail("magento_selection")->getPath();

    echo '<img src="'.$urlImage.'" title="'.$this->image("image")->getText().'" alt="'.$this->image("image")->getAlt().'" class="norelazy" />';
}
?>
                </div>
                <div class="roll_selection centeredcontent"><?php 

                echo $name.'<br />';
                echo '{{block type="core/template" template="lpn/lpn_product_link.phtml" name="givemetheprice_'.$ean.'" product_sku="'.$ean.'"}}';
            
       ?>
                </div>
            </div>
        </div>

        <!-- TEXT -->
        <div class="paddingleft20 col-sm-8  col-sm-<?= ($position == "right") ? "pull-" : ""; ?>8 <?= ($position == "right") ? " homselectiontxtright" : ""; ?>">
            <h2><?= $this->input("headline", ["width" => 400]); ?></h2>
            <div class="selectioncontent"><?= $this->textarea("content1", ["width" => 350, "height" => 200]); ?></div>
            <div class="selectionlink">{{block type="core/template" template="lpn/lpn_product_link.phtml" name="givemetheprice_1_<?= $ean ?>" product_sku="<?= $ean ?>"}}</div>
            <div class="selectionlink"><?= $this->textarea("content2", ["width" => 350, "height" => 100]); ?></div>
            <div class="selectioncontent"><?= $this->textarea("link2", ["width" => 350, "height" => 100]); ?></div>

        </div>

    </div>
    <div class="col-md-16  col-sm-16">
        <div class="clearfix">&nbsp;</div>
    </div>
<?php } ?>



<?php if (!$this->editmode) { ?>
</textarea>
<?php } ?>
