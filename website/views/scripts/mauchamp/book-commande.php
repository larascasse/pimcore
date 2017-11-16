<?php 


echo $this->template("mauchamp/cover-for-piece-commerciale.php",array("product"=>$product,"orderDetail" => $this->orderDetail));


$products = $this->products;
$idx=0;
foreach ($products as $product) {
	if(!$product->isAccessoire()) {
		echo $this->template("product/detail-photos.php",array("product"=>$product,"index"=>$ids++)); 
		echo $this->template("product/detail-intra.php",array("product"=>$product,"index"=>$ids++)); 
	}
}

$idx=0;
	echo $this->template("product/detail-all-accessoires.php",array("products"=>$products)); 


foreach ($products as $product) {
	if(!$product->isPlusValue()) 
		echo $this->template("product/detail-ft.php",array("product"=>$product)); 
}
?>