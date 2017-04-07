<?php
$product = $this->product;
$cols = $this->cols>0?$this->cols:12/4;
$index = $this->index>0?$this->index:0;

    $detailLink = $this->url(array(
                "id" => $product->getId(),
                "text" => $product->getName(),
                "prefix" => ""
                    ), "produits");
?>
  
        <div class="col-<?php echo $cols; ?>">
        <div class="card clickable item">
         <?php if($product->getImage_1()) { ?>
            
            <img src="<?php echo $product->getImage_1()->getThumbnail("productCategory")->getPath(); ?>" class="img-responsive rollover">
          
        <?php } ?>
       <div class="tabledesc">
            <p class="subtype "><?php echo ucfirst($product->getSubtype()); ?></p>
            <h3 class="product-name"><?php echo $product->getShort_name(); ?></h3>
            <p class="subtype "><?php echo $product->getShort_description(); ?></p>

         <!--<p><a href="<?php echo $detailLink; ?>" class="btn btn-primary" role="button">Voir</a></p>-->
             <div class="actions">
             <?php  echo $this->template("/content/link-eshop-renderlet.php",array('product'=>$product,
                'btn_title'=>"" //ne rien mettre pour avoir le prix
             )); ?>
             </div>
            
         </div>
        
        </div>
        </div>

