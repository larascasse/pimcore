<?php

// define a custom class,  for example:
class Website_MauchampPiece extends Object_MauchampPiece {




	public function getShortArray() {
		$attributes = $this->getClass()->getFieldDefinitions();


		//On met ca pour eviter la bouvvle dans getForCsvExport
		$ignoreFields = array("configurable_fields");
		

		$return = [];

		$return["id"] = $this->getId();

		foreach($attributes as $key=> $value) {

		
			$attribute  =  $value->getName();
			$attributeLabel = $value->getTitle();

			$attributeKey = $attributeLabel;

			if(in_array($attribute,$ignoreFields)) {
				//unset($attributeValue);
				continue;
			}
			

			$attributeValue = $value->getForCsvExport($this);

			if($attribute == "Client" || $attribute == "Lignes") {
				//print_r($attributeValue);
				$attributeValue = json_decode($attributeValue);
				//print_r($attributeValue);
				//die;
			}
		

			//echo $attribute." ".$attributeValue."\n<br/>";
			$return[$attribute] = $attributeValue;
		}		

		return $return;
	}

	  public  function getNotes() {
        $list = new \Element\Note\Listing();
        $list->setOrderKey(["date"]);
        $list->setOrder(["DESC", "DESC"]);
        $conditions = array();
        $conditions[] = "(cid = " . $list->quote($this->getId()). ")";
        $list->setCondition(implode(" AND ", $conditions));
        $list->load();
        $notes = [];
        foreach ($list->getNotes() as $note) {
            $note->dateString = date("d/m/Y h:i",$note->getDate());
            $notes[] = $note;
        }
        return $notes;
    }

	

}

// and optionally a related list

class Website_MauchampPiece_List extends Object_MauchampPiece_List {

    
}
?>