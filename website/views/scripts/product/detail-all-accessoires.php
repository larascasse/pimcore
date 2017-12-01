<?php 



$products = $this->products;

?>

<div class="accessoire">
	<div class="ft-header">
		<div class="ft-col-1">
	<div id="logo2" style='width:507px;height:45px'>
				<?php echo $this->template("includes/logo_1l_svg.php"); ?>
				 
			</div>
			
		</div>

		<div class="ft-col-2">
			<div>
			<h1>Accessoires</h1>
			</div>
		</div>

	</div>




<?php
foreach ($products as $product) {
	//echo $product->getName()."<br >";
	if($product->isAccessoire() && !$product->isPlusValue()) {

		echo $this->template("product/detail-accessoire.php",array("product"=>$product,"index"=>$ids++)); 
	}
}

?>
</div>


