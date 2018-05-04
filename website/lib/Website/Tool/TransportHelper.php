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
class TransportHelper
{

	public static function getCssClassByState($transport) {
		
		return self::getInfoForStatus($transport)["type"];

	}

	public static function getMessageByState($transport) {
		
		return self::getInfoForStatus($transport)["message"];

	}

	public function getInfoForStatus($transport) {

		$info=array();
		$info["message"] = "";
		$info["type"] = "";

		$shippingDate = $transport->getShippingDate();
		$now = time();
		$secondsByDay = 60 * 60 * 24;
		//echo "kljlmjkljkl";
		//echo $transport->getStatus();
		//print_r($transport);
		//die;


		switch ($transport->getStatus()) {
			

			case 'processing':

				//pas de ddates de livraison
				if(!$shippingDate) {
					$info["message"] = "Définir une date de livraison";
					$info["type"] = "danger";
				}
				//Livraison loin
				else if($shippingDate< $now - (3 * $secondsByDay)) {
					$info["message"] = "";
					$info["type"] = "success";
				}
				else {
					$info["message"] = "Livraison imminente";
					$info["type"] = "warning";
				}
				break;

			case 'end':
				$info["message"] = "";
				$info["type"] = "dark";
				break;

			
			default:
				//Livraison loin
				if($shippingDate > $now - (7 * $secondsByDay)) {
					$info["message"] = "A valider rapidement";
					$info["type"] = "danger";
				}
				else {
					$info["message"] = "";
					$info["type"] = "info";
				}
				break;
		}
		return  $info;
	}

	public static function getJsonReadyForTransport($transport) {
		//A mettre avant le trafert de date !!
		$transport->classForStatus =  \Website\Tool\TransportHelper::getCssClassByState($transport);
        $transport->shippingDate = is_object($transport->getShippingDate()) ? $transport->getShippingDate()->getTimestamp():null;
        $transport->messageForStatus = \Website\Tool\TransportHelper::getMessageByState($transport);

        return $transport;
    }


}