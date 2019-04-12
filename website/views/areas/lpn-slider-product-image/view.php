
<?php if($this->editmode): ?>
    <?= $this->input("cssClass",
    [
        "placeholder"=>"classe CSS"
    ]); ?><br />

    <?= $this->multihref("objectPaths",
    [
        "types" => ["asset","object"],
        "subtypes" => ["image","folder","product","teinte"]

    ]); ?>
    
<?php else: ?>
<div class="section-content <?php echo $this->input("cssClass") ?> container-main">
       <!-- Carousel Item -->
            <div class="sliderproductimage" data-ride="carousel">
                <div class="owl-carousel image-list">

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

    if($element instanceof Pimcore\Model\Object) {

        $this->template("/snippets/lpn-slider-product-image-item.php",array('asset'=>null,'product'=>$element,'imageformat'=> $imageformat));
    }
    else {
        $this->template("/snippets/lpn-slider-product-image-item.php",array('asset'=>$element,'product'=>null,'imageformat'=> $imageformat));
    }

} 
?>

   
                </div>
            </div>
  
</div>
<?php endif; ?>

