
<div class="card">
<?php
$asset = $this->asset;
$product = $asset->getRelatedProduct();
$imageformat = isset($this->imageformat)?$this->imageformat:'magento_realisation';
?>
           

<?php echo $asset->getThumbnail($imageformat)->getHTML(["class" => "img-fluid norelazy__"]); ?>


<div class="caption">

  <p class="legendtitle"><?php echo  $asset->getRelatedTitle() ?></p>
  <p class="legendimage"><?php echo $asset->getRelatedDescription()?></p>


</div>
</div>
