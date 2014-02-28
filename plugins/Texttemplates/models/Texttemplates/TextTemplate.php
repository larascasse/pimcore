<?php

class Texttemplates_TextTemplate extends Pimcore_Model_Abstract {

    /**
     * @var string
     */
    public $name;

    /**
     * @var string
     */
    public $language;    


    /**
     * @var string
     */
    public $text;


    /**
     * @var int
     */
    public $modificationDate;

    /**
     * @var string
     */
    public $category;

    /**
     * @var string
     */
    public $description;

    /**
     * @param string $name
     * @param string $language
     * @return Texttemplates_TextTemplate
     */
    public static function getByNameLanguage($name, $language) {

        $cacheKey = Texttemplates_TextTemplate_Resource::TABLE_NAME . "_" . $name . "_" . $language;

        try {
            $template = Zend_Registry::get($cacheKey);
        }
        catch (Exception $e) {

            try {
                $template = new self();
                $template->getResource()->getByNameLanguage($name, $language);
                Zend_Registry::set($cacheKey, $template);
            } catch(Exception $ex) {
                Logger::debug($ex->getMessage());
                return null;
            }

        }

        return $template;
    }

    /**
     * @param string $name
     * @return boolean
     */
    public static function templateExists($name) {
        $template = new self();
        return $template->getResource()->templateExists($name);
    }

    /**
     * @param array $values
     * @return Texttemplates_TextTemplate
     */
    public static function create($values = array()) {
        $template = new self();
        $template->setValues($values);
        return $template;
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
        $cacheKey = Texttemplates_TextTemplate_Resource::TABLE_NAME . "_" . $this->getName() . "_" . $this->getLanguage();
        Zend_Registry::set($cacheKey, null);
        $this->getResource()->delete();
    }


    public static function deleteAllLanguages($name) {
        $list = new Texttemplates_TextTemplate_List();

        $db = Pimcore_Resource::get();
        $list->setCondition("name = " . $db->quote($name));

        $items = $list->getTextTemplates();
        foreach($items as $i) {
            $i->delete();
        }
    }


    public function __toString() {
        return ucfirst($this->getName() . " (" . $this->getLanguage() . ")");
    }

    public function setLanguage($language)
    {
        $this->language = $language;
    }

    public function getLanguage()
    {
        return $this->language;
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

    public function setText($text)
    {
        $this->text = $text;
    }

    public function getText()
    {
        return $this->text;
    }

    /**
     * @param string $category
     */
    public function setCategory($category)
    {
        $this->category = $category;
    }

    /**
     * @return string
     */
    public function getCategory()
    {
        return $this->category;
    }

    /**
     * @param string $description
     */
    public function setDescription($description)
    {
        $this->description = $description;
    }

    /**
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

}
