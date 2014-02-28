<?php
    
class Texttemplates_AdminController extends Pimcore_Controller_Action_Admin {


    public function gridProxyAction() {
        if ($this->_getParam("data")) {

        } else {

            $start = 0;
            $limit = 20;
            $orderKey = "name";
            $order = "ASC";

            if ($this->_getParam("limit")) {
                $limit = $this->_getParam("limit");
            }
            if ($this->_getParam("start")) {
                $start = $this->_getParam("start");
            }
            if ($this->_getParam("sort")) {
                if ($this->_getParam("sort") == "id") {
                    $orderKey = "o_id";
                } else {
                    $orderKey = $this->_getParam("sort");
                }
            } else {
                $orderKey = "category";
            }
            if ($this->_getParam("dir")) {
                $order = $this->_getParam("dir");
            }

            $condition = "1 = 1"; 
            if($this->_getParam("filter")) {
                $filterString = $this->_getParam("filter");
                $filters = json_decode($filterString);

                $db = Pimcore_Resource::get();
                foreach($filters as $f) {
                    if($f->field == "query") {
                        $symb = $db->getQuoteIdentifierSymbol();

                        $condition .= " AND (" . $symb . "name" . $symb . " LIKE " . $db->quote("%" . $f->value . "%") . " OR ";
                        $condition .= $symb . "category" . $symb . " LIKE " . $db->quote("%" . $f->value . "%") . " OR ";
                        $condition .= $symb . "description" . $symb . " LIKE " . $db->quote("%" . $f->value . "%") . ")";

                    } else {
                        $condition .= " AND " . $db->getQuoteIdentifierSymbol() . $f->field . $db->getQuoteIdentifierSymbol() . " LIKE " . $db->quote("%" . $f->value . "%");
                    }

                }
            }

            $list = new Texttemplates_TextTemplate_List();
            $list->setCondition($condition);
            $list->setLimit($limit);
            $list->setOffset($start);
            $list->setOrder($order);
            $list->setOrderKey(array($orderKey, "name"));

            $names = $list->getTextTemplatesGroupedByName();
            $objects = array();
            foreach ($names as $name) {
                $o = $this->getGridObjectData($name);
                if(!empty($o)) {
                    $objects[] = $o;
                }
            }

            $this->_helper->json(array("data" => $objects, "success" => true, "total" => $list->getTotalCount()));
        }
    }


    public function getDependenciesAction() {
        $tempateName = $this->_getParam("name");

        $dependencies = array();

        $textTemplateRelationList = new Texttemplates_TextTemplateRelation_List();
        $db = Pimcore_Resource::get();
        $textTemplateRelationList->setCondition("name = " . $db->quote($tempateName));
        $textTemplateRelations = $textTemplateRelationList->getTextTemplateRelations();

        if(!empty($textTemplateRelations)) {
            foreach($textTemplateRelations as $ttr) {
                $id = $ttr->getTargetId();
                $type = $ttr->getTargetType();

                if ($type == "document") {
                    $element = Document::getById($id);
                    if(!empty($element)) {
                        $dependencies[$id] = array(
                            "id" => $element->getId(),
                            "path" => $element->getFullPath(),
                            "type" => "document",
                            "subtype" => $element->getType()
                        );
                    }
                }
                else if ($type == "object") {

                    $element = Object_Abstract::getById($id);
                    if(!empty($element)) {
                        $dependencies[$id] = array(
                            "id" => $element->getId(),
                            "path" => $element->getFullPath(),
                            "type" => "object",
                            "subtype" => $element->geto_Type()
                        );
                    }
                }

            }
        }

        $this->_helper->json(array("dependencies" => array_values($dependencies)));
    }

    public function getTexttemplateAction() {

        $name = $this->_getParam("name");
        $templateList = new Texttemplates_TextTemplate_List();
        $db = Pimcore_Resource::get();
        $templateList->setCondition("name = " . $db->quote($name));
        $templates = $templateList->getTextTemplates();

        $textTemplateObject =  array();
        $textTemplateObject['name'] = $name;
        $textTemplateObject['languages'] = Pimcore_Tool::getValidLanguages();
        if(!empty($templates)) {
            foreach($templates as $t) {
                $textTemplateObject['category'] = $t->getCategory();
                $textTemplateObject['description'] = $t->getDescription();
                $textTemplateObject[$t->getLanguage()] = $t->getText();
            }
        }

        $this->_helper->json(array("success" => true, "data" => $textTemplateObject));
    }

