

<?php if($this->editmode): ?>
    <?= $this->multihref("objectPaths",
    [
        "types" => ["object"],
        "classes" => ["projectPost"],
        "title" => "Faire glisser des réalisations"

    ]); ?>
<?php else: ?>
<div class="blog">
<div class="card-columns clickable">
<?php foreach($this->multihref("objectPaths") as $article) {

	$this->template("/snippets/lpn-grid-realisations-item.php",array('article'=>$article)); ?>

<?php } ?>
   


    </div>
    
</div>
  

<?php endif; ?>
