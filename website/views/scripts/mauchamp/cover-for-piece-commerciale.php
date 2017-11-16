<?php

$orderDetail = $this->orderDetail;

?>
<div class="cover">


<div class="ft-header">
  <div class="ft-col-1">
    <div id="" style='width:420px;height:124px'>
      <?php echo $this->template("includes/logo_2l_svg.php"); ?>
    </div>

  </div>
</div>


<div class="ft-content">

  <!-- First col -->
  <div class="ft-col-1">
  <h2><?php echo $orderDetail["Type_Piece"]?></h2>
  <p>
  <?php
  $products= array();
  $accessoires=array();
  foreach ($this->products as $product) {
    if(!$product->isAccessoire()) {
      $products[] = $product->getName();
    }
    else {
      $accessoires[] = $product->getName();

    }
  }
      echo "<p><strong>".implode("<br />",$products).'</strong></p><p>'.implode(", ",$accessoires).'</p>';

  ?></p>
  </div>

  <div class="ft-col-2">
    <div class="row lpn-contact">
      <div class="col-xs-12">
        <h2>Votre interlocuteur</h2>
        <p><?php echo $orderDetail["Representant"]?> - <?php echo $orderDetail["Representant_Email"]?></p>
        <p><?php echo $orderDetail["Representant2"]?> - <?php echo $orderDetail["Representant2_Email"]?></p>
        <p><?php
        $site = \Website\Tool\MauchampHelper::getSiteAdresse($orderDetail["Site"]);
        $str = $site["name"]."<br />".nl2br(\Website\Tool\MauchampHelper::getFormatedAdress($orderDetail["Site"])).$site["phone"];
        echo $str; 
        ?></p>
      </div>
    </div>
  </div>



  <div class="cover-title">
    <h1><?php echo $this->coverTitle; ?></h1>
    <hr/>
    <p>
      <?php echo $orderDetail["Code_Commande"]?> <br />
      <?php echo $orderDetail["Date"]?>
    </p>
  </div>


</div>
<!-- /ftcontent -->


<div class="ft-footer">
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
</div>