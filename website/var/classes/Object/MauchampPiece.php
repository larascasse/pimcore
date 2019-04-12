<?php 

/** 
* Generated at: 2019-04-12T09:24:25+02:00
* Inheritance: no
* Variants: no
* Changed by: florent (6)
* IP: 172.31.4.114


Fields Summary: 
- Type_Piece [input]
- Code_Piece [input]
- Code_Commande_Web [input]
- Code_Client [input]
- Email_Client [input]
- Reference_Client [input]
- DatePiece [input]
- DateLivraison [input]
- Date_Livraison_Pim [input]
- DateConfirmation [input]
- Date_Preparation_Pim [input]
- DateExpedition [input]
- Date_Sortie_Pim [input]
- Acompte [input]
- Remise [input]
- TypeRemise [input]
- TotalHT [input]
- Site [input]
- Code_Depot [input]
- Remarque [input]
- Etat [input]
- Mode_livraison [input]
- Moyen_Paiement [input]
- Reglement [input]
- Devis_Lies [input]
- Factures_Liees [input]
- Bl_Lies [input]
- Commandes_Liees [input]
- Client [textarea]
- Lignes [textarea]
- Emplacement [input]
*/ 

namespace Pimcore\Model\Object;



/**
* @method \Pimcore\Model\Object\MauchampPiece\Listing getByType_Piece ($value, $limit = 0) 
* @method \Pimcore\Model\Object\MauchampPiece\Listing getByCode_Piece ($value, $limit = 0) 
* @method \Pimcore\Model\Object\MauchampPiece\Listing getByCode_Commande_Web ($value, $limit = 0) 
* @method \Pimcore\Model\Object\MauchampPiece\Listing getByCode_Client ($value, $limit = 0) 
* @method \Pimcore\Model\Object\MauchampPiece\Listing getByEmail_Client ($value, $limit = 0) 
* @method \Pimcore\Model\Object\MauchampPiece\Listing getByReference_Client ($value, $limit = 0) 
* @method \Pimcore\Model\Object\MauchampPiece\Listing getByDatePiece ($value, $limit = 0) 
* @method \Pimcore\Model\Object\MauchampPiece\Listing getByDateLivraison ($value, $limit = 0) 
* @method \Pimcore\Model\Object\MauchampPiece\Listing getByDate_Livraison_Pim ($value, $limit = 0) 
* @method \Pimcore\Model\Object\MauchampPiece\Listing getByDateConfirmation ($value, $limit = 0) 
* @method \Pimcore\Model\Object\MauchampPiece\Listing getByDate_Preparation_Pim ($value, $limit = 0) 
* @method \Pimcore\Model\Object\MauchampPiece\Listing getByDateExpedition ($value, $limit = 0) 
* @method \Pimcore\Model\Object\MauchampPiece\Listing getByDate_Sortie_Pim ($value, $limit = 0) 
* @method \Pimcore\Model\Object\MauchampPiece\Listing getByAcompte ($value, $limit = 0) 
* @method \Pimcore\Model\Object\MauchampPiece\Listing getByRemise ($value, $limit = 0) 
* @method \Pimcore\Model\Object\MauchampPiece\Listing getByTypeRemise ($value, $limit = 0) 
* @method \Pimcore\Model\Object\MauchampPiece\Listing getByTotalHT ($value, $limit = 0) 
* @method \Pimcore\Model\Object\MauchampPiece\Listing getBySite ($value, $limit = 0) 
* @method \Pimcore\Model\Object\MauchampPiece\Listing getByCode_Depot ($value, $limit = 0) 
* @method \Pimcore\Model\Object\MauchampPiece\Listing getByRemarque ($value, $limit = 0) 
* @method \Pimcore\Model\Object\MauchampPiece\Listing getByEtat ($value, $limit = 0) 
* @method \Pimcore\Model\Object\MauchampPiece\Listing getByMode_livraison ($value, $limit = 0) 
* @method \Pimcore\Model\Object\MauchampPiece\Listing getByMoyen_Paiement ($value, $limit = 0) 
* @method \Pimcore\Model\Object\MauchampPiece\Listing getByReglement ($value, $limit = 0) 
* @method \Pimcore\Model\Object\MauchampPiece\Listing getByDevis_Lies ($value, $limit = 0) 
* @method \Pimcore\Model\Object\MauchampPiece\Listing getByFactures_Liees ($value, $limit = 0) 
* @method \Pimcore\Model\Object\MauchampPiece\Listing getByBl_Lies ($value, $limit = 0) 
* @method \Pimcore\Model\Object\MauchampPiece\Listing getByCommandes_Liees ($value, $limit = 0) 
* @method \Pimcore\Model\Object\MauchampPiece\Listing getByClient ($value, $limit = 0) 
* @method \Pimcore\Model\Object\MauchampPiece\Listing getByLignes ($value, $limit = 0) 
* @method \Pimcore\Model\Object\MauchampPiece\Listing getByEmplacement ($value, $limit = 0) 
*/

