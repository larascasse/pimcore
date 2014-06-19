
<!-- Begin Realisations -->
<div id="home_realisation" class="row">
<ul class="slider_lpn">

<?php
$count = $this->select("carouselSlides")->getData();
if(!$count) {
    $count = 1;
}
for($i=0; $i<$count; $i++) {
if($this->image("cImage_".$i)->getThumbnail("magento_realisation"))
$urlImage =  'http://'.$_SERVER['HTTP_HOST'].$this->image("cImage_".$i)->getThumbnail("magento_realisation")->getPath();
else
  $urlImage ="";  


//Realsisation
$arrayImages=array();
$realisationsFolder =$this->href("cGallery".$i)->getElement();
if($realisationsFolder instanceof Asset_Folder) {

    $assets=Asset_Folder::getById($realisationsFolder->id)->getChilds();
    foreach ($assets as $asset) {
        $assetsArray[] = $asset;
        $arrayImages[] = 'http://'.$_SERVER['HTTP_HOST'].$asset->getThumbnail("magento_realisation");
    }
}

if(count($arrayImages)>0)
    $datazoom = implode("|",$arrayImages);
else
    $datazoom = $urlImage;
?>

<li data-zoom="<?= $datazoom ?>" class="<?= ($i==0?'norelazy':'') ?>">
<div class="nsg_container col-md-16">
<div>
<?php if ($this->editmode) { ?>

<?= $this->image("cImage_".$i,array(
    "thumbnail" => "magento_small",
    "attributes" => array(
        "custom-attr" => "value",
        "data-role" => "image"
    )
)
);

} else { 

    echo '<img src="'.$urlImage.'" title="'.$this->image("cImage_".$i)->getText().'" alt="'.$this->image("cImage_".$i)->getAlt().'" class="'.($i==0?'norelazy':'').'" />';
}
?></div>
<div class="nsg_abs">
<?php if ($this->editmode) { echo $this->checkbox("cHidden_".$i,array('boxLabel'=>'Cacher le picto','width'=>200)); echo '<br/>'; } ?>
<div class="<?= $this->checkbox("cHidden_".$i)->isChecked() ? "realisationpictohidden" : "realisationpicto" ?>">Réalisations</div>
<div class="realisationtitle"><?php if($this->editmode) echo "Titre";?><?= $this->input("cTitle_".$i, ["width" => 900]); ?></div>
<div class="realisationcontent"><?php if($this->editmode) echo "Content";?><?= $this->input("cContent_".$i, ["width" => 900]); ?></div>
<div class="jspush">
<?php if ($this->editmode) { 
    echo 'Product :'.$this->href("cProduct".$i,array(
        "types"=>array("object"),
        "classes" => array("product"),
        "reload" => true,
        "width" =>200,
    )); 

    echo 'Gallery :'.$this->href("cGallery".$i,array(
        "types"=>array("asset"),
        "width" =>200,
    )); 


} else { 
        $product = $this->href("cProduct".$i)->getElement();
        if($product ) {
            $ean =  $product->getEan();

            if(!(strlen($ean)>4))
                $ean =  $product->getCode();
        }
        else {
            $product = $this->image("cImage_".$i)->getImage()->getProperty("product");
            if(!$product) {
                $ean = $this->image("cImage_".$i)->getImage()->getMetadata("product");
                $product = Object_Product::getByEan($ean)->objects[0];
                if(!$product) {
                    $product = Object_Product::getByCode($ean)->objects[0];
                }
            }
            else {
                $ean=$product->getEan()?$product->getEan():$product->getCode();
            }
            
        }

        $name="";
        $description="";
        if($product) {
            $name =  $product->getName();

             $description = $product->getShort_description();
            $description = str_replace("\n", "|", $description);
        }
        

        echo '<div class="realisationpush col-xs-16 col-md-10">'.$name.'<br />'.$description .' | EAN : '.$ean.'</div>';
        echo '<div class="realisationlink col-xs-16 col-md-6">{{block type="core/template" template="lpn/lpn_product_link.phtml" name="givemetheprice_'.$ean.'" product_sku="'.$ean.'" class="btnarrow pull-right"}}</div>';
        

  }
   ?>
   </div>


</div>
</div>
</li>
<?php } ?>
</ul>
<div class="clearfix">&nbsp;</div>
<a class="slider_lpn_prev prev" style="display: block;" href="#">&lt;</a> <a class="slider_lpn_next next" style="display: block;" href="#">&gt;</a>
<div class="slider_lpn_push row">&nbsp;</div>
</div>
<?php if($this->editmode) { ?>
    <div class="container" style="padding-bottom: 40px">
        Number of Slides: <?= $this->select("carouselSlides", [
            "width" => 60,
            "reload" => true,
            "store" => [[1,1],[2,2],[3,3],[4,4],[5,5],[6,6],[7,7],[8,8],[9,9]]
        ]); ?>
    </div>
<?php } ?>
<!-- END Realisations -->
