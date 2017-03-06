<?php

$columns = $this->getParam("columns", array(12));
$i = 0;

foreach ($this->columns as $column) {
    $name = "cs" . $column . "_" . $i++; ?>

    <div class="col-12 col-sm-<?= $column ?> col-md-<?= $column ?>">
        <?= $this->template("helper/areablock.php", array("name" => $name, "excludeBricks" => array("columns"))) ?>
    </div>

<?php } ?>
