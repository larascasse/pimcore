<?php 

/** 
* Generated at: 2018-04-20T16:58:35+02:00
* Inheritance: no
* Variants: no
* Changed by: florent (6)
* IP: 172.31.14.113


Fields Summary: 
- codePiece [input]
- clientName [input]
- clientPhone [input]
- clientEmail [input]
- clientAddress [input]
- clientZip [input]
- clientCity [input]
- depot [input]
- vendor [input]
- price [input]
- carrierName [input]
- quoteNumber [input]
- trackingNumber [input]
- shippingDate [date]
- reglement [input]
- shippingMessage [textarea]
*/ 

namespace Pimcore\Model\Object;



/**
* @method \Pimcore\Model\Object\Transport\Listing getByCodePiece ($value, $limit = 0) 
* @method \Pimcore\Model\Object\Transport\Listing getByClientName ($value, $limit = 0) 
* @method \Pimcore\Model\Object\Transport\Listing getByClientPhone ($value, $limit = 0) 
* @method \Pimcore\Model\Object\Transport\Listing getByClientEmail ($value, $limit = 0) 
* @method \Pimcore\Model\Object\Transport\Listing getByClientAddress ($value, $limit = 0) 
* @method \Pimcore\Model\Object\Transport\Listing getByClientZip ($value, $limit = 0) 
* @method \Pimcore\Model\Object\Transport\Listing getByClientCity ($value, $limit = 0) 
* @method \Pimcore\Model\Object\Transport\Listing getByDepot ($value, $limit = 0) 
* @method \Pimcore\Model\Object\Transport\Listing getByVendor ($value, $limit = 0) 
* @method \Pimcore\Model\Object\Transport\Listing getByPrice ($value, $limit = 0) 
* @method \Pimcore\Model\Object\Transport\Listing getByCarrierName ($value, $limit = 0) 
* @method \Pimcore\Model\Object\Transport\Listing getByQuoteNumber ($value, $limit = 0) 
* @method \Pimcore\Model\Object\Transport\Listing getByTrackingNumber ($value, $limit = 0) 
* @method \Pimcore\Model\Object\Transport\Listing getByShippingDate ($value, $limit = 0) 
* @method \Pimcore\Model\Object\Transport\Listing getByReglement ($value, $limit = 0) 
* @method \Pimcore\Model\Object\Transport\Listing getByShippingMessage ($value, $limit = 0) 
*/

