<div class="image-header-container  noimg">
    <div>
      <h1>Projets</h1>
            <?php  echo $this->template("/project-category/dropdown.php",array('category'=>$this->category,'categories'=>$this->categories)); ?>

    </div>
</div>

<?php

 echo $this->template("/project-category/dropdown.php",array('category'=>$this->category,'categories'=>$this->categories)); 

?>



<div class="blog">
    <div class="card-columns">
        <?php foreach ($this->articles as $article) { ?>
        
            <?= $this->template("/snippets/lpn-grid-realisations-item.php",array('article'=>$article)); ?>

        <?php } ?>
    </div>
    
</div>