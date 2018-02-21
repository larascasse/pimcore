<?php

$orderDetail = $this->orderDetail;
$hasEmailContact = strlen($orderDetail["Email_Client"])>0;
$xmlClient = $this->xmlClient;

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


  /** PDF */
  $('.embed-pdf').on('click',function(e) {
      e.preventDefault();
      showEmbededPdf($(this).attr('href'));

      
  });


});


function showProductPhotos(ean) {
  console.log("SHow "+ean);
  var carouselId = 'caroussel-'+ean;
  var carouselContainer = '#container-'+carouselId;
  console.log($('#'+carouselId),carouselContainer,$(carouselContainer))

  $('#photomodal .modal-body').html($(carouselContainer).html());
  $('#photomodal #'+carouselId).attr('id','modalcarousel');
  $('#photomodal .carousel-control-prev').attr('href','#modalcarousel');
  $('#photomodal .carousel-control-next').attr('href','#modalcarousel');
  $('#photomodal .carousel-indicators li').attr('data-target','#modalcarousel');

  //$('#photomodal').modal('handleUpdate')
  
  //$('#modalcarousel').carousel();

  $('#photomodal:has(.carousel)').on('shown', function() {
      var $carousel = $(this).find('.carousel');

      if ($carousel.data('carousel') && $carousel.data('carousel').sliding) {
      $carousel.find('.active').trigger($.support.transition.end);
      }
    }
  );
  $('#photomodal').modal({animation: false});
  //$('.'+carouselId).carousel();

}


function showPleaseWait () {
            $('#pleasewaitmodal').modal({animation: false});
        };

function hidePleaseWait () {
            $('#pleasewaitmodal').modal('hide');
        };




function sendEmail() {
  window.log("sendEmail",$("#mailform"),$("#mailform").serialize());

  $('#formEmail').modal('hide');
  showPleaseWait();
  setTimeout(function(){ 
    hidePleaseWait(); 
    }, 3000);
  
  $.ajax({
     url : '/?controller=mauchamp&action=mauchamp-sendmail',
     data: $("#mailform").serialize()+'&sendmail=true',
     method : "POST",
     success: function (data) {

            //hidePleaseWait();
           // btn.disabled=false;
            alert(data.message);

      },
      error: function (transport) {
        
             // btn.disabled=false;
              //console.log(transport);
              
              //hidePleaseWait();
              window.log("transport",transport);
              if(transport.message)
               alert(transport.message);

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
            
            showEmbededPdf(data.pdfFileUrl);

      },
      error: function (transport) {
        
             // btn.disabled=false;
              //console.log(transport);
              
              hidePleaseWait();
              alert(transport.statusText);

      }
  });
}

function showEmbededPdf(pdfUrl) {
  PDFObject.embed(pdfUrl, "#pdf-container");
  $('#pdfmodal').modal().handleUpdate();
}

</script>
<form id="mailform">
<div style="padding-top: 80px;">
	<table class="table table-bordered table-striped">
		<thead class="thead-inverse__">


<?php
$hasOnePose = false;

foreach ($this->products as $product) {
  echo $this->template("product/inc-product-images-slider.php",array("product"=>$product));


  if(strlen($urlFichePose = $product->getMage_notice_pose_lpn())>0) {
    $hasOnePose = true;
  }
 // if(isset($product) && !$product->isAccessoire() && count($product->getImageAssetArray())>0)
  //  $hasOnePhoto = true;

}
?>
			<tr>
      <th>EAN</th>
      <th>Nom</th>
      <!--<th colspan="2"><input type="checkbox" id="selectAllFt" /></th>-->
      
      <th colspan="1"></th>
      <?php if ($hasOnePose) : ?>
      <!--<th colspan="2"><input type="checkbox" id="selectAllPose" /></th>-->
      <th colspan="1"></th>
    <?php endif ?>
     <!-- <th colspan="2"><input type="checkbox" id="selectAllPhoto" /></th>-->
      <th colspan="1"></th>
    </tr>
		</thead>
		<tbody>

<?php

//print_r($this->products);


