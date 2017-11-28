<?php 



$products = $this->products;
$idx = 0;
$header=array();
$rows = array();
foreach ($products as $product) {
	 $row=array();
	 

	 if(strlen($product->ean)==0) {
	 	continue;
	 }
	 
	 $header[] = "Famille";
	 $header[] = "EAN";
	 $header[] = "Url";

	 $row[] = $product->getCode();
	 $row[] = $product->getEan();
	 $row[] = 'https://pim.laparqueterienouvelle.fr/id/'.$product->getId();


	 $caracteristiques =  $product->getCharacteristicsArray();
	 foreach ($caracteristiques as $key => $value) {

 	

 			if(!is_array($value)) {
 				continue;
 			}

 			if(!isset($value["label"]))
 				continue;

 			if($idx==0) {
 				$header[] = ucfirst(trim($value["label"]));
 			}
 			
 			$content = $description = null;

 			if(isset($value["content"]) && strlen(trim($value["content"]))>0) {
				$content = strip_tags(str_replace("\n","",trim($value["content"])));
 			}

			if(isset($value["description"]) && strlen(trim($value["description"]))>0) {
				$description = strip_tags(str_replace("\n","",trim($value["description"])));
			}

			if(isset($description)) {
				//$html.= '<br />';
				$row[] = ucfirst(trim($description));

			}
			else {
				$row[] = ucfirst($content);
			}

			

			
			
	}

	$row["url"] = $product->getEan();
	$rows[]  = $row;
	$idx ++;
}
echo implode(";", $header)."\n";
foreach ($rows as $row) {
	echo implode(";", $row)."\n";
}


 

