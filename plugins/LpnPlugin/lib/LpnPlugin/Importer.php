 <?php

 class LpnPlugin_Importer {
 	
 	private  $config;
 	private  $overwrite;
 	private  $csvFile;

 	private $parentId = 1514;

 	function LpnPlugin_Importer($importerConfig,$overwrite) {
 		echo "ok\n";
 		$this->config = $importerConfig;
 		$this->overwrite = $overwrite;
 		$this->parentId = $this->config->import->folderId;
 	}

 	function init() {
		echo "\nImporter Init\n";
 	}

    function test() {
        $className = Pimcore_Tool::getModelClassMapping("Object_Product");
        $parentId = $this->config->import->folderId;

        $parent = Object_Product::getByEan("3239918102910");
        //print_r($parent);
        if($parent->count()==1)
             echo "exist".$parent->current()->getFullPath();
        else
            echo "n'existe pas";

        //$mappingRaw = [[0,"",""],[1,"code","code"],[2,"name","name"],[3,"Famille art","famille"],[4,"Essence","essence"],[5,"Qualité","qualite"],[6,"Choix","choix"],[7,"epaisseur","epaisseur"],[8,"largeur","largeur"],[9,"longueur","longueur"],[10,"Unité","unite"],[11,"published (system)",""],[12,"nbrpp","nbrpp"]];
                $mappingRaw = [[0,"Article","code"],[1,"Code_EAN_Article","ean"],[2,"Article Designation","name"],[3,"Epaisseur","epaisseur"],[4,"Largeur","largeur"],[5,"Longueur","longueur"],[6,"Base3",""],[7,"Choix","choix"],[8,"Article Famille","famille"]];

        foreach ($mappingRaw as $map) {

            if ($map[0] !== "" && $map[1] && !empty($map[2])) {
                $mapping[$map[2]] = $map[0];
            } else if ($map[1] == "published (system)") {
                $mapping["published"] = $map[0];
            }
        }
        // print_r($mapping);
        //$articleParent = Object_Abstract::getByPath($parent->getFullPath() . "/" . $data[$mapping["code"]]);
        //print_r($mapping);
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

        $count = 0;
        if (($handle = fopen($file, "r")) !== false) {
            while (($rowData = fgetcsv($handle, 100000,";",'"')) !== false) {
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
        $csv->setCsvControl(";",'"');
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

    public function importProcessAction($job=1)
    {

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


        $mappingRaw = [[0,"",""],[1,"code","code"],[2,"name","name"],[3,"Famille art","famille"],[4,"Essence","essence"],[5,"Qualité","qualite"],[6,"Choix","choix"],[7,"epaisseur","epaisseur"],[8,"largeur","largeur"],[9,"longueur","longueur"],[10,"Unité","unite"],[11,"published (system)",""],[12,"nbrpp","nbrpp"]];
        // $mappingRaw = [[0,"",""],[1,"","code"],[2,"name","name"],[3,"Essence","essence"],[4,"Famille art","famille"],[5,"Qualité","qualite"],[6,"Choix","choix"],[7,"epaisseur","epaisseur"],[8,"largeur","largeur"],[9,"longueur","longueur"],[10,"Unité","unite"],[11,"published (system)",""]];
        
        $class = Object_Class::getById($classId );
        $skipFirstRow = true;
        $fields = $class->getFieldDefinitions();
       
   	

        // currently only csv supported
        // determine type
        $dialect = Pimcore_Tool_Admin::determineCsvDialect($file);

        $count = 0;
        if (($handle = fopen($file, "r")) !== false) {
            $data = fgetcsv($handle, 100000, ";",'"');
        }
        if ($skipFirstRow && $job == 1) {
            //read the next row, we need to skip the head row
            $data = fgetcsv($handle, 100000, ";",'"');
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
        //if ($this->getParam("overwrite") == "true") {
            $overwrite = true;
       // }
         // $canInsert = $parent->isAllowed("create");
          $canInsert = true;
          $isUpdating = false;
        if ($canInsert && $objectKey && $parent) {

            
            $intendedPath = $parent->getFullPath() . "/" . $objectKey;
            if ($overwrite) {
            	//echo "intendedPath : ".$intendedPath;
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
                    //use the existing objectecho "llll".$object;
                    $isUpdating = true;
                    echo "\nUpdate\n";

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
            $object->setParentId($parentId);
            $object->setKey($objectKey);
            $object->setCreationDate(time());
           	$object->setUserOwner($userId);
           	$object->setUserModification($userId);

            if ($data[$mapping["published"]] === "1") {
                $object->setPublished(true);
            } else {
                $object->setPublished(false);
            }

            foreach ($class->getFieldDefinitions() as $key => $field) {


                $value = $data[$mapping[$key]];
                if (array_key_exists($key, $mapping) and  $value != null) {

                    if($isUpdating && $key=="name")
                        continue;
                    // data mapping
                    $value = $field->getFromCsvImport($value);

                    if ($value !== null) {
                        $object->setValue($key, $value);
                        echo $key." ";
                    }
                }
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
                //$this->_helper->json(array("success" => false, "message" => $object->getKey() . " - " . $e->getMessage()));
            }
        }


        //$this->_helper->json(array("success" => $success));
    }
    //
    public function importEanProcessAction($job=1)
    {

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

        $mappingRaw = [[0,"Article","code"],[1,"Code_EAN_Article","ean"],[2,"Article Designation","name"],[3,"Epaisseur","epaisseur"],[4,"Largeur","largeur"],[5,"Longueur","longueur"],[6,"Base3",""],[7,"Choix","choix"],[8,"Article Famille","famille"]];
        
        $class = Object_Class::getById($classId );
        $skipFirstRow = true;
        $fields = $class->getFieldDefinitions();
       
   

        // currently only csv supported
        // determine type
        $dialect = Pimcore_Tool_Admin::determineCsvDialect($file);

        $count = 0;
        if (($handle = fopen($file, "r")) !== false) {
            $data = fgetcsv($handle, 100000, ";",'"');
        }
        if ($skipFirstRow && $job == 1) {
            //read the next row, we need to skip the head row
            $data = fgetcsv($handle, 100000, ";",'"');
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
            } else if ($map[1] == "published (system)") {
                $mapping["published"] = $map[0];
            }
        }
    
        //Sous produit, on vire le name
        $data[$mapping["name"]] = "";






        // create new object
        $className = "Object_" . ucfirst($className);

        $className = Pimcore_Tool::getModelClassMapping($className);

        $parent = Object_Abstract::getById($parentId);

        $articleParent = Object_Abstract::getByPath($parent->getFullPath() . "/" . $data[$mapping["code"]]);
        //print_r($mapping);
       

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
             echo "EAN existe ".$existingEan->getFullPath()."\n";
             
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
                    if($isUpdating && $key=="name")
                        continue;
                    if($isUpdating && $key=="code")
                        continue;
                    if($isUpdating && $key=="famille")
                        continue;
                    // data mapping
                    $value = $field->getFromCsvImport($value);

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


        public function importProduct($product)
    {

      
        $o_className = "product";
        $className=$o_className;
        $parentId = 2019;
        $classId = 5;
        $keyCol = 1;

        $userId = 6;

        $mappingRaw = [[0,"Article","code"],[1,"Code_EAN_Article","ean"],[2,"Article Designation","name"],[3,"Epaisseur","epaisseur"],[4,"Largeur","largeur"],[5,"Longueur","longueur"],[6,"Base3",""],[7,"Choix","choix"],[8,"Article Famille","famille"]];
        
        $class = Object_Class::getById($classId );
        $fields = $class->getFieldDefinitions();
       

        // create new object
        $className = "Object_" . ucfirst($className);

        $className = Pimcore_Tool::getModelClassMapping($className);

        $parent = Object_Abstract::getById($parentId);

        $articleParent = Object_Abstract::getByPath($parent->getFullPath() . "/" . $data[$mapping["code"]]);
        //print_r($mapping);
       

        $objectKey = Pimcore_File::getValidFilename($product["ean"]);
        
   
        $overwrite = true;
        $canInsert = true;
        $isUpdateing = false;


        $existingEan=null;
        $existingProductList = Object_Product::getByEan($data[$product["ean"]);
        //print_r($parent);
        if($existingProductList->count()==1) {
            $existingEan = $existingProductList->current();
             echo "EAN existe ".$existingEan->getFullPath()."\n";
             
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
                    if($isUpdating && $key=="name")
                        continue;
                    if($isUpdating && $key=="code")
                        continue;
                    if($isUpdating && $key=="famille")
                        continue;
                    // data mapping
                    $value = $field->getFromCsvImport($value);

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


        //$this->_helper->json(array("success" => $success));
    }

 }