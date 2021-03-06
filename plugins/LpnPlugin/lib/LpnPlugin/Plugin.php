<?php

namespace LpnPlugin;

use Pimcore\Model\Tool\Setup;
use Pimcore\Model\Translation\Admin;

use Pimcore\API\Plugin as PluginLib;
use Pimcore\WorkflowManagement\Workflow;

use Pimcore\Model\User;

class Plugin extends PluginLib\AbstractPlugin implements PluginLib\PluginInterface {
    
	public function __construct($jsPaths = null, $cssPaths = null, $alternateIndexDir = null)
    {
        parent::__construct($jsPaths, $cssPaths);

        define('LPNPLUGIN_PATH', PIMCORE_PLUGINS_PATH . '/LpnPlugin');
        define('LPNPLUGIN_DEFAULT_ERROR_PATH', LPNPLUGIN_PATH . '/static/lang/errors');
        define('LPNPLUGIN_INSTALL_PATH', LPNPLUGIN_PATH . '/install');
        define('LPNPLUGIN_DATA_PATH', PIMCORE_WEBSITE_VAR . '/lpnplugin');
    }


     public function init() {
        
        parent::init();


        \Pimcore::getEventManager()->attach("lpn.azure.postUpdate", function (\Zend_EventManager_Event $e) {
            $products = $e->getTarget();

            $returnValueContainer = $e->getParam('returnValueContainer');

            //On fait un SQL direct pour aller plus vite, surtout pour le batch
            $tryQuickMode = $e->getParam('tryQuickMode');

            if(is_array($products)) {

                $userId = 6;
                $user = User::getById($userId);

                 $oldUser =  \Pimcore\Tool\Admin::getCurrentUser();
                \Zend_Registry::set("pimcore_admin_user", $user);

                foreach ($products  as $product) {

                    $action = "settomagentosync";
                    $newState = "needs_magento_sync";
                    $newStatus = "content_needs_magento_sync";

                     if($product->getObsolete()) {
                        $action = "set_to_obsolete";
                        $newState = "done";
                        $newStatus = "content_obsolete";
                        //echo "OBOSLETE";
                    }
                    else {
                        //echo "NON OBOSLETE";
                    }


                    if(isset($data)) {
                        $oldDataMessage = $data["message"];
                    }
                    //echo "Z".$oldDataMessage."\n";
                    $data = self::updateProductWorkflow($product,$user,$action,$newState,$newStatus,$tryQuickMode);
                    //echo "Y".$data["message"]."\n";
                    $data["message"] = $oldDataMessage."\n".$data["message"];

                }

                \Zend_Registry::set("pimcore_admin_user", $oldUser);
              
            }

             if(is_object($returnValueContainer))
                 $returnValueContainer->setData($data);
            //print_r($data);
            //print_r($productIds);
            //print_r($productSkus);
            //print_r($productMessages);

        });



        \Pimcore::getEventManager()->attach("lpn.azure.postAdd", function (\Zend_EventManager_Event $e) {
            $products = $e->getTarget();

            $returnValueContainer = $e->getParam('returnValueContainer');

        

           if(is_array($products)) {

                $userId = 6;
                $user = User::getById($userId);

                 $oldUser =  \Pimcore\Tool\Admin::getCurrentUser();
                \Zend_Registry::set("pimcore_admin_user", $user);

                foreach ($products  as $product) {

                         //Ajouter
                   $action = "settomagentosync_new";
                   $newState = "needs_magento_sync";
                   $newStatus = "new";

                    if($product->getObsolete()) {
                        $action = "set_to_obsolete";
                        $newState = "done";
                        $newStatus = "content_obsolete";
                        //echo "OBOSLETE";
                    }

                    // echo "X"."\n";
                    if(isset($data)) {
                        $oldDataMessage = $data["message"];
                    }
                    //echo "Z".$oldDataMessage."\n";
                    $data = self::updateProductWorkflow($product,$user,$action,$newState,$newStatus,true);
                    //echo "Y".$data["message"]."\n";
                    $data["message"] = $oldDataMessage."\n".$data["message"];


                }

                \Zend_Registry::set("pimcore_admin_user", $oldUser);
              
            }

             if(is_object($returnValueContainer))
                 $returnValueContainer->setData($data);
            //print_r($data);
            //print_r($productIds);
            //print_r($productSkus);
            //print_r($productMessages);

        }); 


        /*\Pimcore::getEventManager()->attach("lpn.azure.postUpdateObsolete", function (\Zend_EventManager_Event $e) {
            $products = $e->getTarget();

            $returnValueContainer = $e->getParam('returnValueContainer');

             $action = "set_to_obsolete";
            $newState = "done";
            $newStatus = "content_obsolete";


            if(is_array($products)) {

                $userId = 6;
                $user = User::getById($userId);

                 $oldUser =  \Pimcore\Tool\Admin::getCurrentUser();
                \Zend_Registry::set("pimcore_admin_user", $user);

                foreach ($products  as $product) {
                    $data = self::updateProductWorkflow($product,$user,$action,$newState,$newStatus);

                }

                \Zend_Registry::set("pimcore_admin_user", $oldUser);
              
            }

            if(is_object($returnValueContainer))
                $returnValueContainer->setData($data);
            //print_r($data);
            //print_r($productIds);
            //print_r($productSkus);
            //print_r($productMessages);

        });
        */


        \Pimcore::getEventManager()->attach("lpn.magento.postSynchro", function (\Zend_EventManager_Event $e) {
            

            $products = $e->getTarget();
            $returnValueContainer = $e->getParam('returnValueContainer');

            $action     = "set_content_published";
            $newState   = "done";
            $newStatus  = "content_published";
            

            if(is_array($products)) {

                $userId = 6;
                $user = User::getById($userId);

                 $oldUser =  \Pimcore\Tool\Admin::getCurrentUser();
                \Zend_Registry::set("pimcore_admin_user", $user);

                foreach ($products  as $product) {

                   // echo "X"."\n";
                    if(isset($data)) {
                        $oldDataMessage = $data["message"];
                    }
                    //echo "Z".$oldDataMessage."\n";
                    $data = self::updateProductWorkflow($product,$user,$action,$newState,$newStatus,true);
                    //echo "Y".$data["message"]."\n";
                    $data["message"] = $oldDataMessage."\n".$data["message"];

                }

                \Zend_Registry::set("pimcore_admin_user", $oldUser);
              
            }
            //echo "N".$data["message"]."\n";
             if(is_object($returnValueContainer))
                 $returnValueContainer->setData($data);
            //print_r($data);
            //print_r($productIds);
            //print_r($productSkus);
            //print_r($productMessages);

            

        });

    }


