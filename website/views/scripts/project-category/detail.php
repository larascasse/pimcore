<?php


?>
<ul class="nav nav-tabs justify-content-center">
  <li class="nav-item dropdown">
    <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false"><?php echo $this->category->getName()?></a>
    <div class="dropdown-menu">
    <?php foreach ($this->categories as $allCategory) { 
        // print_r($categories);
        //die;
     // echo '<hr>';
//print_r($categories);

    //  die;
        ?>
      <a class="dropdown-item <?php echo ($allCategory->getId()== $this->category->getId())?"active":"";?>" href="/projets/category/<?php echo $allCategory->getKey() ?>"><?php echo $allCategory->getName() ?></a>
      <?php 
       echo $allCategory->getKey();
   

      } ?>
    </div>
  </li>
</ul>


<div class="blog">
    <div class="card-columns">
        <?php 
          
           foreach ($this->projects as $project) { 
           

          echo $this->template("/snippets/lpn-grid-realisations-item.php",array('article'=>$project)); ?>

        <?php } ?>
    </div>
    
</div>