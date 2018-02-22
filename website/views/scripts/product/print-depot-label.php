<?php
$product = $this->product;

?>

<?php

if(isset($this->message)) {
	echo '
		<div class="row justify-content-center text-center">
		<div class="col-10"><br /><br />
		<div class="p-3 mb-2 bg-'.$this->message[0].' text-white">'.$this->message[1].'</div>
		</div>
		</div>';
}


?>

<?php
if (!isset($product)) {
?>


<div class="page row align-items-center justify-content-center text-center" style="height:250px">
<div class="col-10">
<h2>Etiquette</h2>
<form>
<div class="form-group">
<input class="form-control form-control-lg" name="ean" type="text" placeholder="EAN" value="<?php echo isset($this->ean)?$this->ean:""?>">
</div>
<button type="submit" class="btn btn-primary btn-lg">Rechercher</button>
</form>
</div>
</div>


<?php
}
else {
	$productName = $product->getName(3000);
	$productName = str_ireplace("parquet ", "", $productName);
	$productName = str_ireplace("plancher ", "", $productName);
	$productName = str_ireplace("chene ", "", $productName);
	$productName = str_ireplace("chêne ", "", $productName);
	$productName = str_ireplace("monolame ", "", $productName);
	$productName = str_ireplace("RIVES ABIMEES ", "", $productName);
	$productName = str_ireplace("PEFC", "", $productName);
	$productName = str_ireplace("nf ", " ", $productName);
	$productName = str_ireplace("massif ", " ", $productName);
	$productName = str_ireplace("contrecolle ", " ", $productName);
	$productName = str_ireplace("g2 ", " ", $productName);
	$productName = str_ireplace("teinte ", " ", $productName);
	$productName = str_ireplace("contemporain ", " ", $productName);
	$productName = str_ireplace(" - ", " ", $productName);
	$productName = str_ireplace("  ", " ", $productName);
	$productName = str_ireplace("( ", "(", $productName);
	$productName = str_ireplace(" )", ")", $productName);
	$productName =ucfirst($productName);
?>
<style type="text/css" media="print">
	
/* DYMO 
@media print {
html,body{height:100%;width:100%;margin:0;padding:0;}
@page {
size: A4 landscape;
max-height:100%;
max-width:100%
}
body{
	width:100%;
height:100%;
-webkit-transform: rotate(-90deg) scale(1.3,1.3)  translate(-5%,25%); 
-moz-transform:rotate(-90deg) scale(1,1) 
}    
}
}
*/
</style>

<style>
a[x-apple-data-detectors] {
  color: inherit !important;
  text-decoration: none !important;
  font-size: inherit !important;
  font-family: inherit !important;
  font-weight: inherit !important;
  line-height: inherit !important;
}
</style>


<div class="row landscape text-center">
	<div class="col-12">
<h1  class="display-1" style="letter-spacing: 0.1rem; color:black"><strong><?php echo $product->getEan() ?></strong></h1>
<h1  class="display-3"><strong><?php echo $product->getPimonly_dimensions() ?></strong></h1>
<h2 class="p-3 display-4"><?php echo $productName  ?></h2>
 <?php
$subtitle = "";//strlen($product->getSku())>0?$product->getSku():"";
if(strlen($product->name_scienergie_court)) {
	if(strlen($subtitle)>0) 
		$subtitle .=" - ";
	
	$subtitle .=$product->name_scienergie_court;
	$subtitle .=" - ". $product->getCode();
}
if (strlen($subtitle)>0) {
	echo $subtitle = '<p class="text-center">'.$subtitle.'</p>';
}

?>

<?php
// Seul le texte à écrire est obligatoire
$barcodeOptions = array(
	'text' => $product->getEan(),
	//'barHeight' => 100,
	'barHeight' => 20,
	'fontSize' => 10,
	//'barThickWidth' => 2,
	'factor' => 1,


);
// Pas d'options requises
$rendererOptions = array();
// Tracé du code-barres dans une nouvelle image
$imageResource = Zend_Barcode::draw(
    'code39', 'image', $barcodeOptions, $rendererOptions
);
$imgFile = PIMCORE_TEMPORARY_DIRECTORY . "/barcode_" . $product->getEan() . ".png";
imagepng($imageResource, $imgFile);

$httpFile = \Pimcore\Tool::getHostUrl() . str_replace($_SERVER["DOCUMENT_ROOT"],"",$imgFile);

?>
<?php echo $this->template("includes/logo_1l_small_svg.php"); ?>

<img src="<?php echo $httpFile?>" />
</div>
</div>
<script type="text/javascript">
	var productName="<?php echo wordwrap($this->product->getName(),60,'\\n'); ?>";

</script>
<img src="" id="labelImage" />
<?php
}
?>