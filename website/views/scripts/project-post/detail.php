<?php



    // set page meta-data
    $this->headTitle()->set($this->article->getName());
    $content = "";
    $accroche  =  $this->article->getAccroche();

    $description  =  $this->article->getDescription();
   
    
    /*** META */
    $metaDescription = strip_tags($description);
    $metaDescription = \Website\Tool\Text::getStringAsOneLine($metaDescription);
    $metaDescription = \Website\Tool\Text::cutStringRespectingWhitespace($metaDescription, 160);
    $this->headMeta($metaDescription, "description");
    


    $imagesArray = $this->article->getImagesAssets();
    $posterImage = $this->article->getPosterImage();

    $productName="";
    if($posterImage) {
         $this->headMeta($posterImage->getThumbnail("content")->getPath(), "og:image");
        if(($product = $this->article->getRelatedProduct()) instanceof Object_Product) {
            $productName=$product->getName();
        }
        

    }
   
  


//print_r($imagesArray);
 $content.='<div class="_row 
 card-columns" style="column-count: 2;">';
 $oddList=array();
 $evenList= array();
 $ind=0;
foreach ($imagesArray->assets as $asset) {
    //On zappe la premire image, header ..
    if( $ind==0) {
        $ind++;
        continue;
    }
    $imageProductName = ""; 
    $imageProduct = $asset->getRelatedProduct();

    if($imageProduct) {
        $imageProductName = $imageProduct->getName();
    }

    $item = "";
   
     
     //$content .='<div class="col-12">';
     $item .='<figure class="card">';
     $item.= $asset->getThumbnail("content")->getHTML(["class" => "img-fluid"]);
     $item .='<figcaption class="card-block">';
     $item .='<p class="card-text">'.$imageProductName.'</p>';
     $item.='</figcaption>';
     $item.='</figure>';
     //$content.='</div>';
     //2 colonnes, flexbos, on met dans 2 colums
     if ($ind & 1) {
            $oddList[] = $item;
     } else { 
            $evenList[] = $item;
     }
     $ind++;
     //$content .=$item;
}

 $content.=implode('',$oddList).implode('',$evenList);
 $content.='</div>';

?>

<div class="image-header-container noimg">
    <div>
      <h1><?= $this->article->getName(); ?></h1>
      <p><?=  $accroche ?></p>
    </div>

</div>


    <div class="row">
        <div class="col">
        <?php if($posterImage ) {
            echo  $posterImage->getThumbnail("content")->getHTML(["class" => "img-responsive norelazy__"]);

        }?>
        </div>
    </div>
    <div class="row">
    <div class="col-sm-8 col-lg-9">
    <?= $content ; ?>
    </div>
    <div class="col-sm-4 col-lg-3">
    <p class="lead"><?= $description ?></p>
    </div>
    </div>

