<section class="area-image">

    <div style="position: relative;">
        <?= $this->image("image", array(
            "thumbnail" => "content"
        )) ?>

        <?php if(!$this->editmode) { ?>
            <?php // markers ?>
            <?php foreach ($this->image("image")->getMarker() as $marker) { ?>
                <?php
                    $title = "";
                    $productName="";
                    foreach($marker["data"] as $d) {
                        if($d["name"] == "title") {
                            $title = $d["value"];
                        }
                        if($d["name"] == "product") {
                            $product = Object_Concrete::getByPath($d["value"]);
                            $productName = $product->getName();
                        }
                    }
                    $title = strlen($productName)>0?"":'title="'.$title.'"';
                    $description = strlen($productName)>0?'desc="'.$productName.' - '.$product->getShort_description().'"':'';
                ?>
                <div class="image-marker"
                     style="top:<?=$marker["top"] ?>%; left:<?=$marker["left"] ?>%;"
                     data-toggle="tooltip"
                     <?php echo $title; ?>
                     <?php echo  $description ?>
                    ></div>
            <?php } ?>
        <?php } ?>

        <?php if(!$this->editmode) { ?>
            <?php // hotspots ?>
            <?php foreach ($this->image("image")->getHotspots() as $hotspot) { ?>
                <?php
                    $title = "";
                    $productName="";
                    foreach($hotspot["data"] as $d) {
                        if($d["name"] == "title") {
                            $title = $d["value"];
                        }
                        if($d["name"] == "product") {
                            $productName = $d["value"];
                        }
                    }
                ?>
                <div  class="image-hotspot"
                      style="width: <?=$hotspot["width"] ?>%; height: <?=$hotspot["height"] ?>%; top:<?=$hotspot["top"] ?>%; left:<?=$hotspot["left"] ?>%;"
                      data-toggle="tooltip"
                      title="<?php echo $title."/".$productName; ?>"
                    ></div>
            <?php } ?>
        <?php } ?>
    </div>
</section>