<?php
$email = $this->email;

?>
<script>

	$(document).ready(function() {
	window.log("INIT");
  loadMagentoClient();
  
});


	function loadMagentoClient() {
  //window.log("KK",$("#mailform"),$("#mailform").serialize());
  $('#exampleModalLongTitle').html('Chargement des données');
  //showPleaseWait();
  var url = '/plugin/LpnMageSync/index/load-magento-client/email/<?php echo $email ?>';
  console.log("url... "+url);
  $('#unknown-customer').hide();
  $('#known-customer').hide();
  $.ajax({
     url : url,
     //data: $("#mailform").serialize(),
     method : "GET",
     success: function (data) {

            hidePleaseWait();
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
              
              hidePleaseWait();
              alert(transport.statusText);

      }

  });
}


function createCustomer(target) {
  window.log("KK",$("#mailform"),$("#mailform").serialize());
  var btn = $(target);
  btn.disabled=true;
  showPleaseWait();
  $.ajax({
     url : '/plugin/LpnMageSync/index/create-magento-client/',
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
				<div style="display: block;">
					<textarea  cols="50" rows="20" name="xml"><?php echo $this->xmlClient ?></textarea>
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

