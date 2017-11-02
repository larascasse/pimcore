<?php

// define a custom class,  for example:
class Website_Product extends Object_Product {

	private $_teintePath;
	private $_choixString;
	/**
     * Dummy which can be overwritten by a parent class, this is a hook executed in every getter of the properties in the object
     * @param string $key
     */
    public function _____preGetValue ($key) {

   		
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



    private function getTaxonomyObject($field,$value=null,$path=null) {

    	$getter = "get" . ucfirst($field);
    	
    	//Si pas de value en paramlettre, on prend la value de l'objet
    	if(!isset($value)) {
    		if(empty($this) || !method_exists($this, $getter)) {
	    		return null;
	    	}
	    	$value  = $this->$getter();
    	}
    	
    	

    	if(!$path) {
    		$path = '/'.$field.'/'.strtolower($value);
    	}
    	$data = Object_Abstract::getByPath($path);

		if(!($data instanceof Object_Taxonomy)) {
			$datas = Object_Taxonomy::getByCode($value);
			foreach ($datas as $datatmp) {
			    // do something with the cities
			    $data = $datatmp;
			    break;
			}
		}

		if(!($data instanceof Object_Taxonomy)) {
			$data = new Object\Taxonomy();
			$data->setLabel($value);
			$data->setDescription('');

		}

		return $data;

    }

    public function getSelfAndChildrenTaxonomyObjects($field) {
    	$excludefiled = $field."_not_configurable";
		//if(isset($this->$excludefiled) && $this->$excludefiled)
		//	return;
		
		$getter = "get" . ucfirst($field);


		if(property_exists('Website_Product',$field)) {
			$value = $this->$field;
		}
		else {
			  $def = $this->getClass()->getFieldDefinition($field);
			
			 
			  if($def->fieldtype == 'calculatedValue') {
			 	 
					if(!empty($this) && method_exists($this, $getter)) {
						$value = $this->$getter();
					}
			  }
			  

			
		}

		
		$taxonomies = array();
			

		//On prend la valeur
		if(isset($value) && strlen($value)>0) {
			//if($field="volume")
				//self::getFormatedDimension($value,$prefix,$suffix,$rounded);
			$taxonomies[$this->getTaxonomyObject($field)->getLabel()]=$this->getTaxonomyObject($field);

			//if($field=="volume")
			//	echo self::getFormatedDimension($value,$prefix,$suffix,$rounded);;
		}
		else if(!empty($this) && method_exists($this, $getter) && strlen($value = $this->getValueFromParent($field))>0) {
			$taxonomies[$this->getTaxonomyObject($field)->getLabel()]=$this->getTaxonomyObject($field);

		
		}
		//else {
			$childrens = $this->getChilds();
			$childsDimension = array();

			foreach ($childrens as $subProduct) {
				if($subProduct instanceof Object_Folder || !$subProduct->getPublished())
					continue;

				if($subProduct->getEan()=="") {
					$subProductChildrens = $subProduct->getChilds();
					foreach ($subProductChildrens as $subsubProduct) {
						//echo get_class($subsubProduct);
						if(!($subsubProduct instanceof Website_Product)) {
							continue;
						}
						$taxoObj = $subsubProduct->getTaxonomyObject($field);
						$label = $taxoObj->getLabel();

						if(strlen($label)>0) {
							$taxonomies[$label]=$taxoObj;
						}
					}

				}
				else {
						if(!($subProduct instanceof Website_Product)) {
							continue;
						}
						$taxoObj = $subProduct->getTaxonomyObject($field);
						$label = $taxoObj->getLabel();

						if(strlen($label)>0) {
							$taxonomies[$label]=$taxoObj;
							
						}
				}
			}

			
		//}
		/*if($field=="volume") {
			print_r($childsDimension);
			echo $varationString;
		}*/
		return $taxonomies;
    }

    private function getSingleTaxonomyString($field) {

    	$taxonomies = $this->getSelfAndChildrenTaxonomyObjects($field);
		$varationString = "";
		$childsTaxonomie = array();
		foreach ($taxonomies as $label => $taxonomie) {
			$childsTaxonomie[] = $label;
		}
    	if(count($childsTaxonomie)==2) {
			$varationString= implode(" ou ",$childsTaxonomie);
		}
		else if(count($childsTaxonomie)>0) {
			$varationString= implode(" ou ",$childsTaxonomie);

		}

		return $varationString;

	}


	private function getTaxonomyDescription($field) {

    	//detail taxo
		$taxonomies = $this->getSelfAndChildrenTaxonomyObjects($field);
		if(count($taxonomies) > 0) {
			//$html='<div class="row"><div class="col">';
			$html='';
			if(count($taxonomies)>1) {
				//$html.= "<p><strong>Existe en</strong><br />";
			}
			foreach ($taxonomies as $label => $taxonomie) {
				if(strlen(trim($taxonomie->getDescription()))>0) {
					$html.= '<span class"desc-title">'.ucfirst(strtolower($taxonomie->getLabel())).'</span> : ';
					$html.= "".$taxonomie->getDescription();
				}
				else {
					$html.='<span class"desc-title">'.ucfirst(strtolower($taxonomie->getLabel())).'</span>';
				}
				
			}
			//$html='</div></div>';
			return$html;
		}

	}


	private function getTaxonomyLogoAsset($field) {

    	//detail taxo
		$taxonomies = $this->getSelfAndChildrenTaxonomyObjects($field);
		if(count($taxonomies) > 0) {
			//$html='<div class="row"><div class="col">';
			$html='';
			if(count($taxonomies)>1) {
				//$html.= "<p><strong>Existe en</strong><br />";
			}
			foreach ($taxonomies as $label => $taxonomie) {
				
				return 	$taxonomie->getLogo();

				
			}
			//$html='</div></div>';
			
		}
		return null;

	}




	/**
	* @return string
	*/
	public function getChoixString () {
		if(!$this->_choixString) {
			$this->_choixString = $this->getSingleTaxonomyString('choix');

		}
		return $this->_choixString;
	}


	public function getChoixDescription () {
		return $this->getTaxonomyDescription('choix');
		
	}

	
	/**
	* @return string
	*/
	public function getEssenceString () {
		return $this->getSingleTaxonomyString('essence');

	}

	/**
	* @return string
	*/
	public function getEssenceDescription () {
		return $this->getTaxonomyDescription('essence');

	}

	/**
	* @return string
	*/
	public function getQualiteString () {
		return $this->getSingleTaxonomyString('qualite');

	}


	public function getSupportDescription () {
		return $this->getTaxonomyDescription('support');

	}

	/**
	* @return string
	*/
	public function getClasse_utilisationString () {
		return $this->getSingleTaxonomyString('classe_utilisation');

	}
	/**
	* @return string
	*/
	public function getClasse_utilisationDescription () {
		return $this->getTaxonomyDescription('classe_utilisation');

	}
	public function getClasse_utilisationLogo () {
		return $this->getTaxonomyLogoAsset('classe_utilisation');

	}


	/* LOGO */
	public function getPefcString() {
		if($this->getPefc())
			return "Oui - Pefc - 10-31_3055";
		else
			return "";

	}
	public function getPefcLogo() {
		//$taxonomie =  Object_Taxonomy::getByKey('pefc');
		if($this->getPefc()) {
			$taxonomie =  Object::getByPath("/labels/pefc");
			return $taxonomie ->getLogo();
		}
	}


	public function getParquet_de_franceString() {
		if($this->getParquet_de_france())
			return "Oui";
		else
			return false;

	}

	public function getParquet_de_franceLogo() {
		//$taxonomie =  Object_Taxonomy::getByKey('pefc');
		if($this->getParquet_de_france()) {

			$taxonomie =  Object::getByPath("/labels/parquet_de_france");

			if($taxonomie)
				return $taxonomie ->getLogo();
		}
	}



	public function getFscString() {
		if($this->getFsc())
			return "Oui";
		else
			return false;

	}
	public function getFscLogo() {
		//$taxonomie =  Object_Taxonomy::getByKey('pefc');
		if($this->getFsc()) {
			$taxonomie =  Object::getByPath("/labels/fsc");

			if($taxonomie)
				return $taxonomie ->getLogo();
		}
	}

	public function getNfString() {
		if($this->getNf())
			return "Oui";
		else
			return false;

	}
	public function getNfLogo() {
		//$taxonomie =  Object_Taxonomy::getByKey('pefc');
		if($this->getNf()) {
			$taxonomie =  Object::getByPath("/labels/nf");
			if($taxonomie)
				return $taxonomie ->getLogo();
		}
	}



	public function getPoseDescription($pose) {
		
		$taxonomie =  Object::getByPath("/pose/pose_".$pose);
		if($taxonomie)
			return $taxonomie ->getDescription();
		
	}


	public function getPoseLogo($pose) {
		
		$taxonomie =  Object::getByPath("/pose/pose_".$pose);
		if($taxonomie)
			return $taxonomie ->getLogo();
		
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

		 
		$caracteristiques = $this->getCharacteristicsArray();

		if($isHTML) {
			//if(strtolower($catalogue)=="matieres" || strtolower($catalogue)=="matières") {
				$html ="<dl>\n";
				foreach ($caracteristiques as $key => $value) {
					if(!isset($value["label"]))
						continue;
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
				if(!isset($value["label"]))
						continue;
				$html.="- ".$value["label"]." : ".$value["content"]."\n";
			}
			$html .="";
			return $html;
		}
		  
		
	}

	public function getCharacteristicsArray() {
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


		//Liste des champs qui ne s'affichent pas, mais font on garde les logos
		//$hiddenFields = array("pose_aclouer","pose_avisser","pose_aclouer","pose_avisser");


		//CE
		$descriptionFields = array('Dimensions', 'essence','origine_bois', 'country_of_manufacture','support','epaisseurUsure','choix', 'qualite', 'traitement_surface','finition','fixation','pose','ean','characteristics_others','pefc','fsc','parquet_de_france','nf');


		//CE
		$performanceFields = array("classe_utilisation","classe_upec","classe_durete","masse_volumique","classe_reaction_feu_eu","classe_reaction_feu_fr","degagement_formaldehyde","resistance_thermique","conductivite_thermique_total","condition_mise_en_oeuvre","durabilite_biologique");

		//données tech générales
		$donnesTechGeneralesFields = array("taux_humidite","coefficient_retractabilite","classe_upec","classe_utilisation","characteristics_others_tech","characteristics_others_perf");



		//Ordre des champs
		$order = array('Dimensions', 'Support', 'Essence', 'Choix', 'Qualité', 'Traitement de surface','Finition');


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
			$caracteristiques["Dimensions"] = array("label"=>"Dimensions","key"=>"dimensions","content"=>$dimentionsStringExtended,"isDescription" => true);

		

		//$fields = array("epaisseur","longueur");
		foreach($attributes as $key=> $value) {

			$attribute  =  $value->getName();
			$attributeLabel = $value->getTitle();

			$attributeKey = $attributeLabel;
			
			if(in_array($attribute,$ignoreFields)) {
				unset($attributeValue);
				continue;
			}
			$this->getClass()->getFieldDefinition($value->getName());
			//print_r( $value->fieldtype);
			$getter = "get" . ucfirst($attribute);
			$getterString = $getter."String";
			$getterDescription = $getter."Description";
			$getterLogo = $getter."Logo";
			
			
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


					if($attribute=="characteristics_others" || $attribute=="characteristics_others_tech" || $attribute=="characteristics_others_perf") {

						$others = explode("\n",trim($attributeValue));
						$caracteristiquesOthers=array();
						if(count($others)>0) {
							$row = 0;
							$currentRowTitle = 0; // pour les ligne sans titre, on ajoute a précedement
							$contentWithoutTitle = array();

							//Pour chaque ligne du champ
							foreach ($others as $item) {


								$explode = explode(":",$item);

								////si label et valeur, on ajoute à la ligne précédement
								if(count($explode)>1) {
									if(count($caracteristiquesOthers)>0)
										$currentRowTitle++;	
									$caracteristiquesOthers[$currentRowTitle] = array("key"=>trim($explode[0]),"label"=>trim($explode[0]),"content"=>trim($explode[1]));
								}
								// si pas de label, et début, on met un label vierge
								elseif ($currentRowTitle==0) {
									if(!isset($caracteristiquesOthers[$currentRowTitle])) {
										$caracteristiquesOthers[$currentRowTitle] = array("key"=>"row".$currentRowTitle,"label"=>"","content"=>trim($item));
									}
									else {
										$caracteristiquesOthers[$currentRowTitle]["content"] .="<br />".trim($item);
									}
									

								}
								//Sinon, on ajoute à la ligne précédente
								else {
									$caracteristiquesOthers[$currentRowTitle]["content"] .="<br />".trim($item);
								}

								if($attribute=="characteristics_others") {
									$caracteristiquesOthers[$currentRowTitle]["isDescription"] = true;

								}
								else if($attribute=="characteristics_others_tech") {
									$caracteristiquesOthers[$currentRowTitle]["isDonneeTechnique"] = true;

								}
								else if($attribute=="characteristics_others_perf") {
									 $caracteristiquesOthers[$currentRowTitle]["isMarquageCe"] = true;
								}
								
									
							}
							
						}
						if(count($caracteristiquesOthers)>0) {
							foreach ($caracteristiquesOthers as $valueOther) {
								$caracteristiques[$valueOther["label"]] = $valueOther;
									//print_r($valueOther);

							}
						}


						

					}

					else if(is_array($attributeValue)) {
						if($value->fieldtype=="multiselect") {
							$display = array();
							foreach ($attributeValue as $optionSelect => $keySelect) {
								//echo($optionSelect." ".$keySelect);
								$option = Object_Service::getOptionsForSelectField($this,$attribute);
								$selectedValue = $option[$keySelect]; 
								$display[] = $selectedValue;

								//On va créer une ligne par valeur, pour avoir les logos
								//Maiqs on ne va pas les afficher !!
								$caracteristiques[$attributeKey."_".$keySelect] = array("key"=>$attribute."_".$keySelect,"label"=>$attributeLabel." - ".$selectedValue." ".$keySelect,"content"=>"Oui","is_hidden"=>false);

								if(method_exists($this, $getterLogo)) {
									$caracteristiques[$attributeKey."_".$keySelect]['logo'] = $this->$getterLogo($keySelect);
								}
								if(method_exists($this, $getterDescription)) {
									$caracteristiques[$attributeKey."_".$keySelect]['description'] = $this->$getterDescription($keySelect);
								}


							}

							$attributeValue = implode(", ",$display);
							$caracteristiques[$attributeKey] = array("key"=>$attribute,"label"=>$attributeLabel,"content"=>$attributeValue);
						}
						else {
							$attributeValue = implode(", ",$attributeValue);
							$caracteristiques[$attributeKey] = array("key"=>$attribute,"label"=>$attributeLabel,"content"=>$attributeValue);
						}
						


					}
					else if($value->fieldtype=="select") {
							$attributeValue=Object_Service::getOptionsForSelectField($this,$attribute)[$attributeValue];
							$caracteristiques[$attributeKey] = array("key"=>$attribute,"label"=>$attributeLabel,"content"=>$attributeValue);
							if(method_exists($this, $getterDescription)) {
								$caracteristiques[$attributeKey]['description'] = $this->$getterDescription();
							}
							if(method_exists($this, $getterLogo)) {
								$caracteristiques[$attributeKey]['logo'] = $this->$getterLogo();
							}
					}

					else if($value->fieldtype=="objectbricks") {
							//TODO
						continue;
					}
					
					else {
						//Documents
						if($value->fieldtype=="href"){
							$attributeValue = '<a href="'.$attributeValue.'" target="_blank">> télécharger</a>';
						}
						$caracteristiques[$attributeKey] = array("key"=>$attribute,"label"=>$attributeKey,"content"=>$attributeValue);

						if(method_exists($this, $getterDescription)) {
							$caracteristiques[$attributeKey]['description'] = $this->$getterDescription();
						}
						if(method_exists($this, $getterLogo)) {
							$caracteristiques[$attributeKey]['logo'] = $this->$getterLogo();
						}

					}
					//pour l'affichage Spécifique
					$caracteristiques[$attributeKey]["isMarquageCe"] = in_array($attribute, $performanceFields);
					$caracteristiques[$attributeKey]["isDescription"] = in_array($attribute, $descriptionFields);
					$caracteristiques[$attributeKey]["isDonneeTechnique"] = in_array($attribute, $donnesTechGeneralesFields);

					
					if(isset($caracteristiques[$attributeKey]["content"])) {
						if(in_array($caracteristiques[$attributeKey]["key"],array("weight"))) {
							$caracteristiques[$attributeKey]["content"] = number_format($caracteristiques[$attributeKey]["content"],2);
							continue;
						}
					}
					
					

					//On arrondi les chiffres à virgule
					if(isset($caracteristiques[$attributeKey]["content"]) && is_float($caracteristiques[$attributeKey]["content"])) {
						//echo $attributeKey."/".$caracteristiques[$attributeKey]["content"]."/".gettype($caracteristiques[$attributeKey]["content"])."/".round($caracteristiques[$attributeKey]["content"],2)."<br />";
						$caracteristiques[$attributeKey]["content"] = number_format($caracteristiques[$attributeKey]["content"],2);
					}

					

				} 
			}
								
		}
		$catalogue = $this->getCatalogue();
		Object_Abstract::setGetInheritedValues($inheritance); 


