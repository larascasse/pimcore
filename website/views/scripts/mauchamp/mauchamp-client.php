<div style="display: none;">
            <textarea  cols="50" rows="20" name="xml"><?php echo $this->xmlClient ?></textarea>
</div>


<script>

$(document).ready(function() {
	window.log("INIT");
  
});



function showPleaseWait (message) {
            if(typeof(message)=='undefined')
                message = 'En cours de traitement';
            $('#pleasewaitmodal').modal();
        };

function hidePleaseWait (message) {
            if(typeof(message)=='undefined')
                message = 'En cours de traitement';
            $('#pleasewaitmodal').modal('hide');
        };


// Extended disable function
jQuery.fn.extend({
    disable: function(state) {
        return this.each(function() {
            var $this = $(this);
            if($this.is('input, button, textarea, select'))
              this.disabled = state;
            else
              $this.toggleClass('disabled', state);
        });
    }
});


function sendEmail(target) {
  window.log("KK",$("#mailform"),$("#mailform").serialize());
  var btn = $(target);
  btn.disabled=true;
  showPleaseWait();
  $.ajax({
     url : 'https://www.laparqueterienouvelle.fr/LPN/create_customer.php',
     data: $("#mailform").serialize(),
     method : "POST",
     success: function (data) {

            hidePleaseWait();
            alert(data);
            btn.disabled=false;

      },
      error: function (transport) {
        
              btn.disabled=false;
              console.log(transport);
              
              hidePleaseWait();
              alert(transport.statusText);

      }

  });
}

</script>


<?php
$email = $this->client->Email_Contact;

$customer = \Website\Tool\MagentoHelper::loadMagentoCustomer($email);

/*
$client = new SoapClient('https://www.laparqueterienouvelle.fr/api/v2_soap/?wsdl');

// If some stuff requires api authentification,
// then get a session token
$session = $client->login('pimcore', 'Nuur3vay?');
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
*/
?>

  <div class="container__" style="padding-top: 40px;">
  <div class="row">
    <div class="col-12">
      

      <?php if (!$customer) : ?>
      <h4 style="padding-bottom: 40px; text-align: center;"><?php echo $this->client->Code_Client ?> - <?php echo $email; ?></i></h4>
      <form id="mailform" class="form-horizontal">
      <div class="text-center">
        
        <div class="checkbox">
          <label>
            <input type="checkbox" class="btn btn-primary" name="newsletter" value="1" /> Inscription Newsletter
          </label>
        </div>
        
        <div class="form-group"  style="padding-bottom: 40px;">
          <input type="button" class="btn btn-primary btn-lg" name="button" onclick="sendEmail(this)" value="Créer un compte web" /><br />
          <div style="display: none;">
            <textarea  cols="50" rows="20" name="xml"><?php echo $this->xmlClient ?></textarea>
          </div>
        </div>



      </div>

      <?php 
      else : 
        ?>
        <h4 style="padding-bottom: 40px; text-align: center;">Client existant sur le WEB</h4>
       
        <?php
        foreach ($customer as $key => $value) {
             echo '<div class="form-group row"><div class="col-sm-2"><label>'.$key.' : </label></div><div class="col-sm-10"><input disabled value="'.$value.'"  class="form-control"/></div></div>';
        }


    endif; ?>
<hr />
<br /><br /><br /><br /><br /><br /><br />
 <h4>Données client</h4>

<?php foreach ($this->client as $key => $value) {


    if(is_array($value)) {
       
        echo '<div class="row">';
        for($i=0; $i<count($value); $i++){
           echo '<div class="col-sm-6"><hr /><h4>Adresse</h4>';
          $adresse = $value[$i];
          
          foreach ($adresse as $keyAdresse => $valueAdresse) {
            
            echo '<div class="form-group row"><label>'.$keyAdresse.' : </label> <input disabled value="'.$valueAdresse.'"  class="form-control" /></div>';
          }
          echo '</div>';

        }
        echo '</div>';
    }
    else if(is_string($value)) {
        echo '<div class="form-group row"><div class="col-sm-2"><label>'.$key.' : </label></div><div class="col-sm-10"><input disabled value="'.$value.'"  class="form-control"/></div></div>';
    }
  
}
?>



<div id="pleasewaitmodal" class="modal fade bd-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true"><div class="modal-dialog"><div class="modal-content"> <div class="modal-header"><h5 class="modal-title" id="exampleModalLongTitle">Création du compte pro Web</h5></div><div class="modal-body">En cours de traitement</div></div></div></div>

</div>
</div>
</div>