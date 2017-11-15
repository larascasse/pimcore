<?php 



$product = $this->product;
$relatedProducts = $product->getRelated("relatedProducts");

$associatedArticles = $product->getRelated("associatedArticles");
$relatedAccessories = $product->getRelated("relatedAccessories");
$caracteristiques = $product->getCharacteristicsFo();
$extras = $product->getRelated("extras");

$childrens = $product->getChilds();
$lesplus = $product->getLesPlusArray();


/**** CARACTERISTIQUES ***/

 $hasMarquageCe = false;
 $hasDonneesTech = false;
 $hasDescription= false;
 $caracteristiques =  $product->getCharacteristicsArray();
 $htmlStd='';
 $htmlStd .= '<table class="dl-horizontal">';
 $htmlCe = $htmlDonneeTech = $htmlDescription = $htmlStd;
 $logoAssets = array();
 foreach ($caracteristiques as $key => $value) {

 			if(!is_array($value)) {
 				continue;
 			}

 			if(!isset($value["label"]))
 				continue;
 			
 			$content = $description = null;

 			if(isset($value["content"]) && strlen(trim($value["content"]))>0) {

				$content = trim($value["content"]);
 			}

			if(isset($value["description"]) && strlen(trim($value["description"]))>0) {
				$description = trim($value["description"]);
			}


			if(!isset($description) && !isset($content))
				continue;
			
			$htmlSingle = "<tr>";

			$isHidden = isset($value["is_hidden"]) && $value["is_hidden"];

			$htmlSingle.= '<th class=""'.($isHidden?' style="display:none"':'').'>';
			$htmlSingle.= strlen($value["label"])>0?ucfirst(trim($value["label"])):"";
			$htmlSingle.= '</th>';
			$htmlSingle.= '<td class=""'.($isHidden?' style="display:none"':'').'>';
			

			if(isset($description)) {
				//$html.= '<br />';
				$htmlSingle.= ucfirst(trim($description));

			}
			else {
				$htmlSingle.= ucfirst($content);
			}

			$htmlSingle.= '</td>';


			if(isset($value["logo"])) {
				$logoAssets[] = $value["logo"];
			}

			if(isset($value["isMarquageCe"]) && $value["isMarquageCe"]) {
				$hasMarquageCe = true;

				$htmlCe .=$htmlSingle;
			}
			else if(isset($value["isDonneeTechnique"]) && $value["isDonneeTechnique"]) {
				$hasDonneesTech = true;

				$htmlDonneeTech.=$htmlSingle;
			}
			else if(isset($value["isDescription"]) && $value["isDescription"]) {
				$hasDescription = true;

				$htmlDescription .=$htmlSingle;
			}

			else
				$htmlStd .=$htmlSingle;

			
			//$html.="</li>\n";
}
$htmlStd .='</table>';
$htmlCe .='</table>';
$htmlDescription .='</table>';
$htmlDonneeTech .='</table>';


?>
<div class="ft">
<div class="ft-header">
<div class="ft-col-1">
	<div id="logo2" style='width:338px;height:30px'>
		<?php echo $this->template("includes/logo_1l_svg.php"); ?>
		 
	</div>
	<h4>Fiche technique</h4>
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

<?php

if ($hasDescription) {
	echo "<h2>Description</h2>";
	echo $htmlDescription;
}

if ($hasDonneesTech) {
	echo "<h2>Données techniques</h2>";
	echo $htmlDonneeTech;
}

echo $htmlStd;

?>



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
<hr />
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


