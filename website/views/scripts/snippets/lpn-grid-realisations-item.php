
<div class="card clickable">
<?php


$article = $this->article;
    
/*** MARCHE PAS DANS WEBSERCIVE project:category/all
//TODO, FB TOTDO
      $detailLink = $this->url([
          //"id" => $article->getId(),
          //"text" => $article->getName(),
          //"prefix" => $this->document->getFullPath()
          "key" => $article->getKey()
      ], "projet", false);
      */

$detailLink = '/projet/'.$article->getKey();
$product = $article->getRelatedProduct();

    ?>
           

<?php if($article->getPosterImage()) { ?>
    <?= $article->getPosterImage()->getThumbnail("magento-real-grid")->getHTML(["class" => "card-img-top__ img-fluid norelazy__"]) ?>
<?php } ?>

<div class="card-block">
 <a href="<?= $detailLink; ?>">
  <h4 class="card-title"><?= $article->getName() ?></h4>
  <p class="card-text"><?= $article->getAccroche(); ?></p>
  <!--<p class="card-text"><?= $article->getKey(); ?></p>-->
  
 </a>
</div>
<?php if($product) { ?>
    <!--<div class="card-footer">
      <small class="text-muted"><?= $product->getName(); ?></small>
  </div>-->
  <?php } ?>
</div>
