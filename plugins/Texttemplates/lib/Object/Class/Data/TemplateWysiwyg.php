<?php

class Object_Class_Data_TemplateWysiwyg extends Object_Class_Data_Wysiwyg {

    /**
     * Static type of this element
     *
     * @var string
     */
    public $fieldtype = "templateWysiwyg";

    /**
     * Type for the generated phpdoc
     *
     * @var string
     */
    public $phpdocType = "Object_Data_TemplateWysiwyg";

    /**
     * @see Object_Class_Data::getDataForResource
     * @param string $data
     * @param null|Object_Abstract $object
     * @return string
     */
    public function getDataForResource($data, $object = null) {
        if($data instanceof Object_Data_TemplateWysiwyg) {
            $data = $data->getRawText();
        }

        return $data;
    }

    /**
     * @see Object_Class_Data::getDataFromResource
     * @param string $data
     * @return string
     */
    public function getDataFromResource($data) {
        return Pimcore_Tool_Text::wysiwygText($data);
    }

    /**
     * @see Object_Class_Data::getDataForQueryResource
     * @param string $data
     * @param null|Object_Abstract $object
     * @return string
     */
    public function getDataForQueryResource($data, $object = null) {
        if($data instanceof Object_Data_TemplateWysiwyg) {
            return $data->getCompiledText();
        }

        $compiledData = Texttemplates_Service::compileTextTemplates($object, $data, $this->getName());
        return $compiledData;
    }


    /**
     * @see Object_Class_Data::getDataForEditmode
     * @param string $data
     * @param null|Object_Abstract $object
     * @return string
     */
    public function getDataForEditmode($data, $object = null) {
        return $this->getDataForResource($data, $object);
    }

    /**
     * @see Object_Class_Data::getDataFromEditmode
     * @param string $data
     * @return string
     */
    public function getDataFromEditmode($data, $object = null) {
        return $data;
    }

    /**
     * @param mixed $data
     */
    public function resolveDependencies($data) {
        if($data instanceof Object_Data_TemplateWysiwyg) {
            $data = $data->getCompiledText();
        }

        return Pimcore_Tool_Text::getDependenciesOfWysiwygText($data);
    }

    /**
     * @param mixed $data
     * @param Object_Concrete $ownerObject
     * @param array $blockedTags
     */
    public function getCacheTags($data, $ownerObject, $blockedTags = array()) {
        if($data instanceof Object_Data_TemplateWysiwyg) {
            $data = $data->getCompiledText();
        }

        return Pimcore_Tool_Text::getCacheTagsOfWysiwygText($data, $blockedTags);
    }


    /**
     * Checks if data is valid for current data field
     *
     * @param mixed $data
     * @param boolean $omitMandatoryCheck
     * @throws Exception
     */
    public function checkValidity($data, $omitMandatoryCheck = false){

        if($data instanceof Object_Data_TemplateWysiwyg) {
            $data = $data->getCompiledText();
        }


        if(!$omitMandatoryCheck and $this->getMandatory() and empty($data)){
            throw new Exception(get_class($this).": Empty mandatory field [ ".$this->getName()." ]");
        }
        $dependencies = Pimcore_Tool_Text::getDependenciesOfWysiwygText($data);
        if (is_array($dependencies)) {
            foreach ($dependencies as $key => $value) {
                $el = Element_Service::getElementById($value['type'], $value['id']);
                if (!$el) {
                    throw new Exception(get_class($this) . ": invalid dependency in wysiwyg text");
                }
            }
        }
    }

    /**
     * Checks if data for this field is valid and removes broken dependencies
     *
     * @param Object_Abstract $object
     * @return bool
     */
    public function sanityCheck($object) {
        $key = $this->getName();
        $originalText = $object->$key;
        $sane = true;
        $dependencies = Pimcore_Tool_Text::getDependenciesOfWysiwygText($object->$key);
        $cleanedText = Pimcore_Tool_Text::cleanWysiwygTextOfDependencies($object->$key,$dependencies);
        $object->$key = $cleanedText;
        if($originalText!=$cleanedText){
            $sane=false;
            logger::notice(get_class($this).": Detected insane relation, removed invalid links in html");
        }
        return $sane;
    }


