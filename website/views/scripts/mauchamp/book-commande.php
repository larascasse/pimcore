<?php 

$products = $this->products;
$ids=0;


/* Cover */
echo $this->template("mauchamp/cover-for-piece-commerciale.php",array("product"=>$product,"orderDetail" => $this->orderDetail));


//return;

/* Photos / Fiche produits */
foreach ($products as $product) {
	if(!$product->isAccessoire()) {

		

		if(strlen(trim($product->getDescription()))>0) {
			echo $this->template("product/detail-intra.php",array("product"=>$product,"index"=>$ids)); 
		}

		if(count($product->getImageAssetArray(true))>0) {
			echo $this->template("product/detail-photos.php",array("product"=>$product,"index"=>$ids));

		}

		
		$ids ++;
	}
}



/* Accessoires */
$idx=0;
$hasAccessoires = false;
foreach ($products as $product) {
	if($product->isAccessoire()) {
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


	//Puis, par page
	foreach ($pageProduct as $key => $productsByPage) {

		echo $this->template("product/detail-all-accessoires.php",array("products"=>$productsByPage)); 
	}
	
	
}


/* Fiches techniques */
foreach ($products as $product) {
	if(!$product->isPlusValue() && !$product->getFiche_technique_lpn() && !$product->isAccessoire())  {

		echo $this->template("product/detail-ft.php",array("product"=>$product)); 
	}
}
?>