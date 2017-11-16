<?php

$orderDetail = $this->orderDetail;

?>

<script>

$(document).ready(function() {
	window.log("INIT");
  $('#selectAllFt').on('click', function () {
  	//console.log('KKKKKKKKK',$('input[type="checkbox"]', '.check-ft'))
    if ($(this).hasClass('allChecked')) {
        $('.check-ft').attr('checked', false);
    } else {
        $('.check-ft').attr('checked', true);
    }
    $(this).toggleClass('allChecked');
  });
  $('#selectAllPose').on('click', function () {
  	//console.log('KKKKKKKKK',$('input[type="checkbox"]', '.check-ft'))
    if ($(this).hasClass('allChecked')) {
        $('.check-pose').attr('checked', false);
    } else {
        $('.check-pose').attr('checked', true);
    }
    $(this).toggleClass('allChecked');
  });
  $('#selectAllPhoto').on('click', function () {
  	//console.log('KKKKKKKKK',$('input[type="checkbox"]', '.check-ft'))
    if ($(this).hasClass('allChecked')) {
        $('.check-photo').attr('checked', false);
    } else {
        $('.check-photo').attr('checked', true);
    }
    $(this).toggleClass('allChecked');
  });

  $('#selectAllFt').click();
  $('#selectAllPose').click();
  $('#selectAllPhoto').click();


});



function showPleaseWait () {
            $('#pleasewaitmodal').modal();
        };

function hidePleaseWait () {
            $('#pleasewaitmodal').modal('hide');
        };




function sendEmail() {
  //window.log("KK",$("#mailform"),$("#mailform").serialize());
  $('#formEmail').modal('hide')
  showPleaseWait();
  $.ajax({
     url : '/?controller=mauchamp&action=mauchamp-sendmail',
     data: $("#mailform").serialize()+'&sendmail=true',
     method : "POST",
     success: function (data) {

            hidePleaseWait();
            alert(data.message);

      },
      error: function (transport) {
        
              btn.disabled=false;
              //console.log(transport);
              
              hidePleaseWait();
              alert(transport.statusText);

      }
  });
}


function printBook() {
  //window.log("KK",$("#mailform"),$("#mailform").serialize());
  $('#formEmail').modal('hide')
  showPleaseWait();
  $.ajax({
     url : '/?controller=mauchamp&action=mauchamp-sendmail',
     data: $("#mailform").serialize()+'&sendmail=false',
     method : "POST",
     success: function (data) {

            hidePleaseWait();
            PDFObject.embed(data.pdfFileUrl, "#pdf-container");

            //$('#pdfmodal .modal-content .modal-body').html('<object id="myPdf" type="application/pdf" data="' + data.pdfFileUrl +'" height="400" width="100%"></object>');
            $('#pdfmodal').modal().handleUpdate();
            //alert(data.message+" : "+data.pdfFileUrl);

      },
      error: function (transport) {
        
              btn.disabled=false;
              //console.log(transport);
              
              hidePleaseWait();
              alert(transport.statusText);

      }
  });
}

</script>
<form id="mailform">
<div style="padding-top: 80px;">
	<table class="table table-bordered table-striped">
		<thead class="thead-inverse__">
<?php
$hasOnePose = false;
foreach ($this->products as $product) {
  if(strlen($urlFichePose = $product->getMage_notice_pose_lpn())>0) {
    $hasOnePose = true;
    break;
  }
}
?>
			<tr>
      <th>EAN</th>
      <th>Nom</th>
      <th colspan="2"><input type="checkbox" id="selectAllFt" /></th>
      <?php if ($hasOnePose) : ?>
      <th colspan="2"><input type="checkbox" id="selectAllPose" /></th>
    <?php endif ?>
      <th colspan="2"><input type="checkbox" id="selectAllPhoto" /></th>
    </tr>
		</thead>
		<tbody>

<?php

//print_r($this->products);


foreach ($this->products as $product) {
	$sku = $product->getSku();
  $hasPose = strlen($urlFichePose = $product->getMage_notice_pose_lpn())>0;
  $hasPhoto = isset($product);
	?>
	<tr class="row__">
	<td class="col__"><?php echo $sku ?></td>
	<td class="col__"><?php echo $product->getName()?></td>
	
	<!--<div class="col"><a href="<?php echo $product->getMage_fichepdf()?>" class="btn noajaxload" target="_blank">Fiche technique V1</a></div>-->
	<td class="col__"><input type="checkbox" class="check-ft" name="ft[]" value="<?php echo $product->getSku()?>"/></td>
	<td class="col__"><a href="<?php echo $product->getMage_fichepdf()?>?_dc=<?php echo time()?>" class="btn-link noajaxload table-selectionner-btn__" target="_blank" value="<?php echo $sku ?>">Fiche technique</a></td>


<?php if($hasPose) : ?>
	<td class="col__"><input type="checkbox"  class="check-pose"  name="pose[]" value="<?php echo $product->getSku()?>"/></td>
	<td class="col__"><a href="/id/<?php echo $product->getId()?>?_dc=<?php echo time()?>" class="btn-link noajaxload table-selectionner-btn__" target="_blank" value="<?php echo $sku ?>">Pose</a></td>
    <?php else : ?>
    <!--
    <td></td>
      <td></td>
    -->
<?php endif; ?>


    <td class="col__">
      <?php if($hasPhoto) : ?>
      <input type="checkbox"  class="check-photo"  name="photos[]" value="<?php echo $product->getSku()?>"/>
      <?php endif; ?>
    </td>
    <td class="col__">
       <?php if($hasPhoto) : ?><a href="/id/<?php echo $product->getId()?>?_dc=<?php echo time()?>" class="btn-link noajaxload btn-inverse_" target="_blank">Photos</a>
       <?php endif; ?>
     </td>



	</tr>
	<?php
}

