<?php

// define a custom class,  for example:
class Website_Product extends Object_Product {

	/**
     * Dummy which can be overwritten by a parent class, this is a hook executed in every getter of the properties in the object
     * @param string $key
     */
    public function preGetValue ($key) {

   

     $getter = "get" . ucfirst($key);
  	if(!method_exists($this,$getter)) {
  		return;
  	}

    	$data = $this->$key;

    	
		if(!$data) { return $this->getValueFromParent($key);}
	 	return $data;

        //return;
    }



	/**
	* @return string
	*/
	public function getChoix () {
		//return "klmklmklmklkklmklmklm";
		return parent::getChoix();

		//Deprecated, we use the default beahaviour
		if(Pimcore::inAdmin())
			return parent::getChoix();

		$preValue = $this->choix; 
		if($preValue !== null && !Pimcore::inAdmin() && $preValue !="") { 


		}
		else if((!$preValue ||  $preValue =="")) { 
			$preValue =  $this->getValueFromParent("choix");

		}
		$datas = Object_Taxonomy::getByCode($preValue);
		foreach ($datas as $data) {
		    // do something with the cities
		    return $data->getLabel();
		  
		}
		return $preValue;

	}

	/**
	* @return string
	*/
	public function getChoixString () {
		$preValue = $this->getChoix; 
		$datas = Object_Taxonomy::getByCode($preValue);
		foreach ($datas as $data) {
		    // do something with the cities
		    return $data->getLabel();
		}

	}


	public function getEssence() {

		return parent::getEssence();

		//Deprecated, we use the default beahaviour

		if(Pimcore::inAdmin())
			return parent::getEssence();

		$preValue = $this->essence; 
		if($preValue !== null && !Pimcore::inAdmin() && $preValue !="") { 

		}
		else if((!$preValue ||  $preValue =="")) { 

			$preValue =  $this->getValueFromParent("essence");
		
		}

		$datas = Object_Taxonomy::getByCode($preValue);
		foreach ($datas as $data) {
		    return $data->getLabel();
		  
		}
		return $preValue;
	}
	/**
	* @return string
	*/
	public function getEssenceString () {
		$preValue = $this->getEssence; 
		$datas = Object_Taxonomy::getByCode($preValue);
		foreach ($datas as $data) {
		    // do something with the cities
		    return $data->getLabel();
		}

	}


	public function getQualite() {

		return parent::getQualite();

		//Deprecated, we use the default beahaviour

		if(Pimcore::inAdmin())
			return parent::getQualite();

		$preValue = $this->qualite; 
		if($preValue !== null && !Pimcore::inAdmin() && $preValue !="") { 

		}
		else if((!$preValue ||  $preValue =="")) { 
			$preValue =  $this->getValueFromParent("qualite");
		
		}
		$datas = Object_Taxonomy::getByCode($preValue);
		foreach ($datas as $data) {
		    return $data->getLabel();
		  
		}
		return $preValue;
	}

	/**
	* @return string
	*/
	public function getQualiteString () {
		$preValue = $this->getQualite; 
		$datas = Object_Taxonomy::getByCode($preValue);
		foreach ($datas as $data) {
		    // do something with the cities
		    return $data->getLabel();
		}

	}
	

