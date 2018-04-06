<?php

//namespace LpnPlugin;

use Pimcore\Model\Tool\Setup;
use Pimcore\Model\Translation\Admin;
use Pimcore\API\Plugin as PluginLib;

class LpnPlugin_Plugin  extends Pimcore_API_Plugin_Abstract implements Pimcore_API_Plugin_Interface {
    
	public function __construct($jsPaths = null, $cssPaths = null, $alternateIndexDir = null)
    {
        parent::__construct($jsPaths, $cssPaths);

        define('LPNPLUGIN_PATH', PIMCORE_PLUGINS_PATH . '/LpnPlugin');
        define('LPNPLUGIN_DEFAULT_ERROR_PATH', LPNPLUGIN_PATH . '/static/lang/errors');
        define('LPNPLUGIN_INSTALL_PATH', LPNPLUGIN_PATH . '/install');
        define('LPNPLUGIN_DATA_PATH', PIMCORE_WEBSITE_VAR . '/lpnplugin');
    }


     public static function install()
    {
        $setup = new Setup();
        $setup->insertDump( LPNPLUGIN_INSTALL_PATH . '/sql/install.sql' );

        if( !is_dir( LPNPLUGIN_DATA_PATH ) )
        {
            mkdir( LPNPLUGIN_DATA_PATH );
            mkdir(LPNPLUGIN_DATA_PATH . '/lang');
            mkdir(LPNPLUGIN_DATA_PATH . '/form');
        }

        //$csv = PIMCORE_PLUGINS_PATH . '/LpnPlugin/install/translations/data.csv';
        //Admin::importTranslationsFromFile($csv, true, \Pimcore\Tool\Admin::getLanguages());

        if (self::isInstalled())
        {
            $statusMessage = 'LpnPlugin has been successfully installed.<br>Please reload pimcore!';
        }
        else
        {
            $statusMessage = 'LpnPlugin  could not be installed.';
        }

        return $statusMessage;
    }

	

	public static function uninstall (){
        // implement your own logic here
        $db = \Pimcore\Db::get();
        $db->query('DROP TABLE `lpn_pimpampoum`');

        recursiveDelete( LPNPLUGIN_DATA_PATH );

        if (!self::isInstalled())
        {
            $statusMessage = 'LPN Plugin successfully uninstalled.';
        }
        else
        {
            $statusMessage = 'LPN Plugin could not be uninstalled';
        }

        return $statusMessage;
	}

	public static function needsReloadAfterInstall()
    {
        return false;
    }


	 public static function isInstalled()
    {
        $result = null;

        $db = \Pimcore\Db::get();

        try
        {
            $result = $db->query("SELECT * FROM `lpn_pimpampoum`") or die ("table lpn_pimpampoum doesn't exist.");
        }
        catch (\Zend_Db_Statement_Exception $e)
        {

        }

        return !empty($result);
    }

     /**
     * @param string $language
     * @return string path to the translation file relative to plugin directory
     */
    public static function getTranslationFile($language)
    {
        if(file_exists(LPNPLUGIN_PATH . '/static/texts/' . $language . '.csv'))
        {
            return '/LpnPlugin/static/texts/' . $language . '.csv';
        }

        return '/LpnPlugin/static/texts/en.csv';
    }


}
