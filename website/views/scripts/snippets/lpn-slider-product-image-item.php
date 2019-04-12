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

	if(!$sku && count($childs = $product->getChildren([\Pimcore\Model\Object::OBJECT_TYPE_OBJECT],false))>0) {
		$sku = $childs±[0]->getEan();
	}

	$widgetPrice =  !empty($sku)?'{{block type="core/template" template="lpn/give_me_the_price.phtml" name="givemethepricetsimple_'.$sku.'" product_sku="'.$sku.'"}}' : '';


	$title 	= 	$product->getMage_short_name();
	//$title 	=	$product->getSubtype()."<br />".$product->getShort_name();
	if(!empty($product->getShort_description()))
		$desc 	=  	trim($product->getShort_description()." ".$widgetPrice);
	else
		$desc 	=  	trim($sku." ".$widgetPrice);
	
}


?>       
<div class="card <?php echo $cardformat ?>">    
<?php 
echo '<a href="#" data-zoom="'.$asset->getThumbnail('magento_realisation')->getPath().'">'.$asset->getThumbnail($imageformat)->getHTML(["class" => "img-fluid",/*"attributes"=>["data-zoom"=>$asset->getThumbnail('magento_realisation')->getPath()]*/]).'</a>'; ?>

<div class="card-block caption">
  <p class="card-title legendtitle"><?php echo $title ?></p>
  <p class="card-text legendimage"><?php echo $desc ?></p>
</div>
<?php  
if ($product)
	echo $this->template("/snippets/link-eshop-renderlet.php",array('product'=>$product,'btn_title'=>$product->getShort_name())); ?>

</div>
