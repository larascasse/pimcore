<?php



    // set page meta-data
    $this->headTitle()->set($this->article->getName());
    $content = "";
   
    
    /*** META */
    $description = strip_tags($content);
    $description = \Website\Tool\Text::getStringAsOneLine($description);
    $description = \Website\Tool\Text::cutStringRespectingWhitespace($description, 160);
    $this->headMeta($description, "description");
    


    $imagesArray = $this->article->getImagesAssets();

    if(is_array($imagesArray->assets) && count($imagesArray->assets)>0) {
         $posterImage = $imagesArray->assets[0]->getThumbnail("content");
         $this->headMeta($posterImage->getPath(), "og:image");
        if(($product = $imagesArray->assets[0]->getRelatedProduct()) instanceof Object_Product) {
            echo $product->getName();
        }

    }
   
    
    /*if($this->article->getPosterImage()) {
        
    }*/

//TODO => HELPER









//print_r($imagesArray);
 $content.='<div class="row">';
foreach ($imagesArray->assets as $asset) {
     $content.='<div class="col-sm-4">';
     $content .='<div class="thumbnail">';
     $content.= $asset->getThumbnail("exampleScaleWidth")->getHTML(["class" => "img-responsive"]);
      $content.='</div>';
      $content.='</div>';
}
 $content.='</div>';

?>
<section class="area-wysiwyg" style="padding-left: 10%; padding-right:10%">

    <div class="page-header">
        <h1 class="text-center"><?= $this->article->getName(); ?></h1>

        <?php if($posterImage ) {
            echo  $posterImage->getHTML(["class" => "img-responsive"]);

        }
    ?>
    </div>

    <?php $this->template("project-post/meta.php"); ?>

    <hr />


    <div class="row">
    <div class="col-sm-8">
    <?= $content ; ?>
    </div>
    <div class="col-sm-3">
    <p class="lead"><?= $this->article->getDescription(); ?></p>
    </div>
    </div>

    



</section>