		//classement des caracxteriqyes
		
		$sortedCaracteristiques = array_replace(array_flip($order), $caracteristiques);

		return $sortedCaracteristiques;
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

	function getCalculatedTechnicalSheetPdfUrl() {
		return LPN_ASSET_PREFIX."/pdf/".$this->getId();
	}

	public function getMage_fichepdf() {
		if($this->getFiche_technique_lpn())
			return (\Pimcore\Tool::isFrontend()?"":LPN_ASSET_PREFIX).$this->getFiche_technique_lpn()->getFullPath();
		else
			return $this->getCalculatedTechnicalSheetPdfUrl();
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
   		 //Pas beoin pour le titre...
   		 $parentSuffixe = "";
   		 $parentParentSuffixe = "";
   		/* try {
   		 	$parentSuffixe = $this->getParent()->getPimonly_name_suffixe()." ";
			$parentParentSuffixe = $this->getParent()->getParent()->getPimonly_name_suffixe()." ";

   		 } catch (\Exception $e) {
            //
         }*/


		//Shortname
		$str = $this->getName();
		$str =trim($str);
		if(strlen($this->getPimonly_name_suffixe())>0) {
			$str .= $parentParentSuffixe.$parentSuffixe." ".$this->getPimonly_name_suffixe();
		}
		$str =trim($str);
		Object_Abstract::setGetInheritedValues($inheritance); 
		return $str;
    	

	}


