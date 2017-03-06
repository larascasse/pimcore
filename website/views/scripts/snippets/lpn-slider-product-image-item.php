
<div class="card">
<?php
$asset = $this->asset;
$product = $asset->getRelatedProduct();
?>
           

<?php echo $asset->getThumbnail("magento_realisation")->getHTML(["class" => "card-img-top__ img-fluid norelazy"]); ?>


<div class="caption">

  <p class="legendtitle"><?php echo  $product?$product->getSubtype():""; ?> - <?php echo  $product?$product->getShort_name():""; ?></p>
  <p class="legendimage"></p>


</div>
</div>
