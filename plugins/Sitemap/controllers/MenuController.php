<?php

/**
 * Pimcore
 *
 * LICENSE
 *
 * This source file is subject to the new BSD license that is bundled
 * with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://www.pimcore.org/license
 *
 * @copyright  Copyright (c) 2009-2010 elements.at New Media Solutions GmbH (http://www.elements.at)
 * @license    http://www.pimcore.org/license     New BSD License
 */
class Sitemap_MenuController extends Pimcore_Controller_Action_Admin {

    public function init() {
        parent::init();

        // check permissions
        $notRestrictedActions = array("get-tree");
        if (!in_array($this->_getParam("action"), $notRestrictedActions)) {
            if (!$this->getUser()->isAllowed("classes")) {

                $this->_redirect("/admin/login");
                die();
            }
        }
    }

    public function getDocumentTypesAction() {
        $documentTypes = Document::getTypes();
        $typeItems = array();
        foreach ($documentTypes as $documentType) {
            $typeItems[] = array(
                "text" => $documentType
            );
        }
        $this->_helper->json($typeItems);
    }

    public function getAssetTypesAction() {
        $assetTypes = Asset::getTypes();
        $typeItems = array();
        foreach ($assetTypes as $assetType) {
            $typeItems[] = array(
                "text" => $assetType
            );
        }
        $this->_helper->json($typeItems);
    }

    public function getTreeAction() {
        $menuList = new Sitemap_Sitemap();
        $menus = $menuList->read();


        $menuItems = array();

        foreach ($menus as $menuItem) {
            $menuItems[] = array(
                "id" => $menuItem->id,
                "text" => $menuItem->name,
                "icon" => ""
            );
        }

        $this->_helper->json($menuItems);
    }

    public function getAction() {
        $id = $this->_getParam("id");

        if(file_exists(PIMCORE_PLUGINS_PATH . "/Sitemap/data/menu_" . $id . ".xml")){
            $config = new Zend_Config_Xml(PIMCORE_PLUGINS_PATH . "/Sitemap/data/menu_" . $id . ".xml");

            $data = $config->toArray();
            $this->_helper->json($data);
        }else{
            $this->_helper->json(null);
        }

        
    }

    public function addAction() {
        $table = new Sitemap_Sitemap();
        $name = $this->correctClassname($this->_getParam("name"));
        $id = $table->create($name);
        $settings = array(
            "id"=>$id,
            "name"=>$name
        );

        if(!is_dir(PIMCORE_PLUGINS_PATH . "/Sitemap/data/")){
            mkdir(PIMCORE_PLUGINS_PATH . "/Sitemap/data/");
        }

        if(file_exists(PIMCORE_PLUGINS_PATH . "/Sitemap/data/menu_" . $id . ".xml")){
            unlink(PIMCORE_PLUGINS_PATH . "/Sitemap/data/menu_" . $id . ".xml");
        }

        $config = new Zend_Config($settings, true);
        $writer = new Zend_Config_Writer_Xml(array(
                    "config" => $config,
                    "filename" => PIMCORE_PLUGINS_PATH . "/Sitemap/data/menu_" . $id . ".xml"
                ));

        $writer->write();


        $this->removeViewRenderer();
    }

    public function deleteAction() {
        $id = $this->_getParam("id");
        $table = new Sitemap_Sitemap();
        $table->delete(intval($id));
        if(file_exists(PIMCORE_PLUGINS_PATH . "/Sitemap/data/menu_" . $id . ".xml")){
            unlink(PIMCORE_PLUGINS_PATH . "/Sitemap/data/menu_" . $id . ".xml");
        }
        $this->removeViewRenderer();
    }

