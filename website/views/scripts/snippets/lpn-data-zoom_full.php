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
		        $arrayImages[] = $asset->getThumbnail("magento_realisation")->getPath();
                $assetsArray[$i][$asset->getThumbnail("magento_realisation")->getPath()] = $asset;
		    }
		}
		elseif($element instanceof Asset_Image) {

		    $arrayImages[] = $element->getThumbnail("magento_realisation")->getPath();
            $assetsArray[$i][$element->getThumbnail("magento_realisation")->getPath()] = $element;
		}

        //Element_Service::getElementType($element); 
        ?>
        
    <?php 
    $i++;
    } 

    //ON remplit le JSON
    $return = array();
    $count=count($realisations);
    //$count=count($assetsArray);
        if($count>0) {
           
                 for ($i=0; $i < $count; $i++) { 
                     $element = $realisations[$i];
                     if($element instanceof Asset_Folder) {
                        $assets=Asset_Folder::getById($element->id)->getChilds();
                        $arrayImages2 = array();

                        if(count($assets)>0 && $assets[0] instanceof Asset_Image) {
                     
                            $urlImage = $assets[0]->getThumbnail("magento_realisation")->getPath();
                     
                            foreach ($assets as $asset) {
                                if($asset instanceof Asset_Image) {
                                    $arrayImages2[] = $asset->getThumbnail("magento_realisation")->getPath();
                                }
                            }
                            $return[] = (object) array("base"=>$urlImage,"images"=>$arrayImages2);

                        }
                    }
                    else {
                         $urlImage = $element->getThumbnail("magento_realisation")->getPath();
                         $return[] = (object) array("base"=>$urlImage,"images"=>array($urlImage));
                    }
                }
        }
            




    ?>
    <?php //print_r($arrayImages) ?><br />
    Data ZOOM : 
    <textarea rows="20" cols="100"><?php echo implode('|',$arrayImages) ?></textarea>

    JSON
    <textarea rows="20" cols="100"><?php echo Zend_Json::encode($return); ?></textarea>
<?php } ?>
