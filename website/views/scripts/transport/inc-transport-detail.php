<?php 

if(!function_exists("makeTransportInput")) {
    function makeTransportInput($name,$value,$label="",$type="text") {
        $str ="";
        $str .='<a href="#"" type="'.$type.'" id="'.$name.'" name="'.$name.'" class="editable" data-placeholder="'.$label.'" data-type="'.$type.'" />'.$value.'</a>';
        return $str;
    }
}



$transport  = $this->transport;

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


/*
<div id="content" class="container">

            Array
(
    [codePiece] =&gt; FCA789789XXX
    [clientName] =&gt; Berenger
    [clientPhone] =&gt; 0661845372
    [clientAddress] =&gt; 5 rue de Provence
    [clientZip] =&gt; 75009
    [clientCity] =&gt; Paris
    [depot] =&gt; lpn75020qs
    [vendor] =&gt; MRsqdqsdqSqs
    [price] =&gt; 50
    [carrierName] =&gt; LABOULLE!!!qsdsqdqsd
    [quoteNumber] =&gt; 1212121212888
    [trackingNumber] =&gt; qsdqsdsqdqsdq
    [shippingDate] =&gt; Pimcore\Date Object
    [reglement] =&gt; PAYEqsd
)
*/

?>
<div class="p-3 bg-light">


<h3>Livraison <?php echo $finalAttributesHtml["codePiece"]; ?> <span class="shippingDate-container"> - <?php echo $finalAttributesHtml["shippingDate"]; ?></span></h3>

<div class="row mt-4">
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

<div class="col">
<input type="button" class="btn  btn-primary" value="Créer" id="create-btn" onclick="printBook();return false;" />
<input type="button" class="btn  btn-outline-primary" value="Mail" id="sendmail-btn" onclick="printBook();return false;" />
<input type="button" class="btn  btn-outline-primary" value="Imprimer" id="print-btn" onclick="printBook();return false;" />
</div>

</div>

<div id="msg" class="p-3 m-3 mr-0"></div>

<script>
var transportId="<?php echo $transport->getId()?>";

function refreshFields(transport) {
    if(transport.o_id) {
        $('#create-btn').hide();
        $('#sendmail-btn').show();
        $('#print-btn').show();
    }
    else {
        $('#create-btn').show();
        $('#sendmail-btn').hide();
        $('#print-btn').hide();
    }
    if(!transport.shippingDate || transport.shippingDate.length==0)
        $('.shippingDate-container').hide();
    else {
        $('.shippingDate-container').show();
    }
}

function showMessage(msg) {
    $('#msg').addClass('alert-success').removeClass('alert-error').html(msg).show();
}

$(document).ready(function() {
   
    $.fn.editableform.buttons = '<div class="editable-buttons"><button type="submit" class="btn btn-sm btn-primary btn-sm editable-submit"><svg fill="#000000" height="12" viewBox="0 0 24 24" width="24" xmlns="http://www.w3.org/2000/svg"><path d="M0 0h24v24H0z" fill="none"/><path d="M9 16.2L4.8 12l-1.4 1.4L9 19 21 7l-1.4-1.4L9 16.2z"/></svg></button><button type="button" class="btn btn-default btn-sm editable-cancel"><svg fill="#000000" height="24" viewBox="0 0 24 24" width="12" xmlns="http://www.w3.org/2000/svg"><path d="M19 6.41L17.59 5 12 10.59 6.41 5 5 6.41 10.59 12 5 17.59 6.41 19 12 13.41 17.59 19 19 17.59 13.41 12z"/><path d="M0 0h24v24H0z" fill="none"/></svg></button></div>';




    $('#create-btn').click(function() {
        showMessage('#create-btn CLICK')
       $('.editable').editable('submit', { 
           url: '/transport/update', 
           ajaxOptions: {
               dataType: 'json' //assuming json response
           },           
           success: function(data, config) {
               showMessage('#create-btn SUCSESSS');
               console.log(data);
               if(data && data.transport && data.transport.o_id) {  //record created, response like {"id": 2}
                   //set pk
                   $(this).editable('option', 'pk', data.transport.o_id);
                   //remove unsaved class
                   $(this).removeClass('editable-unsaved');
                   //show messages
                   var msg = 'New user created! Now editables submit individually.';
                   $('#msg').addClass('alert-success').removeClass('alert-error').html(msg).show();
                   $('#create-btn').hide(); 
                   $(this).off('save.newuser');   
                   refreshFields(transport);

               } else if(data && data.errors){ 
                   //server-side validation error, response like {"errors": {"username": "username already exist"} }
                   config.error.call(this, data.errors);
               }               
           },
           error: function(errors) {
               var msg = '';
               if(errors && errors.responseText) { //ajax error, errors = xhr object
                   msg = errors.responseText;
               } else { //validation error (client-side or server-side)
                   $.each(errors, function(k, v) { msg += k+": "+v+"<br>"; });
               } 
               $('#msg').removeClass('alert-success').addClass('alert-error').html(msg).show();
           }
       });
    });



    //INitialise UI
    <?php 
    $data = \Pimcore\Tool\Serialize::removeReferenceLoops($transport);
    $data = \Zend_Json::encode($data, null, []);
    ?>
    var transportJson = <?php echo $data ?>;
    refreshFields(transportJson);

    $('.editable').editable({
        type: 'text',
        url: '/transport/update',    
        pk: transportId, 
        emptytext : '........',  
        //title: 'Enter username',
        showbuttons : true,
        ajaxOptions: {
            dataType: 'json'
        },
        success: function(response, newValue) {
            if(!response) {
                showMessage ('OK');
            }          
            
            if(response.success === false) {
                 showMessage("Erreur "+response.msg);
            }
            else {
                showMessage(response.msg);
                $(this).editable('option', 'pk', response.transport.o_id);
            }
        }        
    });

    $('.editable').on('save.newuser', function(){
       var that = this;
       setTimeout(function() {
           $(that).closest('tr').next().find('.editable').editable('show');
       }, 200);
   });

});

</script>
</div>
