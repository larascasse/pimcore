
<?php 


$this->document->setProperty("leftNavHide","bool",true);
$this->layout()->setLayout("layout-lpn"); 


$relatedProducts = $this->product->getRelated("relatedProducts");

	$associatedArticles = $this->product->getRelated("associatedArticles");
	$relatedAccessories = $this->product->getRelated("relatedAccessories");
	$caracteristiques = $this->product->getCharacteristicsFo();
	$extras = $this->product->getRelated("extras");

	$childrens = $this->product->getChilds();
	$lesplus = $this->product->getLesPlusArray();


?>




<?php $this->headLink(array(
    "rel" => "stylesheet",
    "href" => "/website/static/css/portal.css"));
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
<section class="area-wysiwyg product-detail">
<div class="row">



 <!-- Product Carousel -->
<div class="col-md-8">
 <?php if ($count>0) { ?>


<div id="myCarousel" class="carousel slide">
    <!-- Indicators -->
    <ol class="carousel-indicators">
        <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
        <?php for($i=1; $i<$count; $i++) { ?>
        <li data-target="#myCarousel" data-slide-to="<?php echo $i; ?>"></li>
        <?php } ?>
    </ol>
    <div class="carousel-inner">
        <?php 
        	$count=0;
        	for($i=1; $i<=3; $i++) { 
                $image = $this->product->{"getImage_" . $i}();
            	if($image) { 
            		$count++;
            	}
            }
            for($i=1; $i<=$count; $i++) { 
            	$image = $this->product->{"getImage_" . $i}();
            	?>
            	 <div class="item<?php if($i==1) { ?> active<?php } ?>">
	                <img src="<?php echo $image->getThumbnail("productCarousel"); ?>">
	                <div class="container">
	                    <div class="carousel-caption">
	      				 	<!--<h1><?php echo $this->product->getName(); ?></h1>
	                      	<div class="caption"></div>
	                        <div class="margin-bottom-10"></div>-->
	                    </div>
	                </div>
            	</div>
            <?php } ?>
    </div>
    <a class="left carousel-control" href="#myCarousel" data-slide="prev"><span class="glyphicon glyphicon-chevron-left"></span></a>
    <a class="right carousel-control" href="#myCarousel" data-slide="next"><span class="glyphicon glyphicon-chevron-right"></span></a>
</div>
  <?php } ?>
</div>
 <!-- Fin product Caroussel -->  

<!-- Product Header -->
<div class="col-md-4">

    <div class="page-header">
        <h3><?php echo $this->product->getSubtype(); ?></h3>
        <h1><?php echo $this->product->getMage_short_name(); ?></h1>
        
        <div class="lead">
        	<p><?php echo nl2br($this->product->getShort_description()); ?></p>
        	<p><?php echo nl2br($this->product->getMage_sub_description()); ?></p>
   		</div>
 

   		 <?php
   		 if(count($childrens)>0) {
		echo   "<p>";
		foreach ($childrens as $subProduct) {
			if($subProduct->getEan()=="") {
				$subProductChildrens = $subProduct->getChilds();
				echo "<h3>".$subProduct->getMage_short_name()."</h3>";
				foreach ($subProductChildrens as $subsubProduct) {

					echo   "<b>Existe en : </b>".$subsubProduct->getDimensionsString()." - ".$subsubProduct->getEan()." - ".$subsubProduct->getPrice_4()."€<br />";

				}

			}
			else {
					echo   "<b>- Existe en : </b>".$subProduct->getDimensionsString()." - ".$subProduct->getEan()." - ".$subProduct->getPrice_4()."€<br />";

			}
		}
		echo   "</p>";
	}
	?>

    </div>
</div>
 <!-- Fin product header -->  


</div> <!-- row -->

<div class="row">

	<div class="caracteristiques col-md-8">
	<?php echo nl2br($this->product->getMage_description()); ?>
	</div>
	<div class="caracteristiques col-md-4">
	<h3><!--Vous le choisirez pour: -->&nbsp;</h3>
	<?php echo nl2br($this->product->getMage_lesplus()); ?>
	</div>

</div>

<div class="row">

	<div class="caracteristiques col-md-6">
		<hr />
	     <h3>Caractéristiques</h3>
	     <?php echo $this->product->getCharacteristics()?>
	     <?php
		echo "<p>";
		foreach ($caracteristiques as $caracteristique) { 
				$string =  $caracteristique["label"]!="Divers"?$caracteristique["label"]." : ":"";       
				$string .= ($caracteristique["label"]!="Divers"?$caracteristique["content"]:nl2br($caracteristique["content"]))."<br />";
				echo $string;
			}
		echo "</p>";
		?>
	</div>

	<div class="col-md-6">
		<hr />
    	<h3>Images</h3>
        <?php for($i=1; $i<=3; $i++) { ?>
            <?php
                $image = $this->product->{"getImage_" . $i}();
            ?>
            <?php if($image) { ?>
                <div class="col-lg-3">
                    <a href="<?php echo $image->getThumbnail("galleryLightbox"); ?>" class="thumbnail">
                        <img src="<?php echo $image->getThumbnail("galleryThumbnail"); ?>">
                    </a>
                </div>
            <?php } ?>
        <?php } ?>
    </div>
</div>


<div class="row">
<!-- Product Carousel -->
<div class="col-md-12">
 <?php 
$realisations =$this->product->getRealisations();

//print_r( $realisations);
$count=count($realisations);
$assetsArray=array();
for ($i=0; $i < $count; $i++) { 
		$assets=Asset_Folder::getById($realisations[$i]->id)->getChilds();
		foreach ($assets as $asset) {
			$assetsArray[] = $asset;
		}
}

$count=count($assetsArray);
if($count>0) {
	echo '<div id="myCarousel2" class="carousel slide">';
	echo '<ol class="carousel-indicators">
        <li data-target="#myCarousel2" data-slide-to="0" class="active"></li>';
        for($i=1; $i<=$count; $i++) {
        	echo '<li data-target="#myCarousel2" data-slide-to="'.$i.'"></li>';
        }
    echo '</ol>';

	echo  '<div class="carousel-inner">';
	$index=0;
		foreach ($assetsArray as $asset) {

			echo '<div class="item '.($index==0?'active':'').'">
				<img src="'.$asset->getThumbnail("magento_small")->getPath().'">
	                	<div class="container">
	                    <div class="carousel-caption">
	                    <h1>'.$this->product->getName().'</h1>
	                      	<div class="caption"></div>
	                        <div class="margin-bottom-10"></div>
	                    </div>
	                </div>
            	</div>';
            $index++;
		}
	
	echo '</div>';
	echo '<a class="left carousel-control" href="#myCarousel2" data-slide="prev"><span class="glyphicon glyphicon-chevron-left"></span></a>
    <a class="right carousel-control" href="#myCarousel2" data-slide="next"><span class="glyphicon glyphicon-chevron-right"></span></a>';
	echo '</div>';
}
 ?>

</div>
</div>

	


<div  class="row">
     <?php
    if(count($extras)>0) {
    	echo "<div class='col-md-4'><hr />";
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



	<div class="row">

	<?php 
	if(count($associatedArticles)>0) {
		echo '<div>';
		//echo "<h3>Articles associés</h3>";
		
		foreach ($associatedArticles as $article) {
			echo "<div class='col-md-4'><hr /><h2>".$article->getName()."</h2>";
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
	</div>


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
