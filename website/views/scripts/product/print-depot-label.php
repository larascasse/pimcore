<?php
$product = $this->product;
$order = $this->order;
$orderAzure = $this->order;
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
if (!isset($product) && !isset($order) ) {
?>


<div class="page row align-items-center justify-content-center text-center" style="height:250px">
<div class="col-10">
<h2>Etiquette</h2>
<form>
<div class="form-group">
<input class="form-control form-control-lg" name="ean" type="text" placeholder="EAN" value="<?php echo isset($this->ean)?$this->ean:""?>">
</div>
<button type="submit" name="format"  value="small_label" class="btn btn-primary btn-lg">Petite etiquette</button>
<button type="submit" name="format"  value="big_label" class="btn btn-primary btn-lg">Grosse etiquette</button>
</form>
</div>
</div>


<?php
}
elseif (isset($product)) {
	
	//$productName = $product->getMage_name(3000);
	$productName = $product->getPimonly_print_label();
	/*$productName = str_ireplace("parquet ", "", $productName);
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
	$productName =ucfirst($productName);*/
?>

<script>
var labelContent = new Array();
	
</script>
<input type="button" class="btn" onclick="printLabelSmallEtiquette(labelContent);" value="Print">
<input type="button" class="btn" onclick="test();" value="Test.." />



<script>
// first label
var labelContent = new Array();
labelContent.push({
	texte :  "<?php echo $productName  ?>",
	codebarre : "<?php echo $product->getEan()?>"}
	);

</script>

<?php for ($i=0; $i < 1; $i++) {  ?>
<div class="landscape <?php echo $this->format ?>">
<div>
<div class="p-row">

<div  class="p-name"><?php echo $productName  ?></div>
<div  class="p-dimensions"><?php echo $product->getPimonly_dimensions() ?></div>
<div  class="p-ean"><?php echo $product->getEan() ?></div>


 <?php
$subtitle = "";//strlen($product->getSku())>0?$product->getSku():"";
if(strlen($product->name_scienergie_court)) {
	if(strlen($subtitle)>0) 
		$subtitle .=" - ";
	
	$subtitle .=$product->name_scienergie_court;
	$subtitle .=" - ". $product->getCode();
}
if (strlen($subtitle)>0) {
	//echo $subtitle = '<p class="p-subtitle">'.$subtitle.'</p>';
}

?>

<?php
// Seul le texte à écrire est obligatoire
$barcodeOptions = array(
	'text' => $product->getEan(),
	//'barHeight' => 100,
	'barHeight' => 20,
	'fontSize' => 15,
	'barThickWidth' => 2,
	'barThinWidth' => 1,
	'factor' => 1,
	'stretchText' => true


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
<div class="p-label">
	<div class="p-logo">
<?php echo $this->template("includes/logo_1l_small_svg.php"); ?>
</div>

<img src="<?php //echo $httpFile?>" />
</div>
</div>
</div>
</div>
<?php
}
?>

<?php
}


elseif (isset($order)) {
	
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
<h1  class="display-1 p-3" style="letter-spacing: 0.1rem; color:black; font-size:5em"><strong><?php echo $orderAzure->Code_Commande ?></strong></h1>
<h1  class="display-1 p-3" style="letter-spacing: 0.1rem; color:black; font-size:3em"><strong>Client : <?php echo $orderAzure->getCodeClient() ?></strong></h1>
<?php if(strlen($orderAzure->Reference_Client)>0) {?>
<h1  class="display-3 p-3"><strong>Réf : <?php echo $orderAzure->Reference_Client ?></strong></h1>
<?php } ?>

<h2 class="p-3 display-4">Fact : <?php echo $orderAzure->Adresse_Facturation_Raison_Sociale ?></h2>
<p>
	Site : <?php echo $orderAzure->Code_SITE ?><br />
	Dépot : <?php echo $orderAzure->Code_Depot ?><br />
	Date : <?php echo $orderAzure->Date ?><br /><br />

 

<?php
// Seul le texte à écrire est obligatoire
$barcodeOptions = array(
	'text' =>  $orderAzure->Code_Commande,
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
$imgFile = PIMCORE_TEMPORARY_DIRECTORY . "/barcode_" . $orderAzure->Code_Commande . ".png";
imagepng($imageResource, $imgFile);

$httpFile = \Pimcore\Tool::getHostUrl() . str_replace($_SERVER["DOCUMENT_ROOT"],"",$imgFile);

?>
<?php echo $this->template("includes/logo_1l_small_svg.php"); ?>

<img src="<?php echo $httpFile?>" />
</div>
</div>

<?php
}
?>

