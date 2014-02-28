<?php

class Texttemplates_TextTemplateRelation_List_Resource extends Pimcore_Model_List_Resource_Abstract {

    /**
     * @return array
     */
    public function load() {

        $templates = array();

        $templatesRaw = $this->db->fetchAll("SELECT * FROM " . Texttemplates_TextTemplateRelation_Resource::TABLE_NAME .
                                                 $this->getCondition() . $this->getOrder() . $this->getOffsetLimit());

        foreach ($templatesRaw as $templateRaw) {
            $templates[] = Texttemplates_TextTemplateRelation::create($templateRaw);

        }

        $this->model->setTextTemplateRelations($templates);

        return $templates;
    }
}