    public function getGetterCode ($class) {
        // getter

        $key = $this->getName();
        $code = "";

        $code .= '/**' . "\n";
        $code .= '* @return ' . $this->getPhpdocType() . "\n";
        $code .= '*/' . "\n";
        $code .= "public function get" . ucfirst($key) . " (" . '$deliverRaw = false' . ") {\n";

        // adds a hook preGetValue which can be defined in an extended class
        $code .= "\t" . '$preValue = $this->preGetValue("' . $key . '");' . " \n";

        $code .= "\t" . 'if($preValue !== null && !Pimcore::inAdmin()) { return $preValue;}' . "\n";

        if(method_exists($this,"preGetData")) {
            $code .= "\t" . '$data = $this->getClass()->getFieldDefinition("' . $key . '")->preGetData($this);' . "\n";
        } else {
            $code .= "\t" . '$data = $this->' . $key . ";\n";
        }

        $code .= "\t" . 'if($data && (!$deliverRaw && !Pimcore::inAdmin())) { ' . "\n";
        $code .= "\t\t" . '$data = Texttemplates_Service::compileTextTemplates($this, $data, "' . $key . '");' . "\n";
        $code .= "\t" . '} ' . "\n";


        // insert this line if inheritance from parent objects is allowed
        if ($class->getAllowInherit()) {
            $code .= "\t" . 'if(!$data && Object_Abstract::doGetInheritedValues()) { ' . "\n";
            $code .= "\t\t" . '$data = $this->getValueFromParent("' . $key . '", array(true));' . "\n";
            $code .= "\t\t" . 'if($data && (!$deliverRaw && !Pimcore::inAdmin())) {' . "\n";
            $code .= "\t\t\t" . '$data = Texttemplates_Service::compileTextTemplates($this, $data, "' . $key . '");' . "\n";
            $code .= "\t\t" . '}' . "\n";
            $code .= "\t" . '}' . "\n";
        }

        $code .= "\treturn " . '$data' . ";\n";
        $code .= "}\n\n";

        return $code;
    }


    public function getGetterCodeObjectbrick ($brickClass) {
        $key = $this->getName();
        $code = '/**' . "\n";
        $code .= '* @return ' . $this->getPhpdocType() . "\n";
        $code .= '*/' . "\n";
        $code .= "public function get" . ucfirst($key) . " (" . '$deliverRaw = false' . ") {\n";

        $code .= "\t" . '$data = $this->' . $key . ";\n";

        $code .= "\t" . 'if($data && (!$deliverRaw && !Pimcore::inAdmin())) { ' . "\n";
        $code .= "\t\t" . '$data = Texttemplates_Service::compileTextTemplates($this->getObject(), $data, "' . $key . '");' . "\n";
        $code .= "\t" . '} ' . "\n";

        $code .= "\t" . 'if(!$data && Object_Abstract::doGetInheritedValues($this->getObject())) { ' . "\n";
        $code .= "\t\t" . '$data = $this->getValueFromParent("' . $key . '", array(true));' . "\n";
        $code .= "\t\t" . 'if($data && (!$deliverRaw && !Pimcore::inAdmin())) {' . "\n";
        $code .= "\t\t\t" . '$data = Texttemplates_Service::compileTextTemplates($this->getObject(), $data, "' . $key . '");' . "\n";
        $code .= "\t\t" . '}' . "\n";
        $code .= "\t" . '}' . "\n";

        $code .= "\treturn " . '$data' . ";\n";
        $code .= "}\n\n";

        return $code;
    }


    public function getGetterCodeFieldcollection ($fieldcollectionDefinition) {
        $key = $this->getName();
        $code = '/**' . "\n";
        $code .= '* @return ' . $this->getPhpdocType() . "\n";
        $code .= '*/' . "\n";
        $code .= "public function get" . ucfirst($key) . " (" . '$deliverRaw = false' . ") {\n";

        $code .= "\t" . '$data = $this->' . $key . ";\n";

        $code .= "\t" . 'if($data && (!$deliverRaw && !Pimcore::inAdmin())) { ' . "\n";
        $code .= "\t\t" . '$data = Texttemplates_Service::compileTextTemplates($this->getObject(), $data, "' . $key . '");' . "\n";
        $code .= "\t" . '} ' . "\n";

        $code .= "\treturn " . '$data' . ";\n";
        $code .= "}\n\n";

        return $code;
    }

    /**
     * Creates getter code which is used for generation of php file for localized fields in classes using this data type
     * @param $class
     * @return string
     */
    public function getGetterCodeLocalizedfields ($class) {
        $key = $this->getName();
        $code = '/**' . "\n";
        $code .= '* @return ' . $this->getPhpdocType() . "\n";
        $code .= '*/' . "\n";
        $code .= "public function get" . ucfirst($key) . ' ($language = null, $deliverRaw = false) {' . "\n";

        $code .= "\t" . '$data = $this->getLocalizedfields()->getLocalizedValue("' . $key . '", $language);' . "\n";

        // adds a hook preGetValue which can be defined in an extended class
        $code .= "\t" . '$preValue = $this->preGetValue("' . $key . '");' . " \n";
        $code .= "\t" . 'if($preValue !== null && !Pimcore::inAdmin()) { return $preValue;}' . "\n";


        $code .= "\t" . 'if($data && (!$deliverRaw && !Pimcore::inAdmin())) {' . "\n";
        $code .= "\t\t" . '$data = Texttemplates_Service::compileTextTemplates($this, $data, "' . $key . '");' . "\n";
        $code .= "\t" . '} ' . "\n";
        //$code .= "return $preValue;}' . "\n";

        $code .= "\treturn " . '$data' . ";\n";
        $code .= "}\n\n";

        return $code;
    }

}
