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
        "types" => ["asset","object"],
        "subtypes" => ["image","folder","product","teinte"]

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
foreach($this->multihref("objectPaths") as $element) {
    if($element instanceof \Pimcore\Model\Asset\Image || $element instanceof \Pimcore\Model\Asset\Folder)
        $assets = array_merge($assets,Website\Tool\AssetHelper::getAssetArray(array($element),true)->assets);
    elseif($element instanceof Pimcore\Model\Object) {
        $assets = array_merge($assets,array($element));

    }
}
foreach ($assets as $element) {
    echo '<div class="col-'.(12/$count).'">';
    if($element instanceof Pimcore\Model\Object)
        $this->template("/snippets/lpn-slider-product-image-item.php",array('asset'=>null,'product'=>$element,'imageformat'=> $imageformat));
    else
        $this->template("/snippets/lpn-slider-product-image-item.php",array('asset'=>$element,'product'=>null,'imageformat'=> $imageformat));
} 
?>
   
</div>

<!-- FIN Grid -->

<?php endif; ?>

