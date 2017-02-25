<section class="area-lpn-slider-realisations-item">

<?php 

if(!function_exists ('toto')) {
    function real_get_all_images_from_folder($asset) {
        if(!($asset instanceof Asset_Folder)) {
            return array();
        }
        $assets=Asset_Folder::getById($asset->id)->getChilds();
        foreach ($assets as $assetChild) {
            if($assetChild instanceof Asset_Folder) {
                $assetsArray = real_get_all_images_from_folder($assetChild);
            }
            else if($assetChild instanceof Asset_Image) {
                $assetsArray[] = $assetChild;

            }
        }
        return $assetsArray;
        
    }
}
?>


<?php if($this->editmode): ?>
    <?= $this->multihref("objectPaths",
    [
        "types" => ["object"],
        "classes" => ["projectPost"]

    ]); ?>
<?php else: ?>
<div class="blog">
<div class="card-columns clickable">
<?php foreach($this->multihref("objectPaths") as $article) {

	$this->template("/snippets/lpn-grid-realisations-item.php",array('article'=>$article)); ?>

<?php } ?>
   


    </div>
    
</div>
  

<?php endif; ?>



</section>
