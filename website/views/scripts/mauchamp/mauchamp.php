<script>

$(document).ready(function() {
	console.log("INIT");
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
  console.log("KK",$("#mailform"),$("#mailform").serialize());
  showPleaseWait();
  $.ajax({
     url : '/?controller=mauchamp&action=mauchamp-sendmail',
     data: $("#mailform").serialize()+'&sendmail=true',
     method : "POST",
     success: function (data) {

       

            hidePleaseWait();
            alert(data);

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
</tbody>
</table>
<div class="row">
	<div class="col-12 text-right">
		<a class="btn  btn-outline-primary" data-toggle="collapse" href="#formEmail" aria-expanded="false" aria-controls="formEmail" role="button">Envoyer la sélection par email</a>
		<a href="#" class="btn  btn-outline-primary" target="_blank">Imprimer la sélection</a>
	</div>
</div>
</div>


<div class="collapse" id="formEmail">
	<div class="row justify-content-center">
  <div class="card card-inverse card-info card-block" style="max-width: 800px;margin-top:80px;margin-bottom:80px;">
  
    <div class="form-group has-success__">
  <label class="form-control-label" for="inputSuccess1">Sujet</label>
  <input type="text" class="form-control form-control-success" id="inputSuccess1" value="Votre visite à La Parqueterie Nouvelle">
  <!--<div class="form-control-feedback">Success! You've done it.</div>
  <small class="form-text text-muted">Example help text that remains unchanged.</small>-->
	</div>

	<div class="form-group">
  <label class="form-control-label" for="inputWarning1">Message</label>
  <textarea class="form-control" rows="10" id="inputWarning1">Bonjour,

Merci pour votre commande CCA12343.

Vous trouverez, en pièce jointe, toutes les informations concernant celle-ci.

Si vous avez besoin de plus amples information, je me tiens à votre dispositions :).

Thierry & Michel</textarea>
</div>
 <input type="button" value="Envoyer" id="sendmail" onclick="sendEmail();return false;" />

</div>

</div>
  </div>
</div>
 </form>
<div id="pleasewaitmodal" class="modal fade bd-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true"><div class="modal-dialog modal-sm"><div class="modal-content">En cours de traitement</div></div></div>

<?php print_r($_SERVER); ?>