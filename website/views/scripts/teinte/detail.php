<?php
$teinteName = $this->teinte->getName();
$products = $this->products;

?>

<div class="row">
<div class="col-2">
	<ul style="padding: 0;margin: 0;list-style:none; font-size:10px;">
<?php
if(is_array($this->teintes)) {
	foreach ($this->teintes as $allTeinte) {
		echo '<li style="padding: 0;margin: 0;list-style:none;"><a href="/teinte/'.$allTeinte->getId().'">'.$allTeinte->getName().'</a></li>';
	}
}
?>
</ul>
</div>
<div class="col-10">


<?php

echo "<h1>".$teinteName."</h1>";

//echo $this->template("product/inc-product-table-variations.php",array("products"=>$products));
?>


<?php
foreach ($products as $product) { 
	echo "<h5>".$product->getMage_short_name()." - ".$product->getCode()."</h5>";
	for ($i=1;$i<5;$i++) {
		$image = $product->{"getImage_" . $i}();
		if($image) {
			echo '<img src="'.$image->getThumbnail("galleryCarouselPreview").'"/>';
		}
		$image = $product->{"getImage_" . 'texture'}();
		if($image) {
			echo '<img src="'.$image->getThumbnail("galleryCarouselPreview").'"/>';
		}
	}
	
            	
            	
	                

	echo $this->template("product/inc-product-table-variations.php",array("products"=>array($product)));
	echo "<hr />";

}
?>
</div>
</div>