    public function saveTexttemplateAction() {
        $name = $this->_getParam("name");
        if(empty($name)) {
            $this->_helper->json(array("success" => false, "message" => "texttempalte_name_empty"));
        }

        try {
            $data = json_decode($this->_getParam("data"));

            $languages = Pimcore_Tool::getValidLanguages();
            foreach($languages as $l) {
                $template = Texttemplates_TextTemplate::getByNameLanguage($name, $l);

                if(!empty($template)) {
                    $template->setText($data->$l);
                } else {
                    $template = new Texttemplates_TextTemplate();
                    $template->setName($name);
                    $template->setLanguage($l);
                    $template->setText($data->$l);
                }

                $template->setCategory($data->category);
                $template->setDescription($data->description);
                $template->save();
            }
            $this->_helper->json(array("success" => true));
        } catch(Exception $e) {
            $this->_helper->json(array("success" => false, "message" => $e->getMessage()));
        }
    }

    public function renameTexttemplateAction() {
        $name = $this->_getParam("name");
        $old_name = $this->_getParam("old_name");
        if(empty($old_name)) {
            $this->_helper->json(array("success" => false, "message" => "texttempalte_name_empty"));
        }

        if(Texttemplates_TextTemplate::templateExists($name)) {
            $this->_helper->json(array("success" => false, "message" => "texttempalte_name_already_in_use"));
        }

        try {
            $languages = Pimcore_Tool::getValidLanguages();
            foreach($languages as $l) {
                $template = Texttemplates_TextTemplate::getByNameLanguage($old_name, $l);

                if(!empty($template)) {
                    $template->rename($name);
                    $template->save();
                }
            }
            $this->_helper->json(array("success" => true));
        } catch(Exception $e) {
            $this->_helper->json(array("success" => false, "message" => $e->getMessage()));
        }
    }

    public function createNewTexttemplateAction() {
        $name = $this->_getParam("name");
        if(empty($name)) {
            $this->_helper->json(array("success" => false, "message" => "texttempalte_name_empty"));
        }

        try {
            if(Texttemplates_TextTemplate::templateExists($name)) {
                $this->_helper->json(array("success" => false, "message" => "texttempalte_name_already_in_use"));
            } else {
                $languages = Pimcore_Tool::getValidLanguages();
                foreach($languages as $l) {
                    $template = new Texttemplates_TextTemplate();
                    $template->setName($name);
                    $template->setLanguage($l);
                    $template->save();
                }
                $this->_helper->json(array("success" => true));
            }

        } catch(Exception $e) {
            $this->_helper->json(array("success" => false, "message" => $e->getMessage()));
        }
    }



    public function deleteTexttemplateAction() {
        $name = $this->_getParam("name");
        if(empty($name)) {
            $this->_helper->json(array("success" => false, "message" => "texttempalte_name_empty"));
        }

        try {
            Texttemplates_TextTemplate::deleteAllLanguages($name);
            $this->_helper->json(array("success" => true));
        } catch(Exception $e) {
            $this->_helper->json(array("success" => false, "message" => $e->getMessage()));
        }
    }

    private function getGridObjectData($name) {
        $texttemplate = Texttemplates_TextTemplate::getByNameLanguage($name, Texttemplates_Plugin::getDefaultLanguage());

        $data = array(
            "name" => $name
        );

        if($texttemplate) {
            $languages = Pimcore_Tool::getValidLanguages();
            $variableNames = array();
            foreach($languages as $l) {
                $t = Texttemplates_TextTemplate::getByNameLanguage($name, $l);
                if(!empty($t)) {
                    $variables = Texttemplates_Service::getAllVariables($t->getText());
                    if(!empty($variables)) {
                        foreach($variables as $v) {
                            $variableNames[$v[1]] = $v[1];
                        }
                    }
                }
            }

            $data["variables"] = array_values($variableNames);
            $date =  new Zend_Date($texttemplate->getModificationDate());
            $data["modificationDate"] = $date->get(Zend_Date::DATETIME_MEDIUM);
            $data["text"] = $texttemplate->getText();
            $data["category"] = $texttemplate->getCategory();
            $data["description"] = $texttemplate->getDescription();
        }

        return $data;
    }

    public function settingsAction() {
        if($this->getRequest()->isPost()) {
            Texttemplates_Plugin::setConfig($this->_getParam("default_language"));
            $this->view->default_language = Texttemplates_Plugin::getConfig()->default_language;
        } else {
            $this->view->default_language = Texttemplates_Plugin::getConfig()->default_language;
        }
    }



}
