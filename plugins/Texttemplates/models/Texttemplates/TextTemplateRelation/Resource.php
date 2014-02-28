<?php

class Texttemplates_TextTemplateRelation_Resource extends Pimcore_Model_Resource_Abstract {

    const TABLE_NAME = "plugin_texttemplates_relations";

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

    public function get($name, $targetType, $targetId, $targetFieldname, $variablesMd5) {

        $classRaw = $this->db->fetchRow("SELECT * FROM " . self::TABLE_NAME .
                                        " WHERE name=" . $this->db->quote($name) .
                                        " AND targetType=" . $this->db->quote($targetType) . " AND targetId=" . $this->db->quote($targetId) .
                                        " AND targetFieldname=" . $this->db->quote($targetFieldname) . " AND variablesMd5=" . $this->db->quote($variablesMd5)
        );
        if(empty($classRaw)) {
            throw new Exception("Texttemplate " . $name . " - " . $targetType . "_" . $targetId . "_ " . $targetFieldname . " not found");
        }
        $this->assignVariablesToModel($classRaw);
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

        $data["variablesMd5"] = md5($this->model->getVariables());

        try {
            $this->db->insert(self::TABLE_NAME, $data);
        } catch(Exception $e) {
            $this->db->update(self::TABLE_NAME, $data,
                  " name=" . $this->db->quote($this->model->getName()) .
                  " AND targetType=" . $this->db->quote($this->model->getTargetType()) . " AND targetId=" . $this->db->quote($this->model->getTargetId()) .
                  " AND targetFieldname=" . $this->db->quote($this->model->getTargetFieldname()) . " AND variablesMd5=" . $this->db->quote($data["variablesMd5"]));
        }
    }

    /**
     * Deletes object from database
     *
     * @return void
     */
    public function delete() {
//        echo " name=" . $this->db->quote($this->model->getName()) .
//                  " AND targetType=" . $this->db->quote($this->model->getTargetType()) . " AND targetId=" . $this->db->quote($this->model->getTargetId()) .
//                  " AND targetFieldname=" . $this->db->quote($this->model->getTargetFieldname()) . " AND variablesMd5=" . $this->db->quote(md5($this->model->getVariables()));

        $this->db->delete(self::TABLE_NAME,
                  " name=" . $this->db->quote($this->model->getName()) . 
                  " AND targetType=" . $this->db->quote($this->model->getTargetType()) . " AND targetId=" . $this->db->quote($this->model->getTargetId()) .
                  " AND targetFieldname=" . $this->db->quote($this->model->getTargetFieldname()) . " AND variablesMd5=" . $this->db->quote(md5($this->model->getVariables())));
    }

}
