<?php
$defaultName= isset($this->category)?$this->category->getName():"Tous les projets";
?>

<ul class="nav justify-content-center">
  <li class="nav-item dropdown">
    <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false"><?php echo $defaultName ?></a>
    <div class="dropdown-menu">
    <?php if (!isset($this->category)) { ?>
      <a class="dropdown-item" href="/realisations-parquet-design">Tous les projets</a>
    <?php } ?>
    
    <?php foreach ($this->categories as $allCategory) { 
        ?>
      <a class="dropdown-item <?php echo (isset($this->category) && $allCategory->getId()== $this->category->getId())?"active":"";?>" href="/projets/category/<?php echo $allCategory->getKey() ?>"><?php echo $allCategory->getName() ?></a>
      <?php 

      } ?>
    </div>
  </li>
</ul>