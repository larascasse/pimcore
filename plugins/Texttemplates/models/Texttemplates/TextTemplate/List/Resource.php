<?php

class Texttemplates_TextTemplate_List_Resource extends Pimcore_Model_List_Resource_Abstract {


    protected $totalCount = 0;
    
    /**
     * @return array
     */
    public function load() {

        $templates = array();

        $templatesRaw = $this->db->fetchAll("SELECT name, language FROM " . Texttemplates_TextTemplate_Resource::TABLE_NAME .
                                                 $this->getCondition() . $this->getOrder() . $this->getOffsetLimit());

        $amount = $this->db->fetchRow("SELECT count(*) AS amount FROM " . Texttemplates_TextTemplate_Resource::TABLE_NAME .
                                                 $this->getCondition() . $this->getOrder());
        $this->totalCount = $amount["amount"];

        foreach ($templatesRaw as $templateRaw) {
            $templates[] = Texttemplates_TextTemplate::getByNameLanguage($templateRaw['name'], $templateRaw['language']);

        }

        $this->model->setTextTemplates($templates);

        return $templates;
    }

    public function getTotalCount() {
        return $this->totalCount;
    }


    /**
     * @return array
     */
    public function loadGroupedByName() {
        $templatesRaw = $this->db->fetchCol("SELECT name FROM " . Texttemplates_TextTemplate_Resource::TABLE_NAME .
                                                 $this->getCondition() . " GROUP BY name " . $this->getOrder() . $this->getOffsetLimit());

        $amount = $this->db->fetchRow("SELECT count(DISTINCT name) AS amount FROM " . Texttemplates_TextTemplate_Resource::TABLE_NAME . $this->getCondition());
        $this->totalCount = $amount["amount"];

        $this->model->setTextTemplatesGroupedByName($templatesRaw);
        return $templatesRaw;
    }


}
