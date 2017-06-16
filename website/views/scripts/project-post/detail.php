
<?php

/**
Realisation DETAIL 
**/

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
 $content.='<div class="realisation-detail card-columns grid-count-<?php echo count($imagesArray)?>">';
 $oddList=array();
 $evenList= array();
 $ind=0;
 $lastProductName ="";


foreach ($imagesArray->assets as $asset) {
    //On zappe la premire image, header ..
    if( $ind==0) {
        $ind++;
        continue;
    }
    $imageProductName = ""; 
    $imageProduct = $asset->getRelatedProduct();

    if($imageProduct) {
        //on ne duplique pas les légende
        if($lastProductName!=$imageProduct->getName()) {
            $lastProductName = $imageProductName = $imageProduct->getName();
        }
    }
    $cardclass=strlen($imageProductName>0)?"":" notext";
    $item = "";
   
     
     //$content .='<div class="col-12">';
     $item .='<figure class="card'.$cardclass.'">';
     $item.= $asset->getThumbnail("magento-real-grid")->getHTML(["class" => "img-fluid norelazy","data-zoom"=>$asset->getThumbnail("magento_equigrid_h")->getPath(),"data-zoom-m"=>$asset->getThumbnail("magento_equigrid_v")->getPath()]);

     if(strlen($imageProductName>0)) {
        $item .='<figcaption class="card-block">';
        $item .='<p class="card-text">'.$imageProductName.'</p>';
        $item.='</figcaption>';
     }
    
     $item.='</figure>';
     $item.='<div class="nsg_real_zoom"></div>';
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

<div class="back-content">
    <a href="#" class="btn btn-back">Retour</a>
</div>

<div class="image-header-container noimg">
    <div>
      <h1><?= $this->article->getName(); ?></h1>
      <p><?=  $accroche ?></p>
    </div>

</div>


    <div class="row">
        <div class="col">
        <?php if($posterImage ) {
            echo  $posterImage->getThumbnail("content")->getHTML(["class" => "img-responsive norelazy"]);

        }?>
        </div>
    </div>

     <!-- Content -->
    <div class="row table-product-detail">
        <div class="col-12 col-md-6">
            <p class="realisation-description"><?= nl2br($description) ?></p>
        </div>
        
        <div class="col realisation-related">

        <?php if ($product) { 
                $this->template("/snippets/lpn-slider-product-item.php",array('product'=>$product,'cardformat'=>'card-horizontal clickable'));

        }
        else {?>
                <div class="realisation-contact">
                
                <a href="/contact?real=<?php echo $this->article->getKey()?>" class="btn btn-contact__">En savoir plus ?<br />Contactez-nous</a>
                </div>
        <?php }
        ?>
        </div>
    </div>
    <!-- / Content -->
    
    <!-- Images -->
    <div class="row">
        <div class="col">
        <?= $content ; ?>
        </div>
    </div>
    <!-- / Images -->


