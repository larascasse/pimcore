<?php

// define a custom class,  for example:
class Website_Product extends Object_Product {

	/**
     * Dummy which can be overwritten by a parent class, this is a hook executed in every getter of the properties in the object
     * @param string $key
     */
    public function preGetValue ($key) {

   		
    	if(!Pimcore::inAdmin()) {
		     $getter = "get" . ucfirst($key);
		  	if(!method_exists($this,$getter)) {
		  		return;
		  	}

		    	$data = $this->$key;

		    	
				if(!$data) { return $this->getValueFromParent($key);}
			 	return $data;

	   }
	   return;
	   
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
		$preValue = $this->getChoix(); 

		$data = Object_Abstract::getByPath('/choix/'.strtolower($preValue));

		if($data instanceof Object_Taxonomy)
		return ucwords(strtolower($data->getLabel()));



		$datas = Object_Taxonomy::getByCode($preValue);
		foreach ($datas as $data) {
		    // do something with the cities
		    return ucwords(strtolower($data->getLabel()));
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
		$preValue = $this->getEssence(); 
		//return strtolower('/essence/'.strtolower($preValue));
		$data = Object_Abstract::getByPath('/essence/'.strtolower($preValue));

		if($data instanceof Object_Taxonomy)
			return ucwords(strtolower($data->getLabel()));
		$datas = Object_Taxonomy::getByCode($preValue);
		foreach ($datas as $data) {
		    // do something with the cities
		    return ucwords(strtolower($data->getLabel()));
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
		$preValue = $this->getQualite(); 
		$data = Object_Abstract::getByPath('/qualite/'.strtolower($preValue));
		if($data instanceof Object_Taxonomy)
			return ucwords(strtolower($data->getLabel()));

		$datas = Object_Taxonomy::getByCode($preValue);
		foreach ($datas as $data) {
		    // do something with the cities
		    return ucwords(strtolower($data->getLabel()));
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


	public function getCharacteristics($isHTML=true) {

		 $inheritance = Object_Abstract::doGetInheritedValues(); 
   		 Object_Abstract::setGetInheritedValues(true); 
   
  




		//$attributes = Object_Class::getByName("Product")->getFieldDefinitions();`
		
		$attributes = $this->getClass()->getFieldDefinitions();
		$ignoreFields = array("price","characteristics","name","description", "lesplus","short_description_title","short_description","image_1","image_2","image_3","ean","relatedAccessories","associatedArticles","origineArticles","extras","relatedProducts","code","famille","magentoshort","subtype","nbrpp","fiche_technique_orginale","fiche_technique_lpn","short_name","echantillon","realisations","name_scienergie","mode_calcul","name_scienergie_converti","unite","name_scienergie_court","epaisseur","longueur","largeur","price_1","price_2","price_3","price_4","getMage_categoryIds","no_stock_delay","gallery","re_skus","cs_skus","us_skus","rendement","accessoirepopin","colisage","nbrpp","leadtime");
		foreach($attributes as $key=> $value) {
			$attribute  =  $value->getName();
			if(strpos($attribute,"mage_")===0 || strpos($attribute,"meta_")===0 || strpos($attribute,"image_")===0 || strpos($attribute,"_not_configurable")>0 || strpos($attribute,"pimonly_")===0) {
				$ignoreFields[]=$attribute;
			}
		}
		$showEmptyAttribute = false;
		$caracteristiques = array();

		if(strlen($this->getDimensionsString())>0)
			$caracteristiques[] = array("label"=>"Dimensions","content"=>$this->getDimensionsString());

		

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
			$getterString = $getter."String";
			
			
			if(!empty($this)) {
				if(method_exists($this, $getter) || method_exists($this, $getterString)) {
					unset($attributeValue);
					if(method_exists($this, $getterString)) {
						$attributeValue = $this->$getterString();
					}

					if(empty($attributeValue))
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
						if($value->fieldtype=="multiselect") {
							$display = array();
							foreach ($attributeValue as $optionSelect => $valueSelect) {
								$display[]=Object_Service::getOptionsForSelectField($this,$attribute)[$valueSelect];

							}

							$attributeValue = implode(", ",$display);
							$caracteristiques[] = array("label"=>$attributeLabel,"content"=>$attributeValue);
						}
						else {
							$attributeValue = implode(", ",$attributeValue);
							$caracteristiques[] = array("label"=>$attributeLabel,"content"=>$attributeValue);
						}
						


					}
					else if($value->fieldtype=="select") {
							$attributeValue=Object_Service::getOptionsForSelectField($this,$attribute)[$attributeValue];
							$caracteristiques[] = array("label"=>$attributeLabel,"content"=>$attributeValue);
					}
					
					else {
						//Documents
						if($value->fieldtype=="href"){
							$attributeValue = '<a href="'.$attributeValue.'" target="_blank">> télécharger</a>';
						}
						$caracteristiques[] = array("key"=>$attribute,"label"=>$attributeLabel,"content"=>$attributeValue);
					}

				} 
			}
								
		}
		 Object_Abstract::setGetInheritedValues($inheritance); 


		if($isHTML) {
			$html ="<ul>\n";
			foreach ($caracteristiques as $key => $value) {
				$html.= '<li><div class="col-md-5 col-sm-5"><div class="nsg_ft0">';
				$html.= strlen($value["label"])>0?ucfirst(trim($value["label"])):"";
				$html.= '</div></div>';
				$html.= '<div class="col-md-9 col-sm-9 nsg_ft1">';
				$html.= ucfirst(trim($value["content"]));
				$html.= '</div>';
				$html.="</li>\n";
			}
			$html .="</ul>\n";
			return $html;

		}
		else {
			$html ="";
			foreach ($caracteristiques as $key => $value) {
				$html.="- ".$value["label"]." : ".$value["content"]."\n";
			}
			$html .="";
			return $html;
		}
		  
		
	}

	public function getMage_guideline() {

		$inheritance = Object_Abstract::doGetInheritedValues(); 
   		 Object_Abstract::setGetInheritedValues(true); 


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
		Object_Abstract::setGetInheritedValues($inheritance); 
		return $str;
	}
	public function getMage_fichepdf() {
		if($this->getFiche_technique_lpn())
			return "http://".$_SERVER["HTTP_HOST"].$this->getFiche_technique_lpn()->getFullPath();
		return null;
	}
	public function getMage_short_name() {

		$inheritance = Object_Abstract::doGetInheritedValues(); 
   		 Object_Abstract::setGetInheritedValues(true); 

		//Shortname
    	if(strlen($this->getShort_name())>0) {
    		
    		$str = $this->getShort_name();
    		$str =trim($str);

    		if(strlen($this->getPimonly_name_suffixe())>0) {
    			$str .=" ".$this->getPimonly_name_suffixe();
    		}
    		$str =trim($str);
    		Object_Abstract::setGetInheritedValues($inheritance); 
    		return $str;
    	}
    	//No shorname
    	else if($this->getName()) {
    		$str = $this->getName();
    		$str = str_replace($this->getSubtype(), "", $str);
    		$str =trim($str);
    		if(strlen($this->getPimonly_name_suffixe())>0) {
    			$str .=" ".$this->getPimonly_name_suffixe();
    		}
    		$str =trim($str);
    		$str = substr($str,0,50);
    		Object_Abstract::setGetInheritedValues($inheritance); 
    		return $str;
    	}

	}

	public function getMage_sub_descrition() {

		$inheritance = Object_Abstract::doGetInheritedValues(); 
   		 Object_Abstract::setGetInheritedValues(true);

		if($this->mage_sub_descrition)
			return $this->mage_sub_descrition;

		Object_Abstract::setGetInheritedValues($inheritance); 

		return parent::getMage_sub_descrition();
	}

	public function getMage_origine_arbre() {

		$inheritance = Object_Abstract::doGetInheritedValues(); 
   		 Object_Abstract::setGetInheritedValues(true); 


		$articles = $this->getOrigineArticles();
		$str="";
		if($articles) {
			//$str.="<ul>";
			$index=1;
			foreach ($articles as $key => $article) {
				
				$associatedDocuments = $article->getDocuments();
				foreach ($associatedDocuments as $document) {
					$url = "http://".$_SERVER["HTTP_HOST"].$document->getThumbnail("magento_realisation")->getPath();						
				}

				$str.= '<div class="nsg_fullbkgimg col-md-12 col-md-offset-2 col-xs-12 col-xs-offset-2" data-img="'.$url.'">
						<div class="nsg_origine_cnt">
						<h3>'.$article->getName().'</h3>
						'.$article->getContent().'
						</div>
						</div>';

			}
			$str.="";
		}
		Object_Abstract::setGetInheritedValues($inheritance); 
		return $str;

		/*return '<div class="nsg_fullbkgimg col-md-8 col-sd-8  col-md-offset-4  col-sd-offset-4" data-img="{{media url="wysiwyg/meleze.jpg"}}">
<div class="nsg_origine_cnt">
<h3>M&eacute;l&egrave;ze</h3>
<p>Integer posuere erat a ante venenatis dapibus posuere velit aliquet. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus</p>
</div>
</div>';*/
	}

	public function getMage_config_description() {

		$inheritance = Object_Abstract::doGetInheritedValues(); 
   		 Object_Abstract::setGetInheritedValues(true); 

		//$attributes = Object_Class::getByName("Product")->getFieldDefinitions();`
		
		$attributes = $this->getClass()->getFieldDefinitions();
		$includeFields = array("finition","fixation");
		$showEmptyAttribute = false;
		$caracteristiques = array();

		if(strlen($this->getDimensionsString())>0)
			$caracteristiques[] = array("label"=>"Dimensions","content"=>$this->getDimensionsString());

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
			$getterString = $getter."String";
			
			if(!empty($this)) {
				if(method_exists($this, $getter) || method_exists($this, $getterString)) {
					unset($attributeValue);
					if(method_exists($this, $getterString)) {
						$attributeValue = $this->$getterString();
					}

					if(empty($attributeValue))
						$attributeValue = $this->$getter();

					if(!$showEmptyAttribute && empty($attributeValue))
							continue;

					if(is_array($attributeValue)) {
						if($value->fieldtype=="multiselect" || $value->fieldtype=="multiselect") {
							$display = array();
							foreach ($attributeValue as $optionSelect => $valueSelect) {
								$display[]=Object_Service::getOptionsForSelectField($this,$attribute)[$valueSelect];

							}

							$attributeValue = implode(", ",$display);
							$caracteristiques[] = array("label"=>$attributeLabel,"content"=>$attributeValue);
						}
						else {
							$attributeValue = implode(", ",$attributeValue);
							$caracteristiques[] = array("label"=>$attributeLabel,"content"=>$attributeValue);
						}
						


					}
					else if($value->fieldtype=="select") {
							$attributeValue=Object_Service::getOptionsForSelectField($this,$attribute)[$attributeValue];
							$caracteristiques[] = array("label"=>$attributeLabel,"content"=>$attributeValue);
					}
					
					else {
						//Documents
						if($value->fieldtype=="href"){
							$attributeValue = '<a href="'.$attributeValue.'" target="_blank">> télécharger</a>';
						}
						$caracteristiques[] = array("key"=>$attribute,"label"=>$attributeLabel,"content"=>$attributeValue);
					}

				} 
			}
								
		}
		

		Object_Abstract::setGetInheritedValues($inheritance); 


		$html ="<p>";
		foreach ($caracteristiques as $key => $value) {
			$html.="".$value["label"].": ".$value["content"]."<br />";
		}
		$html .="</p>";

		return $html;
	}

	
	public function getImage_1_src() {
		// get an asset
    	//$asset = Asset::getById($this->getImage_1()->id);
    	if($this->getImage_1())
    	return "http://".$_SERVER["HTTP_HOST"].$this->getImage_1()->getThumbnail("magento_small")->getPath();

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
    	return "http://".$_SERVER["HTTP_HOST"].$this->getImage_3()->getThumbnail("magento_small")->getPath();

	}


	public static function getFormatedDimension($value,$prefix="",$suffix="",$rounded=true) {
		$value = str_replace(",",".", $value);
		$rounded = false;

		if(strlen($value)==1 && ($value=="0" || $value=="" || $value==0)) {
			//echo $value."die";
			return;
		}

        if(floatval($value)==$value && strlen($value)==strlen(floatval($value))) {
        	//echo $value.floatval($value)."\n";
        	$value = $rounded ? round($value):$value;
        	if(strlen($suffix)>0) {
	        	$value.=$suffix;
	        }
        }

        if(strpos($value,"/")>0 && strlen($suffix)>0) {
        	$value.=$suffix;
        }
        //echo "<br /> /--".$value."--/------";
        if(strlen($prefix)>0) {
        	$value= $prefix.": ".$value;
        }
       //echo "/--".$value."--/------";
        if(strlen($value)>0) {
        	//echo "OK !! $value\n";
        	return $value;
        }
    }

	private function getSingleDimentionString($field,$prefix,$suffix="mm",$rounded=true) {
		$excludefiled = $field."_not_configurable";
		if($this->$excludefiled)
			return;
		$childrens = $this->getChilds();
		$value = $this->$field;
		$getter = "get" . ucfirst($field);
			

		
		if(strlen($value)>0) {
			//if($field="volume")
				//self::getFormatedDimension($value,$prefix,$suffix,$rounded);
			$varationString=self::getFormatedDimension($value,$prefix,$suffix,$rounded);

			//if($field=="volume")
			//	echo self::getFormatedDimension($value,$prefix,$suffix,$rounded);;
		}
		else if(!empty($this) && method_exists($this, $getter) && strlen($value = $this->getValueFromParent($field))>0) {

			$varationString=self::getFormatedDimension($value,$prefix,$suffix,$rounded);
		
		}
		else {
			$childsDimension = array();

			foreach ($childrens as $subProduct) {
				if(!$subProduct->getPublished())
					continue;

				if($subProduct->getEan()=="") {
					$subProductChildrens = $subProduct->getChilds();
					foreach ($subProductChildrens as $subsubProduct) {
						if($subsubProduct->$field) {
							$childsDimension[$subsubProduct->$field] = self::getFormatedDimension($subsubProduct->$field,"","",$rounded);
						}
					}

				}
				else {
						
						if($subProduct->$field) {
							//if($field="volume")
							//	self::getFormatedDimension($subProduct->$field,"","",$rounded);
							$childsDimension[$subProduct->$field] = self::getFormatedDimension($subProduct->$field,"","",$rounded);
							
						}
				}
			}

			if(count($childsDimension)>0) {
				$varationString= self::getFormatedDimension(implode("/",$childsDimension),$prefix,$suffix,false);
			}
		}
		/*if($field=="volume") {
			print_r($childsDimension);
			echo $varationString;
		}*/
		return $varationString;

	}



	public function getDimensionsString() {
		$childrens = $this->getChilds();
		$varationString =array();

		if(strlen($value=$this->getSingleDimentionString("epaisseur","Ep"))>0) {
			$varationString[]=$value;
		}
		if(strlen($value=$this->getSingleDimentionString("largeur","l"))>0) {
			$varationString[]=$value;
		}
		if(strlen($value=$this->getSingleDimentionString("longueur","L"))>0) {
			$varationString[]=$value;
		}

		if(strlen($value=$this->getSingleDimentionString("volume","V","",false))>0) {
			$varationString[]=$value;
		}

		

		if($this->getHauteur())
			$varationString[]=$this->getHauteur();

		if($this->getConditionnement())
			$varationString[]=$this->getConditionnement();
		
		return count($varationString)>0?implode($varationString,", "):"";
	}

	public function getDimensionsStringEtiquette() {
		$varationString =array();
		if(round($this->getEpaisseur())>0)
			$varationString[]="".round($this->getEpaisseur())."";
		
		if(round($this->getLargeur())>0)
			$varationString[]="".round($this->getLargeur())."";


		if(round($this->getLongueur())>0) 
			$varationString[]= "".round($this->getLongueur())."";

		if($this->getVolume())
			$varationString[]=$this->getVolume()."L";

		if($this->getHauteur())
			$varationString[]=$this->getHauteur();

		if($this->getConditionnement())
			$varationString[]=$this->getConditionnement();
		
		return count($varationString)>0?implode($varationString,"/"):"";
	}

	public function getLesPlusArray() {

		return array_filter(explode("\n",trim($this->getLesplus())));

	}

	public function getMage_lesplus() {
			$inheritance = Object_Abstract::doGetInheritedValues(); 
   		 Object_Abstract::setGetInheritedValues(true); 

		$lesplus = explode("\n",trim($this->getLesplus()));
		$str="";
		if(count($lesplus)) {
			$str.="<ul>";
			foreach ($lesplus as $item) {
				$item = str_replace(": ","<br />",$item);
				$item = str_replace(":","<br />",$item);
				$str.="<li>".$item."</li>";			
			}
			$str.="</ul>";
		}
		Object_Abstract::setGetInheritedValues($inheritance); 

		return $str;
	}


	public function getMage_description() {
		$inheritance = Object_Abstract::doGetInheritedValues(); 
   		 Object_Abstract::setGetInheritedValues(true); 

   		 $str="";
   		 if(strlen(trim($this->getDescription())))
   		 	$str = "<h2>".$this->getShort_description_title()."</h2><p>".nl2br($this->getDescription())."</p>";
   		  Object_Abstract::setGetInheritedValues($inheritance); 
		return $str;
		   		

	}


	public function getNonOwnerObjects($fieldname){
	   $def = $this->getClass()->getFieldDefinition($fieldname);
	   $refKey = $def->getOwnerFieldName();
	   $refName = $def->getOwnerClassName();
	   $refClass = Object_Class::getByName($refName);
	   $refId = $refClass->getId();
	   $nonOwnerRelations = $this->getRelationData($refKey, false, $refId);
	   $objects = array();
	   foreach($nonOwnerRelations as $relation){
	     $objects[] = Object_Abstract::getById($relation['id'])->getMage_category_id();

	   }
	   return implode(",",$objects);
	}


	public function getMage_categoryIds() {
		return $this->getNonOwnerObjects("categories");
	}



	public function getMage_realisations() {
		$inheritance = Object_Abstract::doGetInheritedValues(); 
   		 Object_Abstract::setGetInheritedValues(true); 

		$str="";
		$realisations =$this->getRealisations();

		//print_r( $realisations);
		$count=count($realisations);
		$assetsArray=array();
		for ($i=0; $i < $count; $i++) { 
				$assets=Asset_Folder::getById($realisations[$i]->id)->getChilds();
				foreach ($assets as $asset) {
					$assetsArray[$asset->getThumbnail("magento_realisation")->getPath()] = $asset;
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
			
		    $arrayImages = array();
		    foreach ($assetsArray as $asset) {
		    	$arrayImages[] = 'http://'.$_SERVER['HTTP_HOST'].$asset->getThumbnail("magento_realisation")->getPath();
		    }
			

			$index=0;
			foreach ($assetsArray as $asset) {
				$urlImage = 'http://'.$_SERVER['HTTP_HOST'].$asset->getThumbnail("magento_realisation")->getPath();

				if(count($arrayImages)>0) {
					$zooms = array_merge(array($urlImage),$arrayImages);
				    $datazoom = implode("|",$zooms);
				}
				else
				    $datazoom = $urlImage;

				
				$str .= '<li data-zoom="'.$datazoom.'" class="'.($index==0?'norelazy':'').'">
							<div class="nsg_container">
								<div><img src="http://'.$_SERVER['HTTP_HOST'].$asset->getThumbnail("magento_realisation")->getPath().'" class="'.($index==0?'norelazy':'').'></div>
		                		<div class="nsg_abs">
		                    		<!--<div class="realisationpicto">Nos r&eacute;alisations</div>
									<div class="realisationtitle">'.$this->getMage_short_name().'</div>
									<div class="realisationcontent">'.$this->getName().'</div>-->
									<div class="realisationtitle"></div>
									<div class="realisationcontent"></div>
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
		 Object_Abstract::setGetInheritedValues($inheritance); 
		return $str;
	}

	public function getRelated($field,$onlyId=false) {
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
							if($onlyId) {
								$returnValue[] = $object->getId();
							}
							else {
								$returnValue[] = $object;
							}
							
	
						}
						else if($object->getClassName()=="category") {
							$products = $object->getProducts();
							foreach ($products as $product) {
								if($onlyId) {
									$returnValue[] = $product->getId();
								}
								else {
									$returnValue[] = $product;
								}
								
							}	
							
						}
						
					}

				}
			}
								
		}
		return $returnValue;
	}

	function getMage_re_skus() {
		$skus=array();
		$products = $this->getRelated("re_skus",false);
		foreach ($products as $product) { 
			if(strlen($product->getEan())>0)
				$skus[] = $product->getEan();
			else
				$skus[] = $product->getCode();
			# code...
		};
		return implode(",",$skus);
	}
	
	function getMage_cs_skus() {
		$skus=array();
		$products = $this->getRelated("cs_skus",false);
		foreach ($products as $product) { 
			if(strlen($product->getEan())>0)
				$skus[] = $product->getEan();
			else
				$skus[] = $product->getCode();
			# code...
		};
		return implode(",",$skus);	
	}

	function getMage_accessoirepopin() {
		$skus=array();
		$products = $this->getRelated("accessoirepopin",false);
		foreach ($products as $product) { 
			if(strlen($product->getEan())>0)
				$skus[] = $product->getEan();
			else
				$skus[] = $product->getCode();
			# code...
		};
		return implode(",",$skus);
	}


}

// and optionally a related list

class Website_Product_list extends Object_Product_List {

    
}
?>