foreach ($this->products as $product) {
	$sku = $product->getSku();
  $hasPose = strlen($urlFichePose = $product->getMage_notice_pose_lpn())>0;
  $hasPhoto = isset($product) && !$product->isAccessoire() && count($product->getImageAssetArray())>0;
	?>
	<tr class="row__">
	<td class="col__"><?php echo $sku ?></td>
	<td class="col__"><?php echo $product->getMage_short_name(3000)?>
    <?php if ($product->isParquet()): 

      $chauffantBasseTemperature = Object_Service::getOptionsForSelectField($product,"chauffantBasseTemperature")[$product->getChauffantBasseTemperature()];
      $chauffantRadiantElectrique = Object_Service::getOptionsForSelectField($product,"chauffantRadiantElectrique")[$product->getChauffantRadiantElectrique()];
      $solRaffraichissant = Object_Service::getOptionsForSelectField($product,"solRaffraichissant")[$product->getSolRaffraichissant()];

      ?>
    <p class="small">Sol chauffant basse temperature : <?php echo  $chauffantBasseTemperature; ?><br />Sol chauffant basse température électrique : <?php echo  $chauffantRadiantElectrique; ?><br />Sol basse température réversible : <?php echo  $solRaffraichissant; ?></p></td>
	<?php endif; ?>
	<!--<div class="col"><a href="<?php echo $product->getMage_fichepdf()?>" class="btn noajaxload" target="_blank">Fiche technique V1</a></div>-->
	<!--<td class="col__"><input type="checkbox" class="check-ft" name="ft[]" value="<?php echo $product->getSku()?>"/></td>-->
	<td class="col__"><a href="<?php echo $product->getMage_fichepdf()?>?_dc=<?php echo time()?>" class="btn-link noajaxload table-selectionner-btn__ embed-pdf" target="_blank" value="<?php echo $sku ?>">Fiche technique</a></td>


<?php if($hasPose) : ?>
	<!--<td class="col__"><input type="checkbox"  class="check-pose"  name="pose[]" value="<?php echo $product->getSku()?>"/></td>-->
	<td class="col__"><a href="/id/<?php echo $product->getId()?>?_dc=<?php echo time()?>" class="btn-link noajaxload table-selectionner-btn__ embed-pdf" target="_blank" value="<?php echo $sku ?>">Pose</a></td>
    <?php elseif($hasOnePose) : ?>
    
    <td></td>
      
<?php endif; ?>

  <!-- 
    <td class="col__">
      <?php if($hasPhoto) : ?>
     <input type="checkbox"  class="check-photo"  name="photos[]" value="<?php echo $product->getSku()?>"/>
      <?php endif; ?>
    </td>-->
    <td class="col__">
       <?php if($hasPhoto) : ?><!--<a href="/?controller=web2print&action=get-product-photo-pdf&id=<?php echo $product->getId()?>&_dc=<?php echo time()?>" class="btn-link noajaxload btn-inverse_ embed-pdf" target="_blank">Photos</a>-->
        <a href="#" class="btn-link noajaxload btn-inverse_" onclick="showProductPhotos('<?php echo $product->getEan()?>');return false;">Photos</a>
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


<?php
//pas de bouton si pas de prouits 
if(count($this->products)>0) : ?>
<div class="row">
	<div class="col-12 text-right">
    
		<a class="btn  btn-outline-primary" data-toggle="modal" data-target="#formEmail"  href="#formEmail" aria-expanded="false" aria-controls="formEmail" role="button">Envoyer la sélection par email</a>
    <input type="button" class="btn  btn-outline-primary" value="Voir / Sauvegarder / Imprimer" id="printbook" onclick="printBook();return false;" />
	</div>
</div>
</div>
<textarea  cols="100" rows="20" name="xml"  style="display: none"><?php echo $this->xmlOrder ?></textarea>





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
            <input type="text" class="form-control form-control-success" id="inputSuccess1" value="<?php echo "Voici le détail de votre ".strtolower($orderDetail["Type_Piece"])." n°".$orderDetail["Code_Commande"]." @ La Parqueterie Nouvelle" ?>" name="subject">
            <!--<div class="form-control-feedback">Success! You've done it.</div>
            <small class="form-text text-muted">Example help text that remains unchanged.</small>-->
           </div>

          <div class="form-group">
            <label class="form-control-label" for="inputWarning1">Message</label>

            <?php
            //messages
        
        
        if(strlen($orderDetail["Representant2"])>0) 
          $representant = "Representant2";

        else if(strlen($orderDetail["Representant"])>0) 
          $representant = "Representant";

        $strRepresentant = "";
        if(isset($representant)) {
            $strRepresentant .= $orderDetail[$representant."_Prenom"];
            $strRepresentant .= " ".$orderDetail[$representant."_Nom"];
           // $strRepresentant .= " (".$orderDetail[$representant].")";
            $strRepresentant .= "\n".$orderDetail[$representant."_Email"];

            $strRepresentant .= "\n";


            if(strlen($orderDetail[$representant."_Tel"])>0)
                $strRepresentant .= "\nTél : ".$orderDetail[$representant."_Tel"];

            //if(strlen($orderDetail[$representant."_Portable"])>0)
            //   $strRepresentant .= "<br />".$orderDetail[$_Portable."_Tel"];
        }

         $site = \Website\Tool\MauchampHelper::getSiteAdresse($orderDetail["Site"]);
        $strSite = $site["name"]."\n".\Website\Tool\MauchampHelper::getFormatedAdress($orderDetail["Site"])."\nTél : ".$site["phone"];


        ?>
       <textarea class="form-control" rows="10" id="inputWarning1" name="message">Bonjour,

Vous trouverez, en pièce jointe, toutes les informations relatives à votre <?php echo strtolower($orderDetail["Type_Piece"]) ?> n° <?php echo $orderDetail["Code_Commande"]?>.

Si vous avez besoin de plus amples informations, je me tiens à votre disposition :)

<?php echo $strRepresentant ?>

<?php echo $strSite ?>
  
</textarea>
            

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

<br /><br /><br /><br />
<div class="row" style="padding-top: 40px">
  <div class="col-12">
<?php
/* Cover */
echo $this->template("mauchamp/inc-mauchamp-magento-client.php",array("email"=>$orderDetail["Email_Client"],"xmlClient"=>$xmlClient));

?>
</div>
</div>

<?php 

else :
  //echo count($this->products);
endif; ?>


<div id="pleasewaitmodal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
  <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
               <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
        <div class="modal-body">
        <br />
        En cours de traitement
        <br />
      </div>
      </div>
    </div>
</div>

<div id="pdfmodal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel2" aria-hidden="true">
  <div class="modal-dialog modal-lg" style="max-width: 90%;">
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

<div id="photomodal" class="modal" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-lg" style="max-width: 90%;">
      <div class="modal-content">
        <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

        <div class="modal-body">
        
      </div>
      </div>
    </div>
</div>


 </form>

<p class="small" style="color:#cccccc">

<div>
  <br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br />
<textarea  cols="100" rows="20" name="xmldebug" style="font-size:10px; color:#CCCCCC"><?php echo $this->xmlOrder ?></textarea>
</div>

<?php 
//var_dump($_SERVER); 

?>
</p>
