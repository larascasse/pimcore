<?= $this->areablock("content"); ?>

<hr />

<div class="blog">
    <div class="card-columns clickable">
        <?php foreach ($this->articles as $article) { ?>
        
            <?= $this->template("/snippets/lpn-grid-realisations-item.php",array('article'=>$article)); ?>


        <?php } ?>
    </div>
    
</div>