
<?php 


$this->document->setProperty("leftNavHide","bool",true);
$this->layout()->setLayout("layout-ft"); 


$relatedProducts = $this->product->getRelated("relatedProducts");

$associatedArticles = $this->product->getRelated("associatedArticles");
$relatedAccessories = $this->product->getRelated("relatedAccessories");
$caracteristiques = $this->product->getCharacteristicsFo();
$extras = $this->product->getRelated("extras");

$childrens = $this->product->getChilds();
$lesplus = $this->product->getLesPlusArray();

?>

<script>
	

</script>


 <?php 
	$count=0;
	for($i=1; $i<=3; $i++) { 
        $image = $this->product->{"getImage_" . $i}();
    	if($image) { 
    		$count++;
    	}
    }
  ?>


<style type="text/css">
	sectionXX h2 {
		text-align: justify;
	}
</style>


<div class="row">



 <!-- Product Carousel -->
<div class="col-12">

 <div class="page-header">

       <!-- <h3><?php echo $this->product->getSubtype(); ?></h3>-->
        <h2 style="" class="balance-text"><?php echo $this->product->getMage_short_name(3000); ?></h2>
        <p><?php echo $this->product->getSku(); ?> - <?php echo $this->product->name_scienergie_court?></p>
 </div>
</div>
</div>

<hr />
<div class="row">

	<div class="col">
	
	     <?php 
	     $hasMarquageCe = false;
	     $caracteristiques =  $this->product->getCharacteristicsArray();
	     $htmlStd='';
	     $htmlStd .= '<dl class="row dl-horizontal">';
	     $htmlCe = $htmlStd;
	     foreach ($caracteristiques as $key => $value) {
	     		
					$content = trim($value["content"]);
					$htmlSingle = "";

					if(!isset($value["label"]) || strlen($content)==0)
						continue;

					$htmlSingle.= '<dt class="col-xs-5">';
					$htmlSingle.= strlen($value["label"])>0?ucfirst(trim($value["label"])):"";
					$htmlSingle.= '</dt>';
					$htmlSingle.= '<dd class="col-xs-7">';
					
	
					if(isset($value["description"])) {
						//$html.= '<br />';
						$htmlSingle.= ucfirst(trim($value["description"]));
	
					}
					else {
						$htmlSingle.= ucfirst($content);
					}

					$htmlSingle.= '</dd>';

					if(isset($value["isMarquageCe"]) && $value["isMarquageCe"]) {
						$hasMarquageCe = true;

						$htmlCe .=$htmlSingle;
					}
					else
						$htmlStd .=$htmlSingle;

					
					//$html.="</li>\n";
		}
		$htmlStd .='</dl>';
		$htmlCe .='</dl>';

echo $htmlStd;


if ($hasMarquageCe) {
	echo "<h3>Déclaration de performance</h3>";
	echo $htmlCe;
	echo '<p class="small">Il n’existe pas de PV pour le classement au feu des parquets massifs et contrecollés. Les classements feu que nous indiquons sur nos fiches techniques et autres documents sont des classements dits « conventionnels », stipulés dans les DTU 51.11 (Pose flottante des parquets contrecollés) et 51.2 (Pose collée des parquets massifs) et selon la norme NF 14341+A1.</p>';
}
?>
		
	</div>

	
</div>
<hr />
<?php 
//detail taxo
$taxonomies = $this->product->getSelfAndChildrenTaxonomyObjects('support');
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
<hr />

<?php 
//detail taxo
$taxonomies = $this->product->getSelfAndChildrenTaxonomyObjects('choix');
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


<div class="row">
<!-- Product Header -->
	<div class="col-xs-6">

	    <div class="page-header">
	        <div class="lead">
	        	<p><?php echo nl2br($this->product->getShort_description()); ?></p>
	        	<p><?php echo nl2br($this->product->getMage_sub_description()); ?></p>
	   		</div>

	    </div>
	</div>
</div>
<div class="row">
	<div class="col">
	    <div class="page-header">
	       

	   		 <?php
	   		 if(count($childrens)>0) {

	   		 	$fields["Choix"] = "getChoix";
	   		 	$fields["Surface"] = "getTraitement_surface";
	   		 	$fields["Finition"] = "getFinition";
	   		 	$fields["Support"] = "getSupport";
	   		 	if($this->product->isParquetContrecolle()) {
	   		 		$fields["CU"] = "getCoucheUsure";
	   		 	}
	   		 	$fields["Colisage"] = "getColisage";
	   		 	$fields["Dimensions"] = "getPimonly_dimensions";
	   		 	$fields["Utilisation"] = "getCalculatedClasseUtilisation";
	   		 	$fields["EAN"] = "getEan";
	   		 	$fields["Prix Public HT<br /> au ".date('d/m/Y')] = "getPrice_4";
	   		 	$fields["FT"] = "getPreviewLink";



			echo   '<table class="table table-striped">  <thead><tr>';
			foreach ($fields as $key => $value) {
				echo '<th>'.$key.'</th>';
			}
			echo '</tr></thead>';

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
							echo '<td>'.$v.'</td>';
						}
						?>
					     
					   
					    
					    </tr>


				<?php

			}
			echo   "</table>";
		}
		?>

	    </div>
	</div>

 <!-- Fin product header -->  


