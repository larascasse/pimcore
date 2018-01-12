<?php

namespace Website\Tool;

use Website\Controller\Action;
use Pimcore\Model\Document;
use Pimcore\Model\Document\Page;
use Pimcore\Model\Asset;
use Pimcore\Model\Object;
use Pimcore\Mail;
use Pimcore\Tool;

use LpnPlugin;


//PIMCORE_DOCUMENT_ROOT.'/plugins/LpnPlugin/odata/lpnservices/urldef.php';
//require_once PIMCORE_DOCUMENT_ROOT.'/plugins/LpnPlugin/odata/lpnservices/LPNEntities.php';
//require_once PIMCORE_DOCUMENT_ROOT.'/plugins/LpnPlugin/odata/lpnservices/functions.php';


//\Website\Tool\MauchampHelper::getAssetArray(self::getImages());;
class MagentoHelper
{
    
    static $apiUsername = 'pimcore';
    static $apiPassword = 'Nuur3vay?';

    public static function loadMagentoCustomer($email) {
        $client = new \SoapClient('https://www.laparqueterienouvelle.fr/api/v2_soap/?wsdl');

        // If some stuff requires api authentification,
        // then get a session token
        $session = $client->login(self::$apiUsername, self::$apiPassword);
        $complexFilter = array(
            'complex_filter' => array(
                array(
                    'key' => 'email',
                    'value' => array('key' => 'in', 'value' => $email)
                )
            )
        );
        $customer = false;
        $result = $client->customerCustomerList($session, $complexFilter);
        if(is_array($result) && count($result)>0)  {

            $customer = $result[0];
            //var_dump ($customer);
        }
        return $customer;
    }

    public static function createMagentoCustomer($xml) {
        $data = Pimcore\Tool::getHttpData('https://www.laparqueterienouvelle.fr/create_customer.php',null,["xml"=>$xml]);
        return $data;
    }

    
}