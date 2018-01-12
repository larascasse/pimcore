<?php
$email = $this->email;

?>
<script>

	$(document).ready(function() {
	window.log("INIT");
  loadMagentoClient();
  
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
        
              console.log(transport);
              
              //hidePleaseWait();
              alert(transport.statusText);

      }

  });
}


function createCustomer(target) {
  window.log("KK",$("#mailform"),$("#mailform").serialize());
  var btn = $(target);
  btn.disabled=true;
  
  $.ajax({
     url : '/plugin/LpnMageSync/front/create-magento-client/',
     data: $("#mailform").serialize(),
     method : "POST",
     success: function (data) {
     		alert(data);
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
              console.log(transport);
              
             try {
			  	hidePleaseWait();
			  }
			  catch(e) {
			  	console.warn(e);
			  }
              alert(transport.statusText);

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


       <div id="unknown-customer" style="display:none">
      <h4 style="padding-bottom: 40px; text-align: center;"><?php echo $this->client->Code_Client ?> - <?php echo $email; ?></i></h4>
      <form id="mailform" class="form-horizontal">
      
	     <div class="text-center">
	        
	        <div class="checkbox">
	          <label>
	            <input type="checkbox" class="btn btn-primary" name="newsletter" value="1" />Inscription Newsletter
	          </label>
	        </div>
	        
			<div class="form-group"  style="padding-bottom: 40px;">
				<input type="button" class="btn btn-primary btn-lg" name="button" onclick="createCustomer(this)" value="Créer un compte web" /><br />
				<div style="display: none;">
					<textarea  cols="50" rows="20" name="xmlclient"><?php echo $this->xmlClient ?></textarea>
				</div>
	     </div>


	   </form>
      </div>

  </div>

          <div id="known-customer" style="display:none">
        <h4 style="padding-bottom: 40px; text-align: center;">Client existant sur le WEB</h4>
       
        <?php
        if(isset($customer)) {
        	foreach ($customer as $key => $value) {
	             echo '<div class="form-group row"><div class="col-sm-2"><label>'.$key.' : </label></div><div class="col-sm-10"><input disabled value="'.$value.'"  class="form-control"/></div></div>';
	        }
        }
        
        ?>
        </div>

