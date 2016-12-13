  <?php
  $product = $this->product;

 if($product instanceof Object_Product) { 
 ?>
 <div class="media">
        <?php
            $detailLink = $this->url(array(
                "id" => $product->getId(),
                "text" => $product->getName(),
                "prefix" => $this->document->getFullPath()
            ), "produits");
        ?>
        <?php if($product->getImage_1()) { ?>
            <a class="pull-left" href="<?php echo $detailLink; ?>">
                <img class="media-object" src="<?php echo $product->getImage_1()->getThumbnail("newsList")->getPath(); ?>">
            </a>
        <?php } ?>

        <div class="media-body">
            <h4 class="media-heading">
                <a href="<?php echo $detailLink; ?>"><?php echo $product->getName(); ?></a>
               <p><?php echo $product->getShort_description(); ?></p>
            </h4>
        </div>
</div>
<?php
}
?>