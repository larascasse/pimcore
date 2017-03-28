<?php

?>

<?php if($this->editmode): ?>
    <?= $this->multihref("objectPaths",
    [
        "types" => ["asset"],
        "subtypes" => ["image","folder"]

    ]); ?>
<?php else: ?>

       <!-- Carousel Item -->
            <div class="sliderimage" data-ride="carousel">
                <div class="owl-carousel image-list">
<?php 

$assets = array();
foreach($this->multihref("objectPaths") as $asset) { 
    $assets = array_merge($assets,Website\Tool\AssetHelper::getAssetArray(array($asset),true)->assets);
}
foreach ($assets as $asset) {
    $this->template("/snippets/lpn-slider-product-image-item.php",array('asset'=>$asset));
} 
?>
   
                </div>
            </div>
  

<?php endif; ?>
