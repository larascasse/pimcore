<?php

class Texttemplates_TextTemplateRelation_List extends Pimcore_Model_List_Abstract {

    /**
     * @var array
     */
    public $textTemplateRelations;


    /**
     * @var array
     */
    public function isValidOrderKey($key) {
        if($key == "name" || $key == "language" || $key == "targetType" || $key == "targetId" || $key == "targetFieldname") {
            return true;
        }
        return false;
    }

    /**
     * @return array
     */
    function getTextTemplateRelations() {
        if(empty($this->textTemplateRelations)) {
            $this->load();
        }
        return $this->textTemplateRelations;
    }

    /**
     * @param array $textTemplateRelations
     * @return void
     */
    function setTextTemplateRelations($textTemplateRelations) {
        $this->textTemplateRelations = $textTemplateRelations;
    }
}
