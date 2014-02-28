<?php

class Texttemplates_TextTemplate_List extends Pimcore_Model_List_Abstract {

    /**
     * @var array
     */
    public $textTemplates;

    /**
     * @var array
     */
    public $textTemplatesGroupedByName;

    /**
     * @var array
     */
    public function isValidOrderKey($key) {
        if($key == "name" || $key == "language" || $key == "text" || $key == "description" || $key == "category") {
            return true;
        }
        return false;
    }

    /**
     * @return array
     */
    function getTextTemplates() {
        if(empty($this->textTemplates)) {
            $this->load();
        }
        return $this->textTemplates;
    }

    /**
     * @param array $textTemplates
     * @return void
     */
    function setTextTemplates($textTemplates) {
        $this->textTemplates = $textTemplates;
    }

    /**
     * @return array
     */
    function getTextTemplatesGroupedByName() {
        if(empty($this->textTemplatesGroupedByName)) {
            $this->loadGroupedByName();
        }
        return $this->textTemplatesGroupedByName;
    }

    /**
     * @param array $textTemplatesGroupedByName
     * @return void
     */
    function setTextTemplatesGroupedByName($textTemplatesGroupedByName) {
        $this->textTemplatesGroupedByName = $textTemplatesGroupedByName;
    }


}
