 
<?php 
if($this->editmode) { 
?>
<h2>Source HTML </h2>  
<?php } ?>
<?= $this->textarea("html",
    [
        "width" => '100%',
        "height" => 500

]); ?>

