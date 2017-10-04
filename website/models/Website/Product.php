<?php

// define a custom class,  for example:
class Website_Product extends Object_Product {

	private $_teintePath;
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
		$includeFields = array("fiche_technique_orginale","fiche_technique_lpn",'notice_pose_lpn');
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
		$ignoreFields = array(
			'characteristics','name','description', 
			'lesplus','short_description_title','short_description',
			'image_1','image_2','image_3','relatedAccessories','associatedArticles',
			'origineArticles','extras','relatedProducts','code','famille','magentoshort',
			'subtype','nbrpp','fiche_technique_orginale','fiche_technique_lpn','short_name',
			'echantillon','realisations','name_scienergie','mode_calcul','name_scienergie_converti',
			'unite','name_scienergie_court',
			'epaisseur', 'epaisseur_txt',
			'largeur', 'largeur_txt',
			'price','price_1','price_2','price_3','price_4',
			'getMage_categoryIds','no_stock_delay','gallery','re_skus','cs_skus','us_skus',
			'rendement','accessoirepopin','colisage','nbrpp','leadtime','shipping_type',
			'longueur','longueur_max','longueur_min','longueur_txt',
			'quantity_min','quantity_max','quantity_min_max_txt',
			'extra_content1','extra_content2',
			'actif_web',
			'subtype_1',
			'notice_pose_lpn'


			);
		foreach($attributes as $key=> $value) {
			$attribute  =  $value->getName();
			if(strpos($attribute,"mage_")===0 || strpos($attribute,"meta_")===0 || strpos($attribute,"image_")===0 || strpos($attribute,"_not_configurable")>0 || strpos($attribute,"pimonly_")===0) {
				$ignoreFields[]=$attribute;
			}
		}
		$showEmptyAttribute = false;
		$caracteristiques = array();

		$dimentionsStringExtended = $this->getDimensionsStringExtended();
		if(strlen($dimentionsStringExtended)>0)
			$caracteristiques[] = array("label"=>"Dimensions","content"=>$dimentionsStringExtended);

		

		//$fields = array("epaisseur","longueur");
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

					//Blooean on affiche oui
					if($value->fieldtype=="checkbox" && $attributeValue==1) {
						$attributeValue = "Oui";
					}


