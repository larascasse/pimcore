<?php 
/*
Affiche un produit en link
*/
?>

<?php

$product = $this->product;
$image = $product -> getImage_1();
if(!$image)
	$image = $product -> getImage_2();
if(!$image)
	$image = $product -> getImage_3();


$imageformat = isset($this->imageformat)?$this->imageformat:'magento_realisation';
$cardformat = isset($this->cardformat)?' '.$this->cardformat:'';
?>

<div class="card <?php echo $cardformat ?>">         

<?php if($image) echo $image->getThumbnail($imageformat)->getHTML(["class" => "img-fluid norelazy__"]); ?>


<div class="caption">

  <p class="legendtitle"><?php echo  $product->getSubtype()."<br />".$product->getShort_name() ?></p>
  <p class="legendimage"><?php echo $product->getDescription()?></p>


</div>
<?php  echo $this->template("/content/link-eshop-renderlet.php",array('product'=>$product,'btn_title'=>$product->getSubtype()." - ".$product->getShort_name())); ?>
</div>
