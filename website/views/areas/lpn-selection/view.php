<?php
if($this->editmode) { ?>
<hr />
<h2>Sélection</h2>
<?php } ?>

<?php

$classNoRoll="";
if($this->editmode) 
    $classNoRoll = "noroll";
?>
<div class="home_selection">

    <div class="">

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
                        $product = $this->image("image")->getImage()->getProperty("product");
                        if(!$product) {
                            $ean = $this->image("image")->getImage()->getMetadata("product");
                            $product = Object_Product::getByEan($ean)->objects[0];
                            if(!$product) {
                                $product = Object_Product::getByCode($ean)->objects[0];
                            }
                        }
                        else {
                            $ean=$product->getEan()?$product->getEan():$product->getCode();
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
        <!-- SLECTION ITEM -->
        <?php 

                    if($this->editmode) { ?>
                    <hr />
                        <div class="editmode-label">
                            <label>Orientation:</label>
                            <?= $this->select("postition", ["store" => [["left","Image à gauche"],["right","Image à droite"]]]); ?>
                        </div>

                    <?php } ?>


        <div class="row featurette <?= ($position == "right") ? "ftinverse" : ""; ?>">

             <div class="ftimg">
                <div class="nsg_container">
                    <div class="fullimg">

                  <?php if ($this->editmode) { ?>

    <?= $this->image("image",array(
        "thumbnail" => "magento_selection",
        
    )
    );

    } else { 
        
        if($this->image("image") ) {
             $urlImage =  $this->image("image")->getThumbnail("magento_selection")->getPath();
             echo '<img src="'.$urlImage.'" title="'.$this->image("image")->getText().'" alt="'.$this->image("image")->getAlt().'" class="" />';
        }
       

        
    }
    ?>
                    </div>
                    <div class="roll_selection<?= $classNoRoll?> centeredcontent"><?php 

                    echo $name.'<br />';
                    if(strlen($ean)>0) 
                        echo '{{block type="core/template" template="lpn/lpn_product_link.phtml" name="givemetheprice_'.$ean.'" product_sku="'.$ean.'"}}';
                
           ?>
                    </div>
                </div>
            </div>

            <!-- TEXT -->
             <div class="fttext">
                <h2><span><?= $this->input("headline", ["width" => 400]); ?></span></h2>
                <div class="selectioncontent"><?= $this->textarea("content1", ["width" => 350, "height" => 200]); ?></div>
                <!--<div class="selectionlink">{{block type="core/template" template="lpn/lpn_product_link.phtml" name="givemetheprice_1_<?= $ean ?>" product_sku="<?= $ean ?>"}}</div>-->
                <div class="selectionlink"><?= $this->textarea("content2", ["width" => 350, "height" => 100]); ?></div>
                <div class="selectioncontent"><?= $this->textarea("link2", ["width" => 350, "height" => 100]); ?></div>

            </div>

        </div>
    <!-- FIN SLECTION ITEM -->

    <?php } ?>
    </div>
</div>