class MauchampPiece extends Concrete {

public $o_classId = 19;
public $o_className = "mauchampPiece";
public $Type_Piece;
public $Code_Piece;
public $Code_Commande_Web;
public $Code_Client;
public $Email_Client;
public $Reference_Client;
public $DatePiece;
public $DateLivraison;
public $Date_Livraison_Pim;
public $DateConfirmation;
public $Date_Preparation_Pim;
public $DateExpedition;
public $Date_Sortie_Pim;
public $Acompte;
public $Remise;
public $TypeRemise;
public $TotalHT;
public $Site;
public $Code_Depot;
public $Remarque;
public $Etat;
public $Mode_livraison;
public $Moyen_Paiement;
public $Reglement;
public $Devis_Lies;
public $Factures_Liees;
public $Bl_Lies;
public $Commandes_Liees;
public $Client;
public $Lignes;
public $Emplacement;


/**
* @param array $values
* @return \Pimcore\Model\Object\MauchampPiece
*/
public static function create($values = array()) {
	$object = new static();
	$object->setValues($values);
	return $object;
}

/**
* Get Type_Piece - Type_Piece
* @return string
*/
public function getType_Piece () {
	$preValue = $this->preGetValue("Type_Piece"); 
	if($preValue !== null && !\Pimcore::inAdmin()) { 
		return $preValue;
	}
	$data = $this->Type_Piece;
	return $data;
}

/**
* Set Type_Piece - Type_Piece
* @param string $Type_Piece
* @return \Pimcore\Model\Object\MauchampPiece
*/
public function setType_Piece ($Type_Piece) {
	$this->Type_Piece = $Type_Piece;
	return $this;
}

/**
* Get Code_Piece - Code_Piece
* @return string
*/
public function getCode_Piece () {
	$preValue = $this->preGetValue("Code_Piece"); 
	if($preValue !== null && !\Pimcore::inAdmin()) { 
		return $preValue;
	}
	$data = $this->Code_Piece;
	return $data;
}

/**
* Set Code_Piece - Code_Piece
* @param string $Code_Piece
* @return \Pimcore\Model\Object\MauchampPiece
*/
public function setCode_Piece ($Code_Piece) {
	$this->Code_Piece = $Code_Piece;
	return $this;
}

/**
* Get Code_Commande_Web - Code_Commande_Web
* @return string
*/
public function getCode_Commande_Web () {
	$preValue = $this->preGetValue("Code_Commande_Web"); 
	if($preValue !== null && !\Pimcore::inAdmin()) { 
		return $preValue;
	}
	$data = $this->Code_Commande_Web;
	return $data;
}

/**
* Set Code_Commande_Web - Code_Commande_Web
* @param string $Code_Commande_Web
* @return \Pimcore\Model\Object\MauchampPiece
*/
public function setCode_Commande_Web ($Code_Commande_Web) {
	$this->Code_Commande_Web = $Code_Commande_Web;
	return $this;
}

/**
* Get Code_Client - Code_Client
* @return string
*/
public function getCode_Client () {
	$preValue = $this->preGetValue("Code_Client"); 
	if($preValue !== null && !\Pimcore::inAdmin()) { 
		return $preValue;
	}
	$data = $this->Code_Client;
	return $data;
}

/**
* Set Code_Client - Code_Client
* @param string $Code_Client
* @return \Pimcore\Model\Object\MauchampPiece
*/
public function setCode_Client ($Code_Client) {
	$this->Code_Client = $Code_Client;
	return $this;
}

/**
* Get Email_Client - Email_Client
* @return string
*/
public function getEmail_Client () {
	$preValue = $this->preGetValue("Email_Client"); 
	if($preValue !== null && !\Pimcore::inAdmin()) { 
		return $preValue;
	}
	$data = $this->Email_Client;
	return $data;
}

/**
* Set Email_Client - Email_Client
* @param string $Email_Client
* @return \Pimcore\Model\Object\MauchampPiece
*/
public function setEmail_Client ($Email_Client) {
	$this->Email_Client = $Email_Client;
	return $this;
}

/**
* Get Reference_Client - Reference_Client
* @return string
*/
public function getReference_Client () {
	$preValue = $this->preGetValue("Reference_Client"); 
	if($preValue !== null && !\Pimcore::inAdmin()) { 
		return $preValue;
	}
	$data = $this->Reference_Client;
	return $data;
}

/**
* Set Reference_Client - Reference_Client
* @param string $Reference_Client
* @return \Pimcore\Model\Object\MauchampPiece
*/
public function setReference_Client ($Reference_Client) {
	$this->Reference_Client = $Reference_Client;
	return $this;
}

/**
* Get DatePiece - Date
* @return string
*/
public function getDatePiece () {
	$preValue = $this->preGetValue("DatePiece"); 
	if($preValue !== null && !\Pimcore::inAdmin()) { 
		return $preValue;
	}
	$data = $this->DatePiece;
	return $data;
}

/**
* Set DatePiece - Date
* @param string $DatePiece
* @return \Pimcore\Model\Object\MauchampPiece
*/
public function setDatePiece ($DatePiece) {
	$this->DatePiece = $DatePiece;
	return $this;
}

/**
* Get DateLivraison - DateLivraison
* @return string
*/
public function getDateLivraison () {
	$preValue = $this->preGetValue("DateLivraison"); 
	if($preValue !== null && !\Pimcore::inAdmin()) { 
		return $preValue;
	}
	$data = $this->DateLivraison;
	return $data;
}

/**
* Set DateLivraison - DateLivraison
* @param string $DateLivraison
* @return \Pimcore\Model\Object\MauchampPiece
*/
public function setDateLivraison ($DateLivraison) {
	$this->DateLivraison = $DateLivraison;
	return $this;
}

/**
* Get Date_Livraison_Pim - Date_Livraison_Pim
* @return string
*/
public function getDate_Livraison_Pim () {
	$preValue = $this->preGetValue("Date_Livraison_Pim"); 
	if($preValue !== null && !\Pimcore::inAdmin()) { 
		return $preValue;
	}
	$data = $this->Date_Livraison_Pim;
	return $data;
}

/**
* Set Date_Livraison_Pim - Date_Livraison_Pim
* @param string $Date_Livraison_Pim
* @return \Pimcore\Model\Object\MauchampPiece
*/
public function setDate_Livraison_Pim ($Date_Livraison_Pim) {
	$this->Date_Livraison_Pim = $Date_Livraison_Pim;
	return $this;
}

/**
* Get DateConfirmation - DateConfirmation
* @return string
*/
public function getDateConfirmation () {
	$preValue = $this->preGetValue("DateConfirmation"); 
	if($preValue !== null && !\Pimcore::inAdmin()) { 
		return $preValue;
	}
	$data = $this->DateConfirmation;
	return $data;
}

/**
* Set DateConfirmation - DateConfirmation
* @param string $DateConfirmation
* @return \Pimcore\Model\Object\MauchampPiece
*/
public function setDateConfirmation ($DateConfirmation) {
	$this->DateConfirmation = $DateConfirmation;
	return $this;
}

/**
* Get Date_Preparation_Pim - Date_Preparation_Pim
* @return string
*/
public function getDate_Preparation_Pim () {
	$preValue = $this->preGetValue("Date_Preparation_Pim"); 
	if($preValue !== null && !\Pimcore::inAdmin()) { 
		return $preValue;
	}
	$data = $this->Date_Preparation_Pim;
	return $data;
}

/**
* Set Date_Preparation_Pim - Date_Preparation_Pim
* @param string $Date_Preparation_Pim
* @return \Pimcore\Model\Object\MauchampPiece
*/
public function setDate_Preparation_Pim ($Date_Preparation_Pim) {
	$this->Date_Preparation_Pim = $Date_Preparation_Pim;
	return $this;
}

/**
* Get DateExpedition - DateExpedition
* @return string
*/
public function getDateExpedition () {
	$preValue = $this->preGetValue("DateExpedition"); 
	if($preValue !== null && !\Pimcore::inAdmin()) { 
		return $preValue;
	}
	$data = $this->DateExpedition;
	return $data;
}

/**
* Set DateExpedition - DateExpedition
* @param string $DateExpedition
* @return \Pimcore\Model\Object\MauchampPiece
*/
public function setDateExpedition ($DateExpedition) {
	$this->DateExpedition = $DateExpedition;
	return $this;
}

/**
* Get Date_Sortie_Pim - Date_Sortie_Pim
* @return string
*/
public function getDate_Sortie_Pim () {
	$preValue = $this->preGetValue("Date_Sortie_Pim"); 
	if($preValue !== null && !\Pimcore::inAdmin()) { 
		return $preValue;
	}
	$data = $this->Date_Sortie_Pim;
	return $data;
}

/**
* Set Date_Sortie_Pim - Date_Sortie_Pim
* @param string $Date_Sortie_Pim
* @return \Pimcore\Model\Object\MauchampPiece
*/
public function setDate_Sortie_Pim ($Date_Sortie_Pim) {
	$this->Date_Sortie_Pim = $Date_Sortie_Pim;
	return $this;
}

/**
* Get Acompte - Acompte
* @return string
*/
public function getAcompte () {
	$preValue = $this->preGetValue("Acompte"); 
	if($preValue !== null && !\Pimcore::inAdmin()) { 
		return $preValue;
	}
	$data = $this->Acompte;
	return $data;
}

/**
* Set Acompte - Acompte
* @param string $Acompte
* @return \Pimcore\Model\Object\MauchampPiece
*/
public function setAcompte ($Acompte) {
	$this->Acompte = $Acompte;
	return $this;
}

/**
* Get Remise - Remise
* @return string
*/
public function getRemise () {
	$preValue = $this->preGetValue("Remise"); 
	if($preValue !== null && !\Pimcore::inAdmin()) { 
		return $preValue;
	}
	$data = $this->Remise;
	return $data;
}

/**
* Set Remise - Remise
* @param string $Remise
* @return \Pimcore\Model\Object\MauchampPiece
*/
public function setRemise ($Remise) {
	$this->Remise = $Remise;
	return $this;
}

/**
* Get TypeRemise - TypeRemise
* @return string
*/
public function getTypeRemise () {
	$preValue = $this->preGetValue("TypeRemise"); 
	if($preValue !== null && !\Pimcore::inAdmin()) { 
		return $preValue;
	}
	$data = $this->TypeRemise;
	return $data;
}

/**
* Set TypeRemise - TypeRemise
* @param string $TypeRemise
* @return \Pimcore\Model\Object\MauchampPiece
*/
public function setTypeRemise ($TypeRemise) {
	$this->TypeRemise = $TypeRemise;
	return $this;
}

/**
* Get TotalHT - TotalHT
* @return string
*/
public function getTotalHT () {
	$preValue = $this->preGetValue("TotalHT"); 
	if($preValue !== null && !\Pimcore::inAdmin()) { 
		return $preValue;
	}
	$data = $this->TotalHT;
	return $data;
}

/**
* Set TotalHT - TotalHT
* @param string $TotalHT
* @return \Pimcore\Model\Object\MauchampPiece
*/
public function setTotalHT ($TotalHT) {
	$this->TotalHT = $TotalHT;
	return $this;
}

/**
* Get Site - Site
* @return string
*/
public function getSite () {
	$preValue = $this->preGetValue("Site"); 
	if($preValue !== null && !\Pimcore::inAdmin()) { 
		return $preValue;
	}
	$data = $this->Site;
	return $data;
}

/**
* Set Site - Site
* @param string $Site
* @return \Pimcore\Model\Object\MauchampPiece
*/
public function setSite ($Site) {
	$this->Site = $Site;
	return $this;
}

/**
* Get Code_Depot - Code_Depot
* @return string
*/
public function getCode_Depot () {
	$preValue = $this->preGetValue("Code_Depot"); 
	if($preValue !== null && !\Pimcore::inAdmin()) { 
		return $preValue;
	}
	$data = $this->Code_Depot;
	return $data;
}

/**
* Set Code_Depot - Code_Depot
* @param string $Code_Depot
* @return \Pimcore\Model\Object\MauchampPiece
*/
public function setCode_Depot ($Code_Depot) {
	$this->Code_Depot = $Code_Depot;
	return $this;
}

/**
* Get Remarque - Remarque
* @return string
*/
public function getRemarque () {
	$preValue = $this->preGetValue("Remarque"); 
	if($preValue !== null && !\Pimcore::inAdmin()) { 
		return $preValue;
	}
	$data = $this->Remarque;
	return $data;
}

/**
* Set Remarque - Remarque
* @param string $Remarque
* @return \Pimcore\Model\Object\MauchampPiece
*/
public function setRemarque ($Remarque) {
	$this->Remarque = $Remarque;
	return $this;
}

/**
* Get Etat - Etat
* @return string
*/
public function getEtat () {
	$preValue = $this->preGetValue("Etat"); 
	if($preValue !== null && !\Pimcore::inAdmin()) { 
		return $preValue;
	}
	$data = $this->Etat;
	return $data;
}

/**
* Set Etat - Etat
* @param string $Etat
* @return \Pimcore\Model\Object\MauchampPiece
*/
public function setEtat ($Etat) {
	$this->Etat = $Etat;
	return $this;
}

/**
* Get Mode_livraison - Mode_livraison
* @return string
*/
public function getMode_livraison () {
	$preValue = $this->preGetValue("Mode_livraison"); 
	if($preValue !== null && !\Pimcore::inAdmin()) { 
		return $preValue;
	}
	$data = $this->Mode_livraison;
	return $data;
}

/**
* Set Mode_livraison - Mode_livraison
* @param string $Mode_livraison
* @return \Pimcore\Model\Object\MauchampPiece
*/
public function setMode_livraison ($Mode_livraison) {
	$this->Mode_livraison = $Mode_livraison;
	return $this;
}

/**
* Get Moyen_Paiement - Moyen_Paiement
* @return string
*/
public function getMoyen_Paiement () {
	$preValue = $this->preGetValue("Moyen_Paiement"); 
	if($preValue !== null && !\Pimcore::inAdmin()) { 
		return $preValue;
	}
	$data = $this->Moyen_Paiement;
	return $data;
}

/**
* Set Moyen_Paiement - Moyen_Paiement
* @param string $Moyen_Paiement
* @return \Pimcore\Model\Object\MauchampPiece
*/
public function setMoyen_Paiement ($Moyen_Paiement) {
	$this->Moyen_Paiement = $Moyen_Paiement;
	return $this;
}

/**
* Get Reglement - Reglement
* @return string
*/
public function getReglement () {
	$preValue = $this->preGetValue("Reglement"); 
	if($preValue !== null && !\Pimcore::inAdmin()) { 
		return $preValue;
	}
	$data = $this->Reglement;
	return $data;
}

/**
* Set Reglement - Reglement
* @param string $Reglement
* @return \Pimcore\Model\Object\MauchampPiece
*/
public function setReglement ($Reglement) {
	$this->Reglement = $Reglement;
	return $this;
}

/**
* Get Devis_Lies - Devis_Lies
* @return string
*/
public function getDevis_Lies () {
	$preValue = $this->preGetValue("Devis_Lies"); 
	if($preValue !== null && !\Pimcore::inAdmin()) { 
		return $preValue;
	}
	$data = $this->Devis_Lies;
	return $data;
}

/**
* Set Devis_Lies - Devis_Lies
* @param string $Devis_Lies
* @return \Pimcore\Model\Object\MauchampPiece
*/
public function setDevis_Lies ($Devis_Lies) {
	$this->Devis_Lies = $Devis_Lies;
	return $this;
}

/**
* Get Factures_Liees - Factures_Liees
* @return string
*/
public function getFactures_Liees () {
	$preValue = $this->preGetValue("Factures_Liees"); 
	if($preValue !== null && !\Pimcore::inAdmin()) { 
		return $preValue;
	}
	$data = $this->Factures_Liees;
	return $data;
}

/**
* Set Factures_Liees - Factures_Liees
* @param string $Factures_Liees
* @return \Pimcore\Model\Object\MauchampPiece
*/
public function setFactures_Liees ($Factures_Liees) {
	$this->Factures_Liees = $Factures_Liees;
	return $this;
}

/**
* Get Bl_Lies - Bl_Lies
* @return string
*/
public function getBl_Lies () {
	$preValue = $this->preGetValue("Bl_Lies"); 
	if($preValue !== null && !\Pimcore::inAdmin()) { 
		return $preValue;
	}
	$data = $this->Bl_Lies;
	return $data;
}

/**
* Set Bl_Lies - Bl_Lies
* @param string $Bl_Lies
* @return \Pimcore\Model\Object\MauchampPiece
*/
public function setBl_Lies ($Bl_Lies) {
	$this->Bl_Lies = $Bl_Lies;
	return $this;
}

/**
* Get Commandes_Liees - Commandes_Liees
* @return string
*/
public function getCommandes_Liees () {
	$preValue = $this->preGetValue("Commandes_Liees"); 
	if($preValue !== null && !\Pimcore::inAdmin()) { 
		return $preValue;
	}
	$data = $this->Commandes_Liees;
	return $data;
}

/**
* Set Commandes_Liees - Commandes_Liees
* @param string $Commandes_Liees
* @return \Pimcore\Model\Object\MauchampPiece
*/
public function setCommandes_Liees ($Commandes_Liees) {
	$this->Commandes_Liees = $Commandes_Liees;
	return $this;
}

/**
* Get Client - Client
* @return string
*/
public function getClient () {
	$preValue = $this->preGetValue("Client"); 
	if($preValue !== null && !\Pimcore::inAdmin()) { 
		return $preValue;
	}
	$data = $this->Client;
	return $data;
}

/**
* Set Client - Client
* @param string $Client
* @return \Pimcore\Model\Object\MauchampPiece
*/
public function setClient ($Client) {
	$this->Client = $Client;
	return $this;
}

/**
* Get Lignes - Lignes
* @return string
*/
public function getLignes () {
	$preValue = $this->preGetValue("Lignes"); 
	if($preValue !== null && !\Pimcore::inAdmin()) { 
		return $preValue;
	}
	$data = $this->Lignes;
	return $data;
}

/**
* Set Lignes - Lignes
* @param string $Lignes
* @return \Pimcore\Model\Object\MauchampPiece
*/
public function setLignes ($Lignes) {
	$this->Lignes = $Lignes;
	return $this;
}

/**
* Get Emplacement - Emplacement
* @return string
*/
public function getEmplacement () {
	$preValue = $this->preGetValue("Emplacement"); 
	if($preValue !== null && !\Pimcore::inAdmin()) { 
		return $preValue;
	}
	$data = $this->Emplacement;
	return $data;
}

/**
* Set Emplacement - Emplacement
* @param string $Emplacement
* @return \Pimcore\Model\Object\MauchampPiece
*/
public function setEmplacement ($Emplacement) {
	$this->Emplacement = $Emplacement;
	return $this;
}

protected static $_relationFields = array (
);

public $lazyLoadedFields = NULL;

}

