<?php

class Texttemplates_TextTemplateRelation extends Pimcore_Model_Abstract {


    /**
     * @var string
     */
    public $name;

    /**
     * @var string
     */
    public $targetType;

    /**
     * @var int
     */
    public $targetId;

    /**
     * @var string
     */
    public $targetFieldname;

    /**
     * @var string
     */
    public $variables;      

    /**
     * @var int
     */
    public $modificationDate;


    /**
     * @static
     * @param  $name
     * @param  $language
     * @param  $targetType
     * @param  $targetId
     * @param  $targetFieldname
     * @return Texttemplates_TextTemplateRelation
     */
    public static function get($name, $targetType, $targetId, $targetFieldname) {
        try {
            $textTemplateRelation = new self();
            $textTemplateRelation->getResource()->get($name, $targetType, $targetId, $targetFieldname);
            return $textTemplateRelation;
        } catch(Exception $e) {
            Logger::debug($e->getMessage());
            return null;
        }
    }

    /**
     * @param array $values
     * @return Texttemplates_TextTemplateRelation
     */
    public static function create($values = array()) {
        $textTemplateRelation = new self();
        $textTemplateRelation->setValues($values);

        return $textTemplateRelation;
    }

    /**
     * @return void
     */
    public function save() {
        $this->setModificationDate(time());
        $this->getResource()->save();
    }

    /**
     * @return void
     */
    public function delete() {
        $this->getResource()->delete();
    }


    public function __toString() {
        return $this->getName() . "(" . $this->getLanguage() . ") - " . $this->getTargetType() . "_" . $this->getTargetId() . "_ " . $this->getTargetFieldname();
    }


    public function setModificationDate($modificationDate)
    {
        $this->modificationDate = $modificationDate;
    }

    public function getModificationDate()
    {
        return $this->modificationDate;
    }

    public function setName($name)
    {
        $this->name = $name;
    }

    public function getName()
    {
        return $this->name;
    }

    public function setTargetFieldname($targetFieldname)
    {
        $this->targetFieldname = $targetFieldname;
    }

    public function getTargetFieldname()
    {
        return $this->targetFieldname;
    }

    public function setTargetId($targetId)
    {
        $this->targetId = $targetId;
    }

    public function getTargetId()
    {
        return $this->targetId;
    }

    public function setTargetType($targetType)
    {
        $this->targetType = $targetType;
    }

    public function getTargetType()
    {
        return $this->targetType;
    }

    public function setVariables($variables)
    {
        $this->variables = $variables;
    }

    public function getVariables()
    {
        return $this->variables;
    }

    public function getVariablesMd5() {
        return md5($this->getVariables());
    }

}
