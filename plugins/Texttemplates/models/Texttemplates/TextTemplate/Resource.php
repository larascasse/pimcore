<?php

class Texttemplates_TextTemplate_Resource extends Pimcore_Model_Resource_Abstract {

    const TABLE_NAME = "plugin_texttemplates_templates";

    /**
     * Contains all valid columns in the database table
     *
     * @var array
     */
    protected $validColumns = array();

    /**
     * Get the valid columns from the database
     *
     * @return void
     */
    public function init() {
        $this->validColumns = $this->getValidTableColumns(self::TABLE_NAME);
    }

    /**
     * @param string $name
     * @param string $language
     * @return void
     */
    public function getByNameLanguage($name, $language) {

        $classRaw = $this->db->fetchRow("SELECT * FROM " . self::TABLE_NAME . " WHERE name=" . $this->db->quote($name) . " AND language=" . $this->db->quote($language));
        if(empty($classRaw)) {
            throw new Exception("Texttemplate " . $name . " (" . $language . ") not found.");
        }
        $this->assignVariablesToModel($classRaw);

    }

    /**
     * @param string $name
     * @return void
     */
    public function templateExists($name) {
        $classRaw = $this->db->fetchRow("SELECT * FROM " . self::TABLE_NAME . " WHERE name=" . $this->db->quote($name));
        return !empty($classRaw);
    }

    /**
     * Save object to database
     *
     * @return void
     */
    public function save() {
        return $this->update();
    }

    /**
     * @return void
     */
    public function update() {

        $class = get_object_vars($this->model);
        foreach ($class as $key => $value) {
            if (in_array($key, $this->validColumns)) {

                if (is_array($value) || is_object($value)) {
                    $value = serialize($value);
                } else  if(is_bool($value)) {
                    $value = (int)$value;
                }
                $data[$key] = $value;
            }
        }

        try {
            $this->db->insert(self::TABLE_NAME, $data);
        } catch(Exception $e) {
            $this->db->update(self::TABLE_NAME, $data, "name=" . $this->db->quote($this->model->getName()) . " AND language=" . $this->db->quote($this->model->getLanguage()));
        }
    }

    public function rename($newName) {
        $data = array('name' => $newName);
        $this->db->update(self::TABLE_NAME, $data, "name=" . $this->db->quote($this->model->getName()) . " AND language=" . $this->db->quote($this->model->getLanguage()));
        $this->model->setName($newName);
    }

    /**
     * Deletes object from database
     *
     * @return void
     */
    public function delete() {
        $this->db->delete(self::TABLE_NAME, "name=" . $this->db->quote($this->model->getName()) . " AND language=" . $this->db->quote($this->model->getLanguage()));
    }

}
