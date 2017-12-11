<?php 



$product = $this->product;

$extras = $product->getRelated("extras");

$childrens = $product->getChilds();
$lesplus = $product->getLesPlusArray();

$packshotsImages = $this->product->getImageAssetArray();

$realisations = 	$this->product->getRealisations();
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

$imageLeft=array();
$imageRight=array();

//colonne de gauche
if(count($packshotsImages)>0) {
	$imageLeft[] = array_shift($packshotsImages);
}
if(count($assetsArray)>0) {
	$imageLeft[] = array_shift($assetsArray);

}



//colonne de droite
if(count($packshotsImages)>0) {
	$imageRight[] = array_shift($packshotsImages);
}
if(count($packshotsImages)>0) {
	$imageRight[] = array_shift($packshotsImages);
}
if(count($assetsArray)>0) {
	$imageRight[] = array_shift($assetsArray);

}

if(count($imageRight)<=2 && count($packshotsImages)>0) {
	$imageRight[] = array_shift($packshotsImages);
}
if(count($imageRight)<=2 && count($assetsArray)>0) {
	$imageRight[] = array_shift($assetsArray);
}


//colonne de gauche
if(count($packshotsImages)>0) {
	$imageLeft[] = array_shift($packshotsImages);
}
if(count($assetsArray)>0) {
	$imageLeft[] = array_shift($assetsArray);

}


if(count($assetsArray)>0) {
	$imageRight[] = array_shift($assetsArray);

}
if(count($assetsArray)>0) {
	$imageRight[] = array_shift($assetsArray);

}

//colonne de gauche
if(count($packshotsImages)>0) {
	$imageLeft[] = array_shift($packshotsImages);
}
if(count($assetsArray)>0) {
	$imageLeft[] = array_shift($assetsArray);

}





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

 foreach ($imageLeft as $asset) {
 	echo getPhotoHtml($asset,$product);
 }
 

?>




</div>
<!-- First col / -->
<!-- Second col -->
<div class="ft-col-2">


<div class="">

 <?php
 
 foreach ($imageRight as $asset) {
 	echo getPhotoHtml($asset,$product);
 }
?>



	
</div>

<!-- Second col / -->
</div>
</div>
<!-- FIN MAIN LAYOUT / -->
</div>
</div>


