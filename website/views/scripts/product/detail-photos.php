<?php 



$product = $this->product;
$relatedProducts = $product->getRelated("relatedProducts");

$associatedArticles = $product->getRelated("associatedArticles");
$relatedAccessories = $product->getRelated("relatedAccessories");
$caracteristiques = $product->getCharacteristicsFo();
$extras = $product->getRelated("extras");

$childrens = $product->getChilds();
$lesplus = $product->getLesPlusArray();

?>

<div class="fp">
<div class="ft-header">
<div class="ft-col-1">
	<div id="logo2" style='width:338px;height:30px'>
		<?php echo $this->template("includes/logo_1l_svg.php"); ?>
		 
	</div>
	<h4>Fiche produit</h4>
		 <p><?php echo $product->getCheminDeFer() ?></p>
</div>

<div class="ft-col-2">
<div>
<h1 style=""><?php echo $product->getMage_short_name(3000); ?></h1>
 <?php
$subtitle = strlen($product->getSku())>0?$product->getSku():"";
if(strlen($product->name_scienergie_court)) {
	if(strlen($subtitle)>0) 
		$subtitle .=" - ";
	$subtitle .=$product->name_scienergie_court;
}
if (strlen($subtitle)>0) {
	echo $subtitle = '<p>'.$subtitle.'</p>';
}
?>
</div>
</div>

</div>

<div class="ft-content">

<div class="">

<!-- First col -->
<div class="ft-col-1">


        <?php for($i=1; $i<=3; $i++) { ?>
            <?php
                $image = $this->product->{"getImage_" . $i}();
            ?>
            <?php if($image) { ?>
                <div class="col-xs-12">
                    <?php echo $image->getThumbnail("magento_realisation")->getHTML(["class"=>"img-responsive"]); ?>
                </div>
            <?php } ?>
        <?php } ?>



</div>
<!-- First col / -->
<!-- Second col -->
<div class="ft-col-2">


<div class="">



<?php
if(is_array($logoAssets) && count($logoAssets)>0) {
	foreach ($logoAssets as  $asset) {
		//echo '<div class="col-xs-2__">';
    	echo  $asset->getThumbnail("magento_logo")->getHTML(array("class"=>'ft-logo')); 
    	//echo '</div>';
    }
}

?>


	
</div>

<!-- Second col / -->
</div>
</div>
<!-- FIN MAIN LAYOUT / -->
</div>
</div>


