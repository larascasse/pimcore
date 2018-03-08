<?php
use Egulias\EmailValidator\EmailValidator;
use Egulias\EmailValidator\Validation\RFCValidation;


$email = $this->email;

$validator = new EmailValidator();

$isEmailValid = $validator->isValid($email, new RFCValidation());


?>
<script>

	$(document).ready(function() {
	window.log("INIT");
  <?php if ($isEmailValid) { ?>
  loadMagentoClient();
  <?php } ?>
  
});


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




	function loadMagentoClient() {
  //window.log("KK",$("#mailform"),$("#mailform").serialize());
  $('#exampleModalLongTitle').html('Chargement des données');
  //showPleaseWait();
  var url = '/plugin/LpnMageSync/front/load-magento-client/email/<?php echo $email ?>';
  console.log("url... "+url);
  $('#unknown-customer').hide();
  $('#known-customer').hide();
  $.ajax({
     url : url,
     //data: $("#mailform").serialize(),
     method : "GET",
     success: function (data) {
            $('#waiting-customer').hide();

            //hidePleaseWait();
            console.log(data.customer);
            if(data.customer) {
              $('#known-customer').show();
            }
            else {
              $('#unknown-customer').show();
            }


      },
      error: function (transport) {
            $('#waiting-customer').hide();
              console.log(transport);
              
              //hidePleaseWait();
              alert(transport.statusText);

      }

  });
}


function createCustomer(target) {
  window.log("KK",$("#mailform-client"),$("#mailform-client").serialize());
  var btn = $(target);
  btn.disabled=true;
  
  $.ajax({
     url : '/plugin/LpnMageSync/front/create-magento-client/',
     data: $("#mailform-client").serialize(),
     method : "POST",
     success: function (data) {
        console.warn('OK',data);
     		alert(data.message);
     		btn.disabled=false;
            try {
			  	hidePleaseWait();
			  }
			  catch(e) {
			  	console.warn(e);
			  }
            
            

      },
      error: function (transport) {
        
        btn.disabled=false;
        console.warn('Error',transport);
              
        try {
			  	hidePleaseWait();
			  }
			  catch(e) {
			  	console.warn(e);
			  }
        if(typeof(transport.message) != "undefined")
          alert("Erreur : "+transport.message);
        else
          alert("Erreur bizarre, connecxion inexistante")

      }

  });
  try {
  	showPleaseWait();
  }
  catch(e) {
  	console.warn(e);
  }
  
}



</script>

<?php if($isEmailValid) { ?>
<div id="waiting-customer">
      <h4 style="padding-bottom: 40px; text-align: center;">Chargement du compte web ...</h4>
      
 </div>
<?php } else { ?>
  <div id="waiting-customer">
      <h4 style="padding-bottom: 40px; text-align: center; color:#FF0000">Email Client non valide</h4>
      
 </div>
<?php } ?>

<div id="unknown-customer" style="display:none">
      <h4 style="padding-bottom: 40px; text-align: center;"><?php echo $this->xmlClient->Code_Client ?> - <?php echo $email; ?></h4>
      <form id="mailform-client" class="form-horizontal">
      
	     <div class="text-center">
	        
	        <div class="checkbox">
	          <label>
	            <input type="checkbox" class="btn btn-primary" name="newsletter" value="1" />Inscription Newsletter
	          </label>
	        </div>
	        
          <div class="form-group"  style="padding-bottom: 40px;">
            <input type="button" class="btn btn-primary btn-lg" name="button" onclick="createCustomer(this)" value="Créer un compte web" /><br />
            <div style="display: none;">
              <textarea  cols="50" rows="20" name="xmlclient"><?php echo $this->xmlClient->asXML() ?></textarea>
            </div>
          </div>

      </div>


	   </form>
 </div>


<div id="known-customer" style="display:none">
        <h4 style="padding-bottom: 40px; text-align: center;">Client existant sur le WEB</h4>
        <div class="row" id="client-container">
        </div>
</div>

<br /><br /><br /><br /><br /><br />

 <h4>Données client</h4>
        <?php
        if(isset($this->xmlClient)) {
          foreach ($this->xmlClient as $key => $value) {
               echo '<div class="row"><div class="col-sm-3">'.$key.' : </div><div class="col-sm-3">'.$value.'</div></div>';
          }
        }
        
        ?>




