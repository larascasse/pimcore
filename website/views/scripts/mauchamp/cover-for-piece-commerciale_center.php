<?php

$orderDetail = $this->orderDetail;

?>

<script language="javascript" type="text/javascript">
window.onload = function() {
  var divName = "cover-title";
  var centeredDiv = document.getElementsByClassName(divName)[0];

  var div_width = document.getElementsByClassName('ft-content')[0].offsetWidth;
  var div_height = document.getElementsByClassName('ft-content')[0].offsetHeight - document.getElementsByClassName('cover-product-block')[0].offsetHeight;


 

  var offset = -(div_height-centeredDiv.offsetHeight)/2;
  //document.getElementsByClassName(divName)[0].style.height = div_height+'px';
  //document.getElementsByClassName(divName)[0].style.width = div_width+'px';
  //centeredDiv.style.position = 'absolute';
  //centeredDiv.style.top = offset;
  //document.getElementsByClassName(divName)[0].style.left = '50%';
  //document.getElementsByClassName(divName)[0].style.marginLeft = -set_width+'px';

   console.log("divName",offset)

  centeredDiv.style.marginTop = -offset+'px';
}
</script>



<div class="cover">


<div class="ft-header">
  

    <div id="" style='width:420px;height:100px'>
      <?php echo $this->template("includes/logo_1l_svg-big.php"); ?>
    </div>


  <div class="row lpn-contact">
      <div class="col-xs-3">

        <?php
        
        if(strlen($orderDetail["Representant2"])>0) 
          $representant = "Representant2";

        else if(strlen($orderDetail["Representant"])>0) 
          $representant = "Representant";

        $strRepresentant = "";
        if(isset($representant)) {
          $strRepresentant.="<strong>";
            $strRepresentant .= $orderDetail[$representant."_Prenom"];
            $strRepresentant .= " ".$orderDetail[$representant."_Nom"];
            $strRepresentant.="</strong>";
            //$strRepresentant .= " (".$orderDetail[$representant].")";
            $strRepresentant .= "<br />".$orderDetail[$representant."_Email"];

            if(strlen($orderDetail[$representant."_Tel"])>0)
                $strRepresentant .= "<br /><br />Tél : ".$orderDetail[$representant."_Tel"];

            //if(strlen($orderDetail[$representant."_Portable"])>0)
            //   $strRepresentant .= "<br />".$orderDetail[$_Portable."_Tel"];
        }
        ?>
        <p><?php echo $strRepresentant ?></p>

      </div>
      <div class="col-xs-9">
        <p><?php
        $site = \Website\Tool\MauchampHelper::getSiteAdresse($orderDetail["Site"]);
        $str = $site["name"]."<br /><br />".nl2br(\Website\Tool\MauchampHelper::getFormatedAdress($orderDetail["Site"]));//."<!--<br />Tél : ".$site["phone"];
        echo $str; 
        ?></p>
      </div>
  </div>
 


</div>


<div class="ft-content">

  

  <div class="cover-title-block">
  <div class="cover-title">
    <h1><?php echo $this->coverTitle; ?></h1>
    <hr/>
    <p>
      <?php echo $orderDetail["Type_Piece"]?> <?php echo $orderDetail["Code_Commande"]?> <br />
      <?php echo $orderDetail["Date"]?>
    </p>
  </div>
 </div>

  <div class="cover-product-block">
  <!-- First col -->
  <div class="ft-col-1">

  <p>
  <?php
  $products= array();
  $accessoires=array();
  foreach ($this->products as $product) {
    if(!$product->isAccessoire()) {
      if(!in_array($product->getName(), $products))
        $products[] = $product->getName();
    }
    else {
      if(!in_array($product->getName(), $accessoires))
       $accessoires[] = $product->getName();

    }
  }
      echo "<p><strong>".implode("<br />",$products).'</strong></p>';

  ?></p>
  </div>

  <div class="ft-col-2">
    <?php echo '<p><strong>Accessoires : </strong/>'.implode(", ",$accessoires).'</p>' ?>
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