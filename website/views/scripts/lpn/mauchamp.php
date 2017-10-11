<div style="padding: 80px;">
	<table class="table table-bordered table-striped">
		<thead class="thead-inverse__">
			<tr>
      <th>EAN</th>
      <th>Nom</th>
      <th></th>
      <th></th>
    </tr>
		</thead>
		<tbody>

<?php

//print_r($this->products);

foreach ($this->products as $product) {
	?>
	<tr class="row__">
	<td class="col__"><h5><?php echo $product->getSku()?></h5></td>
	<td class="col__"><h5><?php echo $product->getName()?></h5></td>
	<!--<div class="col"><a href="<?php echo $product->getMage_fichepdf()?>" class="btn noajaxload" target="_blank">Fiche technique V1</a></div>-->
	<td class="col__"><a href="/id/<?php echo $product->getId()?>?_dc=<?php echo time()?>" class="btn noajaxload table-selectionner-btn" target="_blank">Fiche technique</a></td>
	<td class="col__"><a href="/id/<?php echo $product->getId()?>?_dc=<?php echo time()?>" class="btn noajaxload btn-inverse" target="_blank">Photos</a></td>
	</tr>
	<?php
}

?>
</tbody>
</table>
</div>