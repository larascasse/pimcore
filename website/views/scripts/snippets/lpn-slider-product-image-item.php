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
           

<?php 
echo '<a href="#" data-zoom="'.$asset->getThumbnail('magento_realisation')->getPath().'">'.$asset->getThumbnail($imageformat)->getHTML(["class" => "img-fluid",/*"attributes"=>["data-zoom"=>$asset->getThumbnail('magento_realisation')->getPath()]*/]).'</a>'; ?>


<div class="card-block">

  <p class="card-title"><?php echo  $asset->getRelatedTitle() ?></p>
  <p class="card-text"><?php echo $asset->getRelatedDescription()?></p>


</div>
</div>
