<?php 
/*
Affiche un asset, et le produit associé en légende
*/
?>
<div class="card">
<?php
$asset = $this->asset;
$product = $asset->getRelatedProduct();
$imageformat = isset($this->imageformat)?$this->imageformat:'magento_realisation';
?>
           

<?php echo $asset->getThumbnail($imageformat)->getHTML(["class" => "img-fluid","data-zoom"=>$asset->getThumbnail('magento_realisation')]); ?>


<div class="card-block">

  <p class="card-title"><?php echo  $asset->getRelatedTitle() ?></p>
  <p class="card-text"><?php echo $asset->getRelatedDescription()?></p>


</div>
</div>
