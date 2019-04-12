<?php

$mustRender = $this->layout()->getLayout() == "layout-fiche-pdf";
$product = $this->product;
$cols = $this->cols>0?$this->cols:12/4;
$index = $this->index>0?$this->index:0;

if(!is_object($product)) {
    echo "Pas de produit";
    print_r($product);
    return;
}

$detailLink = $this->url(array(
    "id" => $product->getId(),
    "text" => $product->getName(),
    "prefix" => ""
        ), "produits");


$imageHtml = "";
if($product->getImage_1()) { 
    $imageHtml = '<img src="'.$product->getImage_1()->getThumbnail("productCategory")->getPath().'" class="img-responsive rollover">';   
} 

$subdesc = "";
$subDescArray = explode("\n",$this->product->getMage_sub_description());
if(is_array($subDescArray) && count($subDescArray)>0) {
    $subdesc .=  '<ul class="subdescription">';
    $subdesc .=  '<li>';
    $subdesc .=  implode("<br />", $subDescArray);

    foreach ($subDescArray as $key => $value) {
        //$subdesc .=  '<li>'.$value.'</li>';
    }
    $subdesc .=  "</li>";
    $subdesc .=  "</ul>";
} 


?>
<div class="row">
    <div class="col-xs-12">
         <h3 class="product-name"><?php echo $product->getMage_short_name(3000); ?></h3>
         <p class="subtype "><?php echo $product->getShort_description(); ?></p>
    </div>
    <div class="col-xs-8">
        <?php echo $imageHtml ?>
        <div class="tabledesc">
        <!--<p class="subtype "><?php echo ucfirst($product->getSubtype()); ?></p>-->
            <div class="actions">
                
            </div>

        </div>
    </div>
     <div class="col-xs-4">
        

    </div>
    <div class="col-xs-12">
         <?php echo $subdesc  ?>
         <?php  
         /*echo $this->template("/snippets/link-eshop-renderlet.php",array('product'=>$product,
                'btn_title'=>"XXX" //ne rien mettre pour avoir le prix
                )); */
       // echo '<a href="https://www.laparqueterienouvelle.fr/ean/'.$product->getSku().'" title="Voir '.$product->getName().'" class="" style="font-size: 0.5em;" target="_blank">https://www.laparqueterienouvelle.fr/ean/'.$product->getSku().'</a>';?>
    </div>
       
</div>     

