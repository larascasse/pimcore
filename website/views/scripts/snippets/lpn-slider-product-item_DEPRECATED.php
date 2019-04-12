<?php 
/*
Affiche un produit en link
*/


$product = $this->product;
$image = $product -> getImage_1();
if(!$image)
	$image = $product -> getImage_2();
if(!$image)
	$image = $product -> getImage_3();


$imageformat = isset($this->imageformat)?$this->imageformat:'magento_realisation';
$cardformat = isset($this->cardformat)?' '.$this->cardformat:'';

$widgetPrice =  '{{block type="core/template" template="lpn/give_me_the_price.phtml" name="givemetheprice_'.$product->getSku().'" product_sku="'.$product->getSku().'"}}';


$title 	= 	$product->getShort_name();
//$title 	=	$product->getSubtype()."<br />".$product->getShort_name();
if(!empty($product->getShort_description()))
	$desc 	=  	trim($product->getShort_description()." ".$widgetPrice);
else
	$desc 	=  	trim($product->getSku()." ".$widgetPrice);
?>

<div class="card <?php echo $cardformat ?>">         

<?php if($image) echo $image->getThumbnail($imageformat)->getHTML(["class" => "img-fluid norelazy__"]); ?>


<div class="caption">

  <p class="legendtitle"><?php echo  $product->getSubtype()."<br />".$product->getShort_name() ?></p>
  <p class="legendimage"><?php echo $desc ?></p>


</div>
<?php  echo $this->template("/snippets/link-eshop-renderlet.php",array('product'=>$product,'btn_title'=>$product->getSubtype()." - ".$product->getShort_name())); ?>
</div>