class Transport extends Concrete {

public $o_classId = 18;
public $o_className = "transport";
public $codePiece;
public $clientName;
public $clientPhone;
public $clientEmail;
public $clientAddress;
public $clientZip;
public $clientCity;
public $depot;
public $vendor;
public $price;
public $carrierName;
public $quoteNumber;
public $trackingNumber;
public $shippingDate;
public $reglement;
public $shippingMessage;


/**
* @param array $values
* @return \Pimcore\Model\Object\Transport
*/
public static function create($values = array()) {
	$object = new static();
	$object->setValues($values);
	return $object;
}

/**
* Get codePiece - Code Pièce
* @return string
*/
public function getCodePiece () {
	$preValue = $this->preGetValue("codePiece"); 
	if($preValue !== null && !\Pimcore::inAdmin()) { 
		return $preValue;
	}
	$data = $this->codePiece;
	return $data;
}

/**
* Set codePiece - Code Pièce
* @param string $codePiece
* @return \Pimcore\Model\Object\Transport
*/
public function setCodePiece ($codePiece) {
	$this->codePiece = $codePiece;
	return $this;
}

/**
* Get clientName - Nom
* @return string
*/
public function getClientName () {
	$preValue = $this->preGetValue("clientName"); 
	if($preValue !== null && !\Pimcore::inAdmin()) { 
		return $preValue;
	}
	$data = $this->clientName;
	return $data;
}

/**
* Set clientName - Nom
* @param string $clientName
* @return \Pimcore\Model\Object\Transport
*/
public function setClientName ($clientName) {
	$this->clientName = $clientName;
	return $this;
}

/**
* Get clientPhone - clientPhone
* @return string
*/
public function getClientPhone () {
	$preValue = $this->preGetValue("clientPhone"); 
	if($preValue !== null && !\Pimcore::inAdmin()) { 
		return $preValue;
	}
	$data = $this->clientPhone;
	return $data;
}

/**
* Set clientPhone - clientPhone
* @param string $clientPhone
* @return \Pimcore\Model\Object\Transport
*/
public function setClientPhone ($clientPhone) {
	$this->clientPhone = $clientPhone;
	return $this;
}

/**
* Get clientEmail - Email
* @return string
*/
public function getClientEmail () {
	$preValue = $this->preGetValue("clientEmail"); 
	if($preValue !== null && !\Pimcore::inAdmin()) { 
		return $preValue;
	}
	$data = $this->clientEmail;
	return $data;
}

/**
* Set clientEmail - Email
* @param string $clientEmail
* @return \Pimcore\Model\Object\Transport
*/
public function setClientEmail ($clientEmail) {
	$this->clientEmail = $clientEmail;
	return $this;
}

/**
* Get clientAddress - Adresse
* @return string
*/
public function getClientAddress () {
	$preValue = $this->preGetValue("clientAddress"); 
	if($preValue !== null && !\Pimcore::inAdmin()) { 
		return $preValue;
	}
	$data = $this->clientAddress;
	return $data;
}

/**
* Set clientAddress - Adresse
* @param string $clientAddress
* @return \Pimcore\Model\Object\Transport
*/
public function setClientAddress ($clientAddress) {
	$this->clientAddress = $clientAddress;
	return $this;
}

/**
* Get clientZip - Code Postal
* @return string
*/
public function getClientZip () {
	$preValue = $this->preGetValue("clientZip"); 
	if($preValue !== null && !\Pimcore::inAdmin()) { 
		return $preValue;
	}
	$data = $this->clientZip;
	return $data;
}

/**
* Set clientZip - Code Postal
* @param string $clientZip
* @return \Pimcore\Model\Object\Transport
*/
public function setClientZip ($clientZip) {
	$this->clientZip = $clientZip;
	return $this;
}

/**
* Get clientCity - Ville
* @return string
*/
public function getClientCity () {
	$preValue = $this->preGetValue("clientCity"); 
	if($preValue !== null && !\Pimcore::inAdmin()) { 
		return $preValue;
	}
	$data = $this->clientCity;
	return $data;
}

/**
* Set clientCity - Ville
* @param string $clientCity
* @return \Pimcore\Model\Object\Transport
*/
public function setClientCity ($clientCity) {
	$this->clientCity = $clientCity;
	return $this;
}

/**
* Get depot - Dépot
* @return string
*/
public function getDepot () {
	$preValue = $this->preGetValue("depot"); 
	if($preValue !== null && !\Pimcore::inAdmin()) { 
		return $preValue;
	}
	$data = $this->depot;
	return $data;
}

/**
* Set depot - Dépot
* @param string $depot
* @return \Pimcore\Model\Object\Transport
*/
public function setDepot ($depot) {
	$this->depot = $depot;
	return $this;
}

/**
* Get vendor - Vendeur
* @return string
*/
public function getVendor () {
	$preValue = $this->preGetValue("vendor"); 
	if($preValue !== null && !\Pimcore::inAdmin()) { 
		return $preValue;
	}
	$data = $this->vendor;
	return $data;
}

/**
* Set vendor - Vendeur
* @param string $vendor
* @return \Pimcore\Model\Object\Transport
*/
public function setVendor ($vendor) {
	$this->vendor = $vendor;
	return $this;
}

/**
* Get price - Prix
* @return string
*/
public function getPrice () {
	$preValue = $this->preGetValue("price"); 
	if($preValue !== null && !\Pimcore::inAdmin()) { 
		return $preValue;
	}
	$data = $this->price;
	return $data;
}

/**
* Set price - Prix
* @param string $price
* @return \Pimcore\Model\Object\Transport
*/
public function setPrice ($price) {
	$this->price = $price;
	return $this;
}

/**
* Get carrierName - Transporteur
* @return string
*/
public function getCarrierName () {
	$preValue = $this->preGetValue("carrierName"); 
	if($preValue !== null && !\Pimcore::inAdmin()) { 
		return $preValue;
	}
	$data = $this->carrierName;
	return $data;
}

/**
* Set carrierName - Transporteur
* @param string $carrierName
* @return \Pimcore\Model\Object\Transport
*/
public function setCarrierName ($carrierName) {
	$this->carrierName = $carrierName;
	return $this;
}

/**
* Get quoteNumber - quoteNumber
* @return string
*/
public function getQuoteNumber () {
	$preValue = $this->preGetValue("quoteNumber"); 
	if($preValue !== null && !\Pimcore::inAdmin()) { 
		return $preValue;
	}
	$data = $this->quoteNumber;
	return $data;
}

/**
* Set quoteNumber - quoteNumber
* @param string $quoteNumber
* @return \Pimcore\Model\Object\Transport
*/
public function setQuoteNumber ($quoteNumber) {
	$this->quoteNumber = $quoteNumber;
	return $this;
}

/**
* Get trackingNumber - Numéro cracking
* @return string
*/
public function getTrackingNumber () {
	$preValue = $this->preGetValue("trackingNumber"); 
	if($preValue !== null && !\Pimcore::inAdmin()) { 
		return $preValue;
	}
	$data = $this->trackingNumber;
	return $data;
}

/**
* Set trackingNumber - Numéro cracking
* @param string $trackingNumber
* @return \Pimcore\Model\Object\Transport
*/
public function setTrackingNumber ($trackingNumber) {
	$this->trackingNumber = $trackingNumber;
	return $this;
}

/**
* Get shippingDate - Date de livraison
* @return \Carbon\Carbon
*/
public function getShippingDate () {
	$preValue = $this->preGetValue("shippingDate"); 
	if($preValue !== null && !\Pimcore::inAdmin()) { 
		return $preValue;
	}
	$data = $this->shippingDate;
	return $data;
}

/**
* Set shippingDate - Date de livraison
* @param \Carbon\Carbon $shippingDate
* @return \Pimcore\Model\Object\Transport
*/
public function setShippingDate ($shippingDate) {
	$this->shippingDate = $shippingDate;
	return $this;
}

/**
* Get reglement - Réglement
* @return string
*/
public function getReglement () {
	$preValue = $this->preGetValue("reglement"); 
	if($preValue !== null && !\Pimcore::inAdmin()) { 
		return $preValue;
	}
	$data = $this->reglement;
	return $data;
}

/**
* Set reglement - Réglement
* @param string $reglement
* @return \Pimcore\Model\Object\Transport
*/
public function setReglement ($reglement) {
	$this->reglement = $reglement;
	return $this;
}

/**
* Get shippingMessage - Message
* @return string
*/
public function getShippingMessage () {
	$preValue = $this->preGetValue("shippingMessage"); 
	if($preValue !== null && !\Pimcore::inAdmin()) { 
		return $preValue;
	}
	$data = $this->shippingMessage;
	return $data;
}

/**
* Set shippingMessage - Message
* @param string $shippingMessage
* @return \Pimcore\Model\Object\Transport
*/
public function setShippingMessage ($shippingMessage) {
	$this->shippingMessage = $shippingMessage;
	return $this;
}

protected static $_relationFields = array (
);

public $lazyLoadedFields = NULL;

}

