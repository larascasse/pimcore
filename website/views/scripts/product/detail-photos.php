<?php 



$product = $this->product;

$extras = $product->getRelated("extras");

$childrens = $product->getChilds();
$lesplus = $product->getLesPlusArray();

$packshotsImages = $this->product->getImageAssetArray();

$realisations =$this->product->getRealisations();
$count=count($realisations);
$assetsArray=array();
for ($i=0; $i < $count; $i++) { 
		$assets=Asset_Folder::getById($realisations[$i]->id)->getChilds();
		foreach ($assets as $asset) {
			$assetsArray[] = $asset;
		}
}

//Si pas de photos, on abs(ffiche pas la page)
if(count($packshotsImages)==0 && count($realisations)==0)
	return;

if(!function_exists("getPhotoHtml")) {
	function getPhotoHtml($asset,$product) {
		$str ="";
		$str .='<div class="thumbnail">';
		$str .=  $asset->getThumbnail("magento_realisation")->getHTML(array("class"=>"img-responsive photo"));
 		
 		$title = $asset->getRelatedTitle($fullname=true);
 		if(strlen($title)>0) {
	 		$str .='<div class="caption">';
			$str .= $title;
	 		$str .= "<br />".$product->getAssetIsDiffrentString($asset);
	 		$str .= '</div>';
 		}

 		$str .= '</div>';
 		return $str;
	}
}


?>


<div class="fp photos">
<div class="ft-header">
<div class="ft-col-1">
	<div id="logo2" style='width:507px;height:45px'>
		<?php echo $this->template("includes/logo_1l_svg.php"); ?>
		 
	</div>
	<h4>Photos</h4>
	<p><?php echo $product->getCheminDeFer() ?></p>
</div>

<div class="ft-col-2">
<div>
<h1 style=""><?php echo $product->getMage_short_name(3000); ?></h1>
 <?php
$subtitle = strlen($product->getSku())>0?$product->getSku():"";
if(strlen($product->name_scienergie_court)) {
	if(strlen($subtitle)>0) 
		$subtitle .=" - ";
	
	//$subtitle .=$product->name_scienergie_court;
}
if (strlen($subtitle)>0) {
	echo $subtitle = '<p>'.$subtitle.'</p>';
}
?>
</div>
</div>

</div>

<div class="ft-content">

<div class="">

<!-- First col -->
<div class="ft-col-1">


 <?php
 if(count($packshotsImages)>0) {
 	echo getPhotoHtml($packshotsImages[0],$product);

 }

  if(count($assetsArray)>0) {
 	for ($i=0; $i < min(count($assetsArray),2); $i++) { 
 		echo getPhotoHtml($assetsArray[$i],$product);

 	}
 	
 }


?>




</div>
<!-- First col / -->
<!-- Second col -->
<div class="ft-col-2">


<div class="">

 <?php
 if(count($packshotsImages)>1) {
 	for ($i=1; $i < count($packshotsImages); $i++) { 
 		echo getPhotoHtml($packshotsImages[$i],$product);
 		
 	}
 	
 }
?>

 <?php
 if(count($assetsArray)>2) {
 	for ($i=2; $i < min(4,count($assetsArray)); $i++) { 
 		echo getPhotoHtml($assetsArray[$i],$product);
 	}
 	
 }
?>



	
</div>

<!-- Second col / -->
</div>
</div>
<!-- FIN MAIN LAYOUT / -->
</div>
</div>