	public function getMage_short_name($stringlength = 500) {

		$inheritance = Object_Abstract::doGetInheritedValues(); 
   		 Object_Abstract::setGetInheritedValues(true); 

   		 //Ajout shortanme parent et parentparent
   		 $parentSuffixe = "";
   		 $parentParentSuffixe = "";
   		 try {

   		 	if($this->getParent() instanceof Object_Product) {


   		 		$parentSuffixe = $this->getParent()->getPimonly_name_suffixe()." ";
   		 		if($this->getParent()->getParent() instanceof Object_Product) {
					$parentParentSuffixe = $this->getParent()->getParent()->getPimonly_name_suffixe()." ";
				}

   		 	}
   		 	

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
    		$str = str_replace("monolame ", "", $str);
    		$str =trim($str);

    		if(strlen($this->getPimonly_name_suffixe())>0) {
    			$str .=" ".$parentParentSuffixe.$parentSuffixe.$this->getPimonly_name_suffixe();
    		}
    		$str =trim($str);
    		$str = substr($str,0,$stringlength);
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

		 	 $meta = $this->getMage_short_name(50);
		 	 
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
	        	$value.=" ".$suffix;
	        }
        }

        if(strpos($value,"/")>0 && strlen($suffix)>0) {
        	$value.=" ".$suffix;
        }
        if(strpos($value," ou ")>0 && strlen($suffix)>0) {
        	$value.=" ".$suffix;
        }
        //echo "<br /> /--".$value."--/------";
        if(strlen($prefix)>0) {
        	$value= $prefix." : ".$value;
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
				if($subProduct instanceof Object_Folder || !$subProduct->getPublished())
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
		
		return count($varationString)>0?implode($varationString,"x").' mm':"";
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


	//Generator
/*
        http://www.pointp.fr/les-normes-et-classements-du-parquet-sol-stratifie-ou-pvc-XA933
        Les classes d’utilisation qui concernent le parquet sont à prendre en compte pour placer votre parquet dans la pièce adéquate. La norme européenne EN 685 définit des classes d’utilisation pour les revêtements de sol en fonction des zones de pose du revêtement et de l’intensité de l’usage.
    
        Dureté
        Classe A : Aulne, Epicéa, Pin sylvestre, Sapin.
        Classe B : Bouleau, Bossé, Châtaigner, Mélèze, Merisier, Noyer, Pin maritime, Sipo, Teck.
        Classe C : Acacia, Afrormosia, Charme, Chêne, Erable, Eucalyptus, Frêne, Hêtre Iroko, Makoré, Mansonia, Moabi, Movingui, Mutenye, Orme, Padouk, Zébrano.
        Classe D : Amarante, Angélique, Cabreuva, Doussié, Ebène, Ipé, Jatoba, Merbau, Wengé, Palissandre,
*/
	public function getDurete() {
		switch ($this->getEssence()) {

			case 'AUL':
			case 'EPI':
			case 'PIN':
			case 'SAP':
			case 'DGL':
				return "A";
				break;


			case 'BOU':
			case 'BOS':
			case 'CHA':
			case 'MEL':
			case 'MER':
			case 'NOY':
			case 'PIN':
			case 'SIP':
			case 'TEC':
				return "B";
				break;



			case 'CHE':
			case 'ACA':
			case 'AFR':
			case 'CHA':
			case 'ERA':
			case 'EUC':
			case 'FRE':
			case 'HET':
			case 'IRO':
			case 'MAK':
			case 'MAN':
			case 'MOA':
			case 'MOV':
			case 'MUT':
			case 'ORM':
			case 'PAD':
			case 'ZEB':
				return "C";
				break;


			case 'AMA':
			case 'ANG':
			case 'CAB':
			case 'DOU':
			case 'EPE':
			case 'IPE':
			case 'JAT':
			case 'MER':
			case 'WEN':
			case 'PAL':
				return "B";
				break;
			
			default:
				"";
				break;
		}
	}

  /*
        http://www.pointp.fr/les-normes-et-classements-du-parquet-sol-stratifie-ou-pvc-XA933
        Les classes d’utilisation qui concernent le parquet sont à prendre en compte pour placer votre parquet dans la pièce adéquate. La norme européenne EN 685 définit des classes d’utilisation pour les revêtements de sol en fonction des zones de pose du revêtement et de l’intensité de l’usage.
    
        Dureté
        Classe A : Aulne, Epicéa, Pin sylvestre, Sapin.
        Classe B : Bouleau, Bossé, Châtaigner, Mélèze, Merisier, Noyer, Pin maritime, Sipo, Teck.
        Classe C : Acacia, Afrormosia, Charme, Chêne, Erable, Eucalyptus, Frêne, Hêtre Iroko, Makoré, Mansonia, Moabi, Movingui, Mutenye, Orme, Padouk, Zébrano.
        Classe D : Amarante, Angélique, Cabreuva, Doussié, Ebène, Ipé, Jatoba, Merbau, Wengé, Palissandre,


Classe de dureté des essences   Epaisseur de la couche d’usure
    2,5 mm – 3,2 mm         3,2 mm – 4,5 mm         4,5 mm – 7mm        > 7 mm
A   21                      21                      22                  22
B   21                      22                      23                  31
C   23                      31                      33                  34
D   31                      33                      34                  41

21 : Usage domestique modéré. Zones de passage faible ou intermittent. 
Ex : Chambres et couloirs d’habitation sans accès sur l’extérieur.

22 : Usage domestique général. Zones de passage moyen.
 Ex : Séjours et hall d’entrée d’appartement sans accès vers l’extérieur.

23 : Usage domestique élevé. Zones de passage intense.
 Ex : Pièces avec accès vers l’extérieur ou avec usage professionnel.

31 : Usage commercial modéré. Zones de passage faible ou intermittent.
 Ex : Bureaux individuels, chambres d’hôtels.

32 : Usage commercial général. Zones de passage moyen. 
Ex : Bibliothèque, lieux de culte, boutique à l'étage ou sans accès vers l’extérieur, salles de conférences.

33 : Usage commercial élevé. Zones de passage intense. 
Ex : Salles d'attente d'aéroport, boutiques avec accès direct sur l'extérieur, discothèque hors piste de danse, amphithéâtre, escaliers.

34 : Usage commercial très élevé. Zones de passage très intense. 
Ex : Salles polyvalentes, restaurants d'entreprise, aérogares, salles de classe avec accès direct vers l’extérieur.

41 : Usage industriel modéré. Zones où le travail est essentiellement sédentaire avec utilisation occasionnelle de véhicules légers.  Ex : ateliers d’usine.
*/
	
	public function getCoucheUsure() {
		return  (float)$this->getEpaisseurUsure();
	}

	public function getCalculatedClasseUtilisation() {
		 
        $classes = [
            "A" => ["21","21","21","22","22"],
            "B" => ["21","21","22","23","31"],
            "C" => ["21","23","31","33","34"],
            "D" => ["31","31","33","34","41"],
        ];
      

            $durete = $this->getDurete();

   
            //Si contrecollé
            if($this->isParquetContrecolle())
           	 	$coucheUsure = (float)$this->getEpaisseurUsure();
            //si massif
           	else 
           	 	$coucheUsure = (int)$this->getEpaisseur();




           	if($coucheUsure>0) {
           		 if($coucheUsure<=2.5)
	                $index = 0;
           		else if($coucheUsure<3.2)
	                $index = 1;
	            else if($coucheUsure<4.5)
	                $index = 2;
	            else if($coucheUsure<7)
	                $index = 3;
	            else if($coucheUsure>=7)
	                $index = 4;
	             
	             //return "KKK".$index." ".$coucheUsure;

	            if(isset($classes[$durete]) && isset($classes[$durete][$index]))
	                return $classes[$durete][$index];
	            
	           	}
           	return "";
           
                

        
	}


/* UPEC 
         Classe d'usage         Classement UPEC
21  U₂P₂
22  U₂sP₂
23  U2sP₃
31  U₃P₂
32  U₃P₃
33  U₃₅P₃
*/
	
	public function getClasseUpec() {
		$cu = $this->getCalculatedClasseUtilisation();

		

		$UP = "";
		switch ($cu) {
			case '21':
				# code...
				$UP =  "U₂P₂";
				break;
			case '22':
				# code...
				$UP =  "U₂sP₂";
				break;
			case '23':
				# code...
				$UP =  "U₂sP₃";
				break;
			case '31':
				# code...
				$UP =  "U₃P₂";
				break;
			case '32':
				# code...
				$UP =  "U₃P₃";
				break;
			case '33':
				# code...
				$UP =  "U₃sP₃";
				break;
			
			default:
				# code...
				break;
		}

		if(strlen($UP)>0) {
			$pieceHumide = $this->getPieceHumide();
			if($pieceHumide)
				$UP .="E₂C₁";
			else
				$UP .="E₁C₁";
		}
		return $UP;

	}

/*
RESISTANCE THERMIQUE
https://www.tropical-woods.fr/catalogue/content/coefficient-de-resistance-thermique-d-un-parquet.html
La résistance thermique dépend de la conductivité thermique (X) de l’essence utilisée et de l’épaisseur du parquet ou
de chaque couche du parquet dans le cas d’un parquet contrecollé. Elle s’exprime par la formule suivante

R =
avec
R (en m . °K / W) : résistance thermique du parquet
e (en m) : épaisseur de chaque couche du parquet
X (en W / m °K) : coefficient de conductivité thermique de l’essence utilisée
Le coefficient X a les valeurs suivantes
— X = 0,29 pour les feuillus de densité supérieure à 0,8
— X = 0,23 pour les feuillus de densité comprise entre 0,6 et 0,8
— X 0,1 5 pour les feuillus et les résineux de densité comprise entre 0,45 et 0,60
— X = 0,12 pour les feuillus et les résineux de densité comprise entre 0,3 et 0,45.
• Calcul pour un parquet mosaique en chêne de 8 mm d’épaisseur:
R = 0,008/0,23 = 0,035 m . °K / W
o Calcul pour un parquet contrecollé avec un parement en chêne de 3 mm et une sous-couche en résineux léger de 8 mm:
R = 0,003/0,23 + 0,008/0,12 = 0,01 3 + 0,067 = 0,08 m . °K / W
*/

	public static function getConductiviteThermiqueByEssence($essence) {

/*
. Cette correspondance entre masse volumique et capacités isolantes a été établie en termes normatifs, dans le texte NF EN 14342, comme suit :
Conductivité thermique du bois (λ en w / m. K)
ρ = 300 kg/m3 => λ = 0,09
ρ = 500 kg/m3 => λ = 0,13
ρ = 700 kg/m3 => λ = 0,17
ρ = 1000 kg/m3 => λ = 0,24
*/
		$coeffCt = -1;
		switch ($essence) {
			case 'CHE':
				$coeffCt = 0.16;
				break;

			//HDF 0,7<>0,18
			case 'HDF':
				$coeffCt = 0.15;
				break;
			//pin : 0.36
			//Aglo : 0.15
			//
		}
		return $coeffCt;
	}

	public function getResistanceThermique() {
		$coeffCt = self::getConductiviteThermiqueByEssence($this->getEssence());

		//conductivie thermqie : ) W/mK ;
		

		$epaisseur = $this->getEpaisseur();
		if($epaisseur>0 && $coeffCt>0) {
			if($this->isParquetMassif()) {
			//Dans les deux cas, la résistance thermique du parquet est inférieure à la valeur maximale de 0,1 5 m °K / W exigée par les DTU.
				return ((int)$epaisseur/1000)/$coeffCt;
			}
			else {
				
				$coeffCtSupport = self::getConductiviteThermiqueByEssence('HDF');

				$ctSupport = (($epaisseur -(float)$this->getEpaisseurUsure()) / 1000)/$coeffCtSupport;
				$coeffTotal = ((float)$this->getEpaisseurUsure()/1000)/$coeffCt + $ctSupport;
				return $coeffTotal;
			}
			
		}
		return "Non applicable";
	}

	public function getConductiviteThermiqueTotal() {
		$rT = $this->getResistanceThermique();

		if($rT>0) {
			return  ((int)$this->getEpaisseur()/1000)/$rT;
		}
		return $this->getResistanceThermique();
	}

/*
Les masses volumiques moyennes des contreplaqués sont :

450 kg/m3 pour un 100% Peuplier
500 kg/m3 pour un 100% Okoumé
600 kg/m3 pour un 100% Pin Maritime

*/


	public function getMasseVolumique() {
		if($this->getPimonly_masse_volumique_moyenne()>0) {
			return $this->getPimonly_masse_volumique_moyenne();
		}
		if($this->isParquetContrecolle()) {
			$support = $this->getSupport();
			$essence = $this->getEssence();
			$coucheUsure = (float)$this->getEpaisseurUsure();
			if($essence == "CHE") {
				switch ($support) {
					case 'HDF':
						return 850;
						break;

					case 'cp':
						return 780;
						break;
					
					default:
						return $support;
						break;
				}
			}
		}
		else if($this->isParquetMassif()) {
			$essence = $this->getEssence();
			/* http://biomee.canalblog.com/archives/2008/01/25/7698209.html */
			switch ($essence) {
				case 'CHE':
				case 'FRE':
					return 680;
					break;

				case 'HET':
					return 680;
					break;
				case 'EPI':
				case 'SAP':
					return 460;
					break;
				case 'PIN':
					return 450;
					break;
				case 'AUL':
					return 530;
					break;
				case 'CHA':
					return 620;
					break;
				case 'ACA':
					return 660;
					break;
				case 'PEU':
				case 'BOU':
					return 660;
					break;
				case 'MEL':
					return 580;
				
					break;
				case 'BAM':
					return 680;
					break;

				case 'MER':
					return 830;
					break;

				default:
					# code...
					break;
			}

		}
		return "todo masse vol";
	}


	public function getClasseReactionFeuEu() {
		/*
		C  s1 / M3 pour 19 mm
D  s1 / M4 pour 10 & 14 mm.

//
OU
http://www.parquetfrancais.org/guide-pro/technique-reglementation/reglementation/classement-conventionnel-des-parquets-et-planchers-massifs/


*/
		$massif = $this->isParquetMassif();
		$contreciolle = $this->isParquetContrecolle();
		$masseVolumique = (int)$this->getMasseVolumique();
		$epaisseur = $this->getEpaisseur();
		$coucheUsure = (float)$this->getEpaisseurUsure();

		$lameDAir = $this->poseCloueeEnabled() || $this->poseFlottanteEnabled();
		$sansLameDAir = $this->poseColleeEnabled() || $this->poseColleeAuCordonEnabled();

		//TODO
		$result=array();

		//POSE CLOUE OU FLOTTANTE
		if($lameDAir) {
			$m = "";
			
			if($massif && $masseVolumique >= 650 && $epaisseur>=14) 
				$m = "M3";
			else if($massif && $masseVolumique >= 450 && $epaisseur>=20) 
				$m = "M3";
			else if($contreciolle && $masseVolumique >= 650 && $epaisseur>=14 && $coucheUsure>=5) 
				$m = "M3";
			else
				$m = "M4";

			if(strlen($m)>0)
				$result["Avec lame d'air"] = $m;

		}

		//POSE COLLEE
		if($sansLameDAir) {
			$m = "";
			if($massif && $masseVolumique >= 650 && $epaisseur>=8) 
				$m = "M3";
			else if($contreciolle && $masseVolumique >= 650 && $epaisseur>=10 && $coucheUsure>=5) 
				$m = "M3";
			else if($contreciolle && $masseVolumique >= 500 && $epaisseur>=8) 
				$m = "M4";
			else
				$m = "";

			if(strlen($m)>0)
				$result["Sans lame d'air"] = $m;
		}

		$str = "";
		if(isset($result["Sans lame d'air"])) {
			$str .= $result["Sans lame d'air"]." en pose collée";
		}

		if(isset($result["Avec lame d'air"]) && $this->poseCloueeEnabled()) {
			$str .= strlen($str)>0?" et ":"";
			
			if((isset($result["Sans lame d'air"]) && $result["Avec lame d'air"] != $result["Sans lame d'air"]) || isset($result["Avec lame d'air"]))
				$str .= $result["Avec lame d'air"]." en pose clouée";
			else
				$str .= "ou clouée";
		}
		if(isset($result["Avec lame d'air"]) && $this->poseFlottanteEnabled()) {
			$str .= strlen($str)>0?" et ":"";
			if((isset($result["Sans lame d'air"]) && $result["Avec lame d'air"] != $result["Sans lame d'air"]) || isset($result["Avec lame d'air"]))
				$str .= $result["Avec lame d'air"]." en pose flottante";
			else
				$str .= "ou flottante";
		}

		


		return $str;
	}



	public function getClasseReactionFeuFr() {
		/* 
NB : les classements actuels, définis par la norme NF EN 13501-1 indiquent que les classes A2 fl s2, B fl s1 & s2 et C fl s2 satisfont aux exigences M3. Les classes D fl s1 et s2 satisfont aux exigences M4.
Autrement dit, hors des cas particuliers cités, tous les parquets conviennent quel que soit le mode de pose. */
		return str_replace(array("M5","M3","M4"), array("Efls1","Cfls1","Dfls1"), $this->getClasseReactionFeuEu());
	}



	public function getConditionMiseEnOeuvre() {
		///avaec ou sans lame d'aire
		$lameDAir = $this->poseCloueeEnabled() || $this->poseFlottanteEnabled();
		$sansLameDAir = $this->poseColleeEnabled() || $this->poseColleeAuCordonEnabled();

		if($lameDAir && $sansLameDAir) 
			return "Avec ou sans lame d'air";
		else if($sansLameDAir) 
			return "Sans lame d'air";
		else if($lameDAir && $sansLameDAir) 
			return "Avec lame d'air";
		return "";
	}

	public function getCoefficientRetractabilite() {
		$essence = $this->getEssence();
		switch ($essence) {
			case 'CHE':
				return "Chêne : radial=0,16 et tangentiel=0,32";
				break;
			
			default:
				return "";
				break;
		}
	}


	/* LES POSES */
	/*
	http://boisphile.over-blog.com/tag/le%20parquet/

	*/
	public function poseCloueeEnabled() {
		//SI
		return $this->isParquet() && $this->getEpaisseur()>=20;

	}
	public function poseColleeEnabled() {
		return $this->isParquet() && $this->getEpaisseur()>=8;
		
	}
	public function poseColleeEnPleinEnabled() {
		return $this->isParquet() && $this->getEpaisseur()>=8;
		
	}
	public function poseColleeAuCordonEnabled() {
		// pas de planchete 10mm
		return $this->isParquet() && $this->getEpaisseur()>=8;
		
	}
	public function poseFlottanteEnabled() {
		return ($this->isParquetContrecolle());
	}


	public function getPreviewUrl() {
		return "/id/".$this->getId();
	}
	public function getPreviewLink() {
		return "<a href=\"/id/".$this->getId()."\">Voir</a>";
	}


	public function getDegagementFormaldehyde() {
		return str_replace(array("A+","A"), array("E1","XXXX"), $this->getNorme_sanitaire());
	}

	public function isParquetMassif() {
		return $this->getFamille() == "01MASSIF";
	}
	public function isParquetContrecolle() {
		return $this->getFamille() == "05CONTRECO";
	}
	public function isParquet() {
		return $this->isParquetMassif() || $this->isParquetContrecolle();
	}

}

// and optionally a related list

class Website_Product_list extends Object_Product_List {

    
}
?>