<!-- real #<?php echo $this->article->getId(); ?> -->
<div class="realisation-page" id="realisation-page-<?php echo $this->article->getId(); ?>">
<?php

/**
Realisation DETAIL 
**/

// set page meta-data
$this->headTitle()->set($this->article->getName());
$content = "";
$imgForJson= array();
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
 $content.='<div class="realisation-detail card-columns grid-count-'. count($imagesArray).'">';
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
     $item .='<div class="card'.$cardclass.' imgcnt">';
     $item .='<figure>';
     
     /*
     //On cree les zoom maintenant, on le derfer pas on request
     https://www.pimcore.org/docs/latest/Assets/Working_with_Thumbnails/Image_Thumbnails.html
     ANNULE2
     */
   
     $item.= $asset->getThumbnail("magento-real-grid")->getHTML([
        //Attributes
        "class" => "img-fluid norelazy",
        "data-zoom"=>$asset->getThumbnail("magento_equigrid_h")->getPath(),
        "data-zoom-m"=>$asset->getThumbnail("magento_equigrid_v")->getPath()
        ]

        );

     if(strlen($imageProductName>0)) {
        $item .='<figcaptdevion class="card-block">';
        $item .='<p class="card-text">'.$imageProductName.'</p>';
        $item.='</figcaption>';
     }
    
     $item.='</figure>';
     $item.='<div class="nsg_real_zoom"></div>';
     $item.='</div>';
     
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
                $this->template("/snippets/lpn-slider-product-image-item.php",array('product'=>$product,'cardformat'=>'card-horizontal clickable'));

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
</div>
<!-- FIN real #<?php echo $this->article->getId(); ?> -->