	public function getCharacteristicsFo() {
		//$attributes = Object_Class::getByName("Product")->getFieldDefinitions();`
		
		$attributes = $this->getClass()->getFieldDefinitions();
		$includeFields = array("fiche_technique_orginale","fiche_technique_lpn");
		$showEmptyAttribute = false;
		$caracteristiques = array();

		$fields = array("epaisseur");
		foreach($attributes as $key=> $value) {

			$attribute  =  $value->getName();
			$attributeLabel = $value->getTitle();
			
			if(!in_array($attribute,$includeFields)) {
				unset($attributeValue);
				continue;
			}
			$this->getClass()->getFieldDefinition($value->getName());
			//print_r( $value->fieldtype);
			$getter = "get" . ucfirst($attribute);
			
			
			if(!empty($this)) {
				if(method_exists($this, $getter)) {
					$attributeValue = $this->$getter();

					if(!$showEmptyAttribute && empty($attributeValue))
							continue;

					//Object bricks
					if($value->fieldtype=="objectbricks") {
						//print_r($value);
						$getter2 = $attributeValue->getBrickGetters()[0];
						//echo $getter2;
						/*echo "<pre>";
						print_r($attributeValue->getBrickGetters()[0]);
							echo "</pre>";*/
						//getHtmlTable
						if(method_exists($attributeValue, $getter2) && $attributeValue->$getter2()) {
							$attributeValue=$attributeValue->$getter2()->getTest();
							$caracteristiques[] = array("label"=>$attribute,"content"=>$attributeValue);
						}
					}
					//Fieldcollections
					else if($value->fieldtype=="fieldcollections") {
						
						$returnValue ="";
						if($attributeValue) {
							foreach($attributeValue->getItems() as $fieldCollectionData) {						

								if($fieldCollectionData->getType()=="ProductFieldCollection") {
									$caracteristiques[] = array("label"=>$attribute,"content"=>$fieldCollectionData->prix);
								}
							}

						}
						

					}
					//Multi href
					else if(is_array($attributeValue)) {
						$attributeValue = implode($attributeValue);
						$caracteristiques[] = array("label"=>$attribute." ".$attributeLabel,"content"=>$attributeValue);

					}
					//Documents
					else {
						if($value->fieldtype=="href"){
							$attributeValue = '<a href="'.$attributeValue.'" target="_blank">> télécharger</a>';
						}
						$caracteristiques[] = array("key"=>$attribute,"label"=>$attributeLabel,"content"=>$attributeValue);
					}

				} 
			}
								
		}
		return $caracteristiques;
	}


	public function getCharacteristics() {
		//$attributes = Object_Class::getByName("Product")->getFieldDefinitions();`
		
		$attributes = $this->getClass()->getFieldDefinitions();
		$ignoreFields = array("price","characteristics","name","description", "lesplus","short_description_title","short_description","image_1","image_2","image_3","ean","relatedAccessories","associatedArticles","extras","relatedProducts","code","famille","magentoshort","subtype","nbrpp","fiche_technique_orginale","fiche_technique_lpn","short_name","echantillon","realisations");
		foreach($attributes as $key=> $value) {
			$attribute  =  $value->getName();
			if(strpos($attribute,"mage_")===0 || strpos($attribute,"meta_")===0 || strpos($attribute,"image_")===0) {
				$ignoreFields[]=$attribute;
			}
		}
		$showEmptyAttribute = false;
		$caracteristiques = array();

		$fields = array("epaisseur","longueur");
		foreach($attributes as $key=> $value) {

			$attribute  =  $value->getName();
			$attributeLabel = $value->getTitle();
			
			if(in_array($attribute,$ignoreFields)) {
				unset($attributeValue);
				continue;
			}
			$this->getClass()->getFieldDefinition($value->getName());
			//print_r( $value->fieldtype);
			$getter = "get" . ucfirst($attribute);
			
			
			if(!empty($this)) {
				if(method_exists($this, $getter)) {
					$attributeValue = $this->$getter();

					if(!$showEmptyAttribute && empty($attributeValue))
							continue;

					if($attribute=="characteristics_others") {
						$others = explode("\n",trim($attributeValue));
					
						if(count($others)>0) {
							
							foreach ($others as $item) {
								$explode = explode(":",$item);
								if(count($explode)>1) {
									$caracteristiques[] = array("label"=>$explode[0],"content"=>$explode[1]);
								}
								else {
									$caracteristiques[] = array("label"=>"","content"=>$item);

								}
								
										
							}
							
						}
						

					}

					else if(is_array($attributeValue)) {
						$attributeValue = implode($attributeValue);
						$caracteristiques[] = array("label"=>$attributeLabel,"content"=>$attributeValue);

					}
					//Documents
					else {
						if($value->fieldtype=="href"){
							$attributeValue = '<a href="'.$attributeValue.'" target="_blank">> télécharger</a>';
						}
						$caracteristiques[] = array("key"=>$attribute,"label"=>$attributeLabel,"content"=>$attributeValue);
					}

				} 
			}
								
		}
		$html ="<ul>\n";
		foreach ($caracteristiques as $key => $value) {
			$html.="<li><strong>".$value["label"]."</strong>: ".$value["content"]."</li>\n";
		}
		$html .="</ul>\n";
		return $html;
	}

