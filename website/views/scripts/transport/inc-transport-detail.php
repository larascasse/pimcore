<?php 

if(!function_exists("makeTransportInput")) {
    function makeTransportInput($name,$value,$label="",$type="text",$datasource="",$selectValue="") {
        $str ="";

        $strSelect = "";
        if($type=="select") {
          $strSelect = " data-source='".$datasource."' data-value='".$selectValue."'";
        }
        else if ($type=="date") {
          $strSelect = " data-format='dd/mm/yyyy'";
        }

        $str .='<a href="#"" type="'.$type.'" id="'.$name.'" name="'.$name.'" class="editable" data-placeholder="'.$label.'" data-type="'.$type.'" '.$strSelect .' />'.$value.'</a>';
        

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

    $datasource = "";
    $selectValue = "";
    
    switch ($value->fieldtype) {
        case 'textarea':
             $type = "textarea";
            break;
        
        case 'date':
             $type = "date";
             
             if($attributeValue > 0) {
                $date = new DateTime($attributeValue);     
                $attributeValue = $date->format("d/m/Y");
             }
             
            break;

        case 'select':
             $type = "select";


             $option = Object_Service::getOptionsForSelectField($transport,$attributeKey);
              $json = \Pimcore\Tool\Serialize::removeReferenceLoops($option);
              $json = \Zend_Json::encode($json, null, []);
              $datasource = $json;

              $selectValue = $attributeValue;
              if(empty($selectValue)) {
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

<div class="row transport-short colored">
<div class="col">
Livraison le  <?php echo $finalAttributesHtml["shippingDate"]; ?> - <?php echo $finalAttributesHtml["status"];?>
<br />
par : <?php echo $finalAttributesHtml["carrierName"]; ?>
  depuis : <?php echo $finalAttributesHtml["depot"]; ?><br />
  Client : <?php echo $finalAttributesHtml["clientName"];?><br />
  Pièce : <?php echo $finalAttributesHtml["codePiece"]; ?>
</div>

<div class="col">

Adresse de livraison :<br />
<?php echo $finalAttributesHtml["shippingName"];?><br />
<?php echo $finalAttributesHtml["shippingAddress"]; ?><br />
<?php echo $finalAttributesHtml["shippingZip"]; ?>  <?php echo $finalAttributesHtml["shippingCity"]; ?>
</div>

<div class="col">
  Message : <br ><?php echo $finalAttributesHtml["shippingMessage"]; ?><br />
</div>

<div class="col">
Prix : <?php echo $finalAttributesHtml["price"]; ?><br />
Cotation : <?php echo $finalAttributesHtml["quoteNumber"];?><br />
Numéro de tracking : <?php echo $finalAttributesHtml["trackingNumber"]; ?><br />
Règlement : <?php echo $finalAttributesHtml["reglement"]; ?><br />
Contact LPN : <?php echo $finalAttributesHtml["vendor"]; ?>
</div>





<div class="col d-flex align-items-center flex-column"  style="background-color: white">

<div class="row">
  <input type="button" class="btn  btn-primary create-btn" value="Créer" onclick="" />
  <input type="button" class="btn  btn-outline-primary validate-btn" value="Valider"  onclick="" />
  <input type="button" class="btn  btn-outline-primary sendmail-btn" value="Mail" onclick="" />
  <input type="button" class="btn  btn-outline-primary print-btn" value="Imprimer" onclick="" />
</div>
<br />
<div class="row">
<div id="msg-transport" class="p-3 al-colored" style="width: 100%"></div>
</div>
</div>


</div>





<?php if(isset($this->notes) && 1==2) { ?>
<div>
  <table class="table table-striped">
     <tbody>
    <?php 
    foreach ($this->notes as $note) {
      echo "<tr>";
      echo "<td>".date("d/m/Y h:i",$note->getDate())."</td>";
      echo "<td>".$note->getType()."</td>";
      echo "<td>".$note->getTitle()."</td>";
      echo "<td>".$note->getDescription()."</td>";
       echo "</tr>";
    }
?>
</tbody>
</table>
<?php } ?>

<div id="app">
  <b-table v-html striped hover :items="items"  :fields="fields">
      <template slot="dateString" slot-scope="data">
      {{data.value}}
    </template> 

    <template slot="title" slot-scope="data">
      <span v-html="data.value"></span>
     
    </template>

  </b-table>
</div>


<script>




  var noteVue;
  $(document).ready(function() {
 

    noteVue = new Vue({
        el: '#app',
        
        data: {
          fields: [{key:'dateString',label:"Date",sortable:true}, {key:'type',sortable:false,label: 'Action'}, {key:'title',sortable:false,label: 'Détail'} ],
          items: null
        }
    });
    console.log(noteVue);
    /*
  export default {
    data () {
      return {
        items: items
      }
    }
  }*/
});

</script>


<script>
var transportId="<?php echo $transport->getId()?>";
var transportShippingDate="<?php echo is_object($transport->getShippingDate())?$transport->getShippingDate()->getTimestamp():"";?>";



function refreshFields(transport,notes) {

    $('.sendmail-btn').hide();
    $('.create-btn').hide();
    $('.print-btn').hide();
    $('.validate-btn').hide();

    if(transport.o_id) {

        if(transport.status == "new" || transport.status == "") {
             $('.validate-btn').show();
        }
        else {
            $('.sendmail-btn').show();
            $('.print-btn').show();
        }
        
        $('.colored').removeClassPrefix('bg-').addClass('bg-'+transport.classForStatus);
        $('.text-colored').removeClassPrefix('text-').addClass('text-'+transport.classForStatus);
        $('.al-colored').removeClassPrefix('alert-').addClass('alert-'+transport.classForStatus);
        showMessageTransport(transport.messageForStatus);
      
    }
    else {
        $('.create-btn').show();
    }
    if(!transport.shippingDate || transport.shippingDate.length==0)
        $('.shippingDate-container').hide();
    else {
        $('.shippingDate-container').show();
    }
    if(typeof(notes) != 'undefined') {
      console.log("refresh notes",notes)
      noteVue.items = notes;
    }
}

function showMessageTransport(msg) {
    //$('#msg').addClass('alert-success').removeClass('alert-error').html(msg).show();
    $('#msg-transport').html(msg).show();
}

$(document).ready(function() {
   
    $.fn.editableform.buttons = '<div class="editable-buttons"><button type="submit" class="btn btn-sm btn-primary btn-sm editable-submit"><svg fill="#000000" height="12" viewBox="0 0 24 24" width="24" xmlns="http://www.w3.org/2000/svg"><path d="M0 0h24v24H0z" fill="none"/><path d="M9 16.2L4.8 12l-1.4 1.4L9 19 21 7l-1.4-1.4L9 16.2z"/></svg></button><button type="button" class="btn btn-default btn-sm editable-cancel"><svg fill="#000000" height="24" viewBox="0 0 24 24" width="12" xmlns="http://www.w3.org/2000/svg"><path d="M19 6.41L17.59 5 12 10.59 6.41 5 5 6.41 10.59 12 5 17.59 6.41 19 12 13.41 17.59 19 19 17.59 13.41 12z"/><path d="M0 0h24v24H0z" fill="none"/></svg></button></div>';


    $.fn.removeClassPrefix = function(prefix) {
    this.each(function(i, el) {
        var classes = el.className.split(" ").filter(function(c) {
            return c.lastIndexOf(prefix, 0) !== 0;
        });
        el.className = classes.join(" ");
    });
    return this;
};




    $('.create-btn').click(function() {
        showMessageTransport('.create-btn CLICK')
       $('.editable').editable('submit', { 
           url: '/transport/update', 
           ajaxOptions: {
               dataType: 'json' //assuming json response
           },           
           success: function(data, config) {
               showMessageTransport('.create-btn');
               console.log(data);
               if(data && data.transport && data.transport.o_id) {  //record created, response like {"id": 2}
                   //set pk
                   $(this).editable('option', 'pk', data.transport.o_id);
                   //remove unsaved class
                   $(this).removeClass('editable-unsaved');
                   //show messages
                   var msg = 'New user created! Now editables submit individually.';
                   showMessageTransport (msg);
                   $('#create-btn').hide(); 
                   $(this).off('save.newuser');   
                   refreshFields(data.transport,data.notes);

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
               showMessageTransport(msg);
           }
       });
    });



    //INitialise UI
    <?php 
    $data = \Pimcore\Tool\Serialize::removeReferenceLoops(\Website\Tool\TransportHelper::getJsonReadyForTransport($transport));
    $data = \Zend_Json::encode($data, null, []);

    $dataNotes = \Pimcore\Tool\Serialize::removeReferenceLoops($this->notes);
    $dataNotes = \Zend_Json::encode($dataNotes, null, []);



    ?>
    var transportJson = <?php echo $data ?>;
    var notesJson = <?php echo $dataNotes ?>;
    console.log(transportJson);



    refreshFields(transportJson,notesJson);

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
                showMessageTransport ('OK');
            }          
            
            if(response.success === false) {
                 showMessageTransport("Erreur "+response.msg);
            }
            else {
                //Creation
                showMessageTransport(response.msg);
                $(this).editable('option', 'pk', response.transport.o_id);
                refreshFields(response.transport,response.notes);
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
