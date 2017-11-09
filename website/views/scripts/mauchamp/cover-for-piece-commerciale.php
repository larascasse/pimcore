<?php

$orderDetail = $this->orderDetail;

?>
<div class="cover">


<div id="logo2" style='width:676px;height:60px'>
    <?php echo $this->template("includes/logo_1l_svg.php"); ?>


</div>


<h1 class="display-1">Votre commande <?php echo $orderDetail["Code_Commande"]?><small class="text-muted"> du <?php echo $orderDetail["Date"]?></small></h1>

<h2>Vos produits</h2>
<?php
foreach ($this->products as $product) {
  echo '<p>'.$product->getName().'<p>';
}
?>


<div class="row lpn-contact">
  <div class="col-xs-12">
    <h2>Contact</h2>
    <p><?php echo $orderDetail["Representant"]?> - <?php echo $orderDetail["Representant_Email"]?></p>
    <p><?php echo $orderDetail["Representant2"]?> - <?php echo $orderDetail["Representant2_Email"]?></p>
    <p>La Parqueterie Nouvelle - Paris<br />Angle 141 rue de Bagnolet / 3 rue Pelleport<br />75020 Paris</p>
  </div>

  


</div>

<h2>Nos adresses</h2>
<div class="row showroom-adresses">
  <div class="col-xs-4">
    <p>La Parqueterie Nouvelle - Paris<br />Angle 141 rue de Bagnolet / 3 rue Pelleport<br />75020 Paris</p>
  </div>

  <div class="col-xs-4">
    <p>La Parqueterie Nouvelle - Carrières<br />33, rue des entrepreneurs / ZA des Amandiers<br />78240 Carrières sur Seine</p>
  </div>

  <div class="col-xs-4">
    <p>La Parqueterie Nouvelle - Chambourcy<br />22, route de Mantes<br />78240 Chambourcy</p>
  </div>


</div>




</div>