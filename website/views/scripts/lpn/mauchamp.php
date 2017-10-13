<script>
	console.log("klklmklkml");
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

</script>
<div style="padding-top: 80px;">
	<table class="table table-bordered table-striped">
		<thead class="thead-inverse__">
			<tr>
      <th>EAN</th>
      <th>Nom</th>
      <th><input type="checkbox" id="selectAllFt" /></th>
      <th></th>
      <th><input type="checkbox" id="selectAllPose" /></th>
      <th></th>
      <th><input type="checkbox" id="selectAllPhoto" /></th>
      <th></th>
    </tr>
		</thead>
		<tbody>

<?php

//print_r($this->products);

foreach ($this->products as $product) {
	$sku = $product->getSku();
	?>
	<tr class="row__">
	<td class="col__"><?php echo $sku ?></td>
	<td class="col__"><?php echo $product->getName()?></td>
	
	<!--<div class="col"><a href="<?php echo $product->getMage_fichepdf()?>" class="btn noajaxload" target="_blank">Fiche technique V1</a></div>-->
	<td class="col__"><input type="checkbox" class="check-ft"/></td>
	<td class="col__"><a href="/id/<?php echo $product->getId()?>?_dc=<?php echo time()?>" class="btn-link noajaxload table-selectionner-btn__" target="_blank" value="<?php echo $sku ?>">Fiche technique</a></td>


	<td class="col__"><input type="checkbox"  class="check-pose"/></td>
	<td class="col__"><a href="/id/<?php echo $product->getId()?>?_dc=<?php echo time()?>" class="btn-link noajaxload table-selectionner-btn__" target="_blank" value="<?php echo $sku ?>">Pose</a></td>


	<td class="col__"><input type="checkbox"  class="check-photo" value="<?php echo $sku ?>"/></td>
	<td class="col__"><a href="/id/<?php echo $product->getId()?>?_dc=<?php echo time()?>" class="btn-link noajaxload btn-inverse_" target="_blank">Photos</a></td>
	</tr>
	<?php
}

?>
</tbody>
</table>
<div class="row">
	<div class="col-12 text-right">
		<a class="btn  btn-outline-primary" data-toggle="collapse" href="#formEmail" aria-expanded="false" aria-controls="formEmail" role="button">Envoyer la sélection par email</a>
		<a href="/id/<?php echo $product->getId()?>?_dc=<?php echo time()?>" class="btn  btn-outline-primary" target="_blank">Imprimer la sélection</a>
	</div>
</div>
</div>


<div class="collapse" id="formEmail">
	<div class="row justify-content-center">
  <div class="card card-inverse card-info card-block" style="max-width: 800px;margin-top:80px;margin-bottom:80px;">
  	<form>
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
 <input type="submit" value="Envoyer" />
 </form>
</div>

</div>
  </div>
</div>
