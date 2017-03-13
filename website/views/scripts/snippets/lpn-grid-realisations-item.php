
<div class="card">
<?php
$article = $this->article;
        $detailLink = $this->url([
            //"id" => $article->getId(),
            //"text" => $article->getName(),
            //"prefix" => $this->document->getFullPath()
            "key" => $article->getKey()
        ], "projet", true);
        $product = $article->getRelatedProduct();
    ?>
           

<?php if($article->getPosterImage()) { ?>
    <?= $article->getPosterImage()->getThumbnail("content")->getHTML(["class" => "card-img-top__ img-fluid norelazy__"]) ?>
<?php } ?>

<div class="card-block">
 <a href="<?= $detailLink; ?>">
  <h4 class="card-title"><?= $article->getName() ?></h4>
  <p class="card-text"><?= $article->getDescription(); ?></p>
  
 </a>
</div>
<?php if($product) { ?>
    <!--<div class="card-footer">
      <small class="text-muted"><?= $product->getName(); ?></small>
  </div>-->
  <?php } ?>
</div>
