<?php
$product = $this->product;
$cols = $this->cols>0?$this->cols:3;
$index = $this->index>0?$this->index:0;

 if($product instanceof Object_Product) { 
    $detailLink = $this->url(array(
                "id" => $product->getId(),
                "text" => $product->getName(),
                "prefix" => ""
                    ), "produits");
?>
    <div class="col-md-<?php echo $cols; ?> col-xs-6">
        <div class="thumbnail">
         <?php if($product->getImage_1()) { ?>
            <a class="pull-leftxx" href="<?php echo $detailLink; ?>">
            <img class="media-object" src="<?php echo $product->getImage_1()->getThumbnail("productCategory")->getPath(); ?>">
            </a>
        <?php } ?>
         <p><br /><?php echo $product->getName(); ?></p>
         <p><?php echo $product->getPrice(); ?><span class="glyphicon glyphicon-euro"></span>
         <!--<p><a href="<?php echo $detailLink; ?>" class="btn btn-primary" role="button">Voir</a></p>-->
        </div>
    </div>
 <?php } ?>
