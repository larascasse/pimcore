<?php
$transport = $this->transport;


if(!function_exists("makeTransportInput")) {
    function makeTransportInput($name,$value,$label="",$type="text") {
        $str ="";
        $str .='<a href="#"" type="'.$type.'" id="'.$name.'" name="'.$name.'" class="editable" data-placeholder="'.$label.'" data-type="'.$type.'" />'.$value.'</a>';
        return $str;
    }
}




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

    switch ($value->fieldtype) {
        case 'textarea':
             $type = "textarea";
            break;
        
        case 'date':
             $type = "date";
            break;

        default:
            $type = "text";
            break;
    }

    $finalAttributesHtml[$attributeKey] = makeTransportInput($attributeKey,$attributeValue,$attributeLabel,$type);
    

    if($this->create || 1==1) {
        //echo '<input type="text" class="editable" id="'.$attributeKey.'" name="'.$attributeKey.'" placeholder="'.$attributeLabel.'" value="'.$attributeValue.'" />';
        //echo makeTransportInput($attributeKey,$attributeValue);
    }
    else {

    }
    
}

?>


<tr>
<?php
foreach ($finalAttributes as $key => $value) {
    echo "<td>";
    if($key=="codePiece") {
        echo '<a href="/transport/detail?code='.$value.'">'.$value.'</a>';
    }
    else {
    echo $value;
     
    }
    echo "</td>";
}
?>
</tr>