?>


<?php
foreach ($this->missingProducts as $product) {
 
  ?>
  <tr class="row__">
  <td class="col__"><?php echo $product->ean ?></td>
  <td class="col__"><?php echo $product->name?></td>
  <td colspan="4">Absent du PIM</td>  

  </tr>
  <?php
}

?>


</tbody>
</table>
<div class="row">
	<div class="col-12 text-right">
		<a class="btn  btn-outline-primary" data-toggle="modal" data-target="#formEmail"  href="#formEmail" aria-expanded="false" aria-controls="formEmail" role="button">Envoyer la sélection par email</a>
    <input type="button" class="btn  btn-outline-primary" value="Imprimer la sélection" id="printbook" onclick="printBook();return false;" />
	</div>
</div>
</div>

<!-- MODAL EMAIL -->
<div class="modal" role="dialog" id="formEmail">
  <div class="modal-dialog modal-lg">
    <div class="modal-content"  style="background-color: #bef0ff">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Envoyer les documents par e-mail</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

      <div class="modal-body">
        <div class="">


          <div class="form-group has-success__">
          <label class="form-control-label" for="inputSuccess1">Pour</label>
          <input type="text" class="form-control form-control-success" id="inputSuccess1" name="to-email" value="<?php echo $orderDetail["Email_Client"]?>">
          <!--<div class="form-control-feedback">Success! You've done it.</div>
          <small class="form-text text-muted">Example help text that remains unchanged.</small>-->
          </div>


            <div class="form-group has-success__">
          <label class="form-control-label" for="inputSuccess1">De la part de </label>
          <input type="text" class="form-control form-control-success" id="inputSuccess1" name="from-email" value="<?php echo $orderDetail["Representant2_Email"]?>">
          <!--<div class="form-control-feedback">Success! You've done it.</div>
          <small class="form-text text-muted">Example help text that remains unchanged.</small>-->
          </div>



          <div class="form-group has-success__">
            <label class="form-control-label" for="inputSuccess1">Sujet</label>
            <input type="text" class="form-control form-control-success" id="inputSuccess1" value="Votre visite à La Parqueterie Nouvelle">
            <!--<div class="form-control-feedback">Success! You've done it.</div>
            <small class="form-text text-muted">Example help text that remains unchanged.</small>-->
           </div>

          <div class="form-group">
            <label class="form-control-label" for="inputWarning1">Message</label>
            <textarea class="form-control" rows="10" id="inputWarning1" name="message">Bonjour,
Vous trouverez, en pièce jointe, toutes les informations relatives à votre <?php echo strtolower($orderDetail["Type_Piece"]) ?> n° <?php echo $orderDetail["Code_Commande"]?>.
Si vous avez besoin de plus amples informations, je me tiens à votre disposition :).
<?php echo $orderDetail["Representant2"]?></textarea>
            <textarea  cols="100" rows="20" name="xml"  style="display: none"><?php echo $this->xmlOrder ?></textarea>

          </div>

            <input type="button" class="btn btn-primary btn-block btn-lg" value="Envoyer" id="sendmail" onclick="sendEmail();return false;" />
        </div>
        <!-- / Modal body -->

      </div>
    </div>
  </div>
</div>
<!-- FIN MODAL EMAIL -->

</div>

 </form>


<div id="pleasewaitmodal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
  <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-body">
        <br />
        En cours de traitement
        <br />
      </div>
      </div>
    </div>
</div>

<div id="pdfmodal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel2" aria-hidden="true">
  <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

        <div class="modal-body">
        <div id="pdf-container" style="height: 600px"></div>
      </div>
      </div>
    </div>
</div>



<p class="small" style="color:#cccccc">
<?php 

foreach ($this->orderDetail as $key => $value) {
  //echo $key." : ".$value."<br />";
  # code...
}

?>
<div>
  <br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br />
<textarea  cols="100" rows="20" name="xml" style="font-size:10px; color:#CCCCCC"><?php echo $this->xmlOrder ?></textarea>
</div>

<?php 
//var_dump($_SERVER); 
?>
</p>