	public function getMage_guideline() {
		$articles = $this->getAssociatedArticles();
		$str="";
		if($articles) {
			$str.="<ul>";
			$index=1;
			foreach ($articles as $key => $article) {
				$str.="<li><h3 class=\"img".$index."\">".$index."</h3>";
				$str.="<h2>".$article->getName()."</h2>";
				$str.=$article->getContent();
				$str.="</li>";
				$index++;

			}
			$str.="</ul>";
		}
		return $str;
	}
	public function getMage_fichepdf() {
		if($this->getFiche_technique_lpn())
			return "http://".$_SERVER["HTTP_HOST"].$this->getFiche_technique_lpn()->getFullPath();
		return null;
	}
	public function getMage_short_name() {
		// get an asset
    	//$asset = Asset::getById($this->getImage_1()->id);
    	if(strlen($this->getShort_name())>0)
    		return $this->getShort_name();
    	else if($this->getName()) {

    		$str = $this->getName();
    		$str = str_replace($this->getSubtype(), "", $str);
    		$str =trim($str);
    		$str = substr($str,0,50);
    		return $str;
    	}

	}

	public function getMage_sub_descrition() {
		return "toto";
		if($this->mage_sub_descrition)
			return $this->mage_sub_descrition;

		return parent::getMage_sub_descrition();
	}



	public function getMage_config_description() {
		//$attributes = Object_Class::getByName("Product")->getFieldDefinitions();`
		
		$attributes = $this->getClass()->getFieldDefinitions();
		$includeFields = array("epaisseur","longeur","largeur","finition","fixation","choix","qualite");
		$showEmptyAttribute = false;
		$caracteristiques = array();

		foreach($attributes as $key=> $value) {

			$attribute  =  $value->getName();
			$attributeLabel = $value->getTitle();
			
			if(!in_array($attribute,$includeFields)) {
				unset($attributeValue);
				continue;
			}
			$this->getClass()->getFieldDefinition($value->getName());
			//print_r( $value->fieldtype);
			$getter = "get" . ucfirst($attribute);
			
			
			if(!empty($this)) {
				if(method_exists($this, $getter)) {
					$attributeValue = $this->$getter();

					if(!$showEmptyAttribute && empty($attributeValue))
							continue;

					if(is_array($attributeValue)) {
						$attributeValue = implode($attributeValue);
						$caracteristiques[] = array("label"=>$attribute." ".$attributeLabel,"content"=>$attributeValue);

					}
					//Documents
					else {
						if($value->fieldtype=="href"){
							$attributeValue = '<a href="'.$attributeValue.'" target="_blank">> télécharger</a>';
						}
						$caracteristiques[] = array("key"=>$attribute,"label"=>$attributeLabel,"content"=>$attributeValue);
					}

				} 
			}
								
		}
		/*$html ="<ul>\n";
		foreach ($caracteristiques as $key => $value) {
			$html.="<li>".$value["label"]." ".$value["content"]."</li>\n";
		}
		$html .="</ul>\n";*/

		$html ="<p>";
		foreach ($caracteristiques as $key => $value) {
			$html.="".$value["label"]." ".$value["content"]."<br />";
		}
		$html .="</p>";

		return $html;
	}

	
	public function getImage_1_src() {
		// get an asset
    	//$asset = Asset::getById($this->getImage_1()->id);
    	if($this->getImage_1())
    	return "http://".$_SERVER["HTTP_HOST"].$this->getImage_1()->getFullPath();

	}

	
	public function getImage_2_src() {
		// get an asset
    	//$asset = Asset::getById($this->getImage_1()->id);
    	//if($this->getImage_2())
    	if($this->getImage_2())
    	return "http://".$_SERVER["HTTP_HOST"].$this->getImage_2()->getThumbnail("magento_small")->getPath();

	}

	
	public function getImage_3_src() {
		// get an asset
    	//$asset = Asset::getById($this->getImage_1()->id);
    	if($this->getImage_3())
    	return "http://".$_SERVER["HTTP_HOST"].$this->getImage_3()->getFullPath();

	}



