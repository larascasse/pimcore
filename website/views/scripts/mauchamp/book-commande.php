<?php 

$products = $this->products;
$ids=0;


/* Cover */
echo $this->template("mauchamp/cover-for-piece-commerciale.php",array("product"=>$product,"orderDetail" => $this->orderDetail));




/* Photos / Fiche produits */
foreach ($products as $product) {
	if(!$product->isAccessoire()) {
		echo $this->template("product/detail-photos.php",array("product"=>$product,"index"=>$ids)); 
		echo $this->template("product/detail-intra.php",array("product"=>$product,"index"=>$ids++)); 
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

if($hasAccessoires)
	echo $this->template("product/detail-all-accessoires.php",array("products"=>$products)); 

/* Fiches techniques */
foreach ($products as $product) {
	if(!$product->isPlusValue()) 
		echo $this->template("product/detail-ft.php",array("product"=>$product)); 
}
?>