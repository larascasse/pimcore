
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


 <?php 
	$count=0;
	for($i=1; $i<=3; $i++) { 
        $image = $this->product->{"getImage_" . $i}();
    	if($image) { 
    		$count++;
    	}
    }
  ?>
<section class="product-detail">


<div class="row">



 <!-- Product Carousel -->
<div class="col-12">

 <div class="page-header">

       <!-- <h3><?php echo $this->product->getSubtype(); ?></h3>-->
        <h2 style="text-align: left"><?php echo $this->product->getMage_short_name(); ?></h2>
 </div>
</div>
</div>

<hr />
<div class="row">

	<div class="col">
	
	     <?php $caracteristiques =  $this->product->getCharacteristicsArray();
	     $html='';
	     foreach ($caracteristiques as $key => $value) {
	     		
					$content = trim($value["content"]);


					if(!isset($value["label"]) || strlen($content)==0)
						continue;

					

					$html .= '<dl class="row">';	
					$html.= '<dt class="col-2">';
					$html.= strlen($value["label"])>0?ucfirst(trim($value["label"])):"";
					$html.= '</dt>';
					$html.= '<dd class="col">';
					
					

					if(isset($value["description"])) {
						//$html.= '<br />';
						$html.= ucfirst(trim($value["description"]));
	
					}
					else {
						$html.= ucfirst($content);
					}

					$html.= '</dd>';
					$html .='</dl>';
					//$html.="</li>\n";
		}
		
		echo $html;
		?>
	</div>

	
</div>
<hr />
<?php 
//detail taxo
$taxonomies = $this->product->getSelfAndChildrenTaxonomyObjects('support');
if(count($taxonomies) > 0) { ?>
<div class="row">

	<div class="col-12">
	<h3>Support</h3>
	</div>
<?php
foreach ($taxonomies as $label => $taxonomie) {
	echo '<div class="col-4">';
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

	<div class="col-12">
	<h3>Choix</h3>
	</div>
<?php
foreach ($taxonomies as $label => $taxonomie) {
	echo '<div class="col-4">';
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
	<div class="col-6">

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
			echo   '<table class="table table-striped">
  <thead>
    <tr>
      <!--<th>Nom</th>-->
      <th>Choix</th>
      <th>Surface</th>
       <th>Finition</th>
        <th>Support</th>
        <th>Colisage</th>
      <th>Dimensions</th>
      <th>Utilisation</th>
      <th>EAN</th>
      <th>Prix Public HT<br /> au '.date('d/m/Y').'</th>
    </tr>
  </thead>';
  			$index = 1;
  			$productsToDisplay =array();
			foreach ($childrens as $subProduct) {

				//Configurables
				if($subProduct->getEan()=="") {
					$subProductChildrens = $subProduct->getChilds();
		
					
					foreach ($subProductChildrens as $subsubProduct) {
						$productsToDisplay[] = $subsubProduct;
					?>
						 <!--<tr>
					     
					       <th scope="row"><?php echo $subsubProduct->getMage_short_name() ?></th>
					      <td><?php echo $subsubProduct->getChoixString() ?></td>
					      <td><?php echo $subsubProduct->getDimensionsString() ?></td>
					      <td><?php echo $subsubProduct->getEan() ?></td>
					      <td><?php echo $subsubProduct->getPrice_4() ?> €</td>
					    
					    </tr>-->
    				<?php 
					}

				}
				else { 
					$productsToDisplay[] = $subProduct;
					?>
						<!--<tr>
					       <th scope="row"><?php echo $subProduct->getMage_short_name() ?></th>
					      <td><?php echo $subProduct->getDimensionsString() ?></td>
					      <td><?php echo $subProduct->getEan() ?></td>
					      <td><?php echo $subProduct->getPrice_4() ?> €</td>
					    
					    </tr>-->

				<?php 
				}
			}
			foreach ($productsToDisplay as $subproduct) {
				?>
					-<tr>
					     
					      <!-- <th scope="row"><?php echo $subsubProduct->getMage_short_name(100) ?></th>-->
					      <td><?php echo $subproduct->getChoix() ?></td>
					      <td><?php echo $subproduct->getTraitement_surface() ?></td>
					      <td><?php echo $subproduct->getFinition() ?></td>
					      <td><?php echo $subproduct->getSupport() ?></td>
					      <td><?php echo $subproduct->getColisage() ?></td>
					      <td><?php echo $subproduct->getPimonly_dimensions() ?></td>
					      <td><?php echo $subproduct->getClasseUtilisation() ?></td>
					      <td><?php echo $subproduct->getEan() ?></td>
					      <td><?php echo $subproduct->getPrice_4() ?> €</td>
					    
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
	<div class="col-12">
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
	<h3 class="col-12">Description</h3>
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
    	echo "<div class='col-4'>";
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



</section>
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
