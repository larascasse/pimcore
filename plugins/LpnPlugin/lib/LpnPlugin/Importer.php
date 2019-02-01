 <?php

 class LpnPlugin_Importer {
 	
 	private  $config;
 	private  $overwrite;
 	private  $csvFile;

 	private $parentId = 1514;

 	function __construct($importerConfig=null,$overwrite=false) {
 		//echo "ok\n";
 		$this->config = $importerConfig;
 		$this->overwrite = $overwrite;
        if($importerConfig)
 		 $this->parentId = $this->config->import->folderId;
 	}

 	function init() {
		//echo "\nImporter Init\n";
 	}


    function formatPrice($price) {
        return number_format($price,2,".","");
    }

    function convertScienergieName($name) {

        $name = strtolower($name);
        $name = trim($name);
        $name=str_ireplace("  ", " ", $name);
        $name=str_ireplace("\n", " ", $name);
        $name=str_ireplace("QUALITE ", "qualité ", $name);
        $name=str_ireplace("PRESENCE ", "présence ", $name);
        $name=str_ireplace("RABOTE ", "raboté ", $name);
        $name=str_ireplace("ECOLOGIQUE ", "écologique ", $name);
        $name=str_ireplace("BROSSE ", "brossé ", $name);
        $name=str_ireplace("LEGER ", "léger ", $name);
        $name=str_ireplace("RESISTANCE ", "résistance ", $name);
        $name=str_ireplace("FABRIQUE ", "fabriqué ", $name);
        $name=str_ireplace("ETUVE ", "étuvé ", $name);
        $name=str_ireplace("RESIDU ", "résidu ", $name);
        $name=str_ireplace("PIECE ", "pièce ", $name);
        $name=str_ireplace("TRAITE ", "traité ", $name);
        $name=str_ireplace("DELIGNE ", "déligné ", $name);
        $name=str_ireplace("ABIMEES ", "abimées ", $name);
        $name=str_ireplace("ABIMES ", "abimés ", $name);
        $name=str_ireplace("STRATIFIE ", "stratifié ", $name);


        $name=str_ireplace("PREPATINE ", "prépratiné ", $name);
        $name=str_ireplace("ELEGANCE ", "élégance ", $name);

        $name=str_ireplace(" PAVE ", " pavé ", $name);

        $name=str_ireplace(" FLOTTE ", " flotté ", $name);
        $name=str_ireplace(" METAL ", " métal ", $name);
        $name=str_ireplace(" BETON ", " béton ", $name);
        $name=str_ireplace(" FONCE ", " foncé ", $name);

        $name=str_ireplace(" DECOFFRAGE ", " décoffrage ", $name);
        $name=str_ireplace(" DECOFRAGE ", " décoffrage ", $name);
        $name=str_ireplace(" DECOR ", " décor ", $name);
        
        $name=str_ireplace(" MATIERE ", " matière ", $name);
        $name=str_ireplace(" SATINE ", " satiné ", $name);
        


        $name=str_ireplace("g2", "G2", $name);
        $name=str_ireplace("g4", "G4", $name);
        $name=str_ireplace(" click ", " Click ", $name);
        $name=str_ireplace(" huile ", " huilé ", $name);


        $name=str_ireplace(" geneve  ", " Genève  ", $name);
        $name=str_ireplace(" neuchatel  ", " Neuchatel  ", $name);


        
        //$name=str_ireplace("BROSSE ", "brossé ", $name);
        //$name=str_ireplace("BROSSE ", "brossé ", $name);


        $name=str_ireplace("CONTRECOLLE ", "Contrecollé ", $name);




        $name=str_ireplace("CHENE ", "Chêne ", $name);
        $name=str_ireplace("FRENE ", "Frêne ", $name);
        $name=str_ireplace("HETRE ", "Hêtre ", $name);

        $name=str_ireplace("TETE ", "Tête ", $name);

        $name=str_ireplace("REGLABLE ", "Réglable ", $name);



        $name=str_ireplace("DEGRISEUR ", "Dégriseur ", $name);
        $name=str_ireplace(" STRUCTURE ", " structuré ", $name);
        $name=str_ireplace(" DESTRUCTURE ", " déstructuré ", $name);

        $name=str_ireplace(" BOMBE ", " Bombé ", $name);

        $name=str_ireplace("ANTIDERAPANT", "antidérapant", $name);
        $name=str_ireplace("IPE ", "Ipé ", $name);
        $name=str_ireplace("IPE/", "Ipé/", $name);

        $name=str_ireplace(" A ", " à ", $name);
        $name=str_ireplace("MELEZE ", "Mélèze ", $name);
        $name=str_ireplace("PEIGNE", "Peigné", $name);
        $name=str_ireplace("THERMOCHAUFFE ", "thermochauffé ", $name);
        $name=str_ireplace("STRIEE ", "striée ", $name);
        $name=str_ireplace("RESINEUX ", "résineux ", $name);

        $name=str_ireplace("d'aujourd' hui", "d'aujourd'hui", $name);
        $name=str_ireplace("d' orgine", "d'orgine", $name);
        $name=str_ireplace(" '", "'", $name);
        $name=str_ireplace("' ", "'", $name);

        $name=str_ireplace("( ", "(", $name);
        $name=str_ireplace("(", " (", $name);
        $name=str_ireplace("  (", " (", $name);

        $name=str_ireplace(")", ") ", $name);
        $name=str_ireplace(")  ", ") ", $name);





    
        $name=str_ireplace(".", "", $name);
        //$name = strtolower($name);
        $name = ucfirst($name);

        $name=str_ireplace("pefc", "PEFC", $name);
        $name=str_ireplace("prbis", "PRBis", $name);
        $name=str_ireplace("epfl", "EPFL", $name);
        $name=str_ireplace("epfl", "EPFL", $name);
        $name=str_ireplace("upec", "UPEC", $name);



        return trim($name);

    }

    function splitNameType($name) {
        $types = array(
            "TERRASSE MONOLAME"=>"Lame de terrasse",
            "TERRASSE FINITION" => "Produit de finition",
            "STRUCTURE" => "Produit de structure",
            "TERRASSE ACCESSOIRE" => "Accessoire pour terrasse",
            "TERRASSE DALLE" => "Dalle de terrasse",
            );
        foreach ($types as $key => $value) {
            $splitted = explode($key." ", $name);
            if(count($splitted)>1) {
                return array($splitted[1],$value);
            }
        }
        return array($name,"");
    }


  

 	function doImport() {
		echo "\nImporter doImport\n";

		$className="Product";
		$importParentID = $this->parentId;
		$objKey = 1;


		// create new object
        $className = "Object_" . ucfirst($className);
        $className = Pimcore_Tool::getModelClassMapping($className);


		$objectKey = Pimcore_File::getValidFilename($objKey);


		$parent = Object_Abstract::getById($importParentID);
		$intendedPath = $parent->getFullPath() . "/" . $objectKey;

		$object = Object_Abstract::getByPath($intendedPath);
         if (!$object instanceof Object_Concrete) {
             //create new object
            $object = new $className();
            $object->setCreationDate(time());

         }
         else {
         	//Nothing
         }


         //Zend_Json::decode($this->getParam("mapping"));
		
		//$object->setUserOwner($user->getId());
		//$object->setUserModification($user->getId());
		$object->setPublished(true);

		$object->setName("This is a test 222");

		$object->setKey($objectKey);
		$object->setParentId($importParentID);
		$object->save();

 	}


 	public function importGetFileInfoAction($file)
    {
    	$parentId = $this->config->import->folderId;
        $classId = $this->config->import->classId;

    	$this->csvFile = $file;

    	$tmpFile = $file."import";
        copy($file,$tmpFile);
        $file = $this->csvFile  = $tmpFile;


        $success = true;
        $supportedFieldTypes = array("checkbox", "country", "date", "datetime", "href", "image", "input", "language", "table", "multiselect", "numeric", "password", "select", "slider", "textarea", "wysiwyg", "objects", "multihref", "geopoint", "geopolygon", "geobounds", "link", "user", "email", "gender", "firstname", "lastname", "newsletterActive", "newsletterConfirmed");


        // determine type
        $dialect = Pimcore_Tool_Admin::determineCsvDialect($file);

        print_r($dialect);

        $count = 0;
        if (($handle = fopen($file, "r")) !== false) {

            while (($rowData = fgetcsv($handle, 100000,";")) !== false) {
                if ($count == 0) {
                    $firstRowData = $rowData;
                }
                $tmpData = array();
                foreach ($rowData as $key => $value) {
                    $tmpData["field_" . $key] = $value;
                }
                $data[] = $tmpData;
                $cols = count($rowData);

                $count++;

                if ($count > 18) {
                    break;
                }

            }
            fclose($handle);
        }

        // get class data
        $class = Object_Class::getById($classId);
        $fields = $class->getFieldDefinitions();

        $availableFields = array();

        foreach ($fields as $key => $field) {

            $config = null;
            $title = $field->getName();
            if (method_exists($field, "getTitle")) {
                if ($field->getTitle()) {
                    $title = $field->getTitle();
                }
            }

            if (in_array($field->getFieldType(), $supportedFieldTypes)) {
                $availableFields[] = array($field->getName(), $title . "(" . $field->getFieldType() . ")");
            }
        }

        $mappingStore = array();
        for ($i = 0; $i < $cols; $i++) {

            $mappedField = null;
            if ($availableFields[$i]) {
                $mappedField = $availableFields[$i][0];
            }

            $firstRow = $i;
            if (is_array($firstRowData)) {
                $firstRow = $firstRowData[$i];
                if (strlen($firstRow) > 40) {
                    $firstRow = substr($firstRow, 0, 40) . "...";
                }
            }

            $mappingStore[] = array(
                "source" => $i,
                "firstRow" => $firstRow,
                "target" => $mappedField
            );
        }

        //How many rows
        $csv = new SplFileObject($file);
        $csv->setFlags(SplFileObject::READ_CSV);
        $csv->setCsvControl($dialect->delimiter, $dialect->quotechar, $dialect->escapechar);
        $rows = 0;
        $nbFields = 0;
        foreach ($csv as $fields) {
            if (0 === $rows) {
                $nbFields = count($fields);
                $rows++;
            } elseif ($nbFields == count($fields)) {
                $rows++;
            }
        }

        /*$this->_helper->json(array(
            "success" => $success,
            "dataPreview" => $data,
            "dataFields" => array_keys($data[0]),
            "targetFields" => $availableFields,
            "mappingStore" => $mappingStore,
            "rows" => $rows,
            "cols" => $cols
        ));*/
    }


    // ARTICLE
    public function importProcessAction($job=1) {
                Object_Abstract::setGetInheritedValues(false);


        $success = true;

        $file = $this->csvFile;

        /*$parentId = $this->getParam("parentId");
        $job = $this->getParam("job");
        $id = $this->getParam("id");
        $id = "$this->getParam("id")";*/
        $o_className = "product";
        $className=$o_className;
		$parentId = $this->config->import->folderId;
        $classId = $this->config->import->classId;
		$keyCol = 1;

		$userId = $this->config->import->userId;


        $mappingRaw = [[0,"",""],[1,"code","code"],[2,"name","name"],[3,"Famille art","famille"],[4,"Essence","essence"],[5,"Qualité","qualite"],[6,"Choix","choix"],[7,"epaisseur","epaisseur"],[8,"largeur","largeur"],[9,"longueur","longueur"],[10,"Unité","unite"],[11,"nbrpp","nbrpp"],[12,"mode_calcul","mode_calcul"]];
        // $mappingRaw = [[0,"",""],[1,"","code"],[2,"name","name"],[3,"Essence","essence"],[4,"Famille art","famille"],[5,"Qualité","qualite"],[6,"Choix","choix"],[7,"epaisseur","epaisseur"],[8,"largeur","largeur"],[9,"longueur","longueur"],[10,"Unité","unite"],[11,"published (system)",""]];
        
        $class = Object_Class::getById($classId );
        $skipFirstRow = true;
        $fields = $class->getFieldDefinitions();
       
   	

        // currently only csv supported
        // determine type
        $dialect = Pimcore_Tool_Admin::determineCsvDialect($file);

        $count = 0;
        if (($handle = fopen($file, "r")) !== false) {
            $data = fgetcsv($handle, 100000, ";");
        }
        if ($skipFirstRow && $job == 1) {
            //read the next row, we need to skip the head row
            $data = fgetcsv($handle, 100000, ";");
        }

        $tmpFile = $file . "_tmp";
        $tmpHandle = fopen($tmpFile, "w+");
        while (!feof($handle)) {
            $buffer = fgets($handle);
            fwrite($tmpHandle, $buffer);
        }

        fclose($handle);
        fclose($tmpHandle);

        unlink($file);
        rename($tmpFile, $file);

        print_r($data);


        // prepare mapping
        foreach ($mappingRaw as $map) {

            if ($map[0] !== "" && $map[1] && !empty($map[2])) {
                $mapping[$map[2]] = $map[0];
            } else if ($map[1] == "published (system)") {
                $mapping["published"] = $map[0];
            }
        }

        // create new object
        $className = "Object_" . ucfirst($className);

        $className = Pimcore_Tool::getModelClassMapping($className);

        $parent = Object_Abstract::getById($parentId);

        $objectKey = "object_" . $job;
        if ($keyCol == "id") {
            $objectKey = null;
        }
        else if ($keyCol != "default") {
            $objectKey = Pimcore_File::getValidFilename($data[$keyCol]);
        }
   
        $overwrite = false;
        $overwrite = true;
        $canInsert = true;
        $isUpdating = false;

        if ($canInsert && $objectKey && $parent) {

            
            $intendedPath = $parent->getFullPath() . "/" . strtolower($data[$mapping["famille"]]).  "/" . $objectKey;

            $folderParent = Object_Product::getByPath($parent->getFullPath() . "/" .  strtolower($data[$mapping["famille"]]));

            if(!$folderParent) {
                echo ("Crete product ".$data[$mapping["famille"]]);
                $folderParent = Object_Product::create(array(
                    "o_parentId" => $parentId,
                    "o_creationDate" => time(),
                    "o_userOwner" => $userId,
                    "o_userModification" => $userId,
                    "o_key" => strtolower($data[$mapping["famille"]]),
                    "name" => $data[$mapping["famille"]],
                    "o_published" => false
                ));

                $folderParent->setCreationDate(time());
                $folderParent->setUserOwner($userId);
                $folderParent->setUserModification($userId);

                try {
                    $folder->save();
                    $success = true;
                } catch (Exception $e) {
                    echo "Error creating folder".$e->getMessage();
                }
            }
            $realParentId  = $folderParent->getId();

            $existingArticle=null;

            $existingProductList = Object_Product::getByCode($data[$keyCol]);
            if($existingProductList->count()>=1) {
                $currentArticle = $existingProductList->current();
                
                 if(empty($currentArticle->Ean)) {
                    $existingArticle = $currentArticle;
                     //echo "ARTICLE existe ".$existingArticle->getFullPath()."\n";
                    
                    $intendedPath = $existingArticle->getFullPath();
                    $realParentId = $existingArticle->getParent()->getId();
                 }
                 
            }

            if(!$existingArticle) {
                echo "ARTICLE n'existe pas".$data[$keyCol]."\n";

            }

            

            if ($overwrite) {
            	//echo "intendedPath : ".$intendedPath;
                $object = Object_Abstract::getByPath($intendedPath);
				
                if (!$object instanceof Object_Concrete) {
                    //create new object
                    echo "create new object";
                    $object = new $className();
                } else if (object instanceof Object_Concrete and $object->getO_className() !== $className) {
                    //delete the old object it is of a different class
                    $object->delete();
                    $object = new $className();
                } else if (object instanceof Object_Folder) {
                    //delete the folder
                    $object->delete();
                    $object = new $className();
                } else {
                    //use the existing objectecho "llll".$object;
                    $isUpdating = true;
                    echo "\nUpdate\n";
                }

            } 
            else {
                $counter = 1;
                while (Object_Abstract::getByPath($intendedPath) != null) {
                    $objectKey .= "_" . $counter;
                    $intendedPath = $parent->getFullPath() . "/" . $objectKey;
                    $counter++;
                }
                $object = new $className();
            }

            $object->setDescription(null);
            $object->setClassId($classId);
            $object->setClassName($o_className);
            $object->setParentId($realParentId);
            $object->setKey($objectKey);
            $object->setCreationDate(time());
           	$object->setUserOwner($userId);
           	$object->setUserModification($userId);

            if ($data[$mapping["published"]] === "1") {
                $object->setPublished(true);
            } else {
                //$object->setPublished(false);
            }



            foreach ($class->getFieldDefinitions() as $key => $field) {

                $value = $data[$mapping[$key]];
                if (array_key_exists($key, $mapping) and  $value != null) {
                    if($key=="name") {
                        $splitedName = $this->splitNameType($value);
                        
                        $object->setValue("name_scienergie",$value);

                        $object->setValue("name_scienergie_converti",$this->convertScienergieName($value));

                        if($isUpdating) {
                           // continue;
                        }
                        if(!$isUpdating) {
                            if(count($splitedName)>0)
                                 $object->setValue("subtype", $splitedName[1]);
                        }
                        //a l'insert
                        $value = $this->convertScienergieName($splitedName[0]);


                    }
                    else {
                         // data mapping
                         $value = $field->getFromCsvImport($value);
                    }
                    
                   

                    if ($value !== null) {
                        $object->setValue($key, $value);
                        //echo $key." ";
                    }
                }
                //else
                //    $object->setValue($key, null);
                
            }

            try {
                $object->save();
                if ($isUpdating)
                     echo "\nrow ".$job." updated ".$objectKey." / ".$object->getFullPath()."\n";
                else 
                    echo "\nrow ".$job." inserted ".$objectKey." / ".$object->getFullPath()."\n";
                $this->importProcessAction(++$job);

            } catch (Exception $e) {
            	echo $e->getMessage();
            }
        }

        Pimcore::collectGarbage();
        //$this->_helper->json(array("success" => $success));
    }
    //
    public function importEanProcessAction($job=1) {
                Object_Abstract::setGetInheritedValues(false);


        $success = true;

        $file = $this->csvFile;

        /*$parentId = $this->getParam("parentId");
        $job = $this->getParam("job");
        $id = $this->getParam("id");
        $id = "$this->getParam("id")";*/
        $o_className = "product";
        $className=$o_className;
		$parentId = $this->config->import->folderId;
		$classId = $this->config->import->classId;
		$keyCol = 1;

		$userId = $this->config->import->userId;

        $mappingRaw = [[0,"Article","code"],[1,"Code_EAN_Article","ean"],[2,"Article Designation","name"],[3,"Epaisseur","epaisseur"],[4,"Largeur","largeur"],[5,"Longueur","longueur"],[6,"nbrpp","nbrpp"],[7,"Choix","choix"],[8,"Essence","essence"],[9,"Qualite","qualite"],[10,"Article Famille","famille"],[11,"name_scienergie_court","name_scienergie_court"]];
        
        $class = Object_Class::getById($classId );
        $skipFirstRow = true;
        $fields = $class->getFieldDefinitions();
       
   

        // currently only csv supported
        // determine type
        $dialect = Pimcore_Tool_Admin::determineCsvDialect($file);

        $count = 0;
        if (($handle = fopen($file, "r")) !== false) {
            $data = fgetcsv($handle, 100000, ",",'"');
        }
        if ($skipFirstRow && $job == 1) {
            //read the next row, we need to skip the head row
            $data = fgetcsv($handle, 100000, ",",'"');
        }

        $tmpFile = $file . "_tmp";
        $tmpHandle = fopen($tmpFile, "w+");
        while (!feof($handle)) {
            $buffer = fgets($handle);
            fwrite($tmpHandle, $buffer);
        }

        fclose($handle);
        fclose($tmpHandle);

        unlink($file);
        rename($tmpFile, $file);



        // prepare mapping
        foreach ($mappingRaw as $map) {

            if ($map[0] !== "" && $map[1] && !empty($map[2])) {
                $mapping[$map[2]] = $map[0];
            } 
            else if ($map[1] == "published (system)") {
                $mapping["published"] = $map[0];
            }
        }
    
        //Sous produit, on vire le name
        $data[$mapping["name"]] = "";






        // create new object
        $className = "Object_" . ucfirst($className);

        $className = Pimcore_Tool::getModelClassMapping($className);

        $parent = Object_Abstract::getById($parentId);



        $articleParent = Object_Abstract::getByPath($parent->getFullPath() . "/" . strtolower($data[$mapping["famille"]])."/".$data[$mapping["code"]]);
        //print_r ($articleParent);
       

        $objectKey = "object_" . $job;
        if ($keyCol == "id") {
            $objectKey = null;
        }
        else if ($keyCol != "default") {
            $objectKey = Pimcore_File::getValidFilename($data[$keyCol]);
        }
   
        $overwrite = false;
        //if ($this->getParam("overwrite") == "true") {
            $overwrite = true;
       // }
         // $canInsert = $parent->isAllowed("create");
          $canInsert = true;
        $isUpdateing = false;


        $existingEan=null;
        $existingProductList = Object_Product::getByEan($data[$keyCol]);
        //print_r($parent);
        if($existingProductList->count()==1) {
            $existingEan = $existingProductList->current();
             //echo "EAN existe ".$existingEan->getFullPath()."\n";
             
        }
        else {
            echo "n'existe pas\n";
        }

        if ($canInsert && $objectKey) {

            $objectParentId = $parentId;
            $intendedPath = $parent->getFullPath() . "/" . $objectKey;

            if($existingEan) {
                $intendedPath = $existingEan->getFullPath();
                $objectParentId = $existingEan->getParent()->getId();
            }
            else if($articleParent) {
            	$intendedPath = $articleParent->getFullPath() . "/" . $objectKey;
            	$objectParentId = $articleParent->getId();
            }


            echo ("intendedPath :".$intendedPath);
            if ($overwrite) {
                $object = Object_Abstract::getByPath($intendedPath);
				
                if (!$object instanceof Object_Concrete) {
                    //create new object
                    $object = new $className();
                } else if (object instanceof Object_Concrete and $object->getO_className() !== $className) {
                    //delete the old object it is of a different class
                    $object->delete();
                    $object = new $className();
                } else if (object instanceof Object_Folder) {
                    //delete the folder
                    $object->delete();
                    $object = new $className();
                } else {
                    $isUpdating = true;

                }
            } else {
                $counter = 1;
                while (Object_Abstract::getByPath($intendedPath) != null) {
                    $objectKey .= "_" . $counter;
                    $intendedPath = $parent->getFullPath() . "/" . $objectKey;
                    $counter++;
                }
                $object = new $className();
            }
            $object->setClassId($classId);
            $object->setClassName($o_className);
            $object->setParentId($objectParentId);
            $object->setKey($objectKey);
            if(!$isUpdating)
                $object->setCreationDate(time());
            if($isUpdating)
                $object->setModificationDate(time());

           	$object->setUserOwner($userId);
           	$object->setUserModification($userId);

            if ($data[$mapping["published"]] === "1") {
                $object->setPublished(true);
            } else {
                $object->setPublished(false);
            }

            $object->setPublished(true);

            foreach ($class->getFieldDefinitions() as $key => $field) {


                $value = $data[$mapping[$key]];
                if (array_key_exists($key, $mapping) and  $value != null) {
                    if($isUpdating && $key=="name") {
                        continue;
                    }

                    if($key=="longueur" || $key=="longueur" || $key=="longueur") {
                        if($value >0)
                            $value = round($value);
                        else
                            $value="";
                    }

                    /*else if($key=="code") {
                        $object->setCode(null);
                        $object->save();
                        continue;
                    }
                    else if($isUpdating && $key=="famille") {
                        $object->setFamille(null);
                        $object->save();
                        continue;
                    }*/
                    elseif($key=="name_scienergie_court") {
                        $splitedName = $this->splitNameType($value);
                        $value = $this->convertScienergieName($value);
                    }
                    else {
                       $value = $field->getFromCsvImport($value); 
                    }
                    

                    if ($value !== null) {
                        $object->setValue($key, $value);
                    }
                }
            }

            try {
                $object->save();
                if ($isUpdating)
                     echo "\nrow ".$job." updated ".$objectKey." / ".$object->getFullPath()."\n";
                else 
                    echo "\nrow ".$job." inserted ".$objectKey." / ".$object->getFullPath()."\n";
                $this->importEanProcessAction(++$job);

            } catch (Exception $e) {
            	echo $e->getMessage();
                //$this->_helper->json(array("success" => false, "message" => $object->getKey() . " - " . $e->getMessage()));
            }
        }
    }

    public function createArticle($productEAN) {
        $o_className = "product";
        $className=$o_className;
        $parentId = 2019;
        $classId = 5;
        $keyCol = 1;

        $userId = 6;
        $class = Object_Class::getById($classId );
        $fields = $class->getFieldDefinitions();

        // create new object
        $className = "Object_" . ucfirst($className);
        $className = Pimcore_Tool::getModelClassMapping($className);
        $parent = Object_Abstract::getById($parentId);


       

        $familleKey = Pimcore_File::getValidFilename($productEAN["famille"]);
        $pathFamille = $parent->getFullPath() . "/" . $familleKey;
        $productFamille = Object_Abstract::getByPath($pathFamille);

        //On cree la famille
        if (!$productFamille instanceof Object_Concrete) {
            //Create Famille
            $productFamille = new $className();
            $productFamille->setParentId($parentId);
            $productFamille->setClassId($classId);
            $productFamille->setClassName($o_className);
            $productFamille->setCreationDate(time());
            $productFamille->setKey($familleKey);
            $productFamille->setUserOwner($userId);
            $productFamille->setModificationDate(time());
            $productFamille->setUserModification($userId);
            $productFamille->setPublished(true);
            $productFamille->save();
        }

        //ON CREE L4ARTICLE
        $articleKey = Pimcore_File::getValidFilename($productEAN["code"]);
        $pathArticle = $productFamille->getFullPath().'/'.$articleKey;


        $productArticle = new $className();
        $productArticle->setParentId($productFamille->getId());
        $productArticle->setClassId($classId);
        $productArticle->setClassName($o_className);
        $productArticle->setCreationDate(time());
        $productArticle->setKey($articleKey);
        $productArticle->setUserOwner($userId);
        $productArticle->setModificationDate(time());
        $productArticle->setUserModification($userId);
        $productArticle->setPublished(true);

        
        foreach ($class->getFieldDefinitions() as $key => $field) {
   
            if (isset($productEAN[$key])) {
                $value = $productEAN[$key];
                if($key=="name") {
                    $splitedName = $this->splitNameType($value);
                    
                    $productArticle->setValue("name_scienergie",$value);

                    $productArticle->setValue("name_scienergie_converti",$this->convertScienergieName($value));

                    if(!$isUpdating) {
                        if(count($splitedName)>0)
                             $productArticle->setValue("subtype", $splitedName[1]);
                    }
 
                    $value = $this->convertScienergieName($splitedName[0]);


                }

                if($key=="longueur" || $key=="largeur" || $key=="epaisseur"  || $key=="ean") {
                    continue;
                }
                 
                if($key=="name_scienergie_court") {
                    $splitedName = $this->splitNameType($value);
                    $value = $this->convertScienergieName($value);
                }
                else {
                   $value = $field->getFromCsvImport($value); 
                }
                

                if ($value !== null) {
                    $productArticle->setValue($key, $value);
                }

            }
        }

        try {
            $productArticle->save();
        }
        catch (Exception $e) {
            echo $e->getMessage()."\n";
        }





         return $productArticle;


    }

    public function importProduct($product,$importNonActifWeb=false) {
        //echo "importProduct ".$product["ean"];

        $returnMessage = array();

        $inheritedValues = Object_Abstract::doGetInheritedValues();
        Object_Abstract::setGetInheritedValues(false);

      
        $o_className = "product";
        $className=$o_className;
        $parentId = 2019;
        $classId = 5;
        $keyCol = 1;

        $userId = 6;
        $job = "import";

        
        $class = Object_Class::getById($classId );
        $fields = $class->getFieldDefinitions();
       

        // create new object
        $className = "Object_" . ucfirst($className);

        $className = Pimcore_Tool::getModelClassMapping($className);

        $parent = Object_Abstract::getById($parentId);

        Object_Abstract::setGetInheritedValues(false);


        $overwrite = true;
        $canInsert = true;
        $isUpdating = false;

        //on ne cree pas des produits non actif et obsolete
        $canCreate = !$product["obsolete"] && ($product["actif_web"] || $importNonActifWeb);

        if($product["obsolete"])
            $product["published"] = false;



        if($canCreate) {
            //On check si le parent existe, sinon on le crée
            $articleParentList = new Object_Product_List();
            $articleParentList->setCondition('o_key = ?', $product["code"]);

            if($articleParentList->count()!=1) {
                $articleParent = null;
                //Pad d'object Parrent, on le cree
                $articleParent = $this->createArticle($product);
                if(!is_object($articleParent)) {
                    return ['Creation article parent impossible '.$product["ean"]."skip\n"];
                }

            }
            else {
                $articleParent =  $articleParentList->current();
            }
        }
        
        

        $objectKey = Pimcore_File::getValidFilename($product["ean"]);

        $existingEan=null;
        $existingProductList = Object_Product::getByEan($product["ean"]);

        //print_r($parent);
        if($existingProductList->count()==1) {
            $existingEan = $existingProductList->current();
             //$returnMessage[] =  $product["ean"]." existe ".$existingEan->getFullPath()."\n";
             
        }
        else {
           
            if(!$canCreate) {
                 return  $product["ean"]." n'existe pas et ne sera pas crée (non actif) : SKIP\n";
                 /*if($product["ean"]=='0001162502000') {
                    print_r($product);
                    die;
                    }*/
                 
             }
             else
                 $returnMessage[] = "\n\n*********  ".$product["ean"]." n'existe pas  et sera crée ****** \n";
        }



        if ($canInsert && $objectKey) {

            /* PARENT */
            $objectParentId = $parentId;
            $intendedPath = $parent->getFullPath() . "/" . $objectKey;

            if($existingEan) {
                $intendedPath = $existingEan->getFullPath();
                $objectParentId = $existingEan->getParent()->getId();
            }
            else if($articleParent) {
                $intendedPath = $articleParent->getFullPath() . "/" . $objectKey;
                $objectParentId = $articleParent->getId();
                //echo "article existe ".$articleParent->getFullPath()."\n";
            }
            else {
                 return  ["Article parent n'existe pas... SKIP\n"];
              
            }

           
            
            Object_Abstract::setGetInheritedValues(false);
            $object = Object_Abstract::getByPath($intendedPath);
            
            if (!$object instanceof Object_Concrete) {
                //create new object
                if($canCreate) {
                  $object = new $className();
                }
                else {
                  return [$product["ean"]." ".$product["name"]." n'existe pas et ne sera pas crée\n"];
               
                }

            } 
            else if (object instanceof Object_Concrete and $object->getO_className() !== $className) {
                //delete the old object it is of a different class
                $object->delete();

                if($canCreate) {
                  $object->delete();
                  $object = new $className();
                }
                else {
                  return [$product["ean"]." ".$product["name"]." existe  sous une autre class : SKIP\n"];
                }

            } 
            else if (object instanceof Object_Folder) {
                //delete the folder
               
                if($canCreate) {
                  $object->delete();
                  $object = new $className();
                }
                else {
                  return [$product["ean"]." ".$product["name"]." est un dossier : SKIP\n"];
                }

            } else {
                //echo $product["ean"]." ".$product["name"]." sera mis à jour\n";
                $isUpdating = true;

            }
            

            

            
            $object->setParentId($objectParentId);
            
            if(!$isUpdating && $canCreate){
                $object->setClassId($classId);
                $object->setClassName($o_className);
                $object->setCreationDate(time());
                $object->setKey($objectKey);
                $object->setUserOwner($userId);
            }
            
            if($isUpdating)
                $object->setModificationDate(time());

           
            $object->setUserModification($userId);

           
            $updatedFields = array();

            foreach ($class->getFieldDefinitions() as $key => $field) {


                
                if (isset($product[$key])) {
                    $value = $product[$key];
                    if($key=="name") {
                        $splitedName = $this->splitNameType($value);
                        
                        $object->setValue("name_scienergie",$value);

                        $object->setValue("name_scienergie_converti",$this->convertScienergieName($value));

                        //Mis dans l'article
                        /*if(!$isUpdating) {
                            if(count($splitedName)>0)
                                 $object->setValue("subtype", $splitedName[1]);
                        }*/
                        //2017, pour les EAN, on ne met j'amais le name ... on prend du parent
                        //if($isUpdating) {
                           continue;
                        //}
                        
                        //a l'insert
                        $value = $this->convertScienergieName($splitedName[0]);


                    }

                    if($isUpdating && $key=="code")
                        continue;
                    if($isUpdating && $key=="famille")
                        continue;
                    
                    if($key=="longueur" || $key=="largeur" || $key=="epaisseur") {
                        if($value >0)
                            $value = round($value);
                        else
                            $value="";
                    }

                    //TODO: weight
                     

                    /*else if($key=="code") {
                        $object->setCode(null);
                        $object->save();
                        continue;
                    }
                    else if($isUpdating && $key=="famille") {
                        $object->setFamille(null);
                        $object->save();
                        continue;
                    }*/
                    if($key=="name_scienergie_court") {
                        $splitedName = $this->splitNameType($value);
                        $value = $this->convertScienergieName($value);
                    }
                    else {
                       $value = $field->getFromCsvImport($value); 
                    }
                    

                    if ($value !== null) {

                        //gestion des champs nouveaux
                        $oldValue = "".$object->$key;
                        $testValue = "".$value;
                        if( $oldValue != $testValue || !$isUpdating) {
                            //echo $key."-".$oldValue."-".$value."-\n";
                            $updatedFields[$key] = $oldValue."->".$value;
                            $object->setValue($key, $value);
                        }
                        
                    }


                }
            }

            if(!$isUpdating) {
                $object->setPublished(false);
            
            }
            else {
                if ($product["published"]) {
                    $object->setPublished(true);
                } else {
                    $object->setPublished(false);
                }
            }

            try {
                //si il ya des champs à mettre à jour
                if(count($updatedFields) > 0) {
                    $object->setUserModification(0);
                    $object->save();

                    if ($isUpdating) {

                        $returnDetail = [];
                        foreach ($updatedFields as $key => $value) {
                            $returnDetail[] = $key.":".$value;
                        }
                         $returnMessage[] =  "row ".$job." UPDATED | ".$objectKey." | ".$object->getFullPath()." | ".implode("|", $returnDetail);

                           //$returnMessage["productId"] = $object->getId();
                           //$returnMessage["productSku"] = $object->getEan();
                           //$returnMessage["product"] = $object->getShortArray();

                          

                         $versions = $object->getVersions();
                         if (is_array($versions) && count($versions) > 0) {
                            $version = $versions[0];
                            //$version->setData($this);
                            $version->setNote("Azure Update : ".implode("|", $returnDetail));
                            $version->save();
                         }
                    }
                    else {
                        $returnMessage[] =  "row ".$job." NEW | ".$objectKey." | ".$object->getFullPath();
                        
                        try {
                            $version = new Model\Version();
                            $version->setCid($object->getId());
                            $version->setCtype("object");
                            $version->setDate($this->getModificationDate());
                            $version->setUserId(6);
                            $version->setNote("Azure Create");
                            $version->save();
                        }
                        catch (Exception $e) {
                            //echo($e);
                            $returnMessage[] = "Error save Version\n\n";
                           
                        }
                        

                        print_r($product);
                    }
                }
                else {
                     $returnMessage[] = "row ".$job." SKIPPED (no update) | ".$objectKey." | ".$object->getFullPath();
                }
               

            } catch (Exception $e) {
                //echo($e);
                $returnMessage[] = "Error save ".$e->getMessage()." ".$objectKey." ".$object->getFullPath()."\n\n";
                //$this->_helper->json(array("success" => false, "message" => $object->getKey() . " - " . $e->getMessage()));
            }
             Object_Abstract::setGetInheritedValues($inheritedValues);
        }
        else {
             $returnMessage[] = "row ".$job." SKIPPED  canInsert:".$canInsert. "objectKey : ".$objectKey;
        }

        if(count( $returnMessage) > 0) {
          
            return $returnMessage;
        }

        return "ZARB";


        //$this->_helper->json(array("success" => $success));
    }






    public function importProductPrice($product) {
        Object_Abstract::setGetInheritedValues(false);

      
        $o_className = "product";
        $className=$o_className;
        $parentId = 2019;
        $classId = 5;
        $keyCol = 1;

        $userId = 6;

        
        $class = Object_Class::getById($classId );
        $fields = $class->getFieldDefinitions();
       

        // create new object
        $className = "Object_" . ucfirst($className);

        $className = Pimcore_Tool::getModelClassMapping($className);

        $existingProductList = Object_Product::getByEan($product["ean"],['unpublished' => true]);
        //print_r($parent);
        if($existingProductList->count()==1) {
            $existingEan = $existingProductList->current();
             echo "EAN existe ".$existingEan->getFullPath()."-".$product["name"]."\n";
             
        }
        else {
            echo "n'existe pas ".$product["ean"]."-".$product["name"]."\n";
            
        }

        if ($existingEan) {
           $existingEan->setModificationDate(time());

           $existingEan->setPrice_1($this->formatPrice($product["price_1"]));
           $existingEan->setPrice_2($this->formatPrice($product["price_2"]));
           $existingEan->setPrice_3($this->formatPrice($product["price_3"]));
           $existingEan->setPrice_4($this->formatPrice($product["price_4"]));
           $existingEan->setPrice($this->formatPrice($product["price"]));

            try {
                $existingEan->save();
                echo "\Price  updated ".$product["ean"]." / ".$existingEan->getFullPath()."\n";

            } catch (Exception $e) {
                echo $e->getMessage();
                //$this->_helper->json(array("success" => false, "message" => $object->getKey() . " - " . $e->getMessage()));
            }
        }
                Object_Abstract::setGetInheritedValues(true);



        //$this->_helper->json(array("success" => $success));
    }





    public function clearInheritedValues($product) {
        //if($product["ean"]!="3760102970126")
        //    return;
        
        $inheritedValues = Object_Abstract::doGetInheritedValues();
        Object_Abstract::setGetInheritedValues(false);

      
        $o_className = "product";
        $className=$o_className;
        $parentId = 2019;
        $classId = 5;
        $keyCol = 1;

        $userId = 6;

        $class = Object_Class::getById($classId );
        $fields = $class->getFieldDefinitions();
       

        // create new object
        $className = "Object_" . ucfirst($className);

        $className = Pimcore_Tool::getModelClassMapping($className);
        

        $parent = Object_Abstract::getById($parentId);

        $articleParent = Object_Abstract::getByPath($parent->getFullPath() . "/" . strtolower($product["famille"])."/".$product["code"]);
        

        $objectKey = Pimcore_File::getValidFilename($product["ean"]);
        

        $existingEan=null;
        $existingProductList = Object_Product::getByEan($product["ean"]);
        //print_r($parent);
        if($existingProductList->count()==1) {
            $existingEan = $existingProductList->current();
             echo "EAN existe ".$existingEan->getFullPath()."\n";
             
        }
        Object_Abstract::setGetInheritedValues(true); 

        if($existingEan) {
            $objectParent = $existingEan->getParent();
            foreach ($class->getFieldDefinitions() as $key => $field) {
                //echo "try ".$key." ".$field->fieldtype."\n";
                $getter = "get" . ucfirst($key);
                if($field->fieldtype!="nonownerobjects" && $field->fieldtype!="objects" && $existingEan->$key==$objectParent->$getter()) {
                   // echo "clear ".$key." ".$field->fieldtype."\n";
                    $existingEan->setValue($key,null);
                }
            
           }
           echo 'clear'.$product["ean"].'/n';
           $existingEan->save();
        }


        //$this->_helper->json(array("success" => $success));
    }


 }