	public function getDimensionsString() {
		$varationString =array();
		if(round($this->getEpaisseur())>0)
			$varationString[]="Ep: ".round($this->getEpaisseur());
		
		if(round($this->getLargeur())>0)
			$varationString[]="l: ".round($this->getLargeur());


		if(round($this->getLongueur())>0) 
			$varationString[]= "L: ".round($this->getLongueur());

		if($this->getVolume())
			$varationString[]=$this->getVolume();

		if($this->getHauteur())
			$varationString[]=$this->getHauteur();

		if($this->getConditionnement())
			$varationString[]=$this->getConditionnement();
		
		return implode($varationString," / ");
	}

	public function getLesPlusArray() {

		return array_filter(explode("\n",trim($this->getLesplus())));

	}

	public function getMage_lesplus() {

		$lesplus = explode("\n",trim($this->getLesplus()));
		$str="";
		if(count($lesplus)) {
			$str.="<ul>";
			foreach ($lesplus as $item) {
				$str.="<li>".$item."</li>";			
			}
			$str.="</ul>";
		}
		return $str;
	}


	public function getMage_description() {
		return "<h2>".$this->getShort_description_title()."</h2><p>".$this->getDescription()."</p>";
	}


	public function getMage_realisations() {
		$str="";
		$realisations =$this->getRealisations();

		//print_r( $realisations);
		$count=count($realisations);
		$assetsArray=array();
		for ($i=0; $i < $count; $i++) { 
				$assets=Asset_Folder::getById($realisations[$i]->id)->getChilds();
				foreach ($assets as $asset) {
					$assetsArray[] = $asset;
				}
		}

		$count=count($assetsArray);
		if($count>0) {
			$str .= '<ul id="slider_realisation">';
			/*$str .= '<ol class="carousel-indicators">
		        <li data-target="#myCarousel2" data-slide-to="0" class="active"></li>';
		        for($i=1; $i<=$count; $i++) {
		        	$str .= '<li data-target="#myCarousel2" data-slide-to="'.$i.'"></li>';
		        }
		    $str .= '</ol>';
			*/
			//$str .=  '<div class="carousel-inner">';
			$index=0;
			foreach ($assetsArray as $asset) {

				$str .= '<li>
							<div class="nsg_container">
								<div><img src="http://'.$_SERVER['HTTP_HOST'].$asset->getThumbnail("magento_small").'"></div>
		                		<div class="nsg_abs">
		                    		<div class="realisationpicto">Nos r&eacute;alisations</div>
									<div class="realisationtitle">'.$this->getMage_short_name().'</div>
									<div class="realisationcontent">'.$this->getName().'</div>
								</div>
		                    
		                	</div>
	            		</li>';
	            $index++;
			}
			$str.="</ul>";
			//$str .= '</div>';
			/*$str .= '<a class="left carousel-control" href="#myCarousel2" data-slide="prev"><span class="glyphicon glyphicon-chevron-left"></span></a>
		    <a class="right carousel-control" href="#myCarousel2" data-slide="next"><span class="glyphicon glyphicon-chevron-right"></span></a>';
			$str .= '</div>';*/
		}
		return $str;
	}

	public function getRelated($field) {
		//$attributes = Object_Class::getByName("Product")->getFieldDefinitions();`
		$attributes = $this->getClass()->getFieldDefinitions();

		$returnValue = array();

		//$this->getClass()->getFieldDefinition($value->getName());
		//print_r( $value->fieldtype);
		$getter = "get" . ucfirst($field);
			
		if(!empty($this)) {
			if(method_exists($this, $getter)) {
				$attributeValue = parent::$getter();
				if($attributeValue) {
					foreach($attributeValue as $object) {
		
						if($object->getClassName()=="product"  || $object->getClassName()=="article" || $object->getClassName()=="productExtra") {
							$returnValue[] = $object;
	
						}
						else if($object->getClassName()=="category") {
							$products = $object->getProducts();
							foreach ($products as $product) {
								$returnValue[] = $product;
							}	
							
						}
						
					}

				}
			}
								
		}
		return $returnValue;
	}


}

// and optionally a related list

class Website_Product_list extends Object_Product_List {

    public function myCustomGetter () {
        return true;
    }
}
?>