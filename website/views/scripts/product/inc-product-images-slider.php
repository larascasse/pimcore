<?php

$product = $this->product;

$assetsArray = $this->product->getImageAssetArray($realisation=true);




//ne pas modifier, voir dans
$carousel_js_id = 'caroussel-'.$product->getEan();
?>
<div id="container-<?php echo $carousel_js_id;?>" style="display:none">
<div id="<?php echo $carousel_js_id;?>" class="carousel slide">
    <!-- Indicators -->
    <ol class="carousel-indicators">
        <li data-target="#<?php echo $carousel_js_id;?>" data-slide-to="0" class="active"></li>
        <?php for($i=1; $i<count($packshotsImages); $i++) { ?>
        <li data-target="#<?php echo $carousel_js_id;?>" data-slide-to="<?php echo $i; ?>"></li>
        <?php } ?>
    </ol>
    <div class="carousel-inner">
   

             <?php 
            $count=0;
            $i=0;
            foreach ($assetsArray as $asset) {
              
                $image = $asset;
                ?>
                 <div class="carousel-item <?php if($i==1) { ?> active<?php } ?>">
                    <img class="d-block" src="<?php echo $image->getThumbnail("productCarousel"); ?>">
                    <div class="container">
                        <div class="carousel-caption">
                            <!--<h1><?php echo $this->product->getName(); ?></h1>
                            <div class="caption"></div>
                            <div class="margin-bottom-10"></div>-->
                        </div>
                    </div>
                </div>
            <?php 
            $i++;
            } ?>


    </div>
    <a class="carousel-control-prev" href="#<?php echo $carousel_js_id;?>" role="button" data-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="sr-only">Previous</span>
  </a>
  <a class="carousel-control-next" href="#<?php echo $carousel_js_id;?>" role="button" data-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="sr-only">Next</span>
  </a>

</div>
</div>