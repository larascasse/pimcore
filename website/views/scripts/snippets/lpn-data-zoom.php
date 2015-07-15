<?php if ($this->editmode) { ?>
    <?= $this->multihref("multihref"); ?>
<?php } else { ?>
    <!-- you can iterate through the elements using directly the tag -->
    
    <?php 
    $arrayImages = array();
    foreach($this->multihref("multihref") as $element) { 
    	
		 if($element instanceof Asset_Folder) {

		    $assets=Asset_Folder::getById($element->id)->getChilds();
		    foreach ($assets as $asset) {
		        $assetsArray[] = $asset;
		        $arrayImages[] = 'http://'.$_SERVER['HTTP_HOST'].$asset->getThumbnail("magento_realisation");
		    }
		}
		elseif($element instanceof Asset_Image) {

		    $arrayImages[] = 'http://'.$_SERVER['HTTP_HOST'].$element->getThumbnail("magento_realisation");
		}

        //Element_Service::getElementType($element); 
        ?>
        
    <?php } ?>
    <?php //print_r($arrayImages) ?><br />
    <textarea rows="20" cols="100"><?php echo implode('|',$arrayImages) ?></textarea>
<?php } ?>