</div> <!-- row -->
<hr />
<div class="row">
	<div class="col-xs-12">
		<h3>Images</h3>
	</div>

    	
		
        <?php for($i=1; $i<=3; $i++) { ?>
            <?php
                $image = $this->product->{"getImage_" . $i}();
            ?>
            <?php if($image) { ?>
                <div class="col">
                    <a href="<?php echo $image->getThumbnail("galleryLightbox"); ?>" class="thumbnail">
                        <img src="<?php echo $image->getThumbnail("galleryThumbnail"); ?>">
                    </a>
                </div>
            <?php } ?>
        <?php } ?>

</div>







 



<hr />
<div class="row">
	<h3 class="col-xs-12">Description</h3>
	<div class="caracteristiques col-8">
	<?php echo nl2br($this->product->getDescription()); ?>
	</div>
	<div class="caracteristiques col-4">
	<h3><!--Vous le choisirez pour: -->&nbsp;</h3>
	<?php echo nl2br($this->product->getMage_lesplus()); ?>
	</div>

</div>





	


<div  class="row">

     <?php
    if(count($extras)>0) {
    	echo "<div class='col-xs-4'>";
		foreach ($extras as $extra) {
			echo "<p><strong>".$extra->getName()." : </strong>".$extra->getContent()."</p>";
		}
		echo "</div>";
	}

	?>


	<?php
	if(count($relatedAccessories)>0) {
		
		echo "<div class='col-md-6'><hr />";
		echo "<h4>Accessoires</h4>";
		foreach ($relatedAccessories as $subProduct) {
			 $detailLink = $this->url(array(
	            "id" => $subProduct->getId(),
	            "text" => $subProduct->getName(),
	            "prefix" => $this->document->getFullPath()
	        ), "produits");
			echo "<a href=\"".$detailLink."\">".$subProduct->getName()."-".$subProduct->getCode()."</a><br />";
		}
		echo "</div>";
	}

	if(count($relatedProducts)>0) {
		
			echo "<div class='col-md-6'>whr />";
			echo "<h4>Produits associés</h4>";
		foreach ($relatedProducts as $subProduct) {
			 $detailLink = $this->url(array(
	            "id" => $subProduct->getId(),
	            "text" => $subProduct->getName(),
	            "prefix" => $this->document->getFullPath()
	        ), "produits");
			echo "<a href=\"".$detailLink."\">".$subProduct->getName()."-".$subProduct->getCode()."</a><br />";
		}
		echo "</div>";
	}


	?>
</div>



	

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



<script>

<?php



$strChars = $this->product->getCharacteristics(false);
$strChars=wordwrap($strChars,70,'\n');
$strChars=str_replace("\n", "\\n", $strChars);

$strChildren="";
 if(count($childrens)>0) {
		$strChildren.="";
		foreach ($childrens as $subProduct) {
			if($subProduct->getEan()=="") {
				$subProductChildrens = $subProduct->getChilds();
				$strChildren.="\n".$subProduct->getMage_short_name()."\n";
				foreach ($subProductChildrens as $subsubProduct) {

					$strChildren.=$subsubProduct->getEan()." : ".$subsubProduct->getDimensionsStringEtiquette()."\n";

				}

			}
			else {
					$strChildren.=$subProduct->getEan()." : ".$subProduct->getDimensionsStringEtiquette()."\n";

			}
		}
	}
	$strChildren = trim($strChildren);

//$strChildren=wordwrap($strChildren,80,'\n');
//$strChildren=str_replace("\n", "\\n", $strChildren);
$width=65;

$str=  wordwrap($this->product->getShort_description(),$width);
$str.= "\n".wordwrap(strip_tags($this->product->getDescription()),$width);

//$str.= "\n".$this->product->getMage_sub_description();

//$str.="\n\n".$strChildren;

$str=wordwrap($str,800,'\n');
$str=str_replace("\n", "\\n", $str);


$strChildren=wordwrap($strChildren,$width);
$strChildren=str_replace("\n", "\\n", $strChildren);



?>

var productName="<?php echo wordwrap($this->product->getName(),60,'\\n'); ?>";
var productDescription="<?php echo $str; ?>";
var productChars="<?php echo $strChildren; ?>";

</script>
<img src="" id="labelImage" />
