<?php

class Sitemap_Plugin extends Pimcore_API_Plugin_Abstract implements Pimcore_API_Plugin_Interface {

    public static function install() {
        Pimcore_API_Plugin_Abstract::getDb()->query("CREATE TABLE IF NOT EXISTS `plugin_sitemap` (
		`id` INT NOT NULL AUTO_INCREMENT,
                `name` varchar(255) DEFAULT NULL ,
		`date` INT NULL ,
			  PRIMARY KEY  (`id`),                          
                        UNIQUE KEY `name` (`name`)
			) ENGINE=MyISAM DEFAULT CHARSET=utf8;");

        if (self::isInstalled()) {
            $statusMessage = "Navigation Plugin successfully installed.";
        } else {
            $statusMessage = "Navigation Plugin could not be installed";
        }
        return $statusMessage;
    }

    public static function needsReloadAfterInstall() {
        return true;
    }

    public static function uninstall() {
        Pimcore_API_Plugin_Abstract::getDb()->query("DROP TABLE `plugin_sitemap`");

        $rep = PIMCORE_PLUGINS_PATH . "/Sitemap/data/";
        if (is_dir($rep)) {
            $dir = opendir($rep);
            while ($f = readdir($dir)) {
                if(substr($f,0,4)=="menu"){
                if (file_exists($rep . $f)) {
                    unlink($rep . $f);
                }
                }
            }
        }

        if (!self::isInstalled()) {
            $statusMessage = "Navigation Plugin successfully uninstalled.";
        } else {
            $statusMessage = "Navigation Plugin could not be uninstalled";
        }
        return $statusMessage;
    }

    public static function isInstalled() {
        $result = null;
        try {
            $result = Pimcore_API_Plugin_Abstract::getDb()->query("SELECT * FROM `plugin_sitemap`") or die ("La table n'existe pas");
        } catch (Zend_Db_Statement_Exception $e) {

        }
        return!empty($result);
    }

    public function preDispatch() {

    }

    /**
     *
     * @param string $language
     * @return string path to the translation file relative to plugin direcory
     */
    public static function getTranslationFile($language) {
        if(file_exists(PIMCORE_PLUGINS_PATH . "/Sitemap/texts/" . $language . ".csv")){
            return "/Sitemap/texts/" . $language . ".csv";
        }
        return "/Sitemap/texts/en.csv";
        
    }

}