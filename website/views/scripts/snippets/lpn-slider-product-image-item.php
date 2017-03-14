
<div class="card">
<?php
$asset = $this->asset;
$product = $asset->getRelatedProduct();
$imageformat = isset($this->imageformat)?$this->imageformat:'magento_realisation';
?>
           

<?php echo $asset->getThumbnail($imageformat)->getHTML(["class" => "img-fluid norelazy__"]); ?>


<div class="caption">

  <p class="legendtitle"><?php echo  $product?$product->getSubtype():""; ?> - <?php echo  $product?$product->getShort_name():""; ?></p>
  <p class="legendimage"></p>


</div>
</div>
