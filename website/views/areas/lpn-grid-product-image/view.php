<?php

?>

<?php if($this->editmode): ?>
     
     <div class="container" style="padding-bottom: 40px">
        Nombre de colonnes: <?= $this->select("columns", [
            "width" => 60,
            "reload" => true,
            "store" => [[1,1],[2,2],[3,3],[4,4],[4,4],[6,6]]
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

?>

<!-- Grid -->
<div class="container-main">
<div class="row">
<?php 

$assets = array();
foreach($this->multihref("objectPaths") as $asset) { 
    $assets = array_merge($assets,Website\Tool\AssetHelper::getAssetArray(array($asset),true)->assets);
}
foreach ($assets as $asset) {
    echo '<div class="col-'.(12/$count).'">';
    $this->template("/snippets/lpn-slider-product-image-item.php",array('asset'=>$asset));
    echo '</div>';
} 
?>
   
</div>
</div>
<!-- FIN Grid -->

<?php endif; ?>

