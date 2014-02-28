<?php

class Texttemplates_PreviewController extends Pimcore_Controller_Action {

    public function getPreviewAction() {
        $objectId = $this->_getParam("object_id");
        $fieldName = $this->_getParam("fieldname");
        $data = $this->_getParam("data");

        $object = Object_Abstract::getById($objectId);
        echo Texttemplates_Service::compileTextTemplates($object, $data, $fieldName);
        exit;
    }


    public function testAction() {

        $template = new Texttemplates_TextTemplate();
        $template->setName("myTemplate");
        $template->setLanguage("en");
        $template->setText("EN Das ist mein Text .... yeaaaaa");
        $template->save();


        $list = new Texttemplates_TextTemplate_List();
        $list->setCondition("language = 'de'");
        var_dump($list->getTextTemplates());


        $template = Texttemplates_TextTemplate::getByNameLanguage("myTemplate", "en");
        p_r($template);


        die("YEAAAAA");
    }

    public function test2Action() {

        $object = Object_Concrete::getById(50);

        echo $object->getTemp();


        die("<br/><br/>YEAAA1");


    }

}
