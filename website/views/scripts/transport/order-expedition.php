<?php
if(!function_exists("makeTransportInput")) {
    function makeTransportInput($name,$value,$label="",$type="text") {
        $str ="";
        $str .=$value;
        return $str;
    }
}


//$orderDetail = $this->orderDetail;


$transport = $this->transport;

$attributes = $transport->getClass()->getFieldDefinitions();

$finalAttributesHtml = array();
$finalAttributes = array();

foreach($attributes as $key=> $value) {

    $attribute  =  $value->getName();
    
    $attributeLabel = $value->getTitle();
    $attributeKey = $attribute;
    
    
    $transport->getClass()->getFieldDefinition($value->getName());
    //print_r( $value->fieldtype);
    $getter = "get" . ucfirst($attribute);
    
   
   $attributeValue = "";
    if(!empty($transport)) {
        if(method_exists($transport, $getter)) {
            unset($attributeValue);
            
            $attributeValue = $transport->$getter();

            //Blooean on affiche oui
            if($value->fieldtype=="checkbox" && $attributeValue==1) {
                $attributeValue = "Oui";
            }

        }

    }
    $finalAttributes[$attributeKey] = $attributeValue;

    $datasource = "";
    $selectValue = "";
    
    switch ($value->fieldtype) {
        case 'textarea':
             $type = "textarea";
            break;
        
        case 'date':
             $type = "date";
            break;

        case 'select':
             $type = "select";


             $option = Object_Service::getOptionsForSelectField($transport,$attributeKey);
              $json = \Pimcore\Tool\Serialize::removeReferenceLoops($option);
              $json = \Zend_Json::encode($json, null, []);
              $datasource = $json;

              $selectValue = $attributeValue;
              if($value->isEmpty()) {
                $selectValue = $value->defaultValue;
              }

              //Select & editable
              $attributeValue = $option[$selectValue];


             
            break;

        default:
            $type = "text";
            break;
    }

    $finalAttributesHtml[$attributeKey] = makeTransportInput($attributeKey,$attributeValue,$attributeLabel,$type,$datasource,$selectValue="");
    
    
}

?>



<?php echo $this->template("includes/logo_2l_svg.php"); ?>
<h3>Livraison <?php echo $finalAttributesHtml["codePiece"]; ?> <span class="shippingDate-container"> - <?php echo $finalAttributesHtml["shippingDate"]; ?></span> #<?php echo $transport->getId()?></h3>

<div class="mt-4">
<div class="col">

<h4>Contact</h4>
Nom : <?php echo $finalAttributesHtml["clientName"];?><br />
Adresse : <?php echo $finalAttributesHtml["clientAddress"]; ?><br />
CP/Ville : <?php echo $finalAttributesHtml["clientZip"]; ?>  <?php echo $finalAttributesHtml["clientCity"]; ?><br />
Tél. : <?php echo $finalAttributesHtml["clientPhone"]; ?><br />
Email : <?php echo $finalAttributesHtml["clientEmail"]; ?><br />
Message : <br ><?php echo $finalAttributesHtml["shippingMessage"]; ?><br />


</div>

<div class="col">

<h4>Livraison</h4>
Dépot : <?php echo $finalAttributesHtml["depot"]; ?><br />
Transport : <?php echo $finalAttributesHtml["carrierName"]; ?><br />
Prix : <?php echo $finalAttributesHtml["price"]; ?><br />
Cotation : <?php echo $finalAttributesHtml["quoteNumber"];?><br />
Numéro de tracking : <?php echo $finalAttributesHtml["trackingNumber"]; ?><br />
Date de livraison : <?php echo $finalAttributesHtml["shippingDate"]; ?><br />
Règlement : <?php echo $finalAttributesHtml["reglement"]; ?><br />
Contact LPN : <?php echo $finalAttributesHtml["vendor"]; ?>

</div>


<?php
  $products= array();
  $accessoires=array();
  echo '<table class="table table-striped table-condensed">';
  echo '<tbody>';
  foreach ($this->rawProducts as $product) {
    echo "<tr>";
    echo "<td>".$product->Code_Article."</td>";
    echo "<td>".$product->Code_EAN_Article."</td>";

    echo "<td>".$product->Designation."</td>";
    echo "<td>".$product->Quantite_Unite."</td>";
    echo "<td>".$product->Observation."</td>";
    echo "</tr>";
  }
  echo '</tbody>';
   echo "</table>";
      
  ?>


