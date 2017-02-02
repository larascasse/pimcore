<?php

namespace Pimcore\Model\Object\Fieldcollection\Data;


    // set page meta-data
    $this->headTitle()->set($this->article->getTitle());
    $content = $this->article->getAccroche();
   
    $contentCollection = $this->article->getContent();
    
    // echo "<pre>";
       // print_r($contentItem->getFieldDefinitions());
       // print_r($contentCollection->getItemDefinitions());
    //    echo "</pre>";

    $content = "";
    foreach ($contentCollection->items as $contentItem) {
        $fieldCollectionName = $contentItem->type;
      //   echo "<pre>";
       //print_r($contentItem->getObject());
        //echo($contentItem);
      //  echo "</pre>";
       if($contentItem instanceOf BlocImage) {
            $total = 0;
            if($image1 = $contentItem->getImage1()) {
                $total ++;
            }
            if($image2 = $contentItem->getImage2()) {
                $total ++;
            }
            if($image3 = $contentItem->getImage3()) {
                $total ++;
            }
            if($image4 = $contentItem->getImage4()) {
                $total ++;
            }
            if($total>0) {
                $content.= '<div class="row" style="margin-top: 30px; margin-bottom: 30px;">';
                for($i=0;$i<$total;$i++) {
                    $content.= '<div class="col-md-'.(12/$total).'">';
                    if($image1) {
                        $content.= $image1->getThumbnail("content")->getHTML(["class" => "img-responsive"]);
                        unset($image1);
                    }
                    else if($image2) {
                        $content.= $image2->getThumbnail("content")->getHTML(["class" => "img-responsive"]);
                        unset($image2);
                    }
                    else if($image3) {
                        $content.= $image3->getThumbnail("content")->getHTML(["class" => "img-responsive"]);
                        unset($image3);
                    }
                    else if($image4) {
                        $content.= $image4->getThumbnail("content")->getHTML(["class" => "img-responsive"]);
                        unset($image3);
                    }
                    $content.= '</div>';
                }
                
                $content.= '</div>';

            }
       }
       else  if($contentItem instanceOf ProductList) {
        if(is_array($contentItem->products) && count($contentItem->products)>0) {
                $content.= '<div class="row" style="margin-top: 30px; margin-bottom: 30px;">';
                foreach ($contentItem->products as $key => $product) {
                    //print_r($product);
                    $content.= '<div class="col-md-4">';
                    $content.= '<div class="thumbnail">';
                    $content.= $product->getImage_1()->getThumbnail("magento_selection")->getHTML();
                    $content.= '<div class="caption">';
                     $content.= '<p>'.$product->getSubtype().'</p>';
                    $content.= '<h3>'.$product->getMage_short_name().'</h3>';
                    $content.= '<p>'.$product->getShort_description().'</p>';
                    $content.= '<p><a href="#" class="btn btn-primary" role="button">Acheter</a> <a href="#" class="btn btn-default" role="button">Voir en détail</a></p>';
                    $content.= '</div>';
                    $content.= '</div>';

                    $content.= '</div>';
                    
                    # code...
                }
                $content.= '</div>';
        }
            
       }
        else  if($contentItem instanceOf Text) {
            $content.= '<div class="row" style="margin-top: 30px; margin-bottom: 30px;">';
            $content.= '<div class="col-md-12">';
             $content.= $contentItem->getContent();
            $content.= '</div>';
            $content.= '</div>';
       }
    }

    /*** META */
    $description = strip_tags($content);
    $description = \Website\Tool\Text::getStringAsOneLine($description);
    $description = \Website\Tool\Text::cutStringRespectingWhitespace($description, 160);
    $this->headMeta($description, "description");
    
    if($this->article->getPosterImage()) {
        $this->headMeta($this->article->getPosterImage()->getThumbnail("content")->getPath(), "og:image");
    }

?>
<section class="area-wysiwyg" style="padding-left: 10%; padding-right:10%">

    <div class="page-header">
        <h1 class="text-center"><?= $this->article->getTitle(); ?></h1>
        <p class="lead text-center"><?= $this->article->getAccroche(); ?></p>
    </div>

    <?php $this->template("blog-post/meta.php"); ?>

    <hr />

    <?= $content ; ?>
    <!--
    <?php if($this->article->getPosterImage()) { ?>
        <?= $this->article->getPosterImage()->getThumbnail("content")->getHTML() ?>
        <br /><br />
    <?php } ?>
    -->
    



</section>