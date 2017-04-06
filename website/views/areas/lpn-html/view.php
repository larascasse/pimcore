 
<?php 
if($this->editmode) { 
?>
<h2>Source HTML </h2>  
<?php } ?>
<?= $this->input("html",
    [
        "width" => '100%',
        "height" => 500,
        "htmlspecialchars" => false,
        "placeholder" => "Source HTML brut"

]); ?>