    public function previewAction() {


        $configuration = Zend_Json::decode($this->_getParam("configuration"));
        $values = Zend_Json::decode($this->_getParam("values"));



        if(!is_dir(PIMCORE_PLUGINS_PATH . "/Sitemap/data/")){
            mkdir(PIMCORE_PLUGINS_PATH . "/Sitemap/data/");
        }

        if(file_exists(PIMCORE_PLUGINS_PATH . "/Sitemap/data/menu_preview.xml")){
            unlink(PIMCORE_PLUGINS_PATH . "/Sitemap/data/menu_preview.xml");
        }

        $settings = $values;
        $settings["menuDefinitions"]=$configuration;

        $config = new Zend_Config($settings, true);
        $writer = new Zend_Config_Writer_Xml(array(
                    "config" => $config,
                    "filename" => PIMCORE_PLUGINS_PATH . "/Sitemap/data/menu_preview.xml"
                ));
        $writer->write();

        $nav = new Navigation_Navigation();
       
        $navObj = $nav->getNavigation(-1);
        $ret = $this->view->navigation()->menu()->renderMenu($navObj);
        $this->_helper->json(array("data"=>$ret));
        $this->removeViewRenderer();
    }

    public function saveAction() {
        $id = $this->_getParam("id");

       $table = new Sitemap_Sitemap();
       $name = $table->getName($id);
        

        $configuration = Zend_Json::decode($this->_getParam("configuration"));
        $values = Zend_Json::decode($this->_getParam("values"));

        if ($values["name"] != $name) {
            $values["name"] = $this->correctClassname($values["name"]);
            $table = new Sitemap_Sitemap();
            $table->rename($id,$values["name"]);
        }

        if(!is_dir(PIMCORE_PLUGINS_PATH . "/Sitemap/data/")){
            mkdir(PIMCORE_PLUGINS_PATH . "/Sitemap/data/");
        }

        if(file_exists(PIMCORE_PLUGINS_PATH . "/Sitemap/data/menu_" . $id . ".xml")){
            unlink(PIMCORE_PLUGINS_PATH . "/Sitemap/data/menu_" . $id . ".xml");
        }

        $settings = $values;
        $settings["menuDefinitions"]=$configuration;

        $config = new Zend_Config($settings, true);
        $writer = new Zend_Config_Writer_Xml(array(
                    "config" => $config,
                    "filename" => PIMCORE_PLUGINS_PATH . "/Sitemap/data/menu_" . $id . ".xml"
                ));
        $writer->write();
 
        $this->removeViewRenderer();
    }


    protected function correctClassname($name) {
        $tmpFilename = $name;
        $validChars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ";
        $filenameParts = array();

        for ($i = 0; $i < strlen($tmpFilename); $i++) {
            if (strpos($validChars, $tmpFilename[$i]) !== false) {
                $filenameParts[] = $tmpFilename[$i];
            }
        }

        return implode("", $filenameParts);
    }

    /**
     * FIELDCOLLECTIONS
     */
    public function fieldcollectionGetAction() {
        $fc = Object_Class_Fieldcollection::getByKey($this->_getParam("id"));
        $this->_helper->json($fc);
    }

    public function fieldcollectionUpdateAction() {





        $fc = new Object_Class_Fieldcollection();
        $fc->setKey($this->_getParam("key"));

        if ($this->_getParam("values")) {
            $values = Zend_Json::decode($this->_getParam("values"));
            $fc->setName($values["name"]);
            $fc->setDescription($values["description"]);
        }

        if ($this->_getParam("configuration")) {
            $configuration = Zend_Json::decode($this->_getParam("configuration"));

            $configuration["datatype"] = "layout";
            $configuration["fieldtype"] = "panel";

            $layout = $this->generateLayoutTreeFromArray($configuration);
            $fc->setLayoutDefinitions($layout);
        }

        $fc->save();


        $this->_helper->json(array("success" => true));
    }

    public function fieldcollectionDeleteAction() {
        $fc = Object_Class_Fieldcollection::getByKey($this->_getParam("id"));
        $fc->delete();

        $this->_helper->json(array("success" => true));
    }

    public function fieldcollectionTreeAction() {

        $list = new Object_Class_Fieldcollection_List();
        $list = $list->load();

        $items = array();

        foreach ($list as $fc) {
            $items[] = array(
                "id" => $fc->getKey(),
                "text" => $fc->getKey()
            );
        }

        $this->_helper->json($items);
    }

    public function fieldcollectionListAction() {

        $list = new Object_Class_Fieldcollection_List();
        $list = $list->load();

        $this->_helper->json(array("fieldcollections" => $list));
    }

}
