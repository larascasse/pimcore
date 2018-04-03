<?php 

$products = $this->products;
$ids=0;

$ftIncludedSkus = $this->ftIncludedSkus;
$poseIncludedSkus = $this->poseIncludedSkus;
$photosIncludedSkus = $this->photosIncludedSkus;

print_r($photosIncludedSkus);


/* Cover */
echo $this->template("mauchamp/cover-for-piece-commerciale.php",array(
	"product"=>$product,
	"orderDetail" => $this->orderDetail,
	//"ftIncludedSkus" => $ftIncludedSkus,

));


//return;

/* Photos / Fiche produits */
foreach ($products as $product) {

	if(in_array($product->getSku(),$photosIncludedSkus)) {
		
		if(!$product->isAccessoire()) {

			if(!$product->isTable()) {
				if(strlen(trim($product->getDescription()))>0) {
					echo $this->template("product/detail-intra.php",array("product"=>$product,"index"=>$ids)); 
				}
			}
			

			if(count($product->getImageAssetArray(true))>0) {
				echo $this->template("product/detail-photos.php",array("product"=>$product,"index"=>$ids));

			}

			
			$ids ++;
		}
	}
	
}



/* Accessoires */
$idx=0;
$hasAccessoires = false;
foreach ($products as $product) {
	if($product->isAccessoire() && in_array($product->getSku(),$photosIncludedSkus)) {
		$hasAccessoires =true;
		break;
	}
}

if($hasAccessoires) {

	//On fait des groupes de 4, pour insere une page break
	$ids=0;
	$pageProduct=array();
	foreach ($products as $product) {
		//echo $product->getName()."<br >";

		if(in_array($product->getSku(),$photosIncludedSkus)) {
			if( $product->isAccessoire() && !$product->isPlusValue()) {
				$page = floor($ids/4);
				if(!isset($pageProduct[$page]))
					$pageProduct[$page]=array();

				//echo $page."/".$ids."    ";

				array_push($pageProduct[$page],$product);
				//echo "lklmklkm";
				$ids++;
			}
		}
		
	}


	//Puis, par page
	foreach ($pageProduct as $key => $productsByPage) {

		echo $this->template("product/detail-all-accessoires.php",array("products"=>$productsByPage)); 
	}
	
	
}


/* Fiches techniques */
foreach ($products as $product) {

	if(in_array($product->getSku(),$ftIncludedSkus)) {
		if(!$product->isPlusValue() && !$product->getFiche_technique_lpn() && !$product->isAccessoire())  {

			if(!$product->isTable()) {
				echo $this->template("product/detail-ft.php",array("product"=>$product));
			} 
		}
	}
}
?>