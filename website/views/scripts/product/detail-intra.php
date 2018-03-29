<?php 



$product = $this->product;
$relatedProducts = $product->getRelated("relatedProducts");

$associatedArticles = $product->getRelated("associatedArticles");
$relatedAccessories = $product->getRelated("relatedAccessories");
$caracteristiques = $product->getCharacteristicsFo();
$extras = $product->getRelated("extras");

$childrens = $product->getChilds();
$lesplus = $product->getLesPlusArray();

$caracteristiques =  $product->getCharacteristicsArray();
$packshotsImages = $product->getImageAssetArray();
$logoAssets = array();
 foreach ($caracteristiques as $key => $value) {

 			if(!is_array($value)) {
 				continue;
 			}

			if(isset($value["logo"])) {
				$logoAssets[] = $value["logo"];
			}
}



?>

<div class="fp">
<div class="ft-header">
<div class="ft-col-1">
	<div id="logo2" style='width:507px;height:45px'>
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

/*if(strlen($product->name_scienergie_court)) {
	if(strlen($subtitle)>0) 
		$subtitle .=" - ";
	$subtitle .=$product->name_scienergie_court;
}*/
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

<div class="row">

	<div class="col-xs-12">
	<?php echo ($this->product->getMage_description()); ?><br /><br />
	</div>
	<div class="col-xs-12">
	<?php
	if(count($packshotsImages)>0) {
	 	$image = $packshotsImages[0];
	 	echo $image->getThumbnail("magento_header")->getHTML(["class"=>"img-responsive photo"]);
	 }
	 ?>

	 <?php if (count($lesplus)>0) : ?>
	 <div class="lesplus">
	<h3>Vous aimerez</h3>
	<?php echo str_replace("<br />", " : ",$this->product->getMage_lesplus()); ?>
	</div>
	<?php endif; ?>
	</div>
</div>








</div>
<!-- First col / -->
<!-- Second col -->
<div class="ft-col-2">


<div class="">


	
<?php 
$subDescArray = explode("\n",$this->product->getMage_sub_description());

if(is_array($subDescArray) && count($subDescArray)>0) {
	echo '<ul class="subdescription">';

	foreach ($subDescArray as $key => $value) {
		echo '<li>'.$value.'</li>';
	}
	echo "</ul>";
} 
?>

<br />
<?php
if(is_array($logoAssets) && count($logoAssets)>0) { ?>
	<?php
	foreach ($logoAssets as  $asset) {
		//echo '<div class="col-xs-2__">';
    	echo  $asset->getThumbnail("magento_logo")->getHTML(array("class"=>'ft-logo')); 
    	//echo '</div>';
    }
    ?>
	 
  <?php 
}

?>


	
</div>

<!--
<?php 
//detail taxo
$taxonomies = $product->getSelfAndChildrenTaxonomyObjects('support');
if(count($taxonomies) > 0) { ?>
<div class="row">

	<div class="col-xs-12">
	<h3>Support</h3>
	</div>
<?php
foreach ($taxonomies as $label => $taxonomie) {
	echo '<div class="col-xs-4">';
	echo '<p><strong>'.ucfirst(strtolower($taxonomie->getLabel())).'</strong></p>';
	echo "<p>".$taxonomie->getHelp().'</p>';
	echo '</div>';
}
?>

</div>
<?php } ?>
-->

<!--
<hr />

<?php 
//detail taxo
$taxonomies = $product->getSelfAndChildrenTaxonomyObjects('choix');
if(count($taxonomies) > 0) { ?>
<div class="row">

	<div class="col-xs-12">
	<h3>Choix</h3>
	</div>
<?php
foreach ($taxonomies as $label => $taxonomie) {
	echo '<div class="col-xs-4">';
	echo '<p><strong>'.ucfirst(strtolower($taxonomie->getLabel())).'</strong></p>';
	echo "<p>".$taxonomie->getHelp().'</p>';
	echo '</div>';
}
?>

</div>
<?php } ?>

<hr />
-->

<div class="row">
	<div class="col">
	    <div class="">
	       

	   		 <?php
	   		 $strChildren="";
	   		 if(count($childrens)>0) {

	   		 	$fields["Choix"] = "getChoix";
	   		 	$fields["Surface"] = "getTraitement_surface";
	   		 	$fields["Finition"] = "getFinition";
	   		 	$fields["Support"] = "getSupport";
	   		 	if($product->isParquetContrecolle()) {
	   		 		$fields["CU"] = "getCoucheUsure";
	   		 	}
	   		 	$fields["Colisage"] = "getColisage";
	   		 	$fields["Dimensions"] = "getPimonly_dimensions";
	   		 	$fields["Utilisation"] = "getCalculatedClasseUtilisation";
	   		 	$fields["EAN"] = "getEan";
	   		 	$fields["Prix Public HT<br /> au ".date('d/m/Y')] = "getPrice_4";
	   		 	$fields["FT"] = "getPreviewLink";



			$strChildren.=   '<table class="table table-striped">  <thead><tr>';
			foreach ($fields as $key => $value) {
				$strChildren.= '<th>'.$key.'</th>';
			}
			$strChildren.= '</tr></thead>';

  			$index = 1;
  			$productsToDisplay =array();
			foreach ($childrens as $subProduct) {

				//Configurables
				if($subProduct->getEan()=="") {
					$subProductChildrens = $subProduct->getChilds();
		
					
					foreach ($subProductChildrens as $subsubProduct) {
						$productsToDisplay[] = $subsubProduct;
					
					}

				}
				else { 
					$productsToDisplay[] = $subProduct;
					
				}
			}

			foreach ($productsToDisplay as $subproduct) {
				?>
					<tr>
						<?php
						foreach ($fields as $key => $value) {
							$v = $subproduct->$value();
							$strChildren.= '<td>'.$v.'</td>';
						}
						?>
					     
					   
					    
					    </tr>


				<?php

			}
			$strChildren.=   "</table>";
		}

		//echo $strChildren;
		?>

	    </div>
	</div>

 <!-- Fin product header -->  


</div> <!-- row -->




<!--
<hr />


	

	<?php 
	if(count($associatedArticles)>0) {
		echo '<div class="row">';
		//echo "<h3>Articles associés</h3>";
		
		foreach ($associatedArticles as $article) {
			echo "<div class='col-md-4'><hr /><h3>".$article->getName()."</h3>";
			echo $article->getContent();
			$associatedDocuments = $article->getDocuments();
			foreach ($associatedDocuments as $document) {
				$linkLabel = strlen($document->getProperty("downloadLink"))>0?$document->getProperty("downloadLink"):"Télécharger";
				echo '<a href="'.$document->getFullPath().'" target="_blank">> '.$linkLabel.'</a><br />';
					
			}
			echo "</div>";
		}
		echo "</div>";
	}
	?>
-->
<!-- Second col / -->
</div>
</div>
<!-- FIN MAIN LAYOUT / -->
</div>
</div>


