<script>

$(document).ready(function() {
	console.log("INIT");
  
});



function showPleaseWait () {
            $('#pleasewaitmodal').modal();
        };

function hidePleaseWait () {
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
  console.log("KK",$("#mailform"),$("#mailform").serialize());
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
              alert(transport.statusText);
              hidePleaseWait();

      }

  });
}

</script>

  <div class="container" style="padding-top: 40px;">
  <div class="row">
    <div class="col-xs-12">
      <form id="mailform">
      <div class="text-center">
        <div class="checkbox">
          <label>
          <input type="checkbox" class="btn" name="newsletter" value="1" /> Inscription Newsletter
          </label>
        </div>
        <div class="form-group">
          <input type="button" class="btn" name="button" onclick="sendEmail(this)" value="Créer un compte web" /><br />

          <textarea  cols="50" rows="20" name="xml"><?php echo $this->xmlClient ?></textarea>


        </div>
      </div>

      </form>
<hr />

<?php foreach ($this->client as $key => $value) {
  echo '<div class="form-group"><label>'.$key.' : </label> <input disabled value="'.$value.'" /></div>';
}
?>



<div id="pleasewaitmodal" class="modal fade bd-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true"><div class="modal-dialog modal-sm"><div class="modal-content">En cours de traitement</div></div></div>

</div>
</div>
</div>