    public static function updateProductWorkflow($product,$user,$action, $newState,$newStatus,$tryQuickMode = false) {
         
         $data = [
                'success' => true,
                 'message' => 'no workflow update',

            ];


        //On fait un SQL direct pour aller plus vite, surtout pour le batch
        if ($tryQuickMode) {

            $db = \Pimcore\Db::get();
            //$sql = "UPDATE element_workflow_state SET state = '".$newState."', status = '".$newStatus."'  WHERE cid=".$product->getId() ." AND workflowId=1 AND ctype='object'";
            $sql = "REPLACE INTO element_workflow_state (state,status,cid,workflowId,ctype) VALUES ('".$newState."','".$newStatus."',".$product->getId().",1,'object')";
            //echo $sql;
            $result = $db->query($sql);

            if($result) {

                  $data = [
                        'success' => true,
                        'message' => 'Wotkflow Updated QUIRK '.$product->getSku(),
                        //'callback' => 'reloadObject'
                    ];

                return $data;
            }


        }


        $manager = Workflow\Manager\Factory::getManager($product,$user);
        try {

            if ($manager->validateAction($action, $newState, $newStatus)) {

                //perform the action on the element
                try {
                    $manager->performAction($action,["newState"=>$newState,"newStatus"=>$newStatus]);
                
                    $data = [
                        'success' => true,
                        'message' => 'Wotkflow Updated '.$product->getSku(),
                        'callback' => 'reloadObject'
                    ];
                } 
                catch (\Exception $e) {
                    $data = [
                        'success' => false,
                        'message' => 'error performing action on this element '.$product->getSku(),
                        'reason' => $e->getMessage()
                    ];
                }

            } 
            else {
                $data = [
                    'success' => false,
                    'message' => 'no validating the action '.$action.':'.$newState.':'.$newStatus.' on this element, maybe same state :'.$product->getSku(),
                    'reason' => $manager->getError()
                ];
            }
        } 
        catch (\Exception $e) {
            $data = [
                'success' => false,
                'message' => 'error performing validate action on this element action:'.$action." newState:".$newState." newStatus:".$newStatus." ".$product->getSku(),
                'reason' => $e->getMessage()
            ];
        }

        return $data;
      
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
