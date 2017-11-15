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

<div class="row">

	<div class="col-xs-12">
	<?php echo nl2br($this->product->getMage_description()); ?>
	</div>
	<div class="col-xs-12">
	<?php
	 $image = $this->product->getImage_1();
	 echo $image->getThumbnail("galleryThumbnail")->getHTML(["class"=>"img-responsive"]);
	 ?>

	<h3><!--Vous le choisirez pour: -->&nbsp;</h3>
	<?php echo nl2br($this->product->getMage_lesplus()); ?>
	</div>
</div>








</div>
<!-- First col / -->
<!-- Second col -->
<div class="ft-col-2">


<div class="">


	
	     



<?php



if ($hasMarquageCe) {
	echo "<h2>Déclaration de performance</h2>";
	echo $htmlCe;
	echo '<p class="small"><br /><br />Il n’existe pas de PV pour le classement au feu des parquets massifs et contrecollés. Les classements feu que nous indiquons sur nos fiches techniques et autres documents sont des classements dits « conventionnels », stipulés dans les DTU 51.11 (Pose flottante des parquets contrecollés) et 51.2 (Pose collée des parquets massifs) et selon la norme NF 14341+A1.</p>';
}
?>
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


