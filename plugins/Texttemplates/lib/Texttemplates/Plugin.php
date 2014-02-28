<?php 

class Texttemplates_Plugin extends Pimcore_API_Plugin_Abstract implements Pimcore_API_Plugin_Interface {

    public static $configFile = "/Texttemplates/config.xml";

    /**
     * @return string $jsClassName
     */
    public static function getJsClassName(){
        return "pimcore.plugin.textTemplates";
    }

    /**
     * absolute path to the folder holding plugin translation files
     * @static
     * @return string
     */
    public static function getTranslationFileDirectory() {
        return PIMCORE_PLUGINS_PATH."/Texttemplates/texts";
    }

    /**
    *
    * @param string $language
    * @return string path to the translation file relative to plugin direcory
    */
	public static function getTranslationFile($language){
            if($language=="de"){
                return "/Texttemplates/texts/de.csv";
            } else if($language=="en"){
                return "/Texttemplates/texts/en.csv";
            } else {
                return null;
            }
            return null;
        }

    /**
     * @return string $statusMessage
     */
    public static function install() {
        $db = Pimcore_Resource::get();

        $db->query("CREATE TABLE `plugin_texttemplates_templates` (
              `name` varchar(150) COLLATE utf8_bin NOT NULL,
              `category` varchar(150) COLLATE utf8_bin NOT NULL,
              `description` longtext COLLATE utf8_bin NOT NULL,
              `language` varchar(10) COLLATE utf8_bin NOT NULL,
              `text` longtext COLLATE utf8_bin,
              `modificationDate` bigint(20) NOT NULL,
              PRIMARY KEY (`name`,`language`)
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;
        ");
        

        $db->query("CREATE TABLE `plugin_texttemplates_relations` (
              `name` varchar(150) COLLATE utf8_bin NOT NULL,
              `targetType` varchar(10) COLLATE utf8_bin NOT NULL,
              `targetId` bigint(20) NOT NULL,
              `targetFieldname` varchar(255) COLLATE utf8_bin NOT NULL,
              `variablesMd5` varchar(50) COLLATE utf8_bin NOT NULL,
              `variables` longtext COLLATE utf8_bin NOT NULL,
              `modificationDate` bigint(20) NOT NULL,
              UNIQUE KEY `unique` (`name`,`targetType`,`targetId`,`targetFieldname`,`variablesMd5`)
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;
        ");

    }

    /**
     * @return boolean $isInstalled
     */
    public static function isInstalled() {
		$result = null;
		try{
			$result = Pimcore_API_Plugin_Abstract::getDb()->describeTable("plugin_texttemplates_relations");
		} catch(Zend_Db_Exception $e){}
		return !empty($result);
    }

    /**
     * @return boolean $needsReloadAfterInstall
     */
    public static function needsReloadAfterInstall() {
        return true;
    }

    /**
     * @return boolean $readyForInstall
     */
    public static function readyForInstall() {
        return !self::isInstalled();
    }

    /**
     * @return string $statusMessage
     */
    public static function uninstall() {
        $db = Pimcore_Resource::get();
        $db->query("DROP TABLE IF EXISTS `plugin_texttemplates_templates`;");
        $db->query("DROP TABLE IF EXISTS `plugin_texttemplates_relations`;");
    }

    public function postUpdateObject(Object_Abstract $object) {
        if($object instanceof Object_Concrete) {
            $class = $object->getClass();
            $fielddefinitions = $class->getFieldDefinitions();
            foreach($fielddefinitions as $fd) {
                if($fd instanceof Object_Class_Data_TemplateWysiwyg) {

                    try {

                        Texttemplates_Service::removeOldTextTemplateRelations($object, $fd->getName());

                        $getter = "get" . ucfirst($fd->getName());
                        $text = $object->$getter(false);


                        $matches = Texttemplates_Service::getAllTextTemplates($text);

                        foreach($matches as $match) {
                            $def = Texttemplates_Service::getTextTemplateDefinition($match[1]);
                            Texttemplates_Service::createTextTemplateRelation($def->textTemplateName, $def->variables, $object, $fd->getName(), true);
                        }

                    } catch(Exception $e) {
                        Logger::err($e);
                        echo $e->getMessage();
                    }

                }

            }


        }

    }

    public function preDeleteObject(Object_Abstract $object) {
        if($object instanceof Object_Concrete) {

            $db = Pimcore_Resource::get();
            $list = new Texttemplates_TextTemplateRelation_List();
            $list->setCondition("targetType = 'object' AND targetId = " . $db->quote($object->getId()));
            $textTemplates = $list->getTextTemplateRelations();
            foreach($textTemplates as $tt) {
                $tt->delete();
            }
        }
    }

    public static function getConfig($readonly = true) {
        if(!$readonly) {
            $config = new Zend_Config_Xml(PIMCORE_PLUGINS_PATH . Texttemplates_Plugin::$configFile,
			                              null,
			                              array('skipExtends'        => true,
		    	                                'allowModifications' => true));
        } else {
            $config = new Zend_Config_Xml(PIMCORE_PLUGINS_PATH . Texttemplates_Plugin::$configFile);
        }
        return $config;
    }

    public static function getDefaultLanguage() {
        return self::getConfig()->default_language;
    }

    public static function setConfig($defaultLanguage) {


        $config = self::getConfig(false);
        $config->default_language = $defaultLanguage;

        // Write the config file
        $writer = new Zend_Config_Writer_Xml(array('config'   => $config,
                                                   'filename' => PIMCORE_PLUGINS_PATH . Texttemplates_Plugin::$configFile));
        $writer->write();
    }

}


