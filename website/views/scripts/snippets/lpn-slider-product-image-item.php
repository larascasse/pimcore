<?php 



/*
Affiche un asset, et le produit associé en légende
*/

$asset = $this->asset;
$product = $this->product;


if(!$asset && $product) {
	$asset = $product -> getImage_1();
	if(!$asset)
		$asset = $product -> getImage_2();
	if(!$asset)
		$asset = $product -> getImage_3();
}

if($asset && !$product) {

	$product = $asset->getRelatedProduct();
}



$imageformat = isset($this->imageformat)?$this->imageformat:'magento_realisation';
$cardformat = isset($this->cardformat)?' '.$this->cardformat:'';


$title  = "";
$desc  = "";

if($asset) {
	$title = trim($asset->getRelatedTitle());
	$desc = trim($asset->getRelatedDescription());
}





//si on a un produit, on affiche le itre
//On automaotise pas, on affiche pas le titre de l'image
if($product) {

	$sku = $product->getEan();
	if(!$sku && count($childs = $product->getChildren([\Pimcore\Model\Object::OBJECT_TYPE_OBJECT],false))>0) {
		$product = $childs[0];
		$sku = $product->getEan();
	}

	//$widgetPrice =  !empty($sku)?'{{block type="core/template" template="lpn/give_me_the_price.phtml" name="givemethepricetsimple_'.$sku.'" product_sku="'.$sku.'"}}' : '';

	 //Ajout prix, pour V3, tant qu'on utilise pas V4
    $price = $product->getPrice_4();
    $priceTTC = 0;

    $priceStr = "";
    if($price > 0 ) {
        $price = floatval($price);
        $priceStr = "Prix: ";
        $priceStr .= number_format($price,2);
        $priceStr .= "€ HT/".strtolower($product->getUnite());
        $priceStr .= " - ";
        $priceStr .= number_format($price*1.2,2);
        $priceStr .= "€ TTC/".strtolower($product->getUnite());
    }


	$widgetPrice = $priceStr;


	$title 	= 	$product->getMage_short_name();

	$prefixe = 'Ean: '.$sku." | ";
	//$title 	=	$product->getSubtype()."<br />".$product->getShort_name();
	if(!empty($product->getShort_description()))
		$desc 	=  	trim($product->getShort_description()." ".$prefixe . $widgetPrice);
	else
		$desc 	=  	trim($prefixe . $widgetPrice);
	
}


?>       
<div class="card <?php echo $cardformat ?>">    
<?php 

//Plus de zoom now.. on click !!
//echo '<a href="#" data-zoom="'.$asset->getThumbnail('magento_realisation')->getPath().'">'.$asset->getThumbnail($imageformat)->getHTML(["class" => "img-fluid",/*"attributes"=>["data-zoom"=>$asset->getThumbnail('magento_realisation')->getPath()]*/]).'</a>'; 

echo $asset->getThumbnail($imageformat)->getHTML(["class" => "img-fluid",/*"attributes"=>["data-zoom"=>$asset->getThumbnail('magento_realisation')->getPath()]*/]); 

?>

<div class="card-block caption">
  <p class="card-title legendtitle"><?php echo $title ?></p>
  <p class="card-text legendimage"><?php echo $desc ?></p>
</div>
<?php  
if ($product && $product->isSalable())
	echo $this->template("/content/link-eshop-renderlet.php",array('product'=>$product,'btn_title'=>$product->getShort_name())); ?>

</div>
