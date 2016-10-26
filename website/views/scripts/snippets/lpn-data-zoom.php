<?php 

if(!function_exists ('toto')) {
    function real_product_from_image($asset) {

        $image  = $asset;
        
        $ean="";
        $name="";
        $sku = "";
        $product = null;

        if($image instanceof Asset_Image)
            $product = $image->getProperty("product");
    
         if(!$product) {
        
           
            $dependencies = $image->getDependencies();
            
            $requiredBy = $dependencies->requiredBy;
            if (is_array($requiredBy)) {
            
                foreach ($requiredBy as $key => $value) {
                    if($value['type']=="object") {

                        $element = Object_Abstract::getById($value['id']);
                        if($element && $element instanceof Object_Product) {
                            $product = $element;
                
                        }
                    }
                    
                }
            }
            
             $ean = $image->getMetadata("product");
             if($ean) {
                 if(!$product) {
                 $product = Object_Product::getByEan($ean)->objects[0];
                }

                if(!$product) {
                   $product = Object_Product::getByCode($ean)->objects[0];
                }
             }
           
        }
        //s'il n'y a pas de dependance, on regarde dans le dossier supérieur
        if(!$product) {
            $folder = Asset_Folder::getById($image->getParentId());
            
            if($folder instanceof Asset_Folder) {

                $productParentObject = real_product_from_image($folder);
                if(strlen($productParentObject->sku)>0)
                    return $productParentObject;
            }
        }


        if($product) {
            $name=$product->getName();
            $sku=$product->getEan()?$product->getEan():$product->getCode();

        }
        $productObject =(object) array (
                "name"=>$name,
                "sku" => $sku,
                "magelink" => '{{block type="core/template" template="lpn/lpn_product_link.phtml" name="givemetheprice_'.$sku.'" product_sku="'.$sku.'" class="btnarrow pull-right"}}'
                );
        return $productObject;
        
    }
}
?>

<?php if ($this->editmode) { ?>
    <?= $this->multihref("multihref"); ?>
<?php } else { ?>
    <!-- you can iterate through the elements using directly the tag -->
    
    <?php 
    $arrayImages = array();

    $i=0;
    $realisationsHref = $this->multihref("multihref");
    $assetsArray = array();
    $realisations=array();
    foreach($realisationsHref as $element) { 
        $realisations[]= $element; 
        $assetsArray[$i] = array();
    	
		 if($element instanceof Asset_Folder) {

		    $assets=Asset_Folder::getById($element->id)->getChilds();

		    foreach ($assets as $asset) {
		        $assetsArray[] = $asset;
		        $arrayImages[] = 'http://'.$_SERVER['HTTP_HOST'].$asset->getThumbnail("magento_realisation");
                $assetsArray[$i][$asset->getThumbnail("magento_realisation")->getPath()] = $asset;
		    }
		}
		elseif($element instanceof Asset_Image) {

		    $arrayImages[] = 'http://'.$_SERVER['HTTP_HOST'].$element->getThumbnail("magento_realisation");
            $assetsArray[$i][$element->getThumbnail("magento_realisation")->getPath()] = $element;
		}

        //Element_Service::getElementType($element); 
        ?>
        
    <?php 
    $i++;
    } 

    //ON remplit le JSON

    //Pour une liste de realisation
    $return = array();

    //pour une zoom de plusieurs realisations
    $dataZoomId = "zoom_real_".$this->getId();
    $returnZoomRealisation = (object) array("images"=>array(),"products"=>array(),"id"=>$dataZoomId);

    $count=count($realisations);

    
    
    $dataValue = (object) array("id"=>$dataZoomId);

   

    //$count=count($assetsArray);
        if($count>0) {
           
                 for ($i=0; $i < $count; $i++) { 

                     $dataZoomId = "zoom_real_".$this->getId()."_".$i;

                     $element = $realisations[$i];
                     $products = array();

                     //1 realisation = 1 dossier
                     if($element instanceof Asset_Folder) {
                        
                        $assets=Asset_Folder::getById($element->id)->getChilds();
                        $arrayImages2 = array();

                        $productsFromFolder = real_product_from_image($element);
                        

                        if(count($assets)>0 && $assets[0] instanceof Asset_Image) {
                        
                            $urlImage = 'http://'.$_SERVER['HTTP_HOST'].$assets[0]->getThumbnail("magento_realisation")->getPath();
                     
                            foreach ($assets as $asset) {

                                if($asset instanceof Asset_Image) {
                                    
                                    $arrayImages2[] = 'http://'.$_SERVER['HTTP_HOST'].$asset->getThumbnail("magento_realisation")->getPath();

                                    $returnZoomRealisation->images[] = 'http://'.$_SERVER['HTTP_HOST'].$asset->getThumbnail("magento_realisation")->getPath();
                                    
                                    //Prodits
                                    $productsFromImage = real_product_from_image($asset);

                                    

                                    if(strlen($productsFromImage->sku)>0) {

                                        $products[] = $productsFromImage;
                                        $returnZoomRealisation->products[] = $productsFromImage;
                                    }
                                    else {
                                        $products[] = $productsFromFolder;
                                        $returnZoomRealisation->products[] = $productsFromFolder;
                                    }




                                    
                                    

                                }
                            }
                            $return[] = (object) array("id"=>$dataZoomId,"base"=>$urlImage,"images"=>$arrayImages2,"products"=>$products);

                        }
                    }
                    //1 realisation = 1 image
                    else {

                         $urlImage = 'http://'.$_SERVER['HTTP_HOST'].$element->getThumbnail("magento_realisation")->getPath();
                         $product = real_product_from_image($element);
                         $products[] = $product;
                         $return[] = (object) array("id"=>$dataZoomId,"base"=>$urlImage,"images"=>array($urlImage),"products"=>$products);

                         $returnZoomRealisation->images[] = $urlImage;
                         $returnZoomRealisation->products[] = $product;
                    }
                }
           
                 
                
                

        }
            




    ?>
    <?php //print_r($arrayImages) ?><br />
    Data ZOOM : 
    <textarea rows="20" cols="100"><?php echo implode('|',$arrayImages) ?></textarea>

    <br />Data ZOOM2 ULL (avec légende: 
    <textarea rows="20" cols="100"><?php

   
        echo '<a href="Découvrir nos réalisations" data-zoom-rel="'.$returnZoomRealisation->id.'">';
        echo '<script type="application/json" id="'.$returnZoomRealisation->id.'">';
        echo  Zend_Json::encode($returnZoomRealisation);
        echo  '</script>';


    ?></textarea>

    <br />JSON Pour une liste de real sous forme de bloc, chaque real est une image<br />
    <textarea rows="20" cols="100"><?php echo Zend_Json::encode($return); ?></textarea>
<?php } ?>
