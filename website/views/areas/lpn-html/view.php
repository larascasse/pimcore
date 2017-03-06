 
<?php 
if($this->editmode) { 
?>
<h2>SOurce HTML </h2>  
<?php } ?>
<?= $this->textarea("html",
    [
        "width" => 500

]); ?>

