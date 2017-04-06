<div class="image-header-container noimg">
    <div>
      <h1>Projets</h1>
      <?php  echo $this->template("/project-category/dropdown.php",array('category'=>$this->category,'categories'=>$this->categories)); ?>
    </div>
</div>


<?php



?>



<div class="blog">
    <div class="card-columns">
        <?php 
          
           foreach ($this->projects as $project) { 


          echo $this->template("/snippets/lpn-grid-realisations-item.php",array('article'=>$project)); ?>

        <?php } ?>
    </div>
    
</div>