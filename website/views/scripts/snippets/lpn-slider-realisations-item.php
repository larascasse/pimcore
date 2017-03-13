<?php 

if(!function_exists ('toto')) {
    function real_get_all_images_from_folder($asset) {
        if(!($asset instanceof Asset_Folder)) {
            return array();
        }
        $assets=Asset_Folder::getById($asset->id)->getChilds();
        foreach ($assets as $assetChild) {
            if($assetChild instanceof Asset_Folder) {
                $assetsArray = real_get_all_images_from_folder($assetChild);
            }
            else if($assetChild instanceof Asset_Image) {
                $assetsArray[] = $assetChild;

            }
        }
        return $assetsArray;
        
    }
}
?>

<?php if ($this->editmode) : ?>
    <div class="container" style="padding-bottom: 40px">
        Type: <?= $this->select("sildertype", [
            "width" => 60,
            "reload" => true,
            "store" => [["carousel","carousel"],["bloc","bloc"]]
        ]); 
         if($this->select("sildertype")->isEmpty())
            $this->select("sildertype")->setDataFromResource("carousel");
        ?>
    </div>

<?php 


endif; 
$is_type_bloc =  ($this->select("sildertype")->getValue())=='bloc';
?>
<!-- Begin Realisations -->

<?php if (!$is_type_bloc) : ?>
<div id="home_realisation" class="row">
<ul class="slider_lpn">
<?php else: ?>


<div id="" class="row">
<ul class="realisation-bloc">
<?php endif; ?>

<?php
$count = $this->select("carouselSlides")->getData();
if(!$count) {
    $count = 1;
}

$dataValues = array();

for($i=0; $i<$count; $i++) {
    if($this->image("cImage_".$i)->getThumbnail("magento_realisation"))
        $urlImage =  $this->image("cImage_".$i)->getThumbnail("magento_realisation")->getPath();
    else
      $urlImage ="";  


    //Realsisation
    $arrayImages=array();
    $realisationsFolder =$this->href("cGallery".$i)->getElement();

    $assetsArray = real_get_all_images_from_folder($realisationsFolder);
    foreach ($assetsArray as $asset) {
         $arrayImages[] = $asset->getThumbnail("magento_realisation")->getPath();
    }



    if(count($arrayImages)>0)
        $datazoom = implode("|",$arrayImages);
    else
        $datazoom = $urlImage;

    $dataZoomId = "zoom_real_".$this->getId()."_".$i;
    $dataValue = (object) array("id"=>$dataZoomId,"images"=>$arrayImages);

    /*[
        {
         base => URL IMAGE
         images =>
         thumb =>
         name =>
         sku =>
         }

        ]
    */
    ?>

    <li data-zoom="<?= $datazoom ?>" data-zoom-rel="<?= $dataZoomId; ?>">
    <div class="<?php echo !$is_type_bloc?'nsg_container col-md-16':'';?>">
    <div>
    <?php if ($this->editmode) { ?>

    <?= $this->image("cImage_".$i,array(
        "thumbnail" => "magento_small",
        "attributes" => array(
            "custom-attr" => "value",
            "data-role" => "image"
        )
    )
    );

    } else { 
        if(strlen($urlImage)<3 && count($arrayImages)>0) {
            $urlImage=$arrayImages[0];
        }
        echo '<img src="'.$urlImage.'" title="'.$this->image("cImage_".$i)->getText().'" alt="'.$this->image("cImage_".$i)->getAlt().'" class="'.($i==0?'norelazy__':'').'" />';

        //JSON
        $dataValue->base = $urlImage;
    }
    ?></div>
    <div class="nsg_abs">
    <?php if ($this->editmode) { echo $this->checkbox("cHidden_".$i,array('boxLabel'=>'Cacher le picto','width'=>200)); echo '<br/>'; } ?>
    <div class="<?= $this->checkbox("cHidden_".$i)->isChecked() ? "realisationpictohidden" : "realisationpicto" ?>">Réalisations</div>
    <div class="realisationtitle"><?php if($this->editmode) echo "Titre";?><?= $this->input("cTitle_".$i, ["width" => 900]); ?></div>
    <div class="realisationcontent"><?php 
        if($this->editmode) { 
            echo "Content";
            echo $this->input("cContent_".$i, ["width" => 900]);
        }
        else {
            $content = $this->input("cContent_".$i);

            if(strlen(trim($content))<=5) {
                //on recherche le content de la description
                $content = "test";
                $image = $this->image("cImage_".$i)->getImage();
                if(!$image) {
                    $image = $assetsArray[0];
                }
                else {
                    $content = $image->getProperty("realisation_description");
                }
                
            }
            echo $content;
        }

        ?></div>
    <div class="jspush">
    <?php if ($this->editmode) { 
        echo 'Product :'.$this->href("cProduct".$i,array(
            "types"=>array("object"),
            "classes" => array("product"),
            "reload" => true,
            "width" =>200,
        )); 

        echo 'Gallery :'.$this->href("cGallery".$i,array(
            "types"=>array("asset"),
            "width" =>200,
        )); 


    } else { 
            $product = $this->href("cProduct".$i)->getElement();
            $image = $this->image("cImage_".$i)->getImage();

            if(!$image) {
                $image = $assetsArray[0];
            }


            if($product ) {
                $ean =  $product->getEan();

                if(!(strlen($ean)>4))
                    $ean =  $product->getCode();
            }
            //Si pas de produit défini, on prend le produit associé dans les metadata 
            // de la realisation
            else {
                
                
                if($image) {
                    $product = $image->getProperty("product");
                    if(!$product) {
                        $ean = $image->getMetadata("product");
                        $product = Object_Product::getByEan($ean)->objects[0];
                        if(!$product) {
                            $product = Object_Product::getByCode($ean)->objects[0];
                        }
                    }
                    else {
                        $ean=$product->getEan()?$product->getEan():$product->getCode();
                    }

                }
                
                
            }

            $name="";
            $description="";
            if($product) {
                $name =  $product->getName();
                $description = $product->getShort_description();
                $description = str_replace("\n", "|", $description);
                 echo '<div class="realisationpush col-xs-16 col-md-10">'.$name.'<br />'.$description .' | EAN : '.$ean.'</div>';
                echo '<div class="realisationlink col-xs-16 col-md-6">{{block type="core/template" template="lpn/lpn_product_link.phtml" name="givemetheprice_'.$ean.'" product_sku="'.$ean.'" class="btnarrow pull-right"}}</div>';

                //JSON
                $dataValue->name = $name;
                $dataValue->sku = $ean;
            }
            else {
                 echo '<div class="realisationpush col-xs-16 col-md-10"></div>';
                echo '<div class="realisationlink col-xs-16 col-md-6"></div>';
            
            }

            //JSON
            $dataValue->related = array();

            //ProdutRelated
            if($image || $product) {
                $products = array();
                $teinte = $image->getProperty("realisation_teinte");
                if((!$teinte || !($teinte instanceof Object_Teinte))  && $product) {
                    $teinte = $product->getTeinteObject();
                }
                if($teinte && $teinte instanceof Object_Teinte) {
                    $products = $teinte->getSimilarTeinteProducts();
                }

                if(count($products)>0) {

                    

                    echo '<ul class="similarproducts">';
                    foreach($products as $similarProducs) {
                        $ean=$similarProducs->getEan()?$similarProducs->getEan():$similarProducs->getCode();
                        echo '<li>'.$similarProducs->getName().'<span class="realisationlink">{{block type="core/template" template="lpn/lpn_product_link.phtml" name="givemetheprice_'.$ean.'" product_sku="'.$ean.'" class="btnarrow pull-right"}}</span></li>';
                    }
                     echo "</ul>";

                     //JSON
                     $dataValue->related[] = (object) array("name"=>$similarProducs->getName(),"sku"=>$ean);
                }


            }

            

           

      }
       ?>
       </div>


    </div>
    </div>
    </li>
     <?php //JSON 
    echo '<script type="application/json" id="'.$dataZoomId.'">';
    echo  Zend_Json::encode($dataValue);
    echo  '</script>';
    ?>


<?php } ?>
</ul>
<div class="clearfix">&nbsp;</div>
<?php if (!$is_type_bloc) : ?>
<a class="slider_lpn_prev prev" style="display: block;" href="#">&lt;</a> <a class="slider_lpn_next next" style="display: block;" href="#">&gt;</a>
<div class="slider_lpn_push row">&nbsp;</div>
<?php endif; ?>
</div>
<?php if($this->editmode) { ?>
    <div class="container" style="padding-bottom: 40px">
        Number of Slides: <?= $this->select("carouselSlides", [
            "width" => 60,
            "reload" => true,
            "store" => [[1,1],[2,2],[3,3],[4,4],[5,5],[6,6],[7,7],[8,8],[9,9]]
        ]); ?>
    </div>
<?php } ?>
<!-- END Realisations -->
