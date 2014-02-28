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
 *
 */

class Tools_Plugin extends Pimcore_API_Plugin_Abstract implements Pimcore_API_Plugin_Interface
{


    public function __construct($jsPaths, $cssPaths)
    {

        parent::__construct($jsPaths, $cssPaths);


    }

    /**
     *
     * @return string $jsPluginClassName
     */
    public static function getJsClassName()
    {
        return "pimcore.plugin.tools";
    }

    /**
     *
     * @return boolean $needsUiReloadAfterInstall
     */
    public static function needsReloadAfterInstall()
    {
        return false;
    }

    /**
     *  indicates wether this plugins is currently installed
     * @return boolean $isInstalled
     */
    public static function isInstalled()
    {
        return true;

    }

    /**
     * @return boolean $readyForInstall
     */
    public static function readyForInstall()
    {

        $readyForInstall = true;
        if (file_exists(PIMCORE_PLUGINS_PATH . self::$configFile)) {
            $searchConf = new Zend_Config_Xml(PIMCORE_PLUGINS_PATH . self::$configFile);

            if (!is_dir(PIMCORE_WEBSITE_PATH . "/var/tmp") or !is_writable(PIMCORE_WEBSITE_PATH . "/var/tmp")) {
                $readyForInstall = false;
            }
            if (!is_dir(PIMCORE_WEBSITE_PATH . "/var") or !is_writable(PIMCORE_WEBSITE_PATH . "/var")) {
                $readyForInstall = false;
            }
            if (!is_writable(PIMCORE_PLUGINS_PATH)) {
                $readyForInstall = false;
            }
            if (Pimcore_Version::$revision < 780) {
                $readyForInstall = false;
            }

        } else {
            $readyForInstall = false;
        }
        return $readyForInstall;
    }


    /**
     *  install function
     * @return string $message statusmessage to display in frontend
     */
    public static function install()
    {
        $message = "Tools erfolgreich installiert";
        return $message;
    }

    /**
     * uninstall function
     * @return string $messaget status message to display in frontend
     */
    public static function uninstall()
    {
        return "not possible";
    }


    /**
     * Hook called when maintenance script is called
     */
    public function maintainance()
    {

        if (self::isInstalled()) {
            logger::log("Tools Plugin Start ");


        }
        else {
            logger::crit("internal Error");
        }
    }

    public function preDispatch()
    {

    }

    public function Dispach()
    {
        // @todo geht nicht
    }
}
