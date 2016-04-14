<?php if ($this->editmode) { ?>
    <?= $this->multihref("multihref"); ?>
<?php } else { ?>
    <!-- you can iterate through the elements using directly the tag -->
    
    <?php 
    $arrayImages = array();

    $i=0;
    $realisations = $this->multihref("multihref");
    $count=count($this->multihref("multihref"));

    foreach($realisations as $element) { 

    	
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
    $return = array();
    //$count=count($assetsArray);
        if($count>0) {
           
                 for ($i=0; $i < $count; $i++) { 
                     $element = $realisations[$i];
                     if($element instanceof Asset_Folder) {
                        $assets=Asset_Folder::getById($element->id)->getChilds();
                        $arrayImages2 = array();

                        if(count($assets)>0 && $assets[0] instanceof Asset_Image) {
                     
                            $urlImage = 'http://'.$_SERVER['HTTP_HOST'].$assets[0]->getThumbnail("magento_realisation")->getPath();
                     
                            foreach ($assets as $asset) {
                                if($asset instanceof Asset_Image) {
                                    $arrayImages2[] = 'http://'.$_SERVER['HTTP_HOST'].$asset->getThumbnail("magento_realisation")->getPath();
                                }
                            }
                            $return[] = (object) array("base"=>$urlImage,"images"=>$arrayImages2);

                        }
                    }
                }
           
                 
                
                

        }
            




    ?>
    <?php //print_r($arrayImages) ?><br />
    <textarea rows="20" cols="100"><?php echo implode('|',$arrayImages) ?></textarea>
    <textarea rows="20" cols="100"><?php echo Zend_Json::encode($return) ?></textarea>
<?php } ?>
