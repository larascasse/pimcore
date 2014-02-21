<?php 
$this->document->setProperty("leftNavHide","bool",true);
$this->layout()->setLayout("layout-lpn"); 


$relatedProducts = $this->product->getRelated("relatedProducts");;;
	$associatedArticles = $this->product->getRelated("associatedArticles");
	$relatedAccessories = $this->product->getRelated("relatedAccessories");
	$caracteristiques = $this->product->getCharacteristics();
	$extras = $this->product->getRelated("extras");

	$childrens = $this->product->getChilds();


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

 <?php if ($count>0) { ?>


<section class="area-wysiwyg product-detail">
<div class="col-md-9">
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
	                <img src="<?php echo $image->getThumbnail("content"); ?>">
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


<div class="col-md-3">

    <div class="page-header">
        <h3><?php echo $this->product->getSubtype(); ?></h3>
        <h1><?php echo $this->product->getName(); ?></h1>

        	
     <div class="lead">
        <p><?php echo nl2br($this->product->getShort_description()); ?></p>
	
    </div>

    
     <?php
	foreach ($caracteristiques as $caracteristique) {
			echo   "<b>".$caracteristique["label"]." : </b>".$caracteristique["content"]."<br />";
		}
	?>

	<?php
	if(count($childrens)>0) {
		foreach ($childrens as $subProduct) {
			echo   "<p><b>Existe en : </b>".$subProduct->getDimensionsString()." - ".$subProduct->getEan()."</p>";
		}
	}

	?>

        
    </div>
</div>
   
<div class="col-md-8">
	 



    <div class="clearfix product-desc">

      <?php
    if(count($extras)>0) {
		foreach ($extras as $extra) {
			echo "<p><strong>".$extra->getName()." : </strong>".$extra->getContent()."</p>";
		}
	}

	?>
    <div class="description">
  
    <h3>Description</h3>
    

   
	<p><?php echo nl2br($this->product->getDescription()); ?></p>

	

    </div>

	<div class="caracteristiques">



    


    <?php


	
	if(count($relatedAccessories)>0) {
		echo "<hr /><h4>Accessoires</h4>";
		echo "<ul>";
		foreach ($relatedAccessories as $subProduct) {
			 $detailLink = $this->url(array(
                "id" => $subProduct->getId(),
                "text" => $subProduct->getName(),
                "prefix" => $this->document->getFullPath()
            ), "produits");
			echo "<li><a href=\"".$detailLink."\">".$subProduct->getName()."-".$subProduct->getCode()."</a></li>";
		}
		echo "</ul>";
	}
	
	if(count($relatedProducts)>0) {
		echo "<hr /><h4>Produits associés</h4>";
		echo "<ul>";
		foreach ($relatedProducts as $subProduct) {
			 $detailLink = $this->url(array(
                "id" => $subProduct->getId(),
                "text" => $subProduct->getName(),
                "prefix" => $this->document->getFullPath()
            ), "produits");
			echo "<li><a href=\"".$detailLink."\">".$subProduct->getName()."-".$subProduct->getEan()."</a></li>";
		}
		echo "</ul>";
	}


	?>
	</div>

	</div>

	<hr />
	 <div class="row">
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


	<?php 
	if(count($associatedArticles)>0) {
		echo '<div class="row">';
		//echo "<h3>Articles associés</h3>";
		
		foreach ($associatedArticles as $article) {
			echo "<hr /><h2>".$article->getName()."</h2>";
			echo $article->getContent();
			$associatedDocuments = $article->getDocuments();
			foreach ($associatedDocuments as $document) {
				$linkLabel = strlen($document->getProperty("downloadLink"))>0?$document->getProperty("downloadLink"):"Télécharger";
				echo '<a href="'.$document->getFullPath().'" target="_blank">> '.$linkLabel.'</a><br />';
					
			}
		}
		echo "</div>";
	}
	?>
</div>


</section>