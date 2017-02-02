<div class="text-center">
<i class="glyphicon glyphicon-list"></i>
<?php foreach ($this->article->getCategory() as $key => $category) { ?>
    <a href="?category=<?= $category->getId() ?>"><?= $category->getName() ?></a><?php
    if (($key+1) < count($this->article->getCategory())) {
        echo ",";
    }
    ?>
<?php } ?>
</div>
