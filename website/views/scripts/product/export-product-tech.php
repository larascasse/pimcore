<?php 

function clean($str) {
	$str = str_replace("<br />", " - ", $str);
	$str = str_replace("\n", " - ", $str);
	$str = str_replace("\r", "", $str);
	$str = str_replace("\t", "", $str);
	$str = strip_tags($str);
	$str = trim($str);

	return $str;

}

$products = $this->products;
$idx = 0;
$header=array();
$rows = array();
foreach ($products as $product) {
	 $row=array();
	 

	 if(strlen($product->ean)==0) {
	 	continue;
	 }
	 
	 if($idx==0) {
		 $header[] = "Famille";
		 $header[] = "EAN";
		 $header[] = "Name";
		 $header[] = "Url";
	 }

	 $row[] = $product->getCode();
	 $row[] = $product->getEan();
	 $row[] = $product->getMage_name();
	 $row[] = 'https://pim.laparqueterienouvelle.fr/id/'.$product->getId();


	 $caracteristiques =  $product->getCharacteristicsArray();
	 foreach ($caracteristiques as $key => $value) {

 	
	 		//if(!isset($value["label"]))
 			//	continue;
 			
 			
 			try {
 				if($idx==0) {
 					if(is_array($value) && array_key_exists("label", $value))
	 					$header[] = ucfirst(trim($value["label"]));
	 				else
	 					$header[] = "";
	 			}
 			}
 			catch (Exception $e) {

 			}
 			
 			
 			$content = $description = "";

 			if(isset($value["content"]) && strlen(trim($value["content"]))>0) {
				$content = clean($value["content"]);
 			}

 			$row[] = ucfirst($content);

			/*if(isset($value["description"]) && strlen(trim($value["description"]))>0) {
				$description = clean($value["description"]);
			}

			if(isset($description)) {
				//$html.= '<br />';
				$row[] = ucfirst(trim($description));

			}
			else {
				$row[] = ucfirst($content);
			}*/

			

			
			
	}

	
	$rows[]  = $row;
	$idx ++;
}
echo implode(";", $header)."\n";
foreach ($rows as $row) {
	echo implode(";", $row)."\n";
}


 

