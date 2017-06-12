<?php

?>

<?php if($this->editmode): ?>
     
     <div class="container" style="padding-bottom: 40px">
        Nombre de colonnes: <?= $this->select("columns", [
            "width" => 60,
            "reload" => false,
            "store" => [[1,1],[2,2],[3,3],[4,4],[4,4],[6,6]]
        ]); ?>
    </div>

    <div class="container" style="padding-bottom: 40px">
        Format Image: <?= $this->select("imageformat", [
            "width" => 60,
            "reload" => false,
            "store" => [['magento_equigrid_h','horizontal'],['magento_equigrid_v','vertical'],['magento_equigrid_c','carré']]
        ]); ?>
    </div>



    <?= $this->multihref("objectPaths",
    [
        "types" => ["asset"],
        "subtypes" => ["image","folder"]

    ]); ?>
<?php else: ?>

<?php
$count = $this->select("columns")->getData();
if(!$count) {
    $count = 6;
}

$imageformat = $this->select("imageformat")->getData();

if(!$imageformat) {
    $imageformat = 'magento_equigrid_h';
}

if($count>1 && $imageformat=="magento_equigrid_h") {
    $imageformat = "magento_h_half";
}

?>

<!-- Grid -->

<div class="row image-grid">
<?php 

$assets = array();
foreach($this->multihref("objectPaths") as $asset) { 
    $assets = array_merge($assets,Website\Tool\AssetHelper::getAssetArray(array($asset),true)->assets);
}
foreach ($assets as $asset) {
    echo '<div class="col-'.(12/$count).'">';
    $this->template("/snippets/lpn-slider-product-image-item.php",array('asset'=>$asset,'imageformat'=> $imageformat));
    echo '</div>';
} 
?>
   
</div>

<!-- FIN Grid -->

<?php endif; ?>

