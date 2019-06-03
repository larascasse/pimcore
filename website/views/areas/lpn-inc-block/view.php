<?php

  	$doc = $this->href("doc", [
        //"height" => 500
    ]); 
    $cssClass = $this->input("cssClass",["placeholder"=>"Classe css","htmlspecialchars"=>false]);

      $cl = $cssClass->getData();
      $cl = preg_replace('/\s+/', ' ', $cl);
      $cl = str_replace("&nbsp;", " ", $cl);
      $cl = str_replace(" ", " ", $cl);
      $cl = str_replace("&#160;", " ", $cl);
      
      


//print_r(Pimcore\Tool::isFrontentRequestByAdmin());
  	if ($this->editmode) {
      echo $cssClass;
  		echo $doc;


  	}
  	else if (Pimcore\Tool::isFrontentRequestByAdmin()) {
      echo '<div id="pimbloc'.$doc->getElement()->getId().'" class="'.$cl.'">';
  		//echo Document\Service::render($doc->getElement());
      echo "TATA";
      echo '</div>';

  	}	
  	else {
      
      echo '<div id="pimbloc'.$doc->getElement()->getId().'" class="'.$cl.'">';
  	//	echo '{{widget type="cms/widget_block" template="cms/widget/static_block/default.phtml" block_id="'.$doc->getElement()->getKey().'"}}';
      echo 'TOTO';
      echo '</div>';
  	}
  	
 ?>




