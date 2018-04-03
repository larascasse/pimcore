<?php
$teinteName = $this->teinte->getName();
$products = $this->products;


echo "<h1>".$teinteName."</h1>";

echo $this->template("product/inc-product-table-variations.php",array("products"=>$products));
?>
<table>


<?php
foreach ($products as $product) { ?>
<tr>
	<td><?php echo $product->getName();?></td>
	<td><?php echo $product->getChoixString();?></td>
	<td><?php echo $product->getFinition();?></td>
</tr>
<?php }

?>