<?= $this->areablock("content"); ?>

<ul class="nav nav-tabs justify-content-center">
  <li class="nav-item dropdown">
    <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">Tous les projets</a>
    <div class="dropdown-menu">
    <?php foreach ($this->categories as $category) { ?>
      <a class="dropdown-item" href="/projets/category/<?php echo $category->getKey() ?>"><?php echo $category->getName() ?></a>
      <?php } ?>
    </div>
  </li>
</ul>


<div class="blog">
    <div class="card-columns">
        <?php foreach ($this->articles as $article) { ?>
        
            <?= $this->template("/snippets/lpn-grid-realisations-item.php",array('article'=>$article)); ?>

        <?php } ?>
    </div>
    
</div>