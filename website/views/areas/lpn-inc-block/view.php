<?php

  	$doc = $this->href("doc", [
        //"height" => 500
    ]); 
    $cssClass = $this->input("cssClass",["placeholder"=>"Classe css","htmlspecialchars"=>false]);
//print_r(Pimcore\Tool::isFrontentRequestByAdmin());
  	if ($this->editmode) {
      echo $cssClass;
  		echo $doc;


  	}
  	else if (Pimcore\Tool::isFrontentRequestByAdmin()) {

  		echo Document\Service::render($doc->getElement());

  	}	
  	else {
      $cl = $cssClass->getData();
      $cl = str_replace("&nbsp;", " ", $cl);
      $cl .= " ZZZ";
      echo '<div id="pimbloc'.$doc->getElement()->getId().'" class="'.$cl.'">';
  		echo '{{widget type="cms/widget_block" template="cms/widget/static_block/default.phtml" block_id="'.$doc->getElement()->getKey().'"}}';
      echo '</div>';
  	}
  	
 ?>