					if($attribute=="characteristics_others") {

						$others = explode("\n",trim($attributeValue));
						$caracteristiquesOthers=array();
						if(count($others)>0) {
							$row = 0;
							$currentRowTitle = 0; // pour les ligne sans titre, on ajoute a précedement
							$contentWithoutTitle = array();
							foreach ($others as $item) {
								$explode = explode(":",$item);
								if(count($explode)>1) {
									if(count($caracteristiquesOthers)>0)
										$currentRowTitle++;	
									$caracteristiquesOthers[$currentRowTitle] = array("label"=>trim($explode[0]),"content"=>trim($explode[1]));
								}
								elseif ($currentRowTitle==0) {
									$caracteristiquesOthers[$currentRowTitle] = array("label"=>"","content"=>trim($item));
									

								}
								else {
									$caracteristiquesOthers[$currentRowTitle]["content"] .="<br />".trim($item);
								}
								
									
							}
							
						}
						if(count($caracteristiquesOthers)>0) {
							foreach ($caracteristiquesOthers as $keyOthers => $valueOther) {
								$caracteristiques[] = $valueOther;
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
		$catalogue = $this->getCatalogue();
		Object_Abstract::setGetInheritedValues($inheritance); 


		if($isHTML) {
			//if(strtolower($catalogue)=="matieres" || strtolower($catalogue)=="matières") {
				$html ="<dl>\n";
				foreach ($caracteristiques as $key => $value) {
					$html.= '<dt>';
					$html.= strlen($value["label"])>0?ucfirst(trim($value["label"])):"";
					$html.= '</dt>';
					$html.= '<dd>';
					$html.= ucfirst(trim($value["content"]));
					$html.= '</dd>';
					//$html.="</li>\n";
				}
				$html .="</dl>\n";
			/*}
			else {
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
			}*/
			
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

	public function getMage_produitspose() {
		$inheritance = Object_Abstract::doGetInheritedValues(); 
   		Object_Abstract::setGetInheritedValues(true); 
   		$category = $this->getPimonly_category_pose();
   		if($category instanceof Object_Category) {
   			return $category->getMage_category_id();
   		}

	}

	public function getMage_produitsentretien() {
		$inheritance = Object_Abstract::doGetInheritedValues(); 
   		Object_Abstract::setGetInheritedValues(true); 
   		$category = $this->getPimonly_category_entretien();
   		if($category instanceof Object_Category) {
   			return $category->getMage_category_id();
   		}

	}


	public function getMage_produitsfinition() {
		$inheritance = Object_Abstract::doGetInheritedValues(); 
   		Object_Abstract::setGetInheritedValues(true); 
   		$category = $this->getPimonly_category_finition();
   		if($category instanceof Object_Category) {
   			return $category->getMage_category_id();
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
			return LPN_ASSET_PREFIX.$this->getFiche_technique_lpn()->getFullPath();
		return null;
	}

	public function getMage_notice_pose_lpn() {
		if($this->getNotice_pose_lpn())
			return LPN_ASSET_PREFIX.$this->getNotice_pose_lpn()->getFullPath();
		return null;
	}

	public function getMage_name() {

		$inheritance = Object_Abstract::doGetInheritedValues(); 
   		 Object_Abstract::setGetInheritedValues(true); 


   		  //Ajout shortanme parent et parentparent
   		 $parentMageSuffixe = "";
   		 $parentParentSuffixe = "";
   		 try {
   		 	$parentSuffixe = $this->getParent()->getPimonly_name_suffixe()." ";
			$parentParentSuffixe = $this->getParent()->getParent()->getPimonly_name_suffixe()." ";

   		 } catch (\Exception $e) {
            //
         }


		//Shortname
		$str = $this->getName();
		$str =trim($str);
		if(strlen($this->getPimonly_name_suffixe())>0) {
			$str .=$this->getParent()->getPimonly_name_suffixe()." ".$this->getPimonly_name_suffixe();
		}
		$str =trim($str);
		Object_Abstract::setGetInheritedValues($inheritance); 
		return $str;
    	

	}


	public function getMage_short_name() {

		$inheritance = Object_Abstract::doGetInheritedValues(); 
   		 Object_Abstract::setGetInheritedValues(true); 

   		 //Ajout shortanme parent et parentparent
   		 $parentMageSuffixe = "";
   		 $parentParentSuffixe = "";
   		 try {
   		 	$parentSuffixe = $this->getParent()->getPimonly_name_suffixe()." ";
			$parentParentSuffixe = $this->getParent()->getParent()->getPimonly_name_suffixe()." ";

   		 } catch (\Exception $e) {
            //
         }

   		
		//Shortname
    	if(strlen($this->getShort_name())>0) {
    		

    		$str = $this->getShort_name();
    		$str =trim($str);

    		if(strlen($this->getPimonly_name_suffixe())>0) {
    			$str .=" ".$parentParentSuffixe.$parentSuffixe.$this->getPimonly_name_suffixe();
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
    			$str .=" ".$parentParentSuffixe.$parentSuffixe.$this->getPimonly_name_suffixe();
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
				$url="";
				foreach ($associatedDocuments as $document) {
					if($document instanceof Asset_Image) 
						$url = $document->getThumbnail("magento_origine")->getPath();						
				}

				$str.= '<div class="nsg_fullbkgimg col-md-8 col-md-offset-2 col-xs-12 col-xs-offset-2" data-img="'.$url.'">
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


	public function getMage_meta_title() {

		$inheritance = Object_Abstract::doGetInheritedValues(); 
   		 Object_Abstract::setGetInheritedValues(true); 
   		 $meta = "La Parqueterie Nouvelle";
   		 if($this->meta_title && strlen($this->meta_title)>0 && $this->meta_title!="La Parqueterie Nouvelle") {
			 $meta = $this->meta_title;
   		 }
		 else {

		 	 $meta = $this->getMage_short_name();
		 	 
		 	 if(strlen($meta)<45 && strlen(trim($this->getSubtype2()))>0)
		 	 	$meta .= " - ". ucfirst(trim($this->getSubtype2()));
		 	 
		 	 if(strlen($meta)<35)
		 	 	$meta .= ", ". ucfirst(trim($this->getSubtype()));
		 	 
		 	 if(strlen($meta)<29)
		 	 	$meta .= " - La Parqueterie Nouvelle";
		 }

   		 Object_Abstract::setGetInheritedValues($inheritance); 
   		 return $meta;
   	}


   	public function getMage_meta_description() {

		$inheritance = Object_Abstract::doGetInheritedValues(); 
   		 Object_Abstract::setGetInheritedValues(true); 
   		 $meta = "La Parqueterie Nouvelle";
   		 if($this->meta_description && strlen($this->meta_description)>0 && $this->meta_description!="La Parqueterie Nouvelle - Magasin de Parquet et Terrasses") {
			 $meta = $this->meta_description;
   		 }
		 else {;
		 	
		 	 $meta = $this->getMage_short_name();
		 	 $meta = $this->getSubtype().", ".$this->getSubtype2().", ".$meta;
		 	 $meta .= " - ".$this->getShort_description();
		 	 $meta .= " La Parqueterie Nouvelle";
		 	 
		 	 
		 	 
		 }

   		 Object_Abstract::setGetInheritedValues($inheritance); 
   		 return $meta;
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
    	if($this->getImage_1()) {
    		/*
    		$fsPath = $this->getImage_1()->getThumbnail("magento_small")->getFileSystemPath(true);
        	$path = "http://".$_SERVER["HTTP_HOST"].urlencode_ignore_slash(str_replace(PIMCORE_DOCUMENT_ROOT, "", $fsPath));
			*/

        	/* VERSION CLOUD */
        	$path = 'http:'.$this->getImage_1()->getThumbnail("magento_small")->getPath();

        	return $path;
    	}
    	

	}

	
	public function getImage_2_src() {
		// get an asset
    	//$asset = Asset::getById($this->getImage_1()->id);
    	//if($this->getImage_2())
    	if($this->getImage_2()) {
    		/*
    		$fsPath = $this->getImage_2()->getThumbnail("magento_small")->getFileSystemPath(true);
        	$path = "http://".$_SERVER["HTTP_HOST"].urlencode_ignore_slash(str_replace(PIMCORE_DOCUMENT_ROOT, "", $fsPath));
			*/


        	/* VERSION CLOUD */
        	$path = 'http:'.$this->getImage_2()->getThumbnail("magento_small")->getPath();

        	return $path;
    	}

	}

	
	public function getImage_3_src() {
		// get an asset
    	//$asset = Asset::getById($this->getImage_1()->id);
    	if($this->getImage_3()) {
    		/*$fsPath = $this->getImage_3()->getThumbnail("magento_small")->getFileSystemPath(true);
        	$path = "http://".$_SERVER["HTTP_HOST"].urlencode_ignore_slash(str_replace(PIMCORE_DOCUMENT_ROOT, "", $fsPath));
			¨/
        	/* VERSION CLOUD */
        	$path = 'http:'.$this->getImage_3()->getThumbnail("magento_small")->getPath();

        	return $path;
    	}

	}

	public function getTeintePath() {
		if(!$this->_teintePath) {
			$teintesName=[];
			$objects = $this->getPimonly_teinte_rel();
			if(is_array($objects)) {
				foreach ($objects as $object) {
					if($object instanceof Object_Teinte && $object->getName()!="Teintes") {
			   			$teintesName[] = $object->getName();
			   			$parentObject = $object->getParent();
			   			if($parentObject && $parentObject instanceof Object_Teinte  && $parentObject->getName()!="Teintes") {
			   				$teintesName[] = $parentObject->getName();

			   				$parentParentObject = $parentObject->getParent();
				   			if($parentParentObject && $parentParentObject instanceof Object_Teinte && strlen($parentParentObject->getName())>0  && $parentParentObject->getName()!="Teintes") {
				   				$teintesName[] = $parentParentObject->getName();

				   				$parentParentParentObject = $parentParentObject->getParent();
					   			if($parentParentParentObject && $parentParentParentObject instanceof Object_Teinte && strlen($parentParentParentObject->getName())>0  && $parentParentParentObject->getName()!="Teintes") {
					   				$teintesName[] = $parentParentParentObject->getName();
					   			}

				   			}


			   			}

			   		}
				}
			}
		

			/*

			$teintes = $this->getRelated("pimonly_teinte_rel",false,true);
			if(is_array($teintes)) {
				foreach ($teintes as $teinte) { 
					$teintesName[] = $product->getName();
					
					# code...
				};
			}*/
			$this->_teintesName = array_reverse($teintesName);
		}
		return $this->_teintesName;

	}


	public function getMage_teinte() {
		$teinte = $this->getTeinteObject();
		return $teinte ? $teinte->getName():"";

	}

	public function getTeinteObject() {
		$objects = $this->getPimonly_teinte_rel();
		if(is_array($objects)) {
			foreach ($objects as $object) {
				if($object instanceof Object_Teinte) {
		   			return $object;
		   		}
		   	}
		}
		return null;
	}

	public function getSimilarTeinteProducts($excludeMe=false) {
		$teinte = $this->getTeinteObject();
		$products = array();
		if($teinte) {
			return $teinte->getSimilarTeinteProducts($this);
		}
		return $products;
	}


	public function getMage_teinte_level0() {
		$arr = $this->getTeintePath();
		array_splice($arr, 1);
		return implode(" > ",$arr);
		
	}

	public function getMage_teinte_level1() {
		$arr = $this->getTeintePath();
		array_splice($arr, 2);
		return implode(" > ",$arr);
		
	}

	public function getMage_teinte_level2() {
		$arr = $this->getTeintePath();
		array_splice($arr, 3);
		return implode(" > ",$arr);
		
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
        if(strpos($value," ou ")>0 && strlen($suffix)>0) {
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
		$varationString="";
			

		
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

			if(count($childsDimension)==2) {
				$varationString= self::getFormatedDimension(implode(" ou ",$childsDimension),$prefix,$suffix,false);
			}
			else if(count($childsDimension)>0) {
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

		if(strlen($value=$this->getEpaisseur_txt())>0) {
			$varationString[]=$value;
		}
		elseif(strlen($value=$this->getSingleDimentionString("epaisseur","Ep"))>0) {
			$varationString[]=$value;
		}
		
		if(strlen($value=$this->getLargeur_txt())>0) {
			$varationString[]=$value;
		}
		elseif(strlen($value=$this->getSingleDimentionString("largeur","l"))>0) {
			$varationString[]=$value;
		}
		
		if(strlen($value=$this->getLongueur_txt())>0) {
			$varationString[]=$value;
		}
		elseif(strlen($value=$this->getSingleDimentionString("longueur","L"))>0) {
			$varationString[]=$value;
		}

		if(strlen($value=$this->getSingleDimentionString("volume","Vol.","L",false))>0) {
			$varationString[]=$value;
		}

		

		if($this->getHauteur())
			$varationString[]=$this->getHauteur();

		if($this->getConditionnement())
			$varationString[]=$this->getConditionnement();
		
		return count($varationString)>0?implode($varationString,", "):"";
	}

	public function getDimensionsStringExtended() {
		$childrens = $this->getChilds();
		$varationString =array();
		
		if(strlen($value=$this->getEpaisseur_txt())>0) {
			$varationString[]=$value;
		}
		else if(strlen($value=$this->getSingleDimentionString("epaisseur","Epaisseur"))>0) {
			$varationString[]=$value;
		}
		
		if(strlen($value=$this->getLargeur_txt())>0) {
			$varationString[]=$value;
		}
		elseif(strlen($value=$this->getSingleDimentionString("largeur","Largeur"))>0) {
			$varationString[]=$value;
		}
		
		if(strlen($value=$this->getLongueur_txt())>0) {
			$varationString[]=$value;
		}
		elseif(strlen($value=$this->getSingleDimentionString("longueur","Longueur"))>0) {
			$varationString[]=$value;
		}

		if(strlen($value=$this->getSingleDimentionString("volume","Volume","l",false))>0) {
			$varationString[]=$value;
		}

		

		if($this->getHauteur())
			$varationString[]=$this->getHauteur();

		if($this->getConditionnement())
			$varationString[]=$this->getConditionnement();
		
		return count($varationString)>0?implode("<br />",$varationString):"";
	}


	public function getDimensionsStringEtiquette() {
		$varationString =array();
		
		if(strlen($value=$this->getEpaisseur_txt())>0) {
			$varationString[]=$value;
		}
		elseif(round($this->getEpaisseur())>0)
			$varationString[]="".round($this->getEpaisseur())."";
		
		if(strlen($value=$this->getLargeur_txt())>0) {
			$varationString[]=$value;
		}
		elseif(round($this->getLargeur())>0)
			$varationString[]="".round($this->getLargeur())."";


		if(strlen($value=$this->getLongueur_txt())>0) {
			$varationString[]=$value;
		}
		elseif(round($this->getLongueur())>0) 
			$varationString[]= "".round($this->getLongueur())."";


		if($this->getVolume())
			$varationString[]=$this->getVolume()."L";

		if($this->getHauteur())
			$varationString[]=$this->getHauteur();

		if($this->getConditionnement())
			$varationString[]=$this->getConditionnement();
		
		return count($varationString)>0?implode($varationString,"/"):"";
	}

	public function getPimonly_dimensions() {
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
		
		return count($varationString)>0?implode($varationString,"x"):"";
	}

	public function getPimonly_section() {
		$varationString =array();
		if(round($this->getEpaisseur())>0)
			$varationString[]="".round($this->getEpaisseur())."";
		
		if(round($this->getLargeur())>0)
			$varationString[]="".round($this->getLargeur())."";
		
		return count($varationString)>0?implode($varationString,"x").'mm':"";
	}

	public function getMage_section() {
		$inheritance = Object_Abstract::doGetInheritedValues(); 
   		Object_Abstract::setGetInheritedValues(true); 
   		$str = "";
		if($this->getMage_use_section_as_configurable()) {
			return $this->getPimonly_section();
		}
		Object_Abstract::setGetInheritedValues($inheritance); 

		return $str;
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

	//Retourn le premier produit dont l'asset est depdenat
	private function _getProductFromAsset($asset) {
		//echo $asset->getId().'/';

		//Ca marche,mais en fait prendre le produit courant marche bien ..
		//Commenter la ligne ci dessous pour avec un prodiot référencé dans l'asset ou les dépenances
		//A voir si c'est onction en full, on ne la met pas dans la classe Website_Asset, ou dans un helper
		return $this;


		if($asset instanceof Asset) {

			//D'abord on regarde si un produit n'st pas associé comme medtata
			$product = $asset->getProperty("product");
 			if(!$product) {
                $ean = $asset->getMetadata("product");

                 $list = Object_Product::getList(array(
	                'limit' => 1,
	                'condition' => 'ean = \''.$ean.'\''
	      			));

                $product = $list->current();
                if(!$product) {
                    $list = Object_Product::getList(array(
	                'limit' => 1,
	                'condition' => 'code = \''.$ean.'\''
	      			));
	      			$product = $list->current();
                }
            }
            if($product) {
            	return $product;
            }

            //A partie de la on regarde dans les dépendances

			$dependencies = $asset->getDependencies()->getRequiredBy();


			//echo count($dependencies);

			//si âs de depdance, on prend le folter au dessus
		

			if(count($dependencies)) {

				foreach ($dependencies as $dependencie) {
					//print_r($dependencie);



					if(is_array($dependencie) && count($dependencie)>0 && is_array($dependencie[0])) {


						$product = Object_Abstract::getById($dependencie[0]['id']);
						if($product instanceof Object_Product)
							return $product;
						
					}
					else if(is_array($dependencie) && count($dependencie)>0 && $dependencie['type']  == 'object') {
				

						$product = Object_Abstract::getById($dependencie['id']);
						if($product instanceof Object_Product)
							return $product;
						
					}
					else if(is_int($dependencie)) {
			
						$product = Object_Abstract::getById($dependencie);
						if($product instanceof Object_Product && $product->getId()>0)
							return $product;
					}
				}
			}
			//OK, pas de depenance, on regarde le folder du dessus
			if(($folder = Asset::getById($asset->getParentId())) instanceof Asset_Folder) {
				return $this->_getProductFromAsset($folder);
			}

		}
		//die;
		return;

	}

	public function getSku($product=false) {
		if(!$product)
			$product = $this;

		if(strlen($product->getEan())>0)
			return $product->getEan();
		else
			return $product->getCode();
	}

	public function getMage_realisationsJson($includeProductImage=false,$includeProductName=false,$includeProductThumb=false) {
		$inheritance = Object_Abstract::doGetInheritedValues(); 
   		 Object_Abstract::setGetInheritedValues(true); 

		$return = array();

		$realisations =$this->getRealisations();

		//print_r( $realisations);
		$count=count($realisations);
		$assetsArray=array();

		$i=0;
		if($includeProductImage) {
			
		
			if($this->getImage_1()) {
				
				if($product) {
					$return[] = $product->getName();
				}

				$urlImage = $this->getImage_1()->getThumbnail("magento_realisation")->getPath();

				$returnArray  = (object) array("base"=>$urlImage,"images"=>array($urlImage));

				if($includeProductThumb) {
					$urlImage = $this->getImage_1()->getThumbnail("galleryThumbnail")->getPath();
					$returnArray->thumb = array($urlImage);
				}

				if($includeProductName) {
					$returnArray->name = $this->getName();
					$returnArray->sku = $this->getSku();
				}

				$return[] = $returnArray;

    			/*$assetsArray[] = array (
    				$this->getImage_1()->getThumbnail("magento_realisation")->getPath() => $this->getImage_1());*/
    			$i++;
			}
		}
		if($includeProductImage) {
			
			if($this->getImage_2()) {
				$urlImage = $this->getImage_2()->getThumbnail("magento_realisation")->getPath();
				$return[count($return)-1]->images[] = $urlImage;
				
				if($includeProductThumb) {
					$urlImage = $this->getImage_2()->getThumbnail("galleryThumbnail")->getPath();
					$return[count($return)-1]->thumb[] = $urlImage;
				}
			}
		}
		if($includeProductImage) {
			if($this->getImage_3()) {
				$urlImage = $this->getImage_3()->getThumbnail("magento_realisation")->getPath();
				$return[count($return)-1]->images[] = $urlImage;

				if($includeProductThumb) {
					$urlImage = $this->getImage_3()->getThumbnail("galleryThumbnail")->getPath();
					$return[count($return)-1]->thumb[] = $urlImage;
				}


    			/*$assetsArray[] = array (
    				$this->getImage_3()->getThumbnail("magento_realisation")->getPath() => $this->getImage_3());
    			$i++;*/
			}
		}



		/*for ($i=$i; $i < $count; $i++) { 
				$assets=Asset_Folder::getById($realisations[$i]->id)->getChilds();
				$assetsArray[$i]=array();
				foreach ($assets as $asset) {
					if($asset instanceof Asset_Image) {
						$assetsArray[$i][$asset->getThumbnail("magento_realisation")->getPath()] = $asset;
					}
				}
		}*/

		


		//$count=count($assetsArray);
		if($count>0) {
			
			for ($i=0; $i < $count; $i++) { 
				$assets=Asset_Folder::getById($realisations[$i]->id)->getChilds();
				 $arrayImages = array();
				 $arrayThumbs = array();

				 if(count($assets)>0 && $assets[0] instanceof Asset_Image) {
				 
				 	$urlImage = $assets[0]->getThumbnail("magento_realisation")->getPath();
				 
				 	foreach ($assets as $asset) {
				 		if($asset instanceof Asset_Image) {
				    		$arrayImages[] = $asset->getThumbnail("magento_realisation")->getPath();
				    		
				    		if($includeProductThumb) {
				    			$arrayThumbs[] = $asset->getThumbnail("galleryThumbnail")->getPath();
				    		}
				    	}
				    }
				    
				    $returnArray  = (object) array("base"=>$urlImage,"images"=>$arrayImages);

				    if($includeProductThumb) {
				
						$returnArray->thumb = $arrayThumbs;
					}

					if($includeProductName) {
						//echo $assets[0]->getId()."/";

						$product = $this->_getProductFromAsset($assets[0]);
						$returnArray->name = $product?$product->getName():"";
						$returnArray->sku = $product?$product->getSku():"";
					}

					$return[] = $returnArray;


				 }
				 
				
			    

			}
			
		}
		Object_Abstract::setGetInheritedValues($inheritance); 
		return Zend_Json::encode($return);
	}

	public function getMage_mediagallery() {
		$inheritance = Object_Abstract::doGetInheritedValues(); 
   		 Object_Abstract::setGetInheritedValues(true); 

		$return = array();

		$galleryImages =$this->getGallery();

		if(is_array($galleryImages)) {
			foreach($galleryImages as $element) {
			if($element instanceof Asset_Folder) {
				$assets=Asset_Folder::getById($element->id)->getChilds();
				$assetsArray[$i]=array();
				foreach ($assets as $asset) {
					if($asset instanceof Asset_Image) {
						/* VERSION DRECT 
						$fsPath = $asset->getThumbnail("magento_realisation")->getFileSystemPath(true);
        				$path = "http://".$_SERVER["HTTP_HOST"].urlencode_ignore_slash(str_replace(PIMCORE_DOCUMENT_ROOT, "", $fsPath));
						*/
        				/* VERSION CLOUD */
        				$path = 'http:'.$asset->getThumbnail("magento_realisation")->getPath();

						$return[] = $path."::realisation";
					}
				}
			}
			elseif($element instanceof Asset_Image) {
				//VERSION ABSOLUE
				/*$fsPath = $element->getThumbnail("magento_realisation")->getFileSystemPath(true);
        		$path = "http://".$_SERVER["HTTP_HOST"].urlencode_ignore_slash(str_replace(PIMCORE_DOCUMENT_ROOT, "", $fsPath));
						$return[] = $path."::realisation";
						*/
				/* VERSION CLOUD */
				$path = 'http:'.$element->getThumbnail("magento_realisation")->getPath();
				$return[] = $path."::realisation";
			}
		}

		Object_Abstract::setGetInheritedValues($inheritance); 
		return implode(";",$return);

		}
		return "";
		

	}




	public function getMage_realisations() {
		//On en a plus besoin !!
		return "";

		$inheritance = Object_Abstract::doGetInheritedValues(); 
   		 Object_Abstract::setGetInheritedValues(true); 

		$str="";
		$realisations =$this->getRealisations();

		//print_r( $realisations);
		$count=count($realisations);
		$assetsArray=array();
		for ($i=0; $i < $count; $i++) { 
				$assets=Asset_Folder::getById($realisations[$i]->id)->getChilds();
				$assetsArray[$i]=array();
				foreach ($assets as $asset) {
					if($asset instanceof Asset_Image) {
						$assetsArray[$i][$asset->getThumbnail("magento_realisation")->getPath()] = $asset;
					}
				}
		}

		//$count=count($assetsArray);
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
			for ($i=0; $i < $count; $i++) { 

				 $arrayImages = array();
				   
			    foreach ($assetsArray[$i] as $asset) {
			    	if($asset instanceof Asset_Image) 
			    		$arrayImages[] = $asset->getThumbnail("magento_realisation")->getPath();
			    }

			    if($asset instanceof Asset_Image) 
					$urlImage = $asset->getThumbnail("magento_realisation")->getPath();

				if(count($arrayImages)>0) {
					$zooms = array_merge(array($urlImage),$arrayImages);
				    $datazoom = implode("|",$zooms);
				}
				else
				    $datazoom = $urlImage;

				if($asset instanceof Asset_Image)  {
					$str .= '<li data-zoom="'.$datazoom.'" class="'.($index==0?'norelazy':'').'">
								<div class="nsg_container">
									<div><img src="'.$asset->getThumbnail("magento_realisation")->getPath().'" class="'.($index==0?'norelazy':'').'"ain.></div>
			                		<div class="nsg_abs">';
			        /*$str .= '<!--<div class="realisationpicto">Nos r&eacute;alisations</div>
										<div class="realisationtitle">'.$this->getMage_short_name().'</div>
										<div class="realisationcontent">'.$this->getName().'</div>-->
										<div class="realisationtitle"></div>
										<div class="realisationcontent"></div>
									</div>';*/
			                    
			           $str .= '      	</div>
			           			</div>
		            		</li>';
		            }
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


	public function getRelated($field,$onlyId=false,$removeCategoryProduct=false) {
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
						else if($object->getClassName()=="category" && !$removeCategoryProduct) {
							$products = $object->getProducts();
							if(is_array($products)) {
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

		$objects = $this->getAccessoirepopin();
		if(is_array($objects)) {
			foreach ($objects as $object) {
				if($object instanceof Object_Category) {
		   			$skus[] = 'cat'.$object->getMage_category_id();
		   		}
			}
		}
		

		

		$products = $this->getRelated("accessoirepopin",false,true);
		if(is_array($products)) {
			foreach ($products as $product) { 
				if(strlen($product->getEan())>0)
					$skus[] = $product->getEan();
				else
					$skus[] = $product->getCode();
				# code...
			};
		}
		
		return implode(",",$skus);
	}


}

// and optionally a related list

class Website_Product_list extends Object_Product_List {

    
}
?>