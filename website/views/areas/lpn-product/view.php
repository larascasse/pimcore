<?php
$mustRender = $this->layout()->getLayout() == "layout-fiche-pdf";
?>

<?php if($this->editmode): ?>
     
    

    <div class="container" style="padding-bottom: 40px">
        Format Image: <?= $this->select("imageformat", [
            "width" => 60,
            "reload" => false,
            "store" => [['magento_equigrid_h','horizontal'],['magento_equigrid_v','vertical'],['magento_equigrid_c','carré'],['destructure','destructure']]
        ]); ?>
    </div>


    <?= $this->href("product",
    [
        "types" => ["object"],
        "subtypes" => ["product"]

    ]); ?>
<?php else: ?>

<?php


$imageformat = $this->select("imageformat")->getData();
if(!$imageformat) {
    $imageformat = 'magento_equigrid_h';
}


?>

<!-- FIN Product -->
<?php 

$index=0;
$unpublishedStatus = self::doHideUnpublished();
self::setHideUnpublished(false);
$product = $this->href("product")->getElement();
self::setHideUnpublished($unpublishedStatus);
echo '<div class="product-solo">';
?>

<?php


if ($product instanceof Website_Product):
echo 
    $this->template("includes/inc-product-cell-long.php", array(
        "product" => $product,
        "index"=>0,
        "cols"=>1
    ));
endif; 
echo '</div>';

?>
   

<!-- FIN Product -->

<?php endif; ?>

