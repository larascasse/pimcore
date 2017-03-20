<?php
$product = $this->product;
$cols = $this->cols>0?$this->cols:3;
$index = $this->index>0?$this->index:0;

    $detailLink = $this->url(array(
                "id" => $product->getId(),
                "text" => $product->getName(),
                "prefix" => ""
                    ), "produits");
?>
  
        <li class="card clickable item">
         <?php if($product->getImage_1()) { ?>
            
            <img src="<?php echo $product->getImage_1()->getThumbnail("productCategory")->getPath(); ?>" class="img-responsive refreshcentered rollover">
          
        <?php } ?>
       <div class="tabledesc">
       <p class=""><?php echo $product->getCatalogue(); ?></p>
        <p class=""><?php echo $product->getSubtype(); ?></p>
         <h3 class="product-name"><?php echo $product->getShort_name(); ?></h3>
                 <p class=""><?php echo $product->getShort_description(); ?></p>

         <!--<p><a href="<?php echo $detailLink; ?>" class="btn btn-primary" role="button">Voir</a></p>-->
         <a class="btn" href="<?php echo $detailLink; ?>">Voir</a>
         </div>
        </li>

