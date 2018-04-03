<?php
$teinteName = $this->teinte->getName();
$products = $this->products;


echo "<h1>".$teinteName."</h1>";

//echo $this->template("product/inc-product-table-variations.php",array("products"=>$products));
?>


<?php
foreach ($products as $product) { 
	echo "<h5>".$product->getMage_short_name()." - ".$product->getCode()."</h5>";
	echo $this->template("product/inc-product-table-variations.php",array("products"=>array($product)));
	echo "<hr />";

}