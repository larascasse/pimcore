<?php

  	$doc = $this->href("doc", [
        //"height" => 500
    ]); 
    $cssClass = $this->input("cssClass",["placeholder"=>"Classe css"]);
//print_r(Pimcore\Tool::isFrontentRequestByAdmin());
  	if ($this->editmode) {
      echo $cssClass;
  		echo $doc;


  	}
  	else if (Pimcore\Tool::isFrontentRequestByAdmin()) {

  		echo Document\Service::render($doc->getElement());

  	}	
  	else {
      echo '<div id="pimbloc'.$doc->getElement()->getId().'" class="'.$cssClass->getData().'">';
  		echo '{{widget type="cms/widget_block" template="cms/widget/static_block/default.phtml" block_id="'.$doc->getElement()->getKey().'"}}';
      echo '</div>';
  	}
  